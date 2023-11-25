@extends('layouts.dashboardLayout')

@section('content')
<div class="container">
    <h3 class="my-4">Blogs</h3>
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session()->has('fail'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('fail') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {
    
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('api/blogData') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    
   });
</script>
@endsection