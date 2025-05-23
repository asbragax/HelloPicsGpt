<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar">
    <div class="sidebar-content">
        <ul class="nav">
            <li class="nav-header">Navegação</li>
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}">
                    <i class="fa fa-image"></i>
                    <span>Pedidos</span>
                </a>
            </li>
            <!-- Adicione mais itens aqui -->
        </ul>
    </div>
</div>
<div class="app-sidebar-bg"></div>
<!-- END #sidebar -->
