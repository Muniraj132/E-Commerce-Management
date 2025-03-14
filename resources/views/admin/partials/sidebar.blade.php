<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-Commerce Management</div>
</a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
<li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>


<li class="nav-item {{ request()->routeIs('admin.categories.index', 'admin.products.index') ? 'active' : 'collapsed' }}">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseProductManagement" aria-expanded="{{ request()->routeIs('categories.index', 'products.index') ? 'true' : 'false' }}" aria-controls="collapseProductManagement">
        <i class="fas fa-fw fa-cogs"></i>
        <span>Product Management</span>
    </a>
    <div id="collapseProductManagement" class="collapse {{ request()->routeIs('admin.categories.index', 'admin.products.index') ? 'show' : '' }}" aria-labelledby="headingProductManagement" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">Categories</a>
            <a class="collapse-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">Products</a>
        </div>
    </div>
</li>
    <li class="nav-item {{ request()->routeIs('admin.orders.index') ? 'active' : 'collapsed' }}">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOrderManagement" aria-expanded="{{ request()->routeIs('orders.index') ? 'true' : 'false' }}" aria-controls="collapseOrderManagement">
        <i class="fas fa-fw fa-cogs"></i>
        <span>Orders Management</span>
    </a>
    <div id="collapseOrderManagement" class="collapse {{ request()->routeIs('admin.orders.index') ? 'show' : '' }}" aria-labelledby="collapseOrderManagement" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">Orders</a>
        </div>
    </div>
</li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
    </li>



<li class="nav-item">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-link btn btn-link">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>
    </form>
</li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
