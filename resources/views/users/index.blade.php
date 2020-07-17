@extends('layouts.layout')

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Groups</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tablestyle" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Groups</th>
                                    <th>Created at</th>
{{--                                    <th>Updated at</th>--}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{@$user->roles[0]->name}}</td>
                                        <td>
                                            @foreach($user->groups as $group)
                                                {{$group->name}}<br>
                                            @endforeach
                                        </td>
                                        <td>{{$user->created_at}}</td>
{{--                                        <td>{{$user->updated_at}}</td>--}}
                                        <td id="crud">
                                            @role('admin')
                                            <a href="{{url('deleteUser/'.$user->id)}}"
                                               onclick="confirm('are you sure to delete the user')" type="button"
                                               class="btn btn-danger"><i class="nav-icon fa fa-trash"></i> Delete</a>
                                            @endrole
                                            <a href="{{url('roleUser/'.$user->id)}}" type="button" class="btn btn-info"><i class="nav-icon fa fa-user-check"></i> Role</a>
                                            <a href="{{url('groupUser/'.$user->id)}}" type="button"
                                               class="btn btn-primary"><i class="nav-icon fa fa-users-cog"></i> Groups</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Groups</th>
                                    <th>Created at</th>
{{--                                    <th>Updated at</th>--}}
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
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
