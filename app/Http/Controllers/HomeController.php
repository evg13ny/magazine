<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(Request $req)
    {

        $query = "select posts.*, categories.category from posts join categories on posts.category_id = categories.id";

        $img = new Image();

        $rows = DB::select($query);

        foreach ($rows as $key => $row) {

            $rows[$key]->image = $img->get_thumb_post('uploads/' . $row->image);
        }

        $data['rows'] = $rows;
        $data['page_title'] = 'Home';

        return view('index', $data);
    }

    public function save(Request $req)
    {

        $validate = $req->validate([

            'key' => 'required|string',
            'key' => 'required|image',
        ]);

        return view('index');
    }
}
