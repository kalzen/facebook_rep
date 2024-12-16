<nav class="sidebar">
    <!-- ...existing code... -->
    <li class="nav-item">
        <a href="{{ route('admin.business') }}" class="nav-link {{ request()->routeIs('admin.business') ? 'active' : '' }}">
            <i class="nav-icon fas fa-building"></i>
            <p>Business Management</p>
        </a>
    </li>
    <!-- ...existing code... -->
</nav>
