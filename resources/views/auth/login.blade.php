@extends('layouts.websiteLayout')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="card m-4" style="width: 25rem;">
        <div class="card-body">
            <form id="login" method="POST">
                <p class="display-6 mb-3 text-center">Login Panel</p>
                
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email <span class="text-danger">*</span></label>
                    <input id="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password <span class="text-danger">*</span></label>
                    <input id="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#login').on('submit', function(e) {
        e.preventDefault();

        var email = $("#email").val()
        var password = $("#password").val()

        // var token = localStorage.getItem('token');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{url('verifyUser')}}",
            type: "POST",
            dataType: 'json',
            data: {
                email: email,
                password: password
            },
            error: function(err) {
                alert("Username Password combination is incorrect");
            },
            success: function(data) {
                console.log(data);

                localStorage.setItem('token', JSON.stringify(data.token))
                if(data.type == 'user') {
                    window.location = '/user/dashboard';
                } else {
                    window.location = '/admin/dashboard';
                }
            }
        });
    })
})
</script>
@endsection