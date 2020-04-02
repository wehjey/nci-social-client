<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\APIService;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = session('user');
        return view('pages.profile', ['user' => $user]);
    }

    public function topics()
    {
        $current_page = getPage();
        $response = APIService::getTopics(10, $current_page, 'owner'); // Get topics from API
        $topics = [];
        $total_pages = 0;

        if ($response['success']) {
            $topics = $response['data']['data'];
            $total_pages = getPageCount($response['per_page'], $response['total_count']);
        }

        $data = [
            'topics' => $topics,
            'total_pages' => $total_pages,
            'current_page' => $current_page
        ];

        return view('pages.my_topics', $data);
    }

    public function products()
    {
        $url = '/products?per_page=500&type=owner';
        $current_page = getPage();
        $response = APIService::makeRequest([], $url, 'GET'); // Get topics from API
        $products = [];
        $total_pages = 0;

        if ($response['success']) {
            $products = $response['data']['data'];
            $total_pages = getPageCount($response['per_page'], $response['total_count']);
        }

        $c_response = APIService::getCategories();
        $categories = [];

        if ($c_response['success']) {
            $categories = $c_response['data'];
        }

        $data = [
            'products' => $products,
            'total_pages' => $total_pages,
            'current_page' => $current_page,
            'categories' => $categories
        ];

        return view('pages.my_products', $data);
    }

    public function orders()
    {
        $o_response = APIService::makeRequest([], '/orders', 'GET');
        $s_response = APIService::makeRequest([], '/sales', 'GET');

        $sales = [];
        $orders = [];

        if ($o_response['success'] && $s_response['success']) {
            $orders = $o_response['data'];
            $sales = $s_response['data'];
        }

        $data = [
            'orders' => $orders,
            'sales' => $sales,
        ];

        return view('pages.my_orders', $data);
    }

    public function updateProfile(Request $request)
    {
        $data = $request->only(['firstname', 'lastname', 'phone_number', 'profile_url']);
        $response = APIService::updateProfile($data);
        if($response->success) {
            session(['user' => (array) $response->data]);
            return back()->with('success', 'Profile updated successfully');
        } else {
            return back()->with('error', 'An error occured. Please try again.');
        }
    }
}
