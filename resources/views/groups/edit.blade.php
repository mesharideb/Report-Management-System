@extends('layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Group</h1>
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
                            <h3 class="card-title">Edit Group</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{url('updateGroup/'.$group->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Group Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$group->name}}" id="exampleFormControlInput1" placeholder="Name of Group">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button class="btn btn-primary" type="submit"><i class="nav-icon fa fa-edit"></i> Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
