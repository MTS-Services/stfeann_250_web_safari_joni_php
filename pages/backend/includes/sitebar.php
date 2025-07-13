<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <a href="backend.php?page=dashboard">Dashboard</a>
        </div>
    </div>
    <nav>
        <ul class="nav-menu">
            <li class="nav-item ">
                <a href="backend.php?folder=user&page=index" class="nav-link <?= $folder === 'user' ? 'active' : '' ?>">
                    <span><i class="fas fa-tachometer-alt"></i></span>
                    <span>User</span>
                </a>
            </li>
            <li class="nav-item ">
                <a  href="backend.php?folder=categories&page=index" class="nav-link <?= $folder === 'categories' ? 'active' : '' ?>">
                    <span><i class="fas fa-tachometer-alt"></i></span>
                    <span>Categories</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="backend.php?folder=products&page=index" class="nav-link <?= $page === 'products' ? 'active' : '' ?>">
                    <span><i class="fas fa-tachometer-alt"></i></span>
                    <span>Products</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>