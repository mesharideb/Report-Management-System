@extends('layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Report</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="offset-2 col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Report ({{$report->name}})</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{url('/updateReport/'.@$report->id)}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="exampleFormControlInput1" class="col-3 col-form-label">Report Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                                               value="{{$report->name}}">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlInput1" class="col-3 col-form-label">Report Content</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3">
                                            {{$report->content}}
                                        </textarea>
                                        @error('content')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Old Pictures</label>
                                </div>
                                <div class="form-group row">
                                    @foreach($pictures as $picture)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="oldPictures[]" value="{{$picture}}" id="defaultCheck1" checked>
                                            <label class="form-check-label" for="defaultCheck1">{{$picture}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlInput1" class="col-3 col-form-label">Add New Pictures</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="pictures[]" class="form-control-file" multiple id="exampleFormControlFile1">
                                        @error('picture')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Old Sounds</label>
                                </div>
                                <div class="form-group row">
                                    @foreach($sounds as $sound)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="oldSounds[]" value="{{$sound}}" id="defaultCheck1" checked>
                                            <label class="form-check-label" for="defaultCheck1">{{$sound}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlInput1" class="col-3 col-form-label">Add New Sounds</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="sounds[]" class="form-control-file" multiple id="exampleFormControlFile1">
                                        @error('sound')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Old Other Files</label>
                                </div>
                                <div class="form-group row">
                                    @foreach($files as $file)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="oldFiles[]" value="{{$file}}" id="defaultCheck1" checked>
                                            <label class="form-check-label" for="defaultCheck1">{{$file}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlInput1" class="col-3 col-form-label">Add Other File</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="files[]" class="form-control-file" multiple id="exampleFormControlFile1">
                                        @error('file')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Report Groups</label>
                                </div>
                                <div class="form-group row">
                                    @foreach($groups as $group)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="groups[]" value="{{$group->id}}" id="defaultCheck1"
                                            @foreach($report->groups as $Rgroup)
                                                @if($group->id == $Rgroup->id)
                                                    checked
                                                @endif
                                            @endforeach
                                            >
                                            <label class="form-check-label" for="defaultCheck1">{{$group->name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Report Tags</label>
                                </div>
                                <div class="form-group row">
                                    {{--                                    <div class="col-sm-10">--}}
                                    @foreach($tags as $tag)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}" id="defaultCheck1"
                                                @foreach($report->tags as $Rtag)
                                                @if($tag->id == $Rtag->id)
                                                   checked
                                                @endif
                                                @endforeach
                                            >
                                            <label class="form-check-label" for="defaultCheck1">{{$tag->name}}</label><br>
                                        </div>
                                    @endforeach
                                    {{--                                    </div>--}}
                                </div>
                                <hr>
                                <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
