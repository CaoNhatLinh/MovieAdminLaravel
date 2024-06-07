<nav style="position:fixed;z-index:1; top:0; bottom:0;overflow:auto; height: 100vh" class="scroll navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse ">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $nguoidung->HoTen }}</strong>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="active">
                <a href="{{route('movie.index')}}"><i class="fa fa-film"></i> <span class="nav-label">Danh sách phim</span> </a>
            </li>

            <li>
                <a href="{{route('theloai.index')}}"><i class="fa fa-fill"></i> <span class="nav-label">Danh sách thể loại</span> </a>
            </li>
            <li>
                <a href="{{route('user.index')}}"><i class="fa fa-user"></i> <span class="nav-label">Danh sách người dùng</span></a>
            </li>

        </ul>

    </div>
</nav>