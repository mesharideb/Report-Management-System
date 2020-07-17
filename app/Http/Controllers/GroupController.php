<?php

namespace App\Http\Controllers;

use App\Project_group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups=Project_group::all();
        return view('groups.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
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
            'name' => 'required|unique:project_groups',
        ]);
        $group=new Project_group();
        $group->name=$request->name;
        $group->save();
        if ($group){
            return redirect(url('/groups'))->with('message','the group created successfly');
        }else{
            return redirect(url('/groups'))->with('error','error in creating group');
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
        $group=Project_group::where('id',$id)->first();
        return view('groups.edit',compact('group'));
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
        ]);
        $group=Project_group::where('id',$id)->first();
        $group->name=$request->name;
        $group->save();
        if ($group){
            return redirect(url('/groups'))->with('message','the group updated successfly');
        }else{
            return redirect(url('/groups'))->with('error','error in updating group');
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
        $group=Project_group::where('id',$id)->first();
        $group->delete();
        if ($group){
            return redirect(url('/groups'))->with('message','the group deleted successfly');
        }else{
            return redirect(url('/groups'))->with('error','error in deleting group');
        }
    }
}
