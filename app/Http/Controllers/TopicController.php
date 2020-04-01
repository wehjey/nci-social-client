<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\APIService;

class TopicController extends Controller
{
    public function home()
    {
        $current_page = getPage();
        $response = APIService::getTopics(10, $current_page); // Get topics from API
        $topics = [];
        $total_pages = 0;

        if($response['success']) {
            $topics = $response['data']['data'];
            $total_pages = getPageCount($response['per_page'], $response['total_count']);
        }

        $data = [
            'topics' => $topics,
            'total_pages' => $total_pages,
            'current_page' => $current_page
        ];

        return view('pages.home', $data);
    }

    /**
     * Return topic from api
     *
     * @param Request $request
     * @return void
     */
    public function show(Request $request)
    {
        if (isset($request['id'])) {
            $topic_id = (int) request('id');
        } else {
            return redirect('/');
        }

        $response = APIService::showTopic($topic_id); // Get topic
        
        if ($response['success']) {
            $data = $response['data'];
            return view('pages.topic', ['topic' => $data]);
        } else {
            return redirect('/');
        }
    }

    public function makeComment(Request $request)
    {
        $data = $request->only(['topic', 'comment', 'images']);

        $response = APIService::makeComment($data); // Post comment

        if ($response->success) {
            return back()->with('success', 'Comment added successfully');
        } else {
            return back()->with('error', 'Failed to add comment. Please try again');
        }
    }

    public function store(Request $request)
    {
        $data = $request->only(['title', 'description', 'images']);

        $response = APIService::addTopic($data); // Post topic

        if ($response->success) {
            return back();
        } else {
            return back()->with('error', 'Failed to add topic. Please try again');
        }
    }

    public function removeComment(Request $request)
    {
        if (isset($request['comment_id'])) {
            $comment_id = (int) request('comment_id');
        } else {
            return redirect('/');
        }

        $response = APIService::deleteComment($comment_id); // delete comment

        if ($response['success']) {
            return back()->with('success', 'Comment deleted successfully');
        } else {
            return back()->with('error', 'Failed to delete comment. Please try again');
        }
    }
}
