<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Permission_role;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::with('permissions')->where('id','!=',0)->get();

        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::all();
        return view('roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles',
            'description' => 'required',
        ]);

        $role=new Role();
        $role->name=$request->name;
        $role->description=$request->description;
        $role->save();
        if ($role){
            foreach ($request->permissions as $permission){

                $role->attachPermission($permission);
            }

            return redirect(url('/roles'))->with('message','the role created successfly');
        }else{
            return redirect(url('/roles'))->with('error','error in creating role');
        }

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
    public function edit($id)
    {
        $role=Role::with('permissions')->where('id',$id)->first();
        $permissions=Permission::all();
        return view('roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $role=Role::with('permissions')->where('id',$id)->first();
        $role->name=$request->name;
        $role->description=$request->description;
        $role->save();
        foreach ($request->permissions as $permission){
            $is_exist=Permission_role::where('role_id',$role->id)->where('permission_id',$permission)->first();
            if (!$is_exist){
                $role->attachPermission($permission);
            }
        }

        if ($role){
            return redirect(url('/roles'))->with('message','the role updated successfly');
        }else{
            return redirect(url('/roles'))->with('error','error in updated role');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role=Role::where('id',$id)->first();
        $role->delete();
        if ($role){
            return redirect(url('/roles'))->with('message','the role deleted successfly');
        }else{
            return redirect(url('/roles'))->with('error','error in delete role');
        }

    }
}
