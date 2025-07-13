<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <a href="backend.php?page=dashboard">Dashboard</a>
        </div>
    </div>
    <nav>
        <ul class="nav-menu">
            <li class="nav-item ">
                <a href="backend.php?page=categories" class="nav-link <?= $page === 'categories' ? 'active' : '' ?>">
                    <span><i class="fas fa-tachometer-alt"></i></span>
                    <span>Categories</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="backend.php?page=products" class="nav-link <?= $page === 'products' ? 'active' : '' ?>">
                    <span><i class="fas fa-tachometer-alt"></i></span>
                    <span>Products</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>