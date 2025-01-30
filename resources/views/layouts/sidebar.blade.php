<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <span class="brand-text font-weight-light">Sujon ERP</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Products</p>
                    </a>
                </li>
                {{-- Leads Start --}}
                <li class="nav-item {{ request()->is('lead-*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('lead-*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tty"></i>
                        <p>
                            Leads
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview pl-3" style="display: {{ request()->is('lead-status', 'lead-sources', 'leads', 'lead-*') ? 'block' : 'none' }};">
                        <li class="nav-item">
                            <a href="{{ route('lead.status.index') }}" class="nav-link {{ request()->is('lead-status', 'lead-status/*') ? 'active' : '' }}">
                                <i class="fas fa-blender-phone nav-icon"></i>
                                <p>Lead Status</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/lead-sources') }}" class="nav-link {{ request()->is('admin/lead-sources') ? 'active' : '' }}">
                                <i class="fas fa-globe nav-icon"></i>
                                <p>Lead Sources</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/leads') }}" class="nav-link {{ request()->is('admin/leads') ? 'active' : '' }}">
                                <i class="fas fa-tty nav-icon"></i>
                                <p>Leads</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Leads End --}}
            </ul>
        </nav>
    </div>
</aside>
