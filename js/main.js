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
            
            if (scrollTop > headerHeight) {
                $mainNav.addClass('sticky');
                $('body').css('padding-top', $mainNav.outerHeight());
            } else {
                $mainNav.removeClass('sticky');
                $('body').css('padding-top', 0);
            }
            
            if (scrollTop > lastScrollTop && scrollTop > headerHeight) {
                $mainNav.addClass('nav-hidden');
            } else {
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
    
    // Search Form Toggle
    function initSearchToggle() {
        const $searchToggle = $('.search-toggle').first();
        const $searchContainer = $('.search-form-container').first();
        const $searchForm = $('.search-form').first();
        
        if ($searchToggle.length && $searchContainer.length) {
            $searchToggle.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $searchContainer.toggleClass('hidden');
                
                if (!$searchContainer.hasClass('hidden')) {
                    setTimeout(() => {
                        $('.search-field').focus();
                    }, 100);
                }
            });
            
            $(document).on('click', function(event) {
                if (!$searchContainer.is(event.target) && 
                    $searchContainer.has(event.target).length === 0 && 
                    !$searchToggle.is(event.target)) {
                    $searchContainer.addClass('hidden');
                }
            });
            
            if ($searchForm.length) {
                $searchForm.on('submit', function() {
                    setTimeout(() => {
                        $searchContainer.addClass('hidden');
                    }, 100);
                });
            }
        }
    }

    // Mobile Menu Initialization
    function initMobileMenu() {
        const $menuToggle = $('.menu-toggle');
        const $mainMenu = $('.main-menu');
        
        $menuToggle.on('click', function() {
            $mainMenu.toggleClass('show');
            $(this).attr('aria-expanded', $mainMenu.hasClass('show'));
        });
        
        if ($(window).width() <= 768) {
            $('.main-menu .menu-item-has-children > a').after('<button class="submenu-toggle"><i class="fas fa-chevron-down"></i></button>');
            
            $('.submenu-toggle').on('click', function(e) {
                e.preventDefault();
                $(this).toggleClass('active');
                $(this).siblings('.sub-menu').slideToggle();
            });
        }
    }

    // Initialize main menu functionality
    function initMainMenu() {
        $('.main-menu li.menu-item-has-children > a').append('<i class="fas fa-chevron-down"></i>');
        
        $('.main-menu li.menu-item-has-children').hover(
            function() {
                $(this).children('.sub-menu').addClass('show');
            },
            function() {
                $(this).children('.sub-menu').removeClass('show');
            }
        );
    }

    // Initialize everything when document is ready
    $(document).ready(function() {
        initStickyHeader();
        initBackToTop();
        initResponsiveVideos();
        initImageLightbox();
        initSearchToggle();
        initMobileMenu();
        initMainMenu();
    });

})(jQuery);