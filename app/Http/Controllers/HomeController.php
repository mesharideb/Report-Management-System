<?php

namespace App\Http\Controllers;

use App\Project_group;
use App\Report;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reports=Report::where('id','!=',0)->count();
        $users=User::where('id','!=',0)->count();
        $groups=Project_group::where('id','!=',0)->count();
        $tags=Tag::where('id','!=',0)->count();
        return view('home',compact('users','reports','groups','tags'));
    }
}
