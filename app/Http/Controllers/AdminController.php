<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Image;
use App\Models\MyPage;

class AdminController extends Controller
{

    public function index(Request $req)
    {

        return view('admin.admin', ['page_title' => 'Dashboard']);
    }

    public function posts(Request $req, $type = '', $id = '')
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
                    $data['slug']        = $post->str_to_url($data['title']);

                    $post->insert($data);

                    return redirect('admin/posts');
                }

                $query = "select * from categories order by id desc";
                $categories = DB::select($query);

                return view('admin.add_post', [
                    'page_title' => 'New Post',
                    'categories' => $categories,
                ]);

                break;

            case 'edit':

                $post = new Post();

                if ($req->method() == 'POST') {

                    $validated = $req->validate([

                        'title'   => 'required|string',
                        'file'    => 'image',
                        'content' => 'required'
                    ]);

                    if ($req->file('file')) {

                        $oldrow = $post->find($id);

                        if (file_exists('uploads/' . $oldrow->image)) {

                            unlink('uploads/' . $oldrow->image);
                        }

                        $path = $req->file('file')->store('/', ['disk' => 'my_disk']);
                        $data['image'] = $path;
                    }

                    // $data['id']          = $id;
                    $data['title']       = $req->input('title');
                    $data['category_id'] = $req->input('category_id');
                    $data['content']     = $req->input('content');
                    $data['updated_at']  = date("Y-m-d H:i:s");

                    $post->where('id', $id)->update($data);

                    return redirect('admin/posts');
                }

                $row = $post->find($id);
                $category = $row->category()->first();

                return view('admin.edit_post', [
                    'page_title' => 'Edit Post',
                    'row' => $row,
                    'category' => $category
                ]);

                break;

            case 'delete':

                $post = new Post();

                $row = $post->find($id);

                $category = $row->category()->first();

                if ($req->method() == 'POST') {

                    $row->delete();

                    return redirect('admin/posts');
                }

                return view('admin.delete_post', [
                    'page_title' => 'Delete Post',
                    'row' => $row,
                    'category' => $category
                ]);

                break;

            default:

                $limit = 1;
                $page = $req->input('page') ? (int)$req->input('page') : 1;
                $offset = ($page - 1) * $limit;

                $page_class = new MyPage();
                $links = $page_class->make_links($req->fullUrl(), $page, 1);

                $query = "select posts.*, categories.category from posts join categories on posts.category_id = categories.id limit $limit offset $offset";

                $img = new Image();

                $rows = DB::select($query);

                foreach ($rows as $key => $row) {

                    $rows[$key]->image = $img->get_thumb('uploads/' . $row->image);
                }

                $data['rows'] = $rows;
                $data['page_title'] = 'Posts';
                $data['links'] = $links;

                return view('admin.posts', $data);

                break;
        }
    }

    public function categories(Request $req, $type = '', $id = '')
    {

        switch ($type) {

            case 'add':

                if ($req->method() == 'POST') {

                    $category = new Category();

                    $validated = $req->validate([

                        'category'   => 'required|string',
                    ]);

                    $data['category']       = $req->input('category');
                    $data['created_at']  = date("Y-m-d H:i:s");
                    $data['updated_at']  = date("Y-m-d H:i:s");

                    $category->insert($data);

                    return redirect('admin/categories');
                }

                return view('admin.add_category', ['page_title' => 'New Category']);

                break;

            case 'edit':

                $category = new Category();

                if ($req->method() == 'POST') {

                    $validated = $req->validate([

                        'category' => 'required|string'
                    ]);

                    // $data['id']          = $id;
                    $data['category']       = $req->input('category');
                    $data['updated_at']  = date("Y-m-d H:i:s");

                    $category->where('id', $id)->update($data);

                    return redirect('admin/categories/edit/' . $id);
                }

                $row = $category->find($id);

                return view('admin.edit_category', [
                    'page_title' => 'Edit Category',
                    'row' => $row,
                ]);

                break;

            case 'delete':

                $category = new Category();

                $row = $category->find($id);

                if ($req->method() == 'POST') {

                    $row->delete();

                    return redirect('admin/categories');
                }

                return view('admin.delete_category', [
                    'page_title' => 'Delete Category',
                    'row' => $row,
                ]);

                break;

            default:

                $query = "select * from categories order by id desc";
                $rows = DB::select($query);
                $data['rows'] = $rows;
                $data['page_title'] = 'Categories';

                return view('admin.categories', $data);

                break;
        }
    }

    public function users(Request $req, $type = '', $id = '')
    {

        switch ($type) {

            case 'edit':

                $user = new User();

                if ($req->method() == 'POST') {

                    $validated = $req->validate([

                        'name' => 'required|string',
                        'email' => 'required|email',
                    ]);

                    // $data['id']          = $id;
                    $data['name']  = $req->input('name');
                    $data['email'] = $req->input('email');

                    if (!empty($req->input('password'))) {

                        $data['password'] = $req->input('password');
                    }

                    $data['updated_at']  = date("Y-m-d H:i:s");

                    $user->where('id', $id)->update($data);

                    return redirect('admin/users/edit/' . $id);
                }

                $row = $user->find($id);

                return view('admin.edit_user', [
                    'page_title' => 'Edit User',
                    'row' => $row,
                ]);

                break;

            case 'delete':

                $user = new User();

                $row = $user->find($id);

                if ($req->method() == 'POST') {

                    if ($row->id != 1) {

                        $row->delete();
                    }

                    return redirect('admin/users');
                }

                return view('admin.delete_user', [
                    'page_title' => 'Delete User',
                    'row' => $row,
                ]);

                break;

            default:

                $query = "select * from users order by id desc";
                $rows = DB::select($query);
                $data['rows'] = $rows;
                $data['page_title'] = 'Users';

                return view('admin.users', $data);

                break;
        }
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
