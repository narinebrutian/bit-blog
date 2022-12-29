@extends('admin.layouts.app')

@section('post-head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('main-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                </div>
            </div><!-- /.container-fluid -->
        </section>

        @include('components.messages')

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-offset-5">
                            <h3 class="card-title">Posts</h3>
                        </div>
                        <div class="col-lg-offset-5">
                            <a class="btn btn-success" href="{{ route('post.create') }}">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" >ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Title</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Subtitle</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Slug</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Created at</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Edit</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Delete</th>
                                    </tr>
                                    </thead>



                                    <tbody>
                                        @foreach($posts as $post)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->subtitle }}</td>
                                                <td>{{ $post->slug }}</td>
                                                <td>{{ $post->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('post.edit', $post->id) }}">
                                                        <button class="btn btn-warning">Edit</button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Deleting post</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Delete this post?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-primary">OK</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- Modal -->
                                                    <button class="btn btn-danger" data-id="{{$post->id}}" data-toggle="modal" data-target="#exampleModal">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">ID</th>
                                            <th rowspan="1" colspan="1">Title</th>
                                            <th rowspan="1" colspan="1">Subtitle</th>
                                            <th rowspan="1" colspan="1">Slug</th>
                                            <th rowspan="1" colspan="1">Created at</th>
                                            <th rowspan="1" colspan="1">Edit</th>
                                            <th rowspan="1" colspan="1">Delete</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

@section('post-footer')
    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/script.js') }}"></script>
@endsection
