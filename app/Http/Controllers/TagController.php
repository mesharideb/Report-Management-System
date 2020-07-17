<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=Tag::all();
        return view('tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
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
            'name' => 'required|unique:tags',
        ]);
        $tag=new Tag();
        $tag->name=$request->name;
        $tag->save();
        if ($tag){
            return redirect(url('/tags'))->with('message','the tag created successfly');
        }else{
            return redirect(url('/tags'))->with('error','error in creating tag');
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
        $tag=Tag::where('id',$id)->first();
//        dd($tag);
        return view('tags.edit',compact('tag'));
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
        $tag=Tag::where('id',$id)->first();
        $tag->name=$request->name;
        $tag->save();
        if ($tag){
            return redirect(url('/tags'))->with('message','the tag updated successfly');
        }else{
            return redirect(url('/tags'))->with('error','error in updating tag');
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
        $tag=Tag::where('id',$id)->first();
        $tag->delete();
        if ($tag){
            return redirect(url('/tags'))->with('message','the tag deleted successfly');
        }else{
            return redirect(url('/tags'))->with('error','error in deleting tag');
        }
    }
}
