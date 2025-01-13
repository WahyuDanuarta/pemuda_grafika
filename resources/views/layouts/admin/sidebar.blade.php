<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">
                <img src="{{ asset('assets/templates/user/img/logo/Logo PG.jpg') }}" alt="Illustration" style="width: 30px; height: 30px; margin-right: 10px;">
                 Admin 
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="{{ Route::is('admin.dashboard') }}">
                <a class="nav-link" style="color: rgb(40, 168, 253);" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span></a>
            </li>           

             <!-- Produk -->
             <li class="{{ Request::is('admin/produk*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.produk') }}">
                    <i class="fas fa-shopping-cart" style="color: rgb(40, 168, 253);"></i>
                    <span>Produk</span>
                </a>
            </li>

            <!-- Produk -->
            <li class="{{ Request::is('admin.kategori_produks') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.kategori_produks') }}">
                    <i class="fas fa-shopping-cart" style="color: rgb(40, 168, 253);"></i>
                    <span>Kategori Produk</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/kategori_operasional*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.kategori_operasional') }}">
                    <i class="fas fa-box" style="color: rgb(40, 168, 253);"></i>
                    <span>Kategori Operasional</span>
                </a>
            </li>
            
            <li class="{{ Request::is('admin.transaksi_produks') }}">
                <a class="nav-link" href="{{ route('admin.transaksi_produks') }}">
                    <i class="fas fa-shopping-cart" style="color: rgb(40, 168, 253);"></i>
                    <span>Transaksi Produk</span>
                     </a>
            </li>

            <li class="{{ Request::is('admin/transaksi-operasional*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.transaksi_operasional') }}">
                    <i class="fas fa-chart-line" style="color: rgb(40, 168, 253);"></i>
                    <span>Transaksi Operasional</span>
                </a>
            </li>
        </ul>
    </aside>
</div>