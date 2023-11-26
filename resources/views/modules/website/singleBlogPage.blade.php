@extends('layouts.websiteLayout')

@section('content')
<div class="single-blog d-flex justify-content-center">
    <div class="container d-flex justify-content-center m-4">
        <div class="blog-content">
            <div class="b-c-headline">
                <p class="display-6">{{ $data->title }}</p>
            </div>

            <div class="writer">
                <p><strong>Author</strong> {{ $data->users->name }}</p>
                <p> <i class="fa fa-calendar-alt"></i> {{ date('d/m/Y', strtotime($data->created_at)) }}</p>
            </div>

            <div class="blog-featured-image">
                <img src="{{ asset('user/images/blog/'.$data->featured_img) }}" alt="">
                <p><small>Photo: Collected from google</small></p>
            </div>

            <div class="blog-description">
                {!! $data->blog_post !!}
            </div>

            <div class="direction d-flex justify-content-center gap-4 mt-4">
                <a href="{{ url('/') }}" class="btn btn-danger">Home</a>
            </div>
        </div>
    </div>
</div>
@endsection