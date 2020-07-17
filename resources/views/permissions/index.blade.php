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
                    <h1 class="m-0 text-dark">Permissions</h1>
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
                            <h3 class="card-title">Permissions</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{url('createPermission')}}" type="button" class="btn btn-success"><i
                                    class="nav-icon fa fa-plus"></i> Add a New Permission</a>
                            <table id="tablestyle" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->description}}</td>
                                        <td>{{$permission->created_at}}</td>
                                        <td>{{$permission->updated_at}}</td>
                                        <td id="crud">
                                            <a href="{{url('deletePermission/'.$permission->id)}}"
                                               onclick="confirm('are you sure to delete the permission')" type="button"
                                               class="btn btn-danger"><i class="nav-icon fa fa-trash"></i> Delete</a>
                                            <a href="{{url('editPermission/'.$permission->id)}}" type="button"
                                               class="btn btn-primary"><i class="nav-icon fa fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
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
