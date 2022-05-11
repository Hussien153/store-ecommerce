<?php

namespace App\Http\Controllers\Front;

use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function showUserName(){
        return 'Sayooonara';
    }

    public function getIndex(){
    $data=[];
    $data['id']=5;
    $data['name']= 'What Could have Been';

    $obj = new \stdClass();
    $obj -> name = 'ahmad';
    $obj -> id = 4;
    $obj -> gender = 'male';

    $data=['ahmad', 'baseem'];

    // return view ('welcome',compact('data'));
    return view('welcome',compact('obj'));
    }
}