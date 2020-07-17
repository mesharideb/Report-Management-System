@extends('layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Home</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$users}}</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        @if(Auth::user() != null)
                            @if(Auth::user()->hasRole('admin'))
                                <a href="{{url('users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            @endif
                        @endif
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$reports}}</h3>

                            <p>Reports</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book-reader"></i>
                        </div>
                        @if(Auth::user() != null)
                            @if(Auth::user()->hasRole('admin'))
                                <a href="{{url('reports')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            @endif
                        @endif
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$groups}}</h3>

                            <p>Groups</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users-cog"></i>
                        </div>
                        @if(Auth::user() != null)
                            @if(Auth::user()->hasRole('admin'))
                                <a href="{{url('groups')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            @endif
                        @endif
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$tags}}</h3>

                            <p>Tags</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-edit"></i>
                        </div>
                        @if(Auth::user() != null)
                            @if(Auth::user()->hasRole('admin'))
                                <a href="{{url('tags')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            @endif
                        @endif
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </section>
@endsection
