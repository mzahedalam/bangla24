/**
 * Responsive JavaScript functionality for BANGLA24 theme
 *
 * @package Bangla24
 */

(function($) {
    'use strict';
    
    // Responsive Menu
    function initResponsiveMenu() {
        const $menuToggle = $('.menu-toggle');
        const $mainMenu = $('.main-menu');
        
        // Toggle menu on click
        $menuToggle.on('click', function() {
            $mainMenu.toggleClass('toggled');
            
            if ($menuToggle.attr('aria-expanded') === 'true') {
                $menuToggle.attr('aria-expanded', 'false');
            } else {
                $menuToggle.attr('aria-expanded', 'true');
            }
        });
        
        // Handle submenu toggles
        $('.dropdown-toggle').on('click', function(e) {
            e.preventDefault();
            const $parent = $(this).parent();
            $parent.toggleClass('toggled');
            
            if ($(this).attr('aria-expanded') === 'true') {
                $(this).attr('aria-expanded', 'false');
            } else {
                $(this).attr('aria-expanded', 'true');
            }
        });
        
        // Close menu on outside click
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.main-navigation').length && $mainMenu.hasClass('toggled')) {
                $mainMenu.removeClass('toggled');
                $menuToggle.attr('aria-expanded', 'false');
            }
        });
        
        // Handle window resize
        $(window).on('resize', function() {
            if ($(window).width() > 768 && $mainMenu.hasClass('toggled')) {
                $mainMenu.removeClass('toggled');
                $menuToggle.attr('aria-expanded', 'false');
            }
        });
    }
    
    // Responsive Images
    function initResponsiveImages() {
        // Add lazy loading to images on smaller screens
        function handleImages() {
            if ($(window).width() < 768) {
                $('.article-image img, .featured-main img, .featured-side-item img').attr('loading', 'lazy');
            }
        }
        
        handleImages();
        $(window).on('resize', handleImages);
    }
    
    // Responsive Text
    function initResponsiveText() {
        // Adjust excerpt length based on screen width
        function adjustExcerpts() {
            $('.article-excerpt').each(function() {
                const $excerpt = $(this);
                const fullText = $excerpt.data('full-text') || $excerpt.text();
                
                if (!$excerpt.data('full-text')) {
                    $excerpt.data('full-text', fullText);
                }
                
                let wordCount = 20;
                
                if ($(window).width() < 576) {
                    wordCount = 10;
                } else if ($(window).width() < 768) {
                    wordCount = 15;
                }
                
                const words = fullText.split(' ');
                if (words.length > wordCount) {
                    $excerpt.text(words.slice(0, wordCount).join(' ') + '...');
                }
            });
        }
        
        adjustExcerpts();
        $(window).on('resize', adjustExcerpts);
    }
    
    // Responsive Layout
    function initResponsiveLayout() {
        // Move sidebar to bottom on mobile
        function adjustLayout() {
            if ($(window).width() < 992) {
                if ($('.sidebar').prev('.main-content').length === 0) {
                    $('.sidebar').insertAfter('.main-content');
                }
            }
        }
        
        adjustLayout();
        $(window).on('resize', adjustLayout);
    }
    
    // Initialize on document ready
    $(document).ready(function() {
        initResponsiveMenu();
        initResponsiveImages();
        initResponsiveText();
        initResponsiveLayout();
    });
    
})(jQuery);
