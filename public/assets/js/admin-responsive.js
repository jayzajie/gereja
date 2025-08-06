// Admin Responsive JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.layout-menu-toggle');
    const layoutMenu = document.getElementById('layout-menu');
    const body = document.body;
    
    // Create overlay for mobile menu
    const overlay = document.createElement('div');
    overlay.className = 'layout-menu-overlay';
    body.appendChild(overlay);
    
    // Toggle mobile menu
    if (menuToggle) {
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            toggleMobileMenu();
        });
    }
    
    // Close menu when clicking overlay
    overlay.addEventListener('click', function() {
        closeMobileMenu();
    });
    
    // Close menu on window resize if desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1200) {
            closeMobileMenu();
        }
    });
    
    // Handle submenu toggles on mobile
    const menuToggles = document.querySelectorAll('.menu-toggle');
    menuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            if (window.innerWidth < 1200) {
                e.preventDefault();
                const menuItem = this.closest('.menu-item');
                const submenu = menuItem.querySelector('.menu-sub');
                
                if (submenu) {
                    menuItem.classList.toggle('open');
                    
                    if (menuItem.classList.contains('open')) {
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    } else {
                        submenu.style.maxHeight = '0';
                    }
                }
            }
        });
    });
    
    function toggleMobileMenu() {
        layoutMenu.classList.toggle('show');
        overlay.classList.toggle('show');
        body.classList.toggle('menu-open');
    }
    
    function closeMobileMenu() {
        layoutMenu.classList.remove('show');
        overlay.classList.remove('show');
        body.classList.remove('menu-open');
    }
    
    // Improve table responsiveness
    const tables = document.querySelectorAll('table');
    tables.forEach(table => {
        if (!table.closest('.table-responsive')) {
            const wrapper = document.createElement('div');
            wrapper.className = 'table-responsive';
            table.parentNode.insertBefore(wrapper, table);
            wrapper.appendChild(table);
        }
    });
    
    // Add touch-friendly improvements
    if ('ontouchstart' in window) {
        body.classList.add('touch-device');
        
        // Improve dropdown behavior on touch devices
        const dropdowns = document.querySelectorAll('.dropdown-toggle');
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('touchstart', function(e) {
                e.stopPropagation();
            });
        });
    }
    
    // Optimize performance for mobile
    if (window.innerWidth <= 768) {
        // Disable complex animations on mobile
        const style = document.createElement('style');
        style.textContent = `
            * {
                animation-duration: 0.1s !important;
                transition-duration: 0.1s !important;
            }
        `;
        document.head.appendChild(style);
    }
});

// Utility function for responsive charts
function resizeCharts() {
    if (typeof ApexCharts !== 'undefined') {
        ApexCharts.exec('pie-chart', 'updateOptions', {
            chart: {
                width: '100%',
                height: window.innerWidth <= 768 ? 250 : 350
            }
        });
    }
}

// Call resize function on window resize
window.addEventListener('resize', debounce(resizeCharts, 250));

// Debounce function for performance
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}