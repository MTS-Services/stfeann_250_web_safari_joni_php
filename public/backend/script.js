function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('open');
    overlay.classList.toggle('show');
}

// Close sidebar when clicking on nav links on mobile
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            toggleSidebar();
        }
    });
});

// Handle window resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').classList.remove('show');
    }
});

///////////////////////
/// User Avatar Dropdown ///
///////////////////////
const avatar = document.getElementById('avatar');
const dropdown = document.getElementById('dropdown');

avatar.addEventListener('click', function () {
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
});

// Hide dropdown if clicked outside
document.addEventListener('click', function (e) {
    if (!avatar.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.style.display = 'none';
    }
});

//////////////////////
/// Actions Icons ///
//////////////////////
function toggleDropdown(icon) {
    const menu = icon.nextElementSibling;
    // Close all other dropdowns first
    document.querySelectorAll('.dropdown-menu').forEach(m => {
        if (m !== menu) m.style.display = 'none';
    });
    // Toggle this one
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

// Optional: Close dropdown when clicking outside
document.addEventListener('click', function (e) {
    if (!e.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
    }
});
