@extends('layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create Report</h1>
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
                            <h3 class="card-title">Create Report</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{url('storeReport')}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="exampleFormControlInput1" class="col-3 col-form-label">Report Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                                               placeholder="Name of Report">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlInput1" class="col-3 col-form-label">Report Content</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        @error('content')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlInput1" class="col-3 col-form-label">Report Picture</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="pictures[]" class="form-control-file" multiple id="exampleFormControlFile1">
                                        @error('picture')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlInput1" class="col-3 col-form-label">Report Sound</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="sounds[]" class="form-control-file" multiple id="exampleFormControlFile1">
                                        @error('sound')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlInput1" class="col-3 col-form-label">Other File</label>
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
{{--                                    <div class="col-sm-10">--}}
                                    @foreach($groups as $group)
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="groups[]" value="{{$group->id}}" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">{{$group->name}}</label>
                                        </div>
                                    @endforeach
{{--                                    </div>--}}
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Report Tags</label>
                                </div>
                                <div class="form-group row">
{{--                                    <div class="col-sm-10">--}}
                                    @foreach($tags as $tag)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">{{$tag->name}}</label><br>
                                    </div>
                                    @endforeach
{{--                                    </div>--}}
                                </div>
                                <hr>
                                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
