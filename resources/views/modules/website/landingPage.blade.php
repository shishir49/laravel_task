@extends('layouts.websiteLayout')

@section('content')
@if(count($data) > 0)
<div class="blogs">
    @foreach($data as $blog)
    <div class="blog-card">
        <div class="b-c-headline">
            <p class="display-6">{{ $blog->title }}</p>
        </div>

        <div class="writer">
            <p><strong>Author</strong> {{ $blog->users->name }}</p>
            <p> <i class="fa fa-calendar-alt"></i> {{ date('d/m/Y', strtotime($blog->created_at)) }}</p>
        </div>

        <div class="blog-description">
            {!! strlen($blog->blog_post) > 500 ? substr($blog->blog_post,0,500)."..." : $blog->blog_post !!}
        </div>

        <div class="b-c-footer">
            <a href="{{ url('blog/'.$blog->id) }}" class="btn btn-primary">Read More</a>
        </div>
    </div>
    @endforeach    
</div>
@else 
<div class="blog d-flex justify-content-center align-items-center">
    <div class="m-4">
        <p class="text-center display-6">No Blog Posted Yet !</p>
        <div class="row d-flex justify-content-center m-4">
           <a href="{{ url('user/dashboard') }}" class="btn btn-warning">Be the first Blogger</a>
        </div>
    </div>
</div>
@endif
@endsection