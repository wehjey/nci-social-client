<?php 

namespace App\Libraries;

class APIService {

    public static function login($data)
    {
        return self::makeRequest($data, '/login', 'POST');
    }
    
    public static function register($data)
    {
        $response = self::makeRequest($data, '/register', 'POST');
        if ($response['success']) {
            session(['token' => $response['access_token']]); // Store access token in session
            session(['user' => $response]); // Store the user information in session
        }
        return $response;
    }

    public static function makeRequest($data, $url, $method, $token = '')
    {
        $curl = curl_init();

        $headers = [
            "content-type: application/json",
            "cache-control: no-cache"
        ];

        // Add authorisation token if request requires authentication
        if ($token) {
            $headers = array_merge(
                $headers,
                "authorization: Bearer {$token}"
            );
        }

        curl_setopt_array($curl, array(
                CURLOPT_URL => config('app.api_url') . $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => $headers,
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){
            // there was an error contacting the Paystack API
            die('Curl returned error: ' . $err);
        }

        return json_decode($response, true);
    }

}