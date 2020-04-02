<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\APIService;


class ShopController extends Controller
{
    public function show()
    {
        $response = APIService::getCategories();
        $categories = [];

        if ($response['success']) {
            $categories = $response['data'];
        }

        $current_page = getPage();
        $productResponse = APIService::getProducts(10, $current_page); // Get products from API
        $products = [];
        $total_pages = 0;
        $total_count = 0;

        if ($productResponse['success']) {
            $products = $productResponse['data']['data'];
            $total_pages = getPageCount($productResponse['per_page'], $productResponse['total_count']);
            $total_count = $productResponse['total_count'];
        }

        $data = [
            'products' => $products,
            'total_pages' => $total_pages,
            'current_page' => $current_page,
            'categories' => $categories,
            'total_count' => $total_count
        ];

        return view('pages.shop', $data);
    }

    public function getProductsByCategory($category_id)
    {
        if(!isset($category_id)) {
            return back();
        }

        $category = '';
        if (request()->has('category') && request('category') != '') {
            $category = request('category');
        }

        $current_page = getPage();
        $url = "/products/category/{$category_id}?per_page=10&page={$current_page}";
        $response  = APIService::makeRequest([], $url, 'GET');
        $products = [];
        $products = [];
        $total_pages = 0;
        $total_count = 0;


        if ($response['success']) {
            $products = $response['data']['data'];
            $total_pages = getPageCount($response['per_page'], $response['total_count']);
            $total_count = $response['total_count'];
        }

        $data = [
            'products' => $products,
            'total_pages' => $total_pages,
            'current_page' => $current_page,
            'total_count' => $total_count,
            'category' => $category
        ];

        return view('pages.category_product', $data);
    }

    /**
     * View single product
     *
     * @param Request $request
     * @return void
     */
    public function viewProduct(Request $request)
    {
        if (isset($request['id'])) {
            $product_id = (int) request('id');
        } else {
            return back();
        }

        $response = APIService::getProduct($product_id); // Get product from API

        if ($response['success']) {
            $data = $response['data'];
            return view('pages.product', ['product' => $data]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Order product
     *
     * @param Request $request
     * @return void
     */
    public function makeOrder(Request $request)
    {
        if (isset($request['id'])) {
            $product_id = (int) request('id');
        } else {
            return back();
        }

        $order = [
            'product_id' => $product_id,
            'quantity' => 1
        ];

        $response = APIService::orderProduct($order); // Order for product
        
        if ($response['success']) {
            $url = $response['data'];
            return redirect()->to($url);
        } else {
            return redirect('/');
        }
    }

    public function addProduct(Request $request)
    {
        $data = $request->only(['name', 'description', 'images', 'quantity', 'price', 'category_id']);

        $response = APIService::addProduct($data); // Post product

        if ($response->success) {
            return back()->with('success', 'Product added successfully');
        } else {
            return back()->with('error', 'Failed to add product. Please try again');
        }
    }

    public function deleteProduct(Request $request)
    {
        if (isset($request['id'])) {
            $product_id = (int) request('id');
        } else {
            return redirect('/');
        }

        $url = "/product/{$product_id}";

        $response = APIService::makeRequest([], $url, 'DELETE'); // delete comment

        if ($response['success']) {
            return back()->with('success', 'Product deleted successfully');
        } else {
            return back()->with('error', 'Failed to delete product. Please try again');
        }
    }
}
