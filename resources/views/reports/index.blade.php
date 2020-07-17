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
                    <h1 class="m-0 text-dark">Reports</h1>
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
                           
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{url('createReport')}}" type="button" class="btn btn-success add_report"><i class="fa fa-plus"></i> Add New Report</a>
                            <table id="tablestyle" class="table table-bordered table-striped">
                                <thead>

                                <tr>
                                    <th>Report Name</th>
                                    <th>Editor</th>
                                    <th hidden>content</th>
                                    <th>Groups</th>
                                    <th hidden>tags</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{@$report->name}}</td>
                                        <td>{{@$report->user->name}}</td>
                                        <td hidden>{{@$report->content}}</td>
                                        <td>
                                            @foreach(@$report->groups as $group)
                                                {{$group->name}}<br>
                                            @endforeach
                                        </td>
                                        <td hidden>
                                            @foreach(@$report->tags as $tag)
                                                {{$tag->name}}
                                            @endforeach
                                        </td>
                                        <td>{{@$report->created_at}}</td>
                                        <td id="crud">
                                            @if(@$report->user->id == Auth::user()->id || Auth::user()->hasRole('admin'))
                                            <a href="{{url('deleteReport/'.@$report->id)}}"
                                               onclick="confirm('are you sure to delete the report')" type="button"
                                               class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>

                                            <a href="{{url('editReport/'.@$report->id)}}" type="button"
                                               class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                            @endif
                                            <a href="{{url('showReport/'.@$report->id)}}" type="button"
                                               class="btn btn-info"><i class="fa fa-eye"></i> Show</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Report Name</th>
                                    <th>Editor</th>
                                    <th hidden>content</th>
                                    <th>Groups</th>
                                    <th hidden>tags</th>
                                    <th>Created at</th>
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
