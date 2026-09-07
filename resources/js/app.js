// import './bootstrap';

// import Alpine from 'alpinejs';

// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

// window.Pusher = Pusher;
// Pusher.logToConsole = true;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: '161f7b4b4efbfbced79a',
//     cluster: 'ap2',
//     forceTLS: true,
// });

// window.Alpine = Alpine;

// Alpine.start();
import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    console.log("asdfasdf");
    
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const menuBtn = document.getElementById('menuBtn');

    if (!sidebar || !menuBtn) return;

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    menuBtn.addEventListener('click', () => {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });

    overlay.addEventListener('click', closeSidebar);

    window.addEventListener('resize', () => {
        if (window.innerWidth > 992) closeSidebar();
    });

    // Logout Modal
    const logoutBtn = document.getElementById('logoutBtn');
    const logoutForm = document.getElementById('logoutForm');
    const logoutModal = document.getElementById('logoutModal');
    const cancelLogout = document.getElementById('cancelLogout');
    const confirmLogout = document.getElementById('confirmLogout');

    if (logoutBtn && logoutModal) {
        logoutBtn.addEventListener('click', () => {
            logoutModal.classList.add('active');
        });

        cancelLogout.addEventListener('click', () => {
            logoutModal.classList.remove('active');
        });

        confirmLogout.addEventListener('click', () => {
            logoutForm.submit();
        });

        // Close when clicking outside the box
        logoutModal.addEventListener('click', (e) => {
            if (e.target === logoutModal) {
                logoutModal.classList.remove('active');
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && logoutModal.classList.contains('active')) {
                logoutModal.classList.remove('active');
            }
        });
    }

});
