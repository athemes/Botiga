/**
 * Quick View e2e Tests
 * 
 */
const { test, expect } = require('@playwright/test');

// Quick View - Popup opens in the shop catalog
test('Quick View - Popup opens in the shop catalog', async ({ page }) => {
    await page.goto('http://localhost:1000/?post_type=product');
    await page.locator( 'body.woocommerce-shop .site-main .products .product' ).first().hover();
    await page.locator( 'body.woocommerce-shop .site-main .products .product .botiga-quick-view' ).first().click();
    await expect( page.locator( '.botiga-quick-view-popup-content-ajax' ) ).not.toBeEmpty();
});

// Quick View - Popup opens in the single product
test('Quick View - Popup opens in the single product', async ({ page }) => {
    await page.goto('http://localhost:1000/?product=deep-sweep-2-bha-pore-cleaning-toner-with-moringa');
    await page.locator( 'body.single-product .site-main .products .product' ).first().hover();
    await page.locator( 'body.single-product .site-main .products .product .botiga-quick-view' ).first().click();
    await expect( page.locator( '.botiga-quick-view-popup-content-ajax' ) ).not.toBeEmpty();
});

// Quick View - Popup opens in the search results page (popular products grid)
test('Quick View - Popup opens in the search results page (popular products grid)', async ({ page }) => {
    await page.goto('http://localhost:1000/?s=randomsearch&post_type=product');
    await page.locator( 'body.search .site-main .products .product' ).first().hover();
    await page.locator( 'body.search .site-main .products .product .botiga-quick-view' ).first().click();
    await expect( page.locator( '.botiga-quick-view-popup-content-ajax' ) ).not.toBeEmpty();
});

// Quick View - Popup opens with default woocommerce products grid block
test('Quick View - Popup opens with default woocommerce products grid block', async ({ page }) => {
    await page.goto('http://localhost:1000/');
    await page.locator( 'body.home .site-main .wc-block-grid__products .wc-block-grid__product' ).first().hover();
    await page.locator( 'body.home .site-main .wc-block-grid__products .wc-block-grid__product .botiga-quick-view' ).first().click();
    await expect( page.locator( '.botiga-quick-view-popup-content-ajax' ) ).not.toBeEmpty();
});