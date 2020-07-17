@extends('layouts.layout')

@section('scripts')
    <script>

    </script>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Report Details</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i>
                                {{@$report->name}}
                            </h3>
                        </div>
                        <div class="card-body">
{{--                            <div class="callout callout-danger">--}}
{{--                                <h5></h5>--}}
{{--                                <p></p>--}}
{{--                            </div>--}}
                            <div class="callout callout-success">
                                <h5>Report Content</h5><hr>

                                <p>{{@$report->content}}</p>
                            </div>
                            <div class="callout callout-info">
                                <h5>Report Pictures</h5><hr>
                                <p>
                                    @foreach(@$pictures as $picture)
                                        <img src="{{asset('report_files/pictures').'/'.@$picture}}" class="rounded" alt="{{$picture}}">
                                    @endforeach
                                </p>
                            </div>
                            <div class="callout callout-info">
                                <h5>Report Sounds</h5><hr>

                                <p>
                                    @foreach(@$sounds as $sound)
                                        <a href="{{asset('report_files/sounds').'/'.@$sound}}" download>
                                            <button class="btn btn-info"><i class="fa fa-download"></i> {{@$sound}}</button>
                                        </a>
                                    @endforeach
                                </p>
                            </div>
                            <div class="callout callout-info">
                                <h5>Other Files</h5><hr>

                                <p>
                                    @foreach(@$files as $file)
                                        <a href="{{asset('report_files/files').'/'.@$file}}" download>
                                            <button class="btn btn-info"><i class="fa fa-download"></i> {{@$file}}</button>
                                        </a>
                                    @endforeach
                                </p>
                            </div>
                            <div class="callout callout-success">
                                <h5>Report Groups</h5><hr>
                                <p>
                                    @foreach(@$report->groups as $group)
                                        <button class="btn btn-primary">{{@$group->name}}</button>
                                    @endforeach
                                </p>
                            </div>
                            <div class="callout callout-success">
                                <h5>Report Tags</h5><hr>
                                <p>
                                    @foreach(@$report->tags as $tag)
                                        <button class="btn btn-primary">{{@$tag->name}}</button>
                                    @endforeach
                                </p>
                            </div>
                            <div class="callout callout-warning">
                                <h5>Report Editor</h5><hr>

                                    <div class="form-group row">
                                        <label class="col-form-label">Name</label>
                                        <div class="col-sm-5">
                                            <input readonly class="form-control" value="{{$report->user->name}}">
                                        </div>
                                    </div>
                                <div class="form-group row">
                                    <label class="col-form-label">Email</label>
                                    <div class="col-sm-5">
                                        <input readonly class="form-control" value="{{$report->user->email}}">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
