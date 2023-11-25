<div class="d-sidebar">
    <div class="brand">
        <a href="{{ url('/') }}" class="h4">Blog Application</a>
    </div>
    <div class="menu">
        <div class="primary-menu">
            @if(request()->is('user/*'))
            <a href="{{url('user/dashboard')}}" class="menu-item {{(request()->is('user/dashboard')) ? 'active' : ''}}">
                <div class="dropdown-title">
                <i class="fa-solid fa-house p-x-15"></i> Dashboard {{session('userType')}}
                </div>
            </a>  
            @endif
            @if(request()->is('admin/*'))
            <a href="{{url('admin/dashboard')}}" class="menu-item {{(request()->is('admin/dashboard')) ? 'active' : ''}}">
                <div class="dropdown-title">
                <i class="fa-solid fa-house p-x-15"></i> Dashboard 
                </div>
            </a>  
            @endif
        </div>

        <div class="primary-menu dropdown">
            <a href="#" class="menu-item">
                <div class="dropdown-title {{(request()->is('user/dashboard/blog*')) ? 'active' : ''}}">
                <i class="fa-solid fa-book-open p-x-15"></i> Blog <i class="fa-solid fa-caret-down float-right p-x-15"></i>
                </div>    
            </a>
            <div class="dropdown-content {{(request()->is('user/dashboard/blog*')) ? '' : 'invisible'}}">
                @if(request()->is('user/*'))
                <a href="{{url('user/dashboard/blog/list')}}" class="{{(request()->is('user/dashboard/blog/list')) ? 'active-background' : ''}}">List</a>
                <a href="{{url('user/dashboard/blog/create')}}" class="{{(request()->is('user/dashboard/blog/create')) ? 'active-background' : ''}}">Create</a>
                @endif
                @if(request()->is('admin/*'))
                <a href="{{url('admin/dashboard/blog/list')}}" class="{{(request()->is('admin/dashboard/blog/list')) ? 'active-background' : ''}}">List</a>
                @endif
            </div>
        </div>

        <div class="primary-menu">
            <a href="{{url('logout')}}" class="menu-item">
                <div class="dropdown-title">
                <i class="fa-solid fa-sign-out p-x-15"></i> Logout
                </div>
            </a>    
        </div>
    </div>
</div>