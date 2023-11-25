@extends('layouts.dashboardLayout')

@section('content')
<div class="container mt-4">
    <div class="headline my-4">
      <h3>Create Blog</h3>
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="{{ url('create-blog') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Blog Title">
            @if($errors->has('title'))
                <div class="text-danger">{{ $errors->first('title') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="blog-post" class="form-label">Post <span class="text-danger">*</span></label>
            <textarea class="form-control" name="blog_post" id="blog-post" rows="3"></textarea>
            @if($errors->has('blog_post'))
                <div class="text-danger">{{ $errors->first('blog_post') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Featured Image <span class="text-danger">*</span></label>
            <input class="form-control" name="featured_img" type="file" id="formFile">
            @if($errors->has('featured_img'))
                <div class="text-danger">{{ $errors->first('featured_img') }}</div>
            @endif
        </div>

        <button class="btn btn-primary">Submit</button>
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