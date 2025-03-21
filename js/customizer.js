<?php
/**
 * JavaScript customizer functionality for Modern News Portal theme
 *
 * @package Modern_News_Portal
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	// Primary color.
	wp.customize( 'modern_news_portal_primary_color', function( value ) {
		value.bind( function( to ) {
			// Update CSS variables
			document.documentElement.style.setProperty('--primary-color', to);
			
			// Update specific elements
			$('.main-navigation, .article-category, .featured-main-category, .featured-side-category, .pagination .current, .back-to-top, .widget-title:after, .categories-widget .cat-count, .dark-mode-toggle.active').css('background-color', to);
			$('a, .site-title a, .main-menu .current-menu-item > a, .article-title a:hover, .article-meta a:hover, .widget a:hover').css('color', to);
			$('.widget-title, blockquote').css('border-color', to);
		} );
	} );
	
	// Secondary color.
	wp.customize( 'modern_news_portal_secondary_color', function( value ) {
		value.bind( function( to ) {
			// Update CSS variables
			document.documentElement.style.setProperty('--secondary-color', to);
			
			// Update specific elements
			$('body, button, input, select, optgroup, textarea').css('color', to);
		} );
	} );
	
	// Breaking news label.
	wp.customize( 'modern_news_portal_breaking_news_label', function( value ) {
		value.bind( function( to ) {
			$('.breaking-news-label').text(to);
		} );
	} );
	
	// Copyright text.
	wp.customize( 'modern_news_portal_copyright_text', function( value ) {
		value.bind( function( to ) {
			$('.copyright').html(to);
		} );
	} );
	
} )( jQuery );
