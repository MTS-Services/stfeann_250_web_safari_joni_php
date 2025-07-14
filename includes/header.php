 
 

 
 <section class="navbar_page-wrapper">
            <nav class="navbar_navbar">
                <div class="navbar_navbar-container">
                    <div class="navbar_navbar-content">
                        <div class="navbar_mobile-menu-toggle-wrapper" onclick="toggleMobileMenu()">
                            <button id="mobile-menu-button" class="navbar_mobile-menu-button">
                                <span class="navbar_sr-only">Open main menu</span>
                                <svg  id="hamburger-icon" class="navbar_icon" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                <svg   id="close-icon" class="navbar_icon navbar_hidden"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </form>

                    <div class="navbar_user-action">
                        <button id="open-user-modal-button" class="navbar_user-button">
                            <svg class="navbar_icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </button>
                        <dialog id="user-modal" class="navbar_user-modal">
                            <div class="navbar_modal-content">
                                <h3>Welcome!</h3>
                                <div class="navbar_modal-buttons-inline">
                                    <a href="<?= isLoggedIn() ? '/backend.php?page=dashboard' : '/backend.php?page=dashboard' ?>
                                    " class="navbar_modal-button navbar_primary-button">
                                       <?= isLoggedIn() ? 'Dashboard' : "Login" ?>
                                    </a>
                                    <a href="?page=register" class="navbar_modal-button navbar_secondary-button">Create
                                        Account</a>
                                </div>
                                <div class="navbar_modal-admin-login">
                                    <a href="#" class="navbar_modal-button navbar_admin-button">Admin Login</a>
                                </div>
                                <div class="navbar_modal-actions">
                                    <button id="close-user-modal-button"
                                        class="navbar_modal-close-button">Close</button>
                                </div>
                            </div>
                        </dialog>
                    </div>

                <div oneclick="toggleMobileMenu()" id="mobile-menu" class="navbar_mobile-nav navbar_hidden">
                    <a href="?page=home" class="navbar_mobile-nav-link navbar_active">Início</a>
                    <a href="?page=shop" class="navbar_mobile-nav-link">Loja</a>
                    <a href="?page=about" class="navbar_mobile-nav-link">Sobre nós</a>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="navbar_mobile-nav navbar_hidden">
            <a href="?page=home" class="navbar_mobile-nav-link navbar_active">Início</a>
            <a href="?page=shop" class="navbar_mobile-nav-link">Loja</a>
            <a href="?page=about" class="navbar_mobile-nav-link">Sobre nós</a>
        </div>
    </nav>
</section>