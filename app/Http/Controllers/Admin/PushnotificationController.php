<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pushnotification;
use App\Models\site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PushnotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Pushnotification::latest()->get()->map(function ($notification) {
            // Truncate the content to 150 characters
            $notification->content = Str::limit($notification->content, 150);
            return $notification;
        });

        return view('admin.notifications.index', ['notifications' => $notifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'type' => 'required',
            'image' => 'nullable'
        ]);
        // dd($validated);
        if ($request->hasFile('image')) {
            $imageName = uniqid() . "." . $request->image->extension();
            // dd($imageName);
            $request->image->move(public_path('pushnotification'), $imageName);
            $validated['image'] = $imageName;
            $imageUrl = url('public/pushnotification/' . $imageName);
        }
        $notification = $this->pushnotification($validated['type'], $validated['title'], $validated['content'], $imageUrl = $imageUrl != "" ? $imageUrl : null);
        // dd($notification);
        Pushnotification::create($validated);
        return back()->with('success', "Notification Sent");
    }

    public function pushnotification($type, $title, $content, $imageUrl)
    {
        // dd($type, $title, $content);

        if ($type == 2) {
            //user
            // dd("user");
            $tokens = User::where('is_driver', 0)->whereNotNull('device_token')->get()->pluck('device_token');
            $url = "https://fcm.googleapis.com/v1/projects/doncky-user/messages:send";
            $fcm_token = site::where('id', 1)->first()->userToken;
            $result = $this->SendNotificationToUser($tokens, $url, $fcm_token, $title, $content, $imageUrl);
        } elseif ($type == 3) {
            //driver
            $tokens = User::where('is_driver', 1)->whereNotNull('device_token')->get()->pluck('device_token');
            $url = "https://fcm.googleapis.com/v1/projects/donkey-driver/messages:send";
            $fcm_token = site::where('id', 1)->first()->driverToken;
            $result = $this->SendNotificationToDriver($tokens, $url, $fcm_token, $title, $content, $imageUrl);
        } else {
            if ($type == 1) {
                //user
                $tokens = User::where('is_driver', 0)->whereNotNull('device_token')->get()->pluck('device_token');
                $url = "https://fcm.googleapis.com/v1/projects/doncky-user/messages:send";
                $fcm_token = site::where('id', 1)->first()->userToken;
                $result = $this->SendNotificationToUser($tokens, $url, $fcm_token, $title, $content, $imageUrl);
                //driver
                $tokens = User::where('is_driver', 1)->whereNotNull('device_token')->get()->pluck('device_token');
                $url = "https://fcm.googleapis.com/v1/projects/donkey-driver/messages:send";
                $fcm_token = site::where('id', 1)->first()->driverToken;
                $result = $this->SendNotificationToDriver($tokens, $url, $fcm_token, $title, $content, $imageUrl);
            }
        }
    }

    public function SendNotificationToUser($tokens, $url, $fcm_token, $title, $content, $imageUrl = null)
    {
        if (count($tokens) > 0) {
            $headers = [
                'Authorization: ' . $fcm_token,
                'Content-Type: application/json'
            ];

            $notifData = [
                'title' => $title,
                'body' => $content,
            ];

            $dataPayload = [
                'title' => $title,
                'body' => $content,
                'story_id' => "story_12345"
            ];

            foreach ($tokens as $token) {
                $apiBody = [
                    'message' => [
                        'token' => $token,
                        'notification' => $notifData,
                        'android' => [
                            'priority' => 'high',
                            'notification' => [
                                'sound' => 'default',
                                'channel_id' => '1101',
                                'image' => $imageUrl
                            ]
                        ],
                        'apns' => [
                            'headers' => [
                                'apns-priority' => '10',
                            ],
                            'payload' => [
                                'aps' => [
                                    'mutable-content' => 1, // Required to show images on iOS
                                ],
                                'image' => $imageUrl // Add image URL for iOS
                            ],
                        ],
                        'data' => $dataPayload
                    ]
                ];

                // Initialize CURL and set options
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));

                $result = curl_exec($ch);

                // Log response and errors
                if (curl_errno($ch)) {
                    $error_msg = curl_error($ch);
                    Log::error("CURL error: " . $error_msg);
                } else {
                    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    Log::info("Response code: " . $responseCode);
                    Log::info("FCM Response: " . $result);
                }

                curl_close($ch);

                // Check for success in the response
                $response = json_decode($result, true);
                if (isset($response['error'])) {
                    Log::error("FCM Error: " . $response['error']['message']);
                }
            }
        } else {
            Log::warning("No tokens found to send notifications.");
        }
    }

    public function SendNotificationToDriver($tokens, $url, $fcm_token, $title, $content, $imageUrl)
    {
        if (count($tokens) > 0) {
            $headers = [
                'Authorization: ' . $fcm_token,
                'Content-Type: application/json'
            ];

            $notifData = [
                'title' => $title,
                'body' => $content,
            ];

            $dataPayload = [
                'title' => $title,
                'body' => $content,
                'story_id' => "story_12345"
            ];
            foreach ($tokens as $token) {
                // Combine tokens into a single request
                $apiBody = [
                    'message' => [
                        'token' => $token,
                        'notification' => $notifData,
                        'android' => [
                            'priority' => 'high',
                            'notification' => [
                                'sound' => 'default',
                                'channel_id' => '1101',
                                'image' => $imageUrl
                            ]
                        ],
                        'apns' => [
                            'headers' => [
                                'apns-priority' => '10',
                            ],
                            'payload' => [
                                'aps' => [
                                    'mutable-content' => 1, // Required to show images on iOS
                                ],
                                'image' => $imageUrl // Add image URL for iOS
                            ],
                        ],
                        'data' => $dataPayload
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
                    Log::info("FCM Response: " . $result);

                    // Check if the response contains errors
                    $response = json_decode($result, true);
                    if (isset($response['error'])) {
                        Log::error("FCM Error: " . $response['error']['message']);
                    }
                }

                // Close CURL
                curl_close($ch);

                return $result;
            }
        } else {
            Log::warning("No tokens found to send notifications.");
            return null;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pushnotification  $pushnotification
     * @return \Illuminate\Http\Response
     */
    public function show(Pushnotification $pushnotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pushnotification  $pushnotification
     * @return \Illuminate\Http\Response
     */
    public function edit(Pushnotification $pushnotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pushnotification  $pushnotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pushnotification $pushnotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pushnotification  $pushnotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pushnotification $pushnotification)
    {
        //
    }
}
