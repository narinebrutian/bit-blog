@extends('admin.layouts.app')

@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h1 class="card-title">Create an admin</h1>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        @include('components.errors')

                        @include('components.messages')

                        <form role="form" action="{{ route('admins.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Admin name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               placeholder="Admin name">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                               placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Role</label>
                                        <select class="form-select form-select-sm mb-3">
                                            @foreach($roles as $role)
                                                <option> {{ $role -> name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a href="{{ route('admins.index') }}" class="btn btn-warning">Back</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>

    <!-- jQuery -->
    <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
@endsection
