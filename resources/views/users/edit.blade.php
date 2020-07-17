@extends('layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Assign Role to User</h1>
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
                            <h3 class="card-title">Create Group</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{url('updateUserRole/'.$user->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$user->name}}" readonly
                                           id="exampleFormControlInput1" placeholder="Name of role">
                                </div>
                                <input name="oldRole" value="{{@$user->roles[0]->id}}" hidden>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Role</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="role">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input class="btn btn-primary" type="submit" value="Update">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
