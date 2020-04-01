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

    public function getProductsByCategory(Request $request)
    {

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
}
