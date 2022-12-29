@extends('admin.layouts.app')

@section('tag-head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('main-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        @include('components.messages')

        <!-- Main content -->
        <section class="content">

            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-offset-5">
                            <h3 class="card-title">Roles</h3>
                        </div>
                        <div class="col-lg-offset-5">
                            <a class="btn btn-success" href="{{route('role.create')}}">Add New</a>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Role Title</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Edit</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Delete</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a href="{{ route('role.edit', $role->id ) }}">
                                                    <button type="submit" class="btn btn-warning">Edit</button>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('role.destroy', $role->id ) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" >Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">ID</th>
                                        <th rowspan="1" colspan="1">Role Title</th>
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
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

@section('tag-footer')
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
