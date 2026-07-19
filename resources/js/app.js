import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('app-sidebar');
    const toggleBtn = document.getElementById('sidebar-toggle');
    const mobileToggleBtn = document.getElementById('mobile-sidebar-toggle');
    const overlay = document.getElementById('sidebar-overlay');
    const mainContent = document.getElementById('main-content');

    // Desktop collapse
    toggleBtn?.addEventListener('click', () => {
        sidebar.classList.toggle('is-collapsed');
        const collapsed = sidebar.classList.contains('is-collapsed');
        mainContent.style.marginLeft = collapsed ? '80px' : '';
        // Tutup accordion saat collapse
        if (collapsed) {
            document.querySelectorAll('.accordion-content').forEach(c => {
                c.classList.remove('max-h-96');
                c.classList.add('max-h-0');
            });
            document.querySelectorAll('.accordion-chevron').forEach(c => c.classList.remove('rotate-90'));
        }
    });

    // Mobile drawer
    mobileToggleBtn?.addEventListener('click', () => {
        sidebar.classList.add('is-open');
        overlay.classList.remove('hidden');
    });
    overlay?.addEventListener('click', () => {
        sidebar.classList.remove('is-open');
        overlay.classList.add('hidden');
    });

    // Accordions
    document.querySelectorAll('[data-accordion]').forEach(btn => {
        btn.addEventListener('click', () => {
            if (sidebar.classList.contains('is-collapsed')) return;
            const content = btn.nextElementSibling;
            const chevron = btn.querySelector('.accordion-chevron');
            content.classList.toggle('max-h-0');
            content.classList.toggle('max-h-96');
            chevron?.classList.toggle('rotate-90');
        });
    });
});
