/**
 * Navigation menu toggle and dropdown functionality
 *
 * @package Bangla24
 */

document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mainMenu = document.querySelector('.main-menu');
    
    if (menuToggle && mainMenu) {
        menuToggle.addEventListener('click', function() {
            mainMenu.classList.toggle('toggled');
            
            if (menuToggle.getAttribute('aria-expanded') === 'true') {
                menuToggle.setAttribute('aria-expanded', 'false');
            } else {
                menuToggle.setAttribute('aria-expanded', 'true');
            }
        });
    }
    
    // Add dropdown toggle to menu items with children
    const subMenuParents = document.querySelectorAll('.main-menu .menu-item-has-children');
    
    subMenuParents.forEach(function(menuItem) {
        const dropdownToggle = document.createElement('button');
        dropdownToggle.className = 'dropdown-toggle';
        dropdownToggle.setAttribute('aria-expanded', 'false');
        dropdownToggle.innerHTML = '<i class="fas fa-chevron-down"></i>';
        
        menuItem.appendChild(dropdownToggle);
        
        dropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.parentNode;
            parent.classList.toggle('toggled');
            
            if (this.getAttribute('aria-expanded') === 'true') {
                this.setAttribute('aria-expanded', 'false');
            } else {
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.main-navigation') && mainMenu && mainMenu.classList.contains('toggled')) {
            mainMenu.classList.remove('toggled');
            menuToggle.setAttribute('aria-expanded', 'false');
        }
    });
    
    // Handle keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mainMenu && mainMenu.classList.contains('toggled')) {
            mainMenu.classList.remove('toggled');
            menuToggle.setAttribute('aria-expanded', 'false');
            menuToggle.focus();
        }
    });
});
