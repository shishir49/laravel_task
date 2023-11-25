@extends('layouts.websiteLayout')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="card m-4" style="width: 25rem;">
        <div class="card-body">
            <form id="registration" method="post">
                @csrf
                <p class="display-6 mb-3 text-center">Registration Panel</p>
                <div class="mb-3">
                    <label for="type" class="form-label">Register as a(n):</label>
                    <select id="type" class="form-select" aria-label="Default select example">
                        <option selected>Select an Option</option>
                        <option value="1">Admin</option>
                        <option value="0">User</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" id="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" id="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" id="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Re-enter Password <span class="text-danger">*</span></label>
                    <input type="password" id="c_password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Registration</button>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#registration').on('submit', function(e) {
        e.preventDefault();

        var type = $("#type").val()
        var name = $("#name").val()
        var email = $("#email").val()
        var username = $("#username").val()
        var password = $("#password").val()
        var c_password = $("#c_password").val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "http://127.0.0.1:8000/register",
            type: "POST",
            dataType: 'json',
            data: {
                type: type,
                name: name,
                email: email,
                username: username,
                password: password,
                c_password: c_password
            },
            error: function(err) {
                alert("Required Fields must be filled.");
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