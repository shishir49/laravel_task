@extends('layouts.dashboardLayout')

@section('content')
<div class="container mt-4">
    <div class="headline my-4">
      <h3>Edit Blog</h3>
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="{{ url('blog/update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $data->title }}" placeholder="Blog Title">
            @if($errors->has('title'))
                <div class="text-danger">{{ $errors->first('title') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="blog-post" class="form-label">Post <span class="text-danger">*</span></label>
            <textarea class="form-control" name="blog_post" id="blog-post" rows="3">{{ $data->blog_post }}</textarea>
            @if($errors->has('blog_post'))
                <div class="text-danger">{{ $errors->first('blog_post') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <div class="preview">
                <img src="{{ asset('user/images/blog/'.$data->featured_img) }}" height="80" width="150" alt="">
            </div>
            <label for="formFile" class="form-label">Featured Image</label>
            <input type="hidden" name="old_img" value="{{$data->featured_img}}">
            <input class="form-control" name="featured_img" type="file" id="formFile">
            @if($errors->has('featured_img'))
                <div class="text-danger">{{ $errors->first('featured_img') }}</div>
            @endif
        </div>
        @if(auth()->user()->type == 'admin')
        <div class="mb-3">
            <label for="type" class="form-label">Status:</label>
            <select id="type" name="status" class="form-select" value="{{$data->status}}" aria-label="Default select example">
                @if($data->status == 'Active')
                <option selected value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                @else
                <option value="Active">Active</option>
                <option selected value="Inactive">Inactive</option>
                @endif
                
            </select>
        </div>
        @endif
        <button class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#blog-post').summernote({
        placeholder: 'Write your blog here ...',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    });
</script>
@endsection