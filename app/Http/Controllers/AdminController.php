<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //

    public function index(Request $req)
    {

        return view('admin.admin', ['page_title' => 'Dashboard']);
    }

    public function posts(Request $req, $type = '')
    {

        switch ($type) {
            case 'add':
                return view('admin.add_post', ['page_title' => 'New Post']);
                break;
            case 'edit':
                return view('admin.posts', ['page_title' => 'Edit Post']);
                break;
            case 'delete':
                return view('admin.posts', ['page_title' => 'Delete Post']);
                break;
            default:
                return view('admin.posts', ['page_title' => 'Posts']);
                break;
        }
    }

    public function categories(Request $req)
    {

        return view('admin.admin', ['page_title' => 'Categories']);
    }

    public function users(Request $req)
    {

        return view('admin.admin', ['page_title' => 'Users']);
    }

    public function save(Request $req)
    {

        $validate = $req->validate([

            'key' => 'required|string',
            'key' => 'required|image'

        ]);

        return view('view');
    }
}
