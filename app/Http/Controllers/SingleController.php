<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleController extends Controller
{

    public function index(Request $req, $id = '')
    {

        $query = "select * from posts where slug = :slug limit 1";

        $row = DB::select($query, ['slug' => $id]);

        if ($row) {

            $query = "select * from categories where id = :id limit 1";
            $category = DB::select($query, ['id' => $row[0]->id]);

            $data['row'] = $row[0];

            if (!empty($category)) {

                $data['category'] = $category[0];
            }
        }

        $query = "select * from categories order by id desc";
        $categories = DB::select($query);
        $data['categories'] = $categories;

        return view('single', $data);
    }

    public function save(Request $req)
    {

        $validate = $req->validate([

            'key' => 'required|string',
            'key' => 'required|image',
        ]);

        return view('single');
    }
}
