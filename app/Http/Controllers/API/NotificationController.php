<?php


namespace App\Http\Controllers\API;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\UserFcmTokens;


class NotificationController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendNotification($notification_request)
    {
        // $error_message = '';
        // $request = new \Illuminate\Http\Request();
        // $request->replace($notification_request);

        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'message' => 'required',
        //     'user_id' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $messages = $validator->errors();
        //     $error_message = $messages->first();
        // }
        // if (!$error_message) {
        //     $title = $notification_request['title'];
        //     $message = $notification_request['message'];
        //     $user_id = $notification_request['user_id'];
        //     $device_tokens = UserFcmTokens::where('user_id', $user_id)->pluck('fcm_token')->all();

        //     if ($device_tokens) {
        //         $SERVER_API_KEY = config('services.fcm.server_key');

        //         $data = [
        //             "registration_ids" => $device_tokens,
        //             "notification" => [
        //                 "title" => $title,
        //                 "body" => $message,
        //             ]
        //         ];
        //         $dataString = json_encode($data);

        //         $headers = [
        //             'Authorization: key=' . $SERVER_API_KEY,
        //             'Content-Type: application/json',
        //         ];
        //         $ch = curl_init();

        //         curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        //         curl_setopt($ch, CURLOPT_POST, true);
        //         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //         curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        //         $response = curl_exec($ch);
        //     }
        //     $notification_response = ['response_status_code' => 200, 'response_message' => 'Sent Successfully'];
        // } else {
        //     $notification_response = ['response_status_code' => 422, 'response_message' => $error_message];
        // }

        // return $notification_response;
        $error_message = '';
        $request = new \Illuminate\Http\Request();
        $request->replace($notification_request);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'message' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            $error_message = $messages->first();
        }
        if (!$error_message) {
            $title = $notification_request['title'];
            $message = $notification_request['message'];
            $user_id = $notification_request['user_id'];
            // $device_tokens = UserFcmTokens::where('user_id', $user_id)->pluck('fcm_token')->all();
            $device_tokens = UserFcmTokens::where('user_id', $user_id)->pluck('fcm_token')->all();

            if ($device_tokens) {
                $SERVER_API_KEY = config('services.fcm.server_key');

                $data = [
                    "registration_ids" => $device_tokens,
                    "notification" => [
                        "title" => $title,
                        "body" => $message,
                    ]
                ];
                $dataString = json_encode($data);

                $headers = [
                    'Authorization: key=' . $SERVER_API_KEY,
                    'Content-Type: application/json',
                ];
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

                $response = curl_exec($ch);
            }
            $notification_response = ['response_status_code' => 200, 'response_message' => 'Sent Successfully'];
        } else {
            $notification_response = ['response_status_code' => 422, 'response_message' => $error_message];
        }

        return $notification_response;
    }
}
