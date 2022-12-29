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
                            <h1 class="card-title">Roles</h1>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        @include('components.errors')

                        @include('components.messages')

                        <form role="form" action="{{ route('roles.permissions', $role->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Role Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               value="{{$role->name}}" placeholder="Role name">
                                    </div>
                                    <div class="mt-4 p-2">
                                        <h6><b>Role permissions</b></h6><br>
                                        @if($role->permissions)
                                            @foreach($role->permissions as $rolePermission)
                                                <form action="{{ route('roles.permissions.revoke', [$role->id , $rolePermission->id]) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-primary">{{$rolePermission->name}}</button>
                                                </form>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="form-check">
                                        <select id="permission" class="form-select">
                                            @foreach($permissions as $permission)
                                                <option value="{{$permission->name}}">{{$permission->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-success">Submit</button>
                                <a href="{{ route('role.index') }}" class="btn btn-warning">Back</a>
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

