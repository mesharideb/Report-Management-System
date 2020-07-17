<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions=Permission::all();
        return view('permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
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
            'name' => 'required|unique:permissions',
            'description' => 'required',
        ]);

        $permission=new Permission();
        $permission->name=$request->name;
        $permission->description=$request->description;
        $permission->save();
        if ($permission){
            return redirect(url('/permissions'))->with('message','the permission created successfly');
        }else{
            return redirect(url('/permissions'))->with('error','error in creating permission');
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
        $permission=Permission::where('id',$id)->first();
        return view('permissions.edit',compact('permission'));
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
            'name' => 'required|unique:permissions',
            'description' => 'required',
        ]);
        $permission=Permission::where('id',$id)->first();
        $permission->name=$request->name;
        $permission->description=$request->description;
        $permission->save();
        if ($permission){
            return redirect(url('/permissions'))->with('message','the permission updated successfly');
        }else{
            return redirect(url('/permissions'))->with('error','error in updating permission');
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
        $permission=Permission::where('id',$id)->first();
        $permission->delete();
        if ($permission){
            return redirect(url('/permissions'))->with('message','the permission deleted successfly');
        }else{
            return redirect(url('/permissions'))->with('error','error in deleting permission');
        }
    }
}
