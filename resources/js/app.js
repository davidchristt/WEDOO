import './bootstrap';
import 'preline'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// resources/js/app.js
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('sidebarToggle');

    toggleButton.addEventListener('click', function () {
        sidebar.classList.toggle('-translate-x-full');
    });
});

