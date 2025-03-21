/**
 * Breaking news ticker functionality
 *
 * @package Bangla24
 */

(function($) {
    'use strict';
    
    // Breaking News Ticker
    function initBreakingNewsTicker() {
        if ($('.breaking-news-ticker').length) {
            // Clone ticker items for continuous scrolling
            const $tickerItems = $('.ticker-items');
            const $tickerItemsClone = $tickerItems.children().clone();
            $tickerItems.append($tickerItemsClone);
            
            // Calculate total width
            let totalWidth = 0;
            $('.ticker-item').each(function(index) {
                if (index < $('.ticker-item').length / 2) {
                    totalWidth += $(this).outerWidth(true);
                }
            });
            
            // Set animation duration based on content length
            const duration = totalWidth * 20; // 20ms per pixel
            
            // Apply animation
            $tickerItems.css({
                'animation-duration': duration + 'ms',
                'width': totalWidth * 2 + 'px'
            });
            
            // Pause on hover
            $('.breaking-news-ticker').hover(
                function() {
                    $tickerItems.css('animation-play-state', 'paused');
                },
                function() {
                    $tickerItems.css('animation-play-state', 'running');
                }
            );
        }
    }
    
    // Initialize on document ready
    $(document).ready(function() {
        initBreakingNewsTicker();
    });
    
})(jQuery);
