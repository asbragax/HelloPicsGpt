<div id="header" class="app-header">
    <div class="navbar-header">
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
            <b class="me-3px">Hello</b> Pics Admin</a>
        </a>
        <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <div class="navbar-nav">
        <div class="navbar-item dropdown">
            <a href="#" data-toggle="dropdown" class="navbar-link dropdown-toggle icon">
                <i class="fa fa-user-circle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-1">
                <a href="#" class="dropdown-item">Perfil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Sair</button>
                </form>
            </div>
        </div>
    </div>
</div>
