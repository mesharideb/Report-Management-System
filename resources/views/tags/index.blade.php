@extends('layouts.layout')

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tags</h1>
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
                            <h3 class="card-title">Tags</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{url('createTag')}}" type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add a New Tag</a>
                            <table id="tablestyle" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{@$tag->name}}</td>
                                        <td>{{@$tag->created_at}}</td>
                                        <td>{{@$tag->updated_at}}</td>
                                        <td id="crud">
                                            <a href="{{url('deleteTag/'.@$tag->id)}}"
                                               onclick="confirm('are you sure to delete the tag')" type="button"
                                               class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                            <a href="{{url('editTag/'.@$tag->id)}}" type="button"
                                               class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
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
