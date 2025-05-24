<div id="sidebar" class="app-sidebar">
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <div class="menu-header">Navegação</div>
            <div class="menu-item">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <div class="menu-text">Dashboard</div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('admin.pedidos.index') }}" class="menu-link">
                    <div class="menu-text">Pedidos</div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('admin.produtos.index') }}" class="menu-link">
                    <div class="menu-text">Produtos</div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('admin.usuarios.index') }}" class="menu-link">
                    <div class="menu-text">Usuários</div>
                </a>
            </div>
        </div>
    </div>
</div>
