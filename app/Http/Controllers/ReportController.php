<?php

namespace App\Http\Controllers;

use App\Project_group;
use App\Report;
use App\Reports_group;
use App\Tag;
use App\Tags_report;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ReportController extends Controller
{
    /**
     * get reports that related to groups of user
     * and all reports if the user is admin
     *
     * @return  view reports/index with param (reports)
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')){
            $reports=Report::with('groups','tags','user')->where('id','!=',0)->get();
        }else{
            $user=User::with('groups')->where('id',Auth::user()->id)->first();
            $groups=[];
            foreach ($user->groups as $group){
                $groups[]=$group->id;
            }
            $reports = Report::with('groups','tags','user')->whereHas('groups', function (Builder $query) use ($groups) {
                $query->whereIn('group_id',  $groups);
            })->get();
        }

        return view('reports.index',compact('reports'));
    }

    /**
     * Show the form for creating a new report.
     *
     * @return view reports/create with param (tags, groups)
     */
    public function create()
    {
        $tags=Tag::all();
        $groups=Project_group::all();
        return view('reports.create',compact('tags','groups'));
    }

    /**
     * Store a newly created report in storage.
     * and move a new uploaded files to report_files directory
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect to (reports) that will go to function index
     * with message is success and error if failure
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);

        $report=new Report();
        $report->user_id=Auth::user()->id;
        $report->name=$request->name;
        $report->content=$request['content'];
        if($request->file('pictures') != null) {
            $pictures='';
            foreach ($request->file('pictures') as $picture){
                $file_name = str_random(5).'_' . $picture->getClientOriginalName();
                $picture->move(public_path()."/report_files/pictures/", $file_name);
                $pictures=$pictures.','.$file_name;
            }
            $report->picture = $pictures;
        }
        if($request->file('sounds') != null) {
            $sounds='';
            foreach ($request->file('sounds') as $sound){
                $file_name = str_random(5) .'_'. $sound->getClientOriginalName();
                $sound->move(public_path()."/report_files/sounds/", $file_name);
                $sounds=$sounds.','.$file_name;
            }
            $report->sound=$sounds;
        }
        if($request->file('files') != null) {
            $files='';
            foreach ($request->file('files') as $file){
                $file_name = str_random(5) .'_'. $file->getClientOriginalName();
                $file->move(public_path()."/report_files/files/", $file_name);
                $files=$files.','.$file_name;
            }
            $report->file=$files;
        }
        $report->save();
        if ($report){
            if ($request->groups != null) {
                foreach ($request->groups as $group) {
                    $addGroup = new Reports_group();
                    $addGroup->report_id = $report->id;
                    $addGroup->group_id = $group;
                    $addGroup->save();
                }
            }
            if ($request->tags != null) {
                foreach ($request->tags as $tag) {
                    $addTag = new Tags_report();
                    $addTag->report_id = $report->id;
                    $addTag->tag_id = $tag;
                    $addTag->save();
                }
            }
            return redirect(url('/reports'))->with('message','the report created successfly');
        }else{
            return redirect(url('/reports'))->with('error','error in creating report');
        }


    }

    /**
     * Display the specified report with all data of report.
     *
     * @param  int  $id (report id)
     * @return view reports/show with param (report, pictures, sounds, files)
     */
    public function show($id)
    {
        $report=Report::with('groups','tags','user')->where('id',$id)->first();
        $pictures=$this->str_array($report->picture);
        $sounds=$this->str_array($report->sound);
        $files=$this->str_array($report->file);
        return view('reports.show',compact('report','pictures','sounds','files'));
    }

    /**
     * Show the form for editing the specified report.
     *
     * @param  int  $id (report id)
     * @return redirect to (reports) that will go to function index
     * with message if success and error if failure
     */
    public function edit($id)
    {
        $report=Report::with('groups','tags','user')->where('id',$id)->first();
        $pictures=$this->str_array($report->picture);
        $sounds=$this->str_array($report->sound);
        $files=$this->str_array($report->file);

        $tags=Tag::all();
        $groups=Project_group::all();
        return view('reports.edit',compact('report','tags','groups','pictures','sounds','files'));
    }

    /**
     * Update the specified report in storage.
     * with update the files in report_files directory (delete (that not choose) and add new)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return redirect to (reports) that will go to function index
     * with message if success and error if failure
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);

        $report=Report::with('groups','tags','user')->where('id',$id)->first();
//        dd($report);
        $report->name=$request->name;
        $report->content=$request['content'];
        $allPictures='';
        $pictures=$this->str_array($report->picture);
        $sounds=$this->str_array($report->sound);
        $files=$this->str_array($report->file);

        if ($request->oldPictures != null){
            foreach ($request->oldPictures as $picture){
                if(!array_search($picture,$pictures)){
                    File::delete(public_path() . '/report_files/pictures/' . $picture);;
                }else{
                    $allPictures=$allPictures.','.$picture;
                }
            }
        }
        if($request->file('pictures') != null) {
            foreach ($request->file('pictures') as $picture){
                $file_name = str_random(5) .'_'. $picture->getClientOriginalName();
                $picture->move(public_path()."/report_files/pictures/", $file_name);
                $allPictures=$allPictures.','.$file_name;
            }
        }
        $report->picture = $allPictures;

        $allSounds='';
        if ($request->oldSounds != null){
            foreach ($request->oldSounds as $sound){
                if(!array_search($sound,$sounds)){
                    File::delete(public_path() . '/report_files/sounds/' . $sound);;
                }else{
                    $allSounds=$allSounds.','.$sound;
                }
            }
        }
        if($request->file('sounds') != null) {
            foreach ($request->file('sounds') as $sound){
                $file_name = str_random(5) .'_'. $sound->getClientOriginalName();
                $sound->move(public_path()."/report_files/sounds/", $file_name);
                $allSounds=$allSounds.','.$file_name;
            }
        }
        $report->sound=$allSounds;

        $allFiles='';
        if ($request->oldFiles != null){
            foreach ($request->oldFiles as $file){
                if(!array_search($file,$files)){
                    File::delete(public_path() . '/report_files/files/' . $file);
                }else{
                    $allFiles=$allFiles.','.$file;
                }
            }
        }
        if($request->file('files') != null) {
            foreach ($request->file('files') as $file){
                $file_name = str_random(5) .'_'. $file->getClientOriginalName();
                $file->move(public_path()."/report_files/files/", $file_name);
                $allFiles=$allFiles.','.$file_name;
            }
        }
        $report->file=$allFiles;
        $report->save();
        if ($report){
            if ($request->groups != null) {
                foreach ($report->groups as $group){
                    if(!array_search($group->id,$request->groups)){
                        $deleteGroup=Reports_group::where('report_id',$id)->where('group_id',$group->id)->first();
                        $deleteGroup->delete();
                    }
                }
                foreach ($request->groups as $group) {
                    $isExist=Reports_group::where('report_id',$id)->where('group_id',$group)->first();
                    if (!$isExist){
                        $addGroup = new Reports_group();
                        $addGroup->report_id = $report->id;
                        $addGroup->group_id = $group;
                        $addGroup->save();
                    }
                }
            }
            if ($request->tags != null) {
                foreach ($report->tags as $tag){
                    if(!array_search($tag->id,$request->tags)){
                        $deleteTag=Tags_report::where('report_id',$id)->where('tag_id',$tag->id)->first();
                        $deleteTag->delete();
                    }
                }
                foreach ($request->tags as $tag) {
                    $isExist=Tags_report::where('report_id',$id)->where('tag_id',$tag)->first();
                    if (!$isExist){
                        $addTag = new Tags_report();
                        $addTag->report_id = $report->id;
                        $addTag->tag_id = $tag;
                        $addTag->save();
                    }

                }
            }
            return redirect(url('/reports'))->with('message','the report updated successfly');
        }else{
            return redirect(url('/reports'))->with('error','error in updating report');
        }
    }

    /**
     * Remove the specified report from storage.
     * and delete the files (related to that report) from report_files directory
     *
     * @param  int  $id
     * @return redirect to (reports) that will go to function index
     * with message if success and error if failure
     */
    public function destroy($id)
    {
        $report = Report::where('id', $id)->first();
        if ($report->picture != null){
            $pictures=explode(',',$report->picture);
            foreach ($pictures as $value){
                if ($value != null){
                    File::delete(public_path() . '/report_files/pictures/' . $value);
                }
            }

        }
        if ($report->sound != null){
            $sounds=explode(',',$report->sound);
            foreach ($sounds as $value){
                if ($value != null){
                    File::delete(public_path() . '/report_files/sounds/' . $value);;
                }
            }
        }
        if ($report->file != null){
            $files=explode(',',$report->file);
            foreach ($files as $value){
                if ($value != null){
                    File::delete(public_path() . '/report_files/files/' . $value);;
                }
            }
        }
        $report->delete();
        if ($report){
            Reports_group::where('report_id',$id)->delete();
            Tags_report::where('report_id',$id)->delete();
            return redirect(url('/reports'))->with('message','the report deleted successfly');
        }else{
            return redirect(url('/reports'))->with('error','error in deleting report');
        }
    }

    /**
     * search for reports by request['search'],
     * using different criteria by (report name, content, tag, group, report editor)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect to (reports) that will go to function index
     * with message if success and error if failure
     */
    public function search(Request $request){
        if ($request->search){
            $search=$request->search;
            $result=Report::with('groups','tags','user')
                ->where('name','LIKE','%'.$search.'%')
                ->orWhere('content','LIKE','%'.$search.'%')
                ->orWhereHas('groups', function (Builder $query) use ($search) {
                    $query->where('name','LIKE','%'.$search.'%');
                })
                ->orWhereHas('tags', function (Builder $query) use ($search) {
                    $query->where('name','LIKE','%'.$search.'%');
                })
                ->orWhereHas('user', function (Builder $query) use ($search) {
                    $query->where('name','LIKE','%'.$search.'%');
                })->get();
            if (Auth::user()->hasRole('admin')){
                $reports=$result;
            }else{
                $user=User::with('groups')->where('id',Auth::user()->id)->first();
                $groups=[];
                $reports=[];
                foreach ($user->groups as $group){
                    $groups[]=$group->id;
                }
                foreach ($result as $report){
                    foreach ($report->groups as $group ){
                        if (in_array($group->id,$groups)){
                            $reports[]=$report;
                        }
                    }
                }
                $reports=array_unique($reports);
            }
            return view('reports.index',compact('reports'));

        }else{
            return redirect(url('/reports'));
        }
    }

    /**
     * function to convert a string to array without null values
     * and we use it to get the files name from database
     *
     * @param  string $str
     * @return array $array
     */
    public function str_array($str){
        $array=explode(',',$str);
        foreach ($array as $key=>$value){
            if ($value == null){
                unset($array[$key]);
            }
        }
        return $array;
    }
}
