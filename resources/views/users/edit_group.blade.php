@extends('layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Assign Group to User</h1>
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
                            <h3 class="card-title">Assign Groups</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{url('updateUserGroup/'.$user->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$user->name}}" readonly
                                           id="exampleFormControlInput1" placeholder="Name of role">
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">User Groups</label>
                                </div>
                                <div class="form-group row">
                                    @foreach($groups as $group)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="groups[]"
                                                   value="{{$group->id}}" id="defaultCheck1"
                                                   @foreach($user->groups as $Ugroup)
                                                   @if($group->id == $Ugroup->id)
                                                   checked
                                                @endif
                                                @endforeach
                                            >
                                            <label class="form-check-label" for="defaultCheck1">{{$group->name}}</label>
                                        </div>
                                    @endforeach
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
