<?php

namespace App\Http\Controllers;

use App\Models\site; // Ensure correct casing
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FirebaseController extends Controller
{
    public function getAccessTokenUser()
    {
        return $this->getAccessToken('user_server_key.json', 'userToken');
    }

    public function getAccessTokenDriver()
    {
        return $this->getAccessToken('driver_server_key.json', 'driverToken');
    }

    private function getAccessToken($keyFileName, $tokenField)
    {
        $keyFilePath = storage_path("app/$keyFileName"); // Path to your JSON key file

        if (!file_exists($keyFilePath)) {
            Log::error('Service account key file not found: ' . $keyFileName);
            return response()->json(['error' => 'Service account key file not found.'], 404);
        }

        // Read the JSON key file
        $keyFile = json_decode(file_get_contents($keyFilePath), true);

        // Prepare the JWT
        $header = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);
        $claims = [
            'iss' => $keyFile['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud' => $keyFile['token_uri'],
            'exp' => time() + 3600, // Token expiration (1 hour)
            'iat' => time(), // Issued at
        ];

        $jwtHeader = base64_encode($header);
        $jwtClaims = base64_encode(json_encode($claims));

        // Create the unsigned token
        $unsignedToken = $jwtHeader . '.' . $jwtClaims;

        // Sign the token with the private key
        $signature = '';
        openssl_sign($unsignedToken, $signature, $keyFile['private_key'], 'SHA256');

        // Combine to form the JWT
        $jwt = $unsignedToken . '.' . base64_encode($signature);

        // Request the access token
        $response = $this->makeRequest($keyFile['token_uri'], $jwt);

        // Check for errors in response
        if (isset($response['error'])) {
            Log::error('Error fetching access token: ' . $response['error']);
            return response()->json(['error' => 'Error fetching access token'], 500);
        }

        // Update the site model with the access token
        $site = site::where('id', 1)->first();
        $site->update([$tokenField => "Bearer " . $response['access_token']]);

        // Return success response
        return response()->json(['success' => true]);
    }

    private function makeRequest($url, $jwt)
    {
        $postFields = [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }
}
