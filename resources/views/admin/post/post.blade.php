<!doctype html>
<html lang="en">
<head>
    @include('admin.layouts.head')
</head>
<body>

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Text Editors</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Text Editors</li>
                    </ol>
                </div>
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
                        <h1 class="card-title">Titles</h1>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    @include('components.errors')

                    @include('components.messages')

                    <form role="form" action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">Post Title</label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle">Post Subtitle</label>
                                        <input type="text" class="form-control" name="subtitle" id="subtitle"
                                               placeholder="Subtitle">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Post Slug</label>
                                        <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">File1 input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="image">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="status" value="1" class="form-check-input" id="status">
                                        <label class="form-check-label" for="status">Publish</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mt-4 px-3 py-2 border-dashed border-gray-200 border rounded-lg">
                                        <label>Tags</label>

                                        <hr>

                                        @foreach($tags as $tag)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="flexCheckDefault" name="tags[]">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{$tag->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-4 px-3 py-2 border-dashed border-gray-200 border rounded-lg">
                                        <label>Categories</label>
                                        <hr>
                                        @foreach($categories as $category)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="flexCheckDefault" name="categories[]">
                                                <label class="form-check-label">
                                                    {{$category->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <br>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card card-outline card-info mt-2">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Post Body
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                  <textarea id="summernote" name="body" placeholder="Place some text here"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('post.index') }}" class="btn btn-warning">Back</a>
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

{{--<script src="{{asset('admin/dist/js/summernote.js')}}"></script>--}}

@include('admin.layouts.footer')
<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<!-- Summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{asset('admin/dist/js/summernote.js')}}"></script>


</body>
</html>
