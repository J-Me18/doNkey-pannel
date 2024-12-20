<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Message\CreateMessageRequest;
use App\Models\Message;
use App\Models\site;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageControler extends Controller
{
    public function createMessage(CreateMessageRequest $request)
    {
        $validator = $request->validated();
        if ($request->has('attachment')) {
            $imageDecode = base64_decode($validator['attachment']);
            if ($imageDecode !== false) {
                $imageName = uniqid() . ".jpeg";
                file_put_contents(public_path('attachment') . '/' . $imageName, $imageDecode);
                $validator['attachment'] = $imageName;
            }
        }
        $message = Message::create($validator);
        $user = User::where('id', $validator['reciver_id'])?->first();
        $driver = User::where('user_id', $validator['reciver_id'])?->first();
        if (isset($user) || isset($driver)) {
            $fcm_token = site::where('id', 1)?->first();
            $title = "New Message Arrived";
            $content = $validator['message'];
            $user = $user != "" ? $user : $driver;
            $result = $this->sendNotification($user, $fcm_token, $title, $content);
        }

        return new JsonResponse([
            'status' => 'true',
            'message' => 'message send successfully'
        ]);
    }

    public function reciveMessage()
    {
        $messages = Message::when(request('reciver_id'), function ($query, $reciver_id) {
            $query->where('sender_id', '=', $reciver_id)
                ->orWhere('reciver_id', '=', $reciver_id);
        })
            // ->latest()
            ->get()
            ->makeHidden(['updated_at', 'deleted_at']); // Apply hiding to the collection
        // return $messages;
        foreach ($messages as $message) {
            // Fetch sender
            $sender = User::where('id', $message?->sender_id)
                ->orWhere('user_id', $message?->sender_id)
                ->first();
            $message->sender = $sender;

            // Fetch receiver
            $receiver = User::where('id', $message?->reciver_id)
                ->orWhere('user_id', $message?->reciver_id)
                ->first();
            $message->receiver = $receiver;
        }
        return new JsonResponse([
            'status' => true,
            'message' => $messages
        ]);
    }

    public function sendNotification($user, $fcm_token, $title, $content)
    {
        if (isset($user)) {
            if ($user->is_driver == 1) {
                $token = $user->device_token;
                $fcm_token = $fcm_token->driverToken;
                $url = "https://fcm.googleapis.com/v1/projects/donkey-driver/messages:send";
            } else {
                $token = $user->device_token;
                $fcm_token = $fcm_token->userToken;
                $url = "https://fcm.googleapis.com/v1/projects/doncky-user/messages:send";
            }
            // Compile headers in one variable
            $headers = array(
                'Authorization: ' . $fcm_token,
                'Content-Type: application/json'
            );

            // Notification payload
            $notifData = [
                'title' => $title,
                'body' => $content,
            ];

            // Data payload (extra data)
            $dataPayload = [
                'title' => $title,
                'body' => $content,
                'story_id' => "story_12345"
            ];

            $apiBody = [
                'message' => [
                    'token' => $token, // Target device token
                    'notification' => $notifData,  // Notification section
                    'android' => [
                        'priority' => 'high',
                        'notification' => [
                            'sound' => 'default',
                            'channel_id' => '1101'
                        ]
                    ],
                    'apns' => [
                        'headers' => [
                            'apns-priority' => '10', // iOS notification priority
                        ],
                    ],
                    'data' => $dataPayload // Data section
                ]
            ];

            // Initialize CURL and set options
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));

            // Execute the call and save the response
            $result = curl_exec($ch);

            // Capture any CURL error
            if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
                Log::error("CURL error: " . $error_msg);
            } else {
                $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                Log::info("Response code: " . $responseCode);
            }

            // Log the entire result and response for debugging
            Log::info("FCM Response: " . $result);

            // Close CURL
            curl_close($ch);
            return $result;
        }
    }

    public function redDot(Request $request)
    {
        $validated = $request->validate([
            'userId' => 'required',
        ]);
        $unreadMessages = Message::where('reciver_id', $validated['userId'])
            ->whereNull('readBy')
            ->get();
        if (count($unreadMessages) > 0) {
            $visible = 1;
        } else {
            $visible = 0;
        }
        return new JsonResponse([
            'status' => true,
            'visible' => $visible
        ]);
    }

    public function readBy(Request $request)
    {
        $validated = $request->validate([
            'userId' => 'required',
        ]);
        $unreadMessages = Message::where('reciver_id', $validated['userId'])
            ->whereNull('readBy')
            ->get();
        foreach ($unreadMessages as $message) {
            $message->update([
                'readBy' => $validated['userId']
            ]);
        }
        return new JsonResponse([
            'status' => true,
            'message' => 'Message Readed Successfully'
        ]);
    }
}
