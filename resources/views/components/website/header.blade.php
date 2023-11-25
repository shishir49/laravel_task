<div class="w-header d-flex align-items-center">
    <div class="container">
        <div class="row">
            <a href="{{ url('/') }}" class="col logo text-center text-white">
                <span class="display-6">Blog Application</span>
            </a>
            @if(auth()->check()) 
                @if(auth()->user()->type == 'admin')
                <div class="col navigation-menu">
                    <a href="{{ url('admin/dashboard') }}" class="">{{ auth()->user()->name }}</a>
                </div>
                @else 
                <div class="col navigation-menu">
                    <a href="{{ url('user/dashboard') }}" class="">{{ auth()->user()->name }}</a>
                </div>
                @endif
            @else
            <div class="col navigation-menu">
                <a href="{{ route('login') }}" class="">Login</a>
                <a href="{{ route('registration') }}" class="">Registration</a>
            </div>
            @endif
        </div>
    </div>
</div>