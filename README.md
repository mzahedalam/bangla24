# BANGLA24 - WordPress Theme

A modern, responsive WordPress theme for news portals inspired by Prothom Alo, BBC News, and ajkerpotrika.com.

## Features

- **Modern Design**: Clean, professional layout with ample whitespace and clear typography
- **Responsive Layout**: Fully responsive design that works perfectly on all devices
- **Breaking News Ticker**: Highlight time-sensitive updates with an animated ticker
- **Featured Posts Section**: Showcase important articles in a prominent featured area
- **Category-Based Navigation**: Intuitive navigation organized by content categories
- **Dark Mode Support**: Toggle between light and dark modes for comfortable reading
- **Social Media Integration**: Easy sharing and following options for social platforms
- **Author Bio Section**: Highlight content creators with author information and social links
- **Related Posts**: Show related content to keep readers engaged
- **Performance Optimized**: Fast loading with critical CSS, deferred JavaScript, and image optimization
- **Accessibility Ready**: WCAG compliant with keyboard navigation, screen reader support, and more
- **SEO Friendly**: Clean code and semantic markup for better search engine visibility

## Requirements

- WordPress 5.6 or higher
- PHP 7.4 or higher
- Modern web browser

## Installation

1. Upload the `modern-news-portal` folder to the `/wp-content/themes/` directory
2. Activate the theme through the 'Themes' menu in WordPress
3. Go to Appearance > Customize to configure theme options

## Theme Structure

```
modern-news-portal/
├── css/
│   ├── custom.css
│   └── responsive.css
├── js/
│   ├── main.js
│   ├── navigation.js
│   ├── responsive.js
│   └── ticker.js
├── images/
│   └── default images
├── inc/
│   ├── customizer.php
│   ├── jetpack.php
│   ├── performance.php
│   ├── responsive.php
│   ├── template-functions.php
│   ├── template-tags.php
│   └── widgets.php
├── template-parts/
│   ├── content-featured.php
│   ├── content-none.php
│   ├── content-responsive-image.php
│   ├── content-single.php
│   └── content.php
├── templates/
│   └── (custom page templates)
├── 404.php
├── archive.php
├── author.php
├── category.php
├── comments.php
├── date.php
├── footer.php
├── functions.php
├── header.php
├── index.php
├── page.php
├── README.md
├── screenshot.png
├── search.php
├── sidebar.php
├── single.php
├── style.css
└── tag.php
```

## Customization

### Theme Options

The theme can be customized through the WordPress Customizer:

1. Go to Appearance > Customize
2. Available sections:
   - Site Identity: Logo, site title, and tagline
   - Colors: Primary and secondary color scheme
   - Header Options: Header layout and elements
   - Footer Options: Footer widgets and copyright text
   - Typography: Font family and size options
   - Homepage Layout: Featured posts and content organization
   - Post Display Options: Meta information and featured images

### Widget Areas

The theme includes the following widget areas:

- Main Sidebar: Appears on posts and pages
- Header Ad: For advertisement in the header
- Footer 1-4: Four footer widget areas

### Navigation Menus

The theme supports the following menu locations:

- Primary Menu: Main navigation menu
- Top Menu: Secondary menu in the header top bar
- Footer Menu: Links in the footer
- Social Menu: Social media links

## Performance Features

The theme includes several performance optimizations:

- Critical CSS inlining for faster initial render
- Deferred loading of non-critical JavaScript
- Responsive images with WebP support
- Browser caching headers
- Lazy loading for below-the-fold images
- Removal of unnecessary WordPress features

## Responsive Design

The theme is fully responsive with breakpoints at:

- Desktop: 992px and above
- Tablet: 768px to 991px
- Mobile: 577px to 767px
- Small Mobile: 576px and below

## Accessibility

The theme follows WCAG 2.1 guidelines with features like:

- Keyboard navigation
- Screen reader text
- Skip links
- Focus styles
- ARIA attributes
- Color contrast compliance
- Dark mode
- Reduced motion support

## Credits

- Font Awesome for icons
- Google Fonts for typography
- Inspiration from Prothom Alo, BBC News, and ajkerpotrika.com

## License

This theme is licensed under the GPL v2 or later.

## Support

For support, please contact [support@example.com](mailto:support@example.com)
