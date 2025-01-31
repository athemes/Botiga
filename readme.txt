=== Botiga ===

Contributors: athemes
Tags: e-commerce, custom-menu, custom-logo, grid-layout, featured-images, right-sidebar, left-sidebar, custom-colors, editor-style, theme-options, threaded-comments, translation-ready, blog, one-column, two-columns, rtl-language-support, custom-background, custom-header, footer-widgets, post-formats, wide-blocks

Requires at least: 5.4
Version: 2.2.16
Tested up to: 6.7
Requires PHP: 7
Stable tag: 2.2.16
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A starter theme called Botiga.

== Description ==

Launch your store with Botiga. A beautiful theme that is optimized for both the block editor and Elementor. We proudly introduce Botiga, with a modern and clean design that will effortlessly match your brand. Botiga has been developed from the ground up with clean code for optimal performance. You’ll get a mobile-optimized theme that looks and works great on any device and comes with plenty of customization options as well. Discover the theme that will transform your online business.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload Theme and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= Does this theme support any plugins? =

Botiga includes support for WooCommerce and for Infinite Scroll in Jetpack.

== Changelog ==
= 2.2.17 =
Changed - Merchant compatibility: Remove extra margin-left in the Buy Now button.
Changed - Added support to x.com in the Twitter social icons.
Fixed - Customizer Additional CSS: The code editor width is wrong.
Fixed - Quick View: Unncessary doubled review counter.
Fixed - Product Card: Image radius being applied to the wrong element.
Fixed - Popular Products (search): Layout broken when 'Masonry' is set.
Fixed - Customizer: Single product price color isn't working.
Fixed - Blog Archive: The post meta author image is breaking to a new line on small containers.
Fixed - Mini Cart: The Merchant product labels and Wishlist icon are displayed over the mini cart content.

= 2.2.16 =
Fixed - Elementor Pro: Custom header/footer templates not displaying in the shop archive page.
Fixed - Single Product: Clear variation button with wrong style when it's rendered as a HTML button tag.

= 2.2.15 =
Fixed - Cart Page: Ugly CSS styling for invalid coupon notice.
Fixed - Added to cart notice ‘View Cart’ button position and style is not correct.
Fixed - Header social icons customizer: Discord is excluded from icon color style.
Fixed - Single Blog Posts: The ‘Page Builder Mode’, when enabled, isn’t following the block editor full width settings from the blocks.
Fixed - Customizer: Some section navigation items without style after WordPress 6.7.1.
Changed - Sale Badge: Improve logic and implementation for better compatibility with Merchant Storewide Sale.

= 2.2.14 =
Fixed - Translations ‘loaded too early’ warning since WordPress 6.7.
Fixed - Customizer broken after WordPress 6.7.
Fixed - Header Builder: Button color options not working.
Fixed - Elementor Tabs is conflicting with ‘button’ tag styles from Botiga.

= 2.2.13 =
Fixed - Elementor: Pages built with Elementor rendering with wrong width and spacements.

= 2.2.12 =
Fixed - Elementor: Title hidden on pages built with elementor.

= 2.2.11 =
Fixed - Merchant compatibility: Buttons styling conflict with the Side Cart module.

= 2.2.10 =
Added - New customizer options to control the products 'thumbnail_image_width' and 'single_image_width'.
Added - Blog - Single Posts: Right alignment option for the single post header.
Added - Elementor Pro Theme Builder: Compatibility with all the template types.
Fixed - Elementor Pro Custom Headers: The mini cart/side cart widget is broken in terms of styling.
Fixed - Single Product Gallery Lightbox: Styling issue with the buttons.
Fixed - Real Time Ajax Search: Hide out of stock option from WooCommerce isn’t taking effect.
Fixed - Merchant Frequently Bought Together: Broken layout when set to display products in the checkout page.
Fixed - Cart Cross Sell: Hidden when there's more than 3 products to be displayed.

= 2.2.9 =
Fixed - Plugin conflict: Buttons conflicting with the Side Cart module from Merchant. 
Fixed - WooCommerce update order review notice being displayed with wrong layout in the checkout when Merchant FBT product is added.

= 2.2.8 =
Fixed - CSS: Button HTML tags are not styled by the theme options.

= 2.2.7 =
Fixed - Customizer: Taking too much to load since WooCommerce 9.2.0+.

= 2.2.6 =
Fixed - Quick View: Issue with big images overtaking the modal container.
Fixed - Cart: Border is not consistent.
Fixed - Customizer: Tabs control over multiple color control tooltips.
Fixed - Shop Archive Categories: The category description is disappearing when pagination is active.
Fixed - Merchant Integration: Stock Scarcity module being displayed twice in the customizer single product elements sorting.

= 2.2.5 =
Added - Support to 'appearance-tools' (more block editor controls).
Fixed - Strong and bold tags: The bold style is not being applied in some browsers and OS's.
Fixed - Search Page: PhotoSwiper buttons appearing in the bottom of the page when there's no results in the search.
Fixed - Notices being hide in the Appearance > Themes page.
Fixed - Product Categories Block/Widget: PHP error when option to display only children categories is enabled.

= 2.2.4 =
Added - Header: New control for header mobile breakpoint.
Changed - Real Time Search - Search by SKU: Ensure the SKU match is the first in the results list.
Fixed - Real Time Search: Hidden products are displayed in the results.
Fixed - Some customizer styling options are not being applied to the default Woo Cart & Checkout blocks.

= 2.2.3 =
Changed - Improved menu dropdowns user experience (added hover delay).
Fixed - Merchant integration: Customizer in some rare cases breaking.

= 2.2.2 =
Added - Header Builder WooCommerce Icons Component: New option to control spacing between the icons.
Added - New option do display review rating count on product archive.
Added - New customizer option to disable the single product lightbox.
Changed - Regenerate the custom CSS file when a module is activated/deactivated.
Changed - Do not disable Merchant modules that are related to Botiga Pro when Botiga Pro is deactivated.
Changed - Single Product: Preload main product gallery image.
Changed - Cart: Display how many products are in stock before backorder.
Fixed - Quantity input displaying messed when product is variable and set to 'has-only-one-instock'.
Fixed - Sale Tag: Transparent background color isn't working.
Fixed - Botiga sticky header logo doesn’t work with big images.

= 2.2.1 =
Added - Merchant Compatibility: Single product modules from Merchant are now sortable via Botiga customizer options.
Added - Quick View: Better compatibility with Merchant plugin.
Fixed - Sticky Header: Hiding coupon notices after the scrolling.
Fixed - Lighthouse: Error regarding improve scrolling performance with passive listeners.
Fixed - RTL: Product title column not aligned to right in the cart page.
Fixed - RTL: Menu dropdowns rendering wrong.
Fixed - Real Time Ajax Search: 'See all products' not working with all permalink structures.
Fixed - Single Product Hide Breadcrumb Product Title: Categories are not rendering with link.

= 2.2.0 =
Added - Shop Category List Widget: The active category is now highlighted.
Fixed - Elementor Pro Theme Builder: The elementor pro widgets wasn't rendering correctly. 
Fixed - SKU Search: Search main query is messing when the option is enabled.

= 2.1.9 =
Fixed - Single Blog Posts: Font size customizer control not working.
Fixed - Some header builder components are breaking the layout when WooCommerce plugin is deactivated.
Fixed - Blog Posts: There’s a margin-top causing layout inconcistency.
Fixed - h1 tag it's not following customize color options.
Fixed - Sorting select is not following font-family defined from customizer.
Fixed - Single Product Ajax Add To cart: Quantity accepting empty values.

= 2.1.8 =
Fixed - Payment Options: BACS isn’t styled in the order thank you page.
Fixed - Quantity input: Lighthouse error - Links do not have a discernible name.
Fixed - Search By Sku: Returning duplicated values in some cases.

= 2.1.7 =
Added - Notice regarding WooCommerce 8.3 new cart and checkout blocks.

= 2.1.6 =
Fixed - Display Conditions: Not working conditions with input, e.g product name, category name.

= 2.1.5 =
Changed - Botiga modules will take precedence over Merchant modules.
Fixed - Blog Page: Displaying the 'Archive' title along with 'Blog'.

= 2.1.4 =
Added - Real Time Ajax Search: New option to add 'See all products' button on search results.
Changed - Real Time Ajax Search: Include variations in the results when 'include SKU' is enabled.
Changed - Update Twitter icons to X.
Fixed - Customizer Typography: Google fonts json file isn't loading in some servers.
Fixed - Mini-cart (on header) not updating when quantity increased from cart page.

= 2.1.3 =
Fixed - Add To Cart Button Layout 3: Layout is broken when quick view is disabled.
Fixed - Menus: Some color options from customizer are not applying.
Fixed - Sticky Header Logo: Sticky logo is not showing when using with header builder.

= 2.1.2 =
Added - Custom dynamic CSS: Fallback to render the css as internal style if the CSS file is not present in the uploads folder.
Changed - Custom dynamic CSS: Use CSS variables to control the values (+ performance).
Changed - Removed unused modules JS code from main theme JS file (+ performance).
Fixed - Custom dynamic CSS: Empty css values.
Fixed - WC blocks: Add to cart missaligned after adding to cart.
Fixed - Single Product Gallery: Thumbnails rendering wrong when thumbs slider option is disabled.

= 2.1.1 =
Added - New option to hide all others shipping methods when free shipping is available and match the conditions.
Changed - Single Product Sale Badge: HTML rendering position.
Fixed - Single Product + Ajax Search: The arrows from single product gallery are over the ajax search content.
Fixed - WC Blocks: Wrong alignment for add to cart button layout 4.
Fixed - Theme Dashboard License: 'key' icon breaking layout in some OS's.

= 2.1.0 =
Added - New 'Theme Dashboard' design.
Changed - Better customizer workflow in some sections. 

= 2.0.8 =
Added - New option to 'Hide Page Title' in the Blog Archives customizer settings.
Changed - Removed Botiga metabox from the page that's defined as the 'Blog' page.
Changed - Improvement to headings SEO outline structure from single product related products.
Fixed - Single Product Gallery: Some layouts with no pagination in the thumbnails.

= 2.0.7 =
Added - New product card button width option (auto or full-width).
Added - Single Product: New option to hide title on breadcrumbs.
Changed - Cross Sell Carousel: Allow 1, 2, 3, 4, 5, 6 columns in the JS code.
Changed - Improvements to admin block editor layout appearance to be more close to frontend layout.
Changed - WCAG improvements.
Changed - Automatic focus on the search input when you click on the search icon.
Fixed - Customizer Adobe Typekit Control: PHP Notice.
Fixed - Global styles (customizer) are overriding the block level styles.

= 2.0.6 =
Added - New customization options for store notice.
Added - New option to search by SKU in the Ajax Search feature.
Changed - Header Builder Customizer: Automatically switch to mobile/tablet customizer mode when 'Mobile Header' shortcut nav item is clicked.
Fixed - Mobile iOS: Header search form getting rounded when we focus the input.
Fixed - Header Builder: When WooCommerce is not being used, components are getting 'undefined' value.

= 2.0.5 =
Fixed - Customizer: Images select control conflicting with ACF plugin.
Fixed - Header Builder (Customizer Tablet Mode): Components popup is wrong opening when you navigate trough 'Global Header' sections.
Fixed - Header Builder Columns: Horizontal alignment media querie breakpoint adjusted from 992px to 1025px.
Fixed - Cart: Quantity style issue between screen size 992px and 1024px.
Fixed - Quantity field not hiding when product is sold individually since WooCommerce 7.4.0.

= 2.0.4 =
Added - Schema Markup. You might enable this module from Appearance > Theme dashboard > Theme Features.
Fixed - Mobile Offcanvas: Some options like font-size, line-height, letter-spacing and others not working.
Fixed - Main menu dropdown direction reversing in a wrong way with large dropdowns.
Fixed - Elementor Pro widget 'Archive Description' not working to render shop description.

= 2.0.3 =
Fixed - Mobile menu dropdowns not expanding.

= 2.0.2 =
Fixed - PHP error when header builder mobile offcanvas contains some specific components.

= 2.0.1 =
Added - New theme dashboard 'Settings' page. 
Added - Header and Footer Builder: New option for add image background to the builder wrapper and rows.
Added - Allow Shortcodes in the default woocommerce store notice.
Added - Search Page: New option to display a grid of popular products when there's no search results.
Added - New theme hook to allow change product loops title (botiga_shop_loop_product_title).
Added - Header/Footer Builder: More customization options to builrder wrapper, rows, columns and free components (responsive padding/margin and visibility).
Changed - Moved 'Load Google Fonts Locally' module from Theme Dashboard > Theme Features to Theme Dashboard > Settings > Performance.
Fixed - CSS class added to article breaking Events Calendar layout (when list view mode is active).
Fixed - Shopping cart widget doesn’t show up in sidebar area.

= 2.0.0 =
Added - Elementor version from free demo/starter.
Added - Single product ajax add to cart functionality to single product pages.
Added - 'Canvas' page template (page with no header and footer).
Changed - Customizer UI revamped.
Changed - Some features are now modules.
Fixed - Dashboard CSS issue.
Fixed - RTL issues in the theme dashboard and customizer.
Fixed - Botiga Page Options Sidebar: Admin metabox page options images are not rendering when child theme is active.

= 1.2.2 =
Added - Header/Footer Builder: New color and text alignment options to HTML and Shortcode components.
Added - New custom theme hook to searchform.php
Added - Support to mobile anchor links (scroll to section).
Changed - Header Builder: Rename 'Site Title & Logo' component to 'Site identity'.
Changed - Change on product quantity to make it works site wide (improves 3rd party plugins compatibility).
Fixed - Show sale badge percentage text in quick view.
Fixed - Header/Footer Builder: Fixed JS error when rows data is empty.
Fixed - Footer Builder: Default footer credits/copyright alignment is wrong.
Fixed - Color Palettes: Some features like header/footer builder are not changing the color on customizer.
Fixed - Removed js code that was triggering 'wc_fragment_refresh' ajax on every request.


= 1.2.1 =
Added - Display Conditions
Added - Header Builder: New 1:4:1 ratio 'Column Layout'.
Added - Color Palettes: Backward compatibility to the old class names pattern.
Added - New customizer controls for header menu font-size, font-weight, font-family, etc.
Added - New custom theme hooks inside the quick view popup.
Changed - JS: Removed 'botiga.helpers.botigaDomReady' from scripts for better compatibility with caching plugins.
Fixed - Botiga AJAX Search Includes Products that are in draft.
Fixed - Header Builder: Mobile bug when 'sticky header' and 'on scroll to top' effect is active.

= 1.2.0 =
Fixed - PHP fatal error with some pro users after update.

= 1.1.9 =
Added - New drag and drop header and footer builder.
Added - Single Product: New option to enable carousel on product gallery thumbnails.
Added - Ensure compatibility with 'ELEX WooCommerce Dynamic Pricing' plugin.
Added - Option to control theme container max-width.
Added - Option to set product catalog columns equal height.

= 1.1.8 =
Added – Support to Post Formats.
Changed – WCAG accessibility non compliance error (search icon on header).
Fixed – Product Catalog: Wrong category item layout when 'Layout Type' is 'List'.
Fixed – Product Catalog: Wrong category image size when products per row is 1 or 2.
Fixed – Colors: Custom pallete colors are not being added to custom-style.css.

= 1.0.6 - September 24 2021 =
Added – New option to hide/show the cart and checkout coupon form
Added – Button to back to theme dashboard while previewing the demo
Fixed – Huge font size when shop catalog is set to show products and categories
Fixed – Changelog link in the theme dashboard
Fixed – Mobile single product page gallery layout with arrows issue

= 1.0.5 - September 08 2021 =
Added – New options to hide products meta (SKU, categories or tags)
Added – New option to show "Header Image" only in the home page
Added – 2 new blog post layouts
Improved – Better compatibility with "Buy Now" buttons 3rd party plugins
Fixed – Minor issues

= 1.0.4 - August 27 2021 =
Improved – Checkout - Returning Customer Login Not Styled
Fixed – Two or More Search Icons Not Working In The Second Button
Fixed – Product Variable Quantity Breaking Layout. Grouped Product Too
Fixed – No Space Between Variation Options
Fixed – Color Pallete Issues
Fixed – Sticky Header Mini Cart and Search Box Issues (with some header layouts)
Fixed – Offcanvas Mobile Menu Dropdowns Issue
Fixed – Menu Position Working Only With Header Layout 2
Fixed – Checkout Create Account: Layout Issue

= 1.0.3 - August 20 2021 =
Added – New option to toggle the display of product cross sells in cart page
Added – New option to align blog author box
Added – Product quantity input with increase and decrease buttons
Fixed – Header Layout 3 Issue
Fixed – Contact Form not being rendered after import

= 1.0.2 - August 11 2021 =
Changed description

= 1.0.1 - August 6 2021 =
Improved – Accessibility

= 1.0.0 - July 26 2021 =
Initial release

== Credits ==

* Based on Underscores https://underscores.me/, (C) 2012-2020 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2018 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)
* Folder vendor/kirki-framework https://github.com/kirki-framework, (C) kirki-framework, [MIT](https://opensource.org/licenses/MIT)
* Customizer controls https://maddisondesigns.com, (C) Anthony Hortin, [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* Cross Sell Carousel https://pawelgrzybek.github.io/siema/, (C) Paweł Grzybek, [MIT](https://opensource.org/licenses/MIT)
* Swiper https://swiperjs.com, (C) 2014-2022 Vladimir Kharlampidi, [MIT](https://opensource.org/licenses/MIT)
* Hero screenshot image https://www.flickr.com/photos/192934727@N03/51163578540/, (C) Kamruzzaman Alam, [CC0](http://creativecommons.org/publicdomain/zero/1.0/deed.en)
* Product screenshot image https://www.flickr.com/photos/192934727@N03/51330901495/, (C) Kamruzzaman Alam, [CC0](http://creativecommons.org/publicdomain/zero/1.0/deed.en)
* Product screenshot image https://www.flickr.com/photos/192934727@N03/51330631769/, (C) Kamruzzaman Alam, [CC0](http://creativecommons.org/publicdomain/zero/1.0/deed.en)
* Product screenshot image https://www.flickr.com/photos/192934727@N03/51329907086/, (C) Kamruzzaman Alam, [CC0](http://creativecommons.org/publicdomain/zero/1.0/deed.en)
* Select2 https://github.com/select2/select2, (C) Kevin Brown, Igor Vaynberg, and Select2 contributors, [MIT](https://opensource.org/licenses/MIT)
* SVG icons https://fontawesome.io/ ,(C) Dave Gandy, [SIL](https://scripts.sil.org/OFL?)
* All assets in assets/img are made for this theme https://athemes.com, (C) aThemes, [CC0](http://creativecommons.org/publicdomain/zero/1.0/deed.en)