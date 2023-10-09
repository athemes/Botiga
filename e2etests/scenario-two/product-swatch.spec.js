/**
 * Product Swatch e2e Tests
 * 
 */
const { test, expect } = require('@playwright/test');

test('Product Swatch - Single Product: Swatch tooltip is visible', async ({ page }) => {
    await page.goto('http://localhost:6064/?product=thick-gold-earrings');
    await page.locator( 'body.single-product .entry-summary .botiga-variations-wrapper .botiga-variation-item' ).first().hover();
    await expect( page.locator( 'body.single-product .entry-summary .botiga-variations-wrapper .botiga-variation-item .botiga-variation-tooltip' ).first() ).toBeVisible();
});

test('Product Swatch - Single Product: Swatches are functional (when we click on them)', async ({ page }) => {
    await page.goto('http://localhost:6064/?product=thick-gold-earrings');
    await page.locator( 'body.single-product .entry-summary .botiga-variations-wrapper .botiga-variation-item' ).first().click();
    await expect( page.locator( 'body.single-product .entry-summary .reset_variations' ) ).toBeVisible();
});

test('Product Swatch - Single Product Sticky Add To Cart: Swatches are functional (when we click on them)', async ({ page }) => {
    await page.goto('http://localhost:6064/?product=thick-gold-earrings');
    await page.locator( 'body.single-product .botiga-single-sticky-add-to-cart-wrapper .botiga-variations-wrapper .botiga-variation-item' ).first().click();
    await expect( page.locator( 'body.single-product .botiga-single-sticky-add-to-cart-wrapper .reset_variations' ) ).toBeVisible();
});

test('Product Swatch - Quick View Popup: Swatches are functional (when we click on them)', async ({ page }) => {
    await page.goto('http://localhost:6064/?post_type=product');
    await page.locator( 'body.woocommerce-shop .site-main .products .product' ).first().hover();
    await page.locator( 'body.woocommerce-shop .site-main .products .product .botiga-quick-view' ).first().click();
    await page.locator( 'body.woocommerce-shop .botiga-quick-view-popup-content .botiga-variations-wrapper .botiga-variation-item' ).first().click();
    await expect( page.locator( 'body.woocommerce-shop .botiga-quick-view-popup-content .reset_variations' ) ).toBeVisible();
});

test('Product Swatch - Display Swatches On Shop Catalog: Swatches are functional (when we click on them)', async ({ page }) => {
    await page.goto('http://localhost:6064/?post_type=product');
    await page.locator( 'body.woocommerce-shop .site-main .products .product .botiga-variations-wrapper .botiga-variation-item' ).first().click();
    await expect( page.locator( 'body.woocommerce-shop .site-main .products .product .botiga-variations-wrapper .botiga-variation-item' ).first() ).toHaveClass(/active/);
});

test('Product Swatch - Display Swatches On Shop Catalog (WooCommerce Blocks): Swatches are functional (when we click on them)', async ({ page }) => {
    await page.goto('http://localhost:6064/');
    await page.locator( 'body.home .site-main .wc-block-grid__products .wc-block-grid__product .botiga-variations-wrapper .botiga-variation-item' ).first().click();
    await expect( page.locator( 'body.home .site-main .wc-block-grid__products .wc-block-grid__product .botiga-variations-wrapper .botiga-variation-item' ).first() ).toHaveClass(/active/);
});

test('Product Swatch - Display Swatches On Shop Catalog (Search page with no results - popular grid): Swatches are functional (when we click on them)', async ({ page }) => {
    await page.goto('http://localhost:6064/?s=randomsearch&post_type=product');
    await page.locator( 'body.search .site-main .products .product .botiga-variations-wrapper .botiga-variation-item' ).first().click();
    await expect( page.locator( 'body.search .site-main .products .product .botiga-variations-wrapper .botiga-variation-item' ).first() ).toHaveClass(/active/);
});

test('Product Swatch - Display Swatches On Shop Catalog (Search page with results): Swatches are functional (when we click on them)', async ({ page }) => {
    await page.goto('http://localhost:6064/?s=a&post_type=product');
    await page.locator( 'body.search .site-main .products .product .botiga-variations-wrapper .botiga-variation-item' ).first().click();
    await expect( page.locator( 'body.search .site-main .products .product .botiga-variations-wrapper .botiga-variation-item' ).first() ).toHaveClass(/active/);
});

test('Product Swatch Widget - Filter By Widget: Swatches are functional (when we click on them)', async ({ page }) => {
    await page.goto('http://localhost:6064/?post_type=product');
    await page.locator( 'body.post-type-archive-product #secondary .botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-item' ).first().click();
    await expect( page ).toHaveURL('http://localhost:6064/?post_type=product&filter_color=bronze&query_type_color=or');
});

test('Product Swatch Widget - Active Filter: Widget is displayed when we select an attribute', async ({ page }) => {
    await page.goto('http://localhost:6064/?post_type=product');
    await page.locator( 'body.post-type-archive-product #secondary .botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-item' ).first().click();
    await expect( page.locator( 'body.post-type-archive-product #secondary .botiga_widget_product_swatch_active_filter' ) ).toBeVisible();
});