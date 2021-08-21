<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

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
                if ($req->method() == 'POST') {

                    $post = new Post();

                    $validated = $req->validate([

                        'title'   => 'required|string',
                        'file'    => 'required|image',
                        'content' => 'required'
                    ]);

                    $path = $req->file('file')->store('/', ['disk' => 'my_disk']);

                    $data['title']       = $req->input('title');
                    $data['category_id'] = 1;
                    $data['image']       = $path;
                    $data['content']     = $req->input('content');
                    $data['created_at']  = date("Y-m-d H:i:s");
                    $data['updated_at']  = date("Y-m-d H:i:s");

                    $post->insert($data);
                }

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
