<!doctype html>
<html lang="en">
@include('user.layouts.head')

<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('register') }}">Register</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Page Header-->

<header class="masthead" style="background-image: url({{ asset(Storage::disk('local')->url($post->image)) }})">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading text-left">
                        <h1>{{ $post->title }}</h1>
                        <h2 class="subheading">{{ $post->subtitle }}</h2>
{{--                        <span class="meta">--}}
{{--                            Posted by--}}
{{--                            <a href="#!">Start Bootstrap</a>--}}
{{--                            on August 24, 2022--}}
{{--                        </span>--}}
                    </div>
                </div>
            </div>
        </div>
</header>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0" nonce="6WP58FS3"></script>
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="">
                        <div class="">
                            <small class="">Created <b>{{ $post->created_at->diffForHumans() }}</b></small>
                        </div>
                        <hr class="my-4" />

                        <h3>Categories</h3>
                        <br>

                        @foreach($categories as $category)
                            <a href="{{route('category', $category->slug)}}">
                                <span class="categories">
                                    <small class="">
                                        {{ $category->name }}
                                    </small>
                                </span>
                            </a>
                        @endforeach
                    </div>

                    {!! htmlspecialchars_decode($post->body) !!}

                    <div class="">
                        <h3>Tag clouds</h3>
                        <br>
                        @foreach($post->tags as $tag)
                            <a href="{{route('tag', $tag->slug)}}">
                                <span class="tags">
                                    <small class="">
                                        {{ $tag->name }}
                                    </small>
                                </span>
                            </a>
                        @endforeach
                        <hr class="my-4" />
                        <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="5"></div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</body>
@include('user.layouts.footer')

<!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Core theme JS -->
<script src="{{asset('user/js/scripts.js')}}"></script>
</html>



