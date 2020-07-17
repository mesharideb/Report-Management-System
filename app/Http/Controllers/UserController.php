<?php

namespace App\Http\Controllers;

use App\Groups_user;
use App\Project_group;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::with('roles','groups')->where('id','!=',0)->get();

        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_role($id)
    {
        $user=User::with('roles')->where('id',$id)->first();
        $roles=Role::all();
        return view('users.edit',compact('user','roles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_role(Request $request, $id)
    {
        $user=User::where('id',$id)->first();
        if ($request->oldRole){
            $user->detachRole($request->oldRole);
        }
        $user->attachRole($request->role);
        return redirect(url('/users'));
    }

    public function edit_group($id){
        $user=User::with('groups')->where('id',$id)->first();
        $groups=Project_group::all();
        return view('users.edit_group',compact('user','groups'));
    }

    public function update_group(Request $request, $id){
        $user=User::with('groups')->where('id',$id)->first();
        if ($request->groups != null) {
            foreach ($user->groups as $group){
                if(!array_search($group->id,$request->groups)){
                    $deleteGroup=Groups_user::where('user_id',$id)->where('group_id',$group->id)->first();
                    $deleteGroup->delete();
                }
            }
            foreach ($request->groups as $group) {
                $isExist=Groups_user::where('user_id',$id)->where('group_id',$group)->first();
                if (!$isExist){
                    $addGroup = new Groups_user();
                    $addGroup->user_id = $id;
                    $addGroup->group_id = $group;
                    $addGroup->save();
                }
            }
        }
        return redirect(url('/users'))->with('message','the groups assigned to user successfly');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::where('id',$id)->first();
        $user->delete();
        return redirect(url('/users'));
    }
}
