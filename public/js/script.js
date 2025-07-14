// Header

document.addEventListener('DOMContentLoaded', function () {
  const params = new URLSearchParams(window.location.search);
  const currentPage = params.get('page') || 'home';

  document.querySelectorAll('.navbar_nav-link').forEach(link => {
    const linkPage = new URL(link.href, window.location.origin).searchParams.get('page') || 'home';
    if (linkPage === currentPage) {
      link.classList.add('navbar_active');
    } else {
      link.classList.remove('navbar_active');
    }
  });
});


// home.js

document.addEventListener('DOMContentLoaded', function () {
  const swiper = new Swiper(".home_page_categorySlider", {
    // Optional parameters
    loop: true,
    spaceBetween: 20,

    // Autoplay
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },

    // Pagination uses the library's default class name
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },

    // Responsive breakpoints
    breakpoints: {
      // when window width is >= 0px
      0: {
        slidesPerView: 2,
      },
      // when window width is >= 640px
      640: {
        slidesPerView: 4,
      },
      // when window width is >= 1024px
      1024: {
        slidesPerView: 5,
      },
      // when window width is >= 1280px
      1280: {
        slidesPerView: 6,
      },
    },
  });
});
// footer.js

document.addEventListener('DOMContentLoaded', () => {
  // This script contains simple JavaScript for the footer.
  // The mobile accordions (using <details> and <summary>) work natively
  // and do not require JavaScript for their basic open/close functionality.

  // Example: If you wanted to add a class when a details element is opened (for more complex animations)
  const detailElements = document.querySelectorAll('.footer-details');

  detailElements.forEach(detail => {
    detail.addEventListener('toggle', () => {
      if (detail.open) {
        detail.classList.add('is-open');
        // You could add more complex animations here with CSS transitions/animations
      } else {
        detail.classList.remove('is-open');
      }
    });
  });
});
// login page script
document.querySelectorAll('.pagination-link').forEach(link => {
  link.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('.current-page')?.classList.remove('current-page');
    this.classList.add('current-page');
  });
});
document.addEventListener("DOMContentLoaded", () => {
  const openUserModalBtn = document.getElementById("open-user-modal-button");
  const closeUserModalBtn = document.getElementById("close-user-modal-button");
  const userModal = document.getElementById("user-modal");

  // Open modal
  openUserModalBtn.addEventListener("click", () => {
    userModal.showModal();
  });

  // Close modal
  closeUserModalBtn.addEventListener("click", () => {
    userModal.close();
  });

  // Optional: Close modal when clicking outside the content
  userModal.addEventListener("click", (event) => {
    const rect = userModal.querySelector(".navbar_modal-content").getBoundingClientRect();
    const isInDialog = (
      rect.top <= event.clientY && event.clientY <= rect.bottom &&
      rect.left <= event.clientX && event.clientX <= rect.right
    );
    if (!isInDialog) {
      userModal.close();
    }
  });
});

// registration.js
// Password
const passwordInput = document.getElementById("password");
const eyeWrapper = document.getElementById("eyeWrapper");
const eyeSlash = document.getElementById("eyeSlash");
let passwordVisible = false;

function handlePasswordInput() {
  if (passwordInput.value.length > 0) {
    eyeWrapper.style.display = "flex";
  } else {
    eyeWrapper.style.display = "none";
  }
}

function togglePassword() {
  passwordVisible = !passwordVisible;
  passwordInput.type = passwordVisible ? "text" : "password";
  eyeSlash.style.display = passwordVisible ? "none" : "block";
}

// Confirm Password
const confirmPasswordInput = document.getElementById("password_confirmation");
const confirmEyeWrapper = document.getElementById("confirmEyeWrapper");
const confirmEyeSlash = document.getElementById("confirmEyeSlash");
let confirmVisible = false;

function handleConfirmPasswordInput() {
  if (confirmPasswordInput.value.length > 0) {
    confirmEyeWrapper.style.display = "flex";
  } else {
    confirmEyeWrapper.style.display = "none";
  }
}

function toggleConfirmPassword() {
  confirmVisible = !confirmVisible;
  confirmPasswordInput.type = confirmVisible ? "text" : "password";
  confirmEyeSlash.style.display = confirmVisible ? "none" : "block";
}

// Init
document.addEventListener("DOMContentLoaded", () => {
  eyeWrapper.style.display = "none";
  confirmEyeWrapper.style.display = "none";
  eyeSlash.style.display = "block";
  confirmEyeSlash.style.display = "block";
});

// ////////////////////////////////////////////////////details page js
const swiper = new Swiper(".mySwiper", {
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  spaceBetween: 20,
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 15,
    },
    640: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 5,
      spaceBetween: 20,
    },
  },
});

document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("thumbnailScroll");
  const mainImage = document.getElementById("mainImage");
  const thumbnails = container.querySelectorAll("img");

  thumbnails.forEach(thumb => {
    thumb.addEventListener("click", () => {
      mainImage.src = thumb.src;
    });
  });

  let isDown = false;
  let startX;
  let scrollLeft;

  container.addEventListener('mousedown', (e) => {
    isDown = true;
    startX = e.pageX - container.offsetLeft;
    scrollLeft = container.scrollLeft;
  });

  container.addEventListener('mouseleave', () => {
    isDown = false;
  });

  container.addEventListener('mouseup', () => {
    isDown = false;
  });

  container.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - container.offsetLeft;
    const walk = (x - startX) * 2;
    container.scrollLeft = scrollLeft - walk;
  });
});

// NavBar Toggle

function toggleMobileMenu() {
  const mobileMenu = document.getElementById('mobile-menu');
  mobileMenu.classList.toggle('navbar_hidden');
}