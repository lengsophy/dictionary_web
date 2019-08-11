<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="sidebar-wrapper"> 
        <div class="user">
            <div class="photo">
                <img class="avatar border-gray" src="{{url('images/default_avatar_male.jpg')}}" alt="...">
            </div>
            <div class="info">
                <a href="#">
                  <span>
                   {{ Auth::user()->name}}
                  </span>
                </a>
            </div>
        </div>
        <!--  -->
        <ul class="nav">
            @if(is_permission('dashboard'))
            <li class="nav-item {!!(Request::is('/')) ? 'active' : ' ' !!} ">
                <a href="{{url('/')}}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @endif
            @if(is_permission('dictionarylist'))
            <li class="nav-item {!!(Request::is('dictionarylist')) ? 'active' : ' ' !!} || {!!(Request::is('dictionarylist/*')) ? 'active' : ' ' !!}">
                <a href="{{url('/dictionarylist')}}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>Dictionary List</p>
                </a>
            </li>
            @endif
            @if(is_permission('admin_user'))
            <li>
                <a data-toggle="collapse" href="#AdminController">
                    <i class="nc-icon nc-circle-10"></i>
                    <p>User & Role<b class="caret"></b></p>
                </a>
                <div class="collapse {!!(Request::is('user')) ? 'show' : ' ' !!} || {!!(Request::is('user/*')) ? 'show' : ' ' !!} || {!!(Request::is('role')) ? 'show' : ' ' !!} || {!!(Request::is('role/*')) ? 'show' : ' ' !!}"
                    id="AdminController">
                    <ul class="nav">
                        @if(is_permission('admin_user'))
                        <li
                            class="nav-item {!!(Request::is('user')) ? 'active' : ' ' !!} || {!!(Request::is('user/*')) ? 'active' : ' ' !!}">
                            <a href="{{url('user')}}">
                                <i class="nc-icon nc-minimal-right"></i>
                                <span class="sidebar-normal sub_title">User Admin</span>
                            </a>
                        </li>
                        @endif
                        @if(is_permission('role_permission'))
                        <li
                            class="nav-item {!!(Request::is('role')) ? 'active' : ' ' !!} || {!!(Request::is('role/*')) ? 'active' : ' ' !!}">
                            <a href="{{url('role')}}">
                                <i class="nc-icon nc-minimal-right"></i>
                                <span class="sidebar-normal sub_title">Role & Permission</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif
        </ul>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
   
</script>
@endpush