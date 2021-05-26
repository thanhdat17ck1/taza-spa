<?php

namespace App\Http\Controllers;
use App\Helpers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //trang chủ
    public function home(){
        // dd(session()->get('user_token'));
        $uri = 'article';
        $result = API::connect($uri, [], 'GET');
        $data = json_decode($result, true);
        $Article = $data['data'];
        //dd($Article);
        return view('layouts.master',compact('Article'));
    }
    public function test($id,Request $request){
        // dd($request->headers);

        $uri = 'article/$id';
        
        // dd($uri);
        // session()->put('user_token','c2hhMjU2OjUyOmY0MTQ5NzQ4MDk4NWRmZGE1YzJhMjRjMzBkODBjNDg1NTEyYTdmODU0MzM5OWY0MDA0ZDJkZGFiYmUxMGQ0NWU=');
        // dd(session()->get('user_token'))

        // $data['page'] = 1;
        $random = rand();
        
        $result = API::connect($uri, [], 'GET');
        dd($result);
        $data = json_decode($result, true);
        $Article = $data['data'];
        dd($Article);
        



        // $data = [
        //     'alias' => 'testtt',
        //     'articletext' => 'casdsadsa',
        //     'catid' => 'casdsadsa',
        //     'language' => '*',
        //     'metadesc' => 'casdsadsa',
        //     'metakey' => 'title',
        //     'title' => 'Here\'s an article',

        // ];
        // $uri = 'article';
        
        // $result = API::connect($uri, $data, 'POST');
        // dd($result);
        // return response()->json([
            
        // ]);
    }
    public function create(Request $request){
        $request->validate([
            'title' => 'required',
        ],[
            'title.required' => 'Tiêu đề không được để trống',
        ]);
        $random = rand();
        $data = [
            'alias' => $request->alias,
            'articletext' => $request->articletext,
            'catid' => $random,
            'language' => '*',
            'metadesc' => '',
            'metakey' => '',
            'title' => $request->title,

        ];
        $uri = 'article';
        $result = API::connect($uri, $data, 'POST');
        dd($result);
        return response()->json([
            
        ]);
        //dd($data);
    }   
    //chi tiết bài viết
    public function detail($id){
        // dd("")
    }
}
