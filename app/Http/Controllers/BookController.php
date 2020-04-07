<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\APIService;

class BookController extends Controller
{
    public function newBooks()
    {
        $books = [];
        $response = APIService::makeRequest([], '/books/new', 'GET');

        if($response['success']) {
            $books = $response['data'];
        }

        return view('pages.books_new', ['books' => $books]);
    }

    /**
     * Search for books
     *
     * @param Request $request
     * @return void
     */
    public function searchBooks(Request $request)
    {
        $keyword = '';
        if($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
        } else {
            return back();
        }

        $current_page = getPage();
        $data = [
            'keyword' => $keyword,
            'page' => $current_page,
        ];

        dd($data);

        $response = APIService::makeRequest($data, '/books/search/', 'POST'); // Get topics from API

        $books = [];
        $total_pages = 0;

        if($response['success']) {
            $books = $response['data'];
            $total_pages = getPageCount($response['per_page'], $response['total_count']);
        }

        $data = [
            'books' => $books,
            'total_pages' => $total_pages,
            'current_page' => $current_page
        ];

        return view('pages.books_search', $data);
    }
}
