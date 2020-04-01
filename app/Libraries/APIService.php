<?php 

namespace App\Libraries;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class APIService {

    /**
     * Make login request with user creds
     *
     * @param [array] $data
     * @return void
     */
    public static function login($data)
    {
        return self::makeRequest($data, '/login', 'POST');
    }

    /**
     * Make register request user creds
     *
     * @param [array] $data
     * @return void
     */
    public static function register($data)
    {
        $response = self::makeRequest($data, '/register', 'POST');
        if ($response['success']) {
            session(['token' => $response['access_token']]); // Store access token in session
            session(['user' => $response]); // Store the user information in session
        }
        return $response;
    }

    /**
     * Get topics
     *
     * @param [type] $per_page
     * @param integer $page
     * @param string $type
     * @return void
     */
    public static function getTopics($per_page, $page = 1, $type = 'all')
    {
        return self::makeRequest(
            [], 
            "/topics?type={$type}&page={$page}&per_page={$per_page}", 
            'GET'
        );
    }

    /**
     * Get topics
     *
     * @param integer $topic_id
     * @return void
     */
    public static function showTopic($topic_id)
    {
        return self::makeRequest(
            [], 
            "/topic/{$topic_id}", 
            'GET'
        );
    }

    /**
     * Get topics
     *
     * @param integer $topic_id
     * @return void
     */
    public static function deleteComment($comment_id)
    {
        return self::makeRequest(
            [], 
            "/comment/{$comment_id}", 
            'DELETE'
        );
    }

    /**
     * Get categories
     *
     * @return void
     */
    public static function getCategories()
    {
        return self::makeRequest(
            [], 
            "/categories", 
            'GET'
        );
    }

    /**
     * Get products
     *
     * @return void
     */
    public static function getProducts()
    {
        return self::makeRequest(
            [], 
            '/products', 
            'GET'
        );
    }

    /**
     * Get product
     *
     * @return void
     */
    public static function getProduct($product_id)
    {
        return self::makeRequest(
            [], 
            "/product/{$product_id}", 
            'GET'
        );
    }

    /**
     * Order product
     *
     * @return void
     */
    public static function orderProduct($order)
    {
        return self::makeRequest(
            $order, 
            "/order", 
            'POST'
        );
    }

    /**
     * Make comment
     *
     * @param array $data
     * @return void
     */
    public static function makeComment($data)
    {
        $output = [];
        
        if(isset($data['images'])) {
            foreach ($data['images'] as $key => $value) {
                if (! is_array($value)) {
                    $output[] = [
                        'name'     => 'images[]',
                        'contents' => fopen($value->getPathname(), 'r'),
                        'filename' => $value->getClientOriginalName()
                        ];
                    continue;
                }
            }
        }

        $output[] =
            [
                'name'     => 'description',
                'contents' => $data['comment']
            ];

        return self::makeRequestFile(
            $output, 
            "/comment/{$data['topic']}", 
            'POST'
        );
    }

    /**
     * Add topic
     *
     * @param array $data
     * @return void
     */
    public static function addTopic($data)
    {
        $output = [];
        
        if(isset($data['images'])) {
            foreach ($data['images'] as $key => $value) {
                if (! is_array($value)) {
                    $output[] = [
                        'name'     => 'images[]',
                        'contents' => fopen($value->getPathname(), 'r'),
                        'filename' => $value->getClientOriginalName()
                        ];
                    continue;
                }
            }
        }

        $output[] = [
                'name'     => 'description',
                'contents' => $data['description']
            ];

        $output[] = [
                'name'     => 'title',
                'contents' => $data['title']
            ];

        return self::makeRequestFile(
            $output, 
            "/topic", 
            'POST'
        );
    }

    public static function makeRequest($data, $url, $method)
    {
        $curl = curl_init();

        $headers = [
            "content-type: application/json",
            "cache-control: no-cache"
        ];
        
        // Add authorisation token if request requires authentication
        if (session('token')) {
            $headers = array_merge(
                $headers,
                ['authorization: Bearer ' . session('token')]
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


    public static function makeRequestFile($data, $url, $method)
    {
        $client = new Client([
            'base_uri'    => config('app.api_url'),
            ]);

             $response = $client->request('POST', 'v1'.$url, [
            'headers' => [
            'Authorization' => 'Bearer '. session('token')
            ],
            'multipart' => $data

            ]);

            $data = \GuzzleHttp\json_decode($response->getBody());

        return $data;
    }

}