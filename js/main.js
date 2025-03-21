/**
 * Main JavaScript functionality
 *
 * @package Bangla24
 */

(function($) {
    'use strict';
    
    // Sticky Header
    function initStickyHeader() {
        const $header = $('.site-header');
        const $mainNav = $('.main-navigation');
        const headerHeight = $header.outerHeight();
        let lastScrollTop = 0;
        
        $(window).scroll(function() {
            const scrollTop = $(this).scrollTop();
            
            // Add sticky class when scrolling down
            if (scrollTop > headerHeight) {
                $mainNav.addClass('sticky');
                $('body').css('padding-top', $mainNav.outerHeight());
            } else {
                $mainNav.removeClass('sticky');
                $('body').css('padding-top', 0);
            }
            
            // Hide/show on scroll direction
            if (scrollTop > lastScrollTop && scrollTop > headerHeight) {
                // Scrolling down
                $mainNav.addClass('nav-hidden');
            } else {
                // Scrolling up
                $mainNav.removeClass('nav-hidden');
            }
            
            lastScrollTop = scrollTop;
        });
    }
    
    // Back to Top Button
    function initBackToTop() {
        const $backToTop = $('<a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>');
        $('body').append($backToTop);
        
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $backToTop.addClass('show');
            } else {
                $backToTop.removeClass('show');
            }
        });
        
        $backToTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 800);
        });
    }
    
    // Responsive Video Embeds
    function initResponsiveVideos() {
        $('.entry-content iframe[src*="youtube.com"], .entry-content iframe[src*="vimeo.com"]').each(function() {
            $(this).wrap('<div class="video-container"></div>');
        });
    }
    
    // Image Lightbox
    function initImageLightbox() {
        $('.entry-content a img').parent().addClass('image-link');
        
        $('.image-link').on('click', function(e) {
            e.preventDefault();
            
            const imgSrc = $(this).attr('href');
            const $lightbox = $('<div class="lightbox"><div class="lightbox-content"><img src="' + imgSrc + '"><span class="close-lightbox">&times;</span></div></div>');
            
            $('body').append($lightbox);
            $lightbox.fadeIn(300);
            
            $('.close-lightbox, .lightbox').on('click', function() {
                $lightbox.fadeOut(300, function() {
                    $(this).remove();
                });
            });
            
            $('.lightbox-content').on('click', function(e) {
                e.stopPropagation();
            });
            
            $(document).keyup(function(e) {
                if (e.key === "Escape") {
                    $lightbox.fadeOut(300, function() {
                        $(this).remove();
                    });
                }
            });
        });
    }
    
    // Dark Mode Toggle
    function initDarkMode() {
        // Check for saved preference
        const darkModeEnabled = localStorage.getItem('darkMode') === 'enabled';
        
        // Create toggle button
        const $darkModeToggle = $('<button class="dark-mode-toggle" aria-label="Toggle Dark Mode"><i class="fas fa-moon"></i></button>');
        $('.header-top-right').prepend($darkModeToggle);
        
        // Apply dark mode if enabled
        if (darkModeEnabled) {
            $('body').addClass('dark-mode');
            $darkModeToggle.html('<i class="fas fa-sun"></i>');
        }
        
        // Toggle dark mode on click
        $darkModeToggle.on('click', function() {
            $('body').toggleClass('dark-mode');
            
            if ($('body').hasClass('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                $(this).html('<i class="fas fa-sun"></i>');
            } else {
                localStorage.setItem('darkMode', 'disabled');
                $(this).html('<i class="fas fa-moon"></i>');
            }
        });
    }
    
    // Initialize on document ready
    $(document).ready(function() {
        initStickyHeader();
        initBackToTop();
        initResponsiveVideos();
        initImageLightbox();
        initDarkMode();
    });
    
})(jQuery);
