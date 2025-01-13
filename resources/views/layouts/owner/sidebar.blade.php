<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">
                <img src="{{ asset('assets/templates/user/img/logo/Logo PG.jpg') }}" alt="Logo" style="width: 30px; height: 30px; margin-right: 10px;">
                Owner
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>

            <!-- Dashboard -->
            <li class="{{ Route::is('owner.dashboard') ? 'active' : '' }}">
                <a class="nav-link" style="color: rgb(40, 168, 253);" href="{{ route('owner.dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="{{ Request::is('owner.admins') }}">
                <a class="nav-link" href="{{ route('owner.admins') }}">
                    <i class="fas fa-users fa-sm" style="color: rgb(40, 168, 253);"></i>
                    <span>Admin</span>
                     </a>
            </li>

            <!-- Link lainnya di sidebar -->
            <li class="{{ Request::is('owner.detail_transaksi_produks') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('owner.detail_transaksi_produks') }}">
                    <i class="fas fa-boxes fa-sm" style="color: rgb(40, 168, 253);"></i>
                    <span>Laporan Transaksi Produk</span>
                </a>
            </li>

            <!-- Laporan Transaksi Operasional -->
            <li class="{{ Request::is('owner/detail_transaksi_operasionals*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('owner.detail_transaksi_operasionals') }}">
                    <i class="fas fa-cogs fa-sm" style="color: rgb(40, 168, 253);"></i>
                    <span>Laporan Transaksi Operasional</span>
                </a>
            </li>
            
        </ul>
    </aside>
</div>
