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
const avatar_dropdown = document.getElementById('avatarDropdown');

avatar.addEventListener('click', function (e) {
    e.stopPropagation(); // Prevent click from bubbling to document
    avatar_dropdown.style.display =
        avatar_dropdown.style.display === 'block' ? 'none' : 'block';
});

document.addEventListener('click', function (e) {
    if (!avatar.contains(e.target) && !avatar_dropdown.contains(e.target)) {
        avatar_dropdown.style.display = 'none';
    }
});


//////////////////////
/// Actions Icons ///
//////////////////////
function toggleDropdown(icon) {
    const menu = icon.nextElementSibling;
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




// // Add some interactive functionality
// document.addEventListener('DOMContentLoaded', function () {
//     // Gallery item click handlers
//     const galleryItems = document.querySelectorAll('.gallery-item');
//     galleryItems.forEach(item => {
//         item.addEventListener('click', function () {
//             // Add lightbox functionality here
//             console.log('Gallery item clicked');
//         });
//     });

//     // Button click handlers
//     const buttons = document.querySelectorAll('.btn');
//     buttons.forEach(button => {
//         button.addEventListener('click', function (e) {
//             // Add loading state
//             const originalText = this.innerHTML;
//             this.innerHTML = '<div class="loading"></div> Processing...';
//             this.disabled = true;

//             // Simulate API call
//             setTimeout(() => {
//                 this.innerHTML = originalText;
//                 this.disabled = false;
//             }, 2000);
//         });
//     });

//     // Overlay button handlers
//     const overlayBtns = document.querySelectorAll('.overlay-btn');
//     overlayBtns.forEach(btn => {
//         btn.addEventListener('click', function (e) {
//             e.stopPropagation();
//             console.log('Overlay button clicked');
//         });
//     });
// });