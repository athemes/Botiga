/**
 * Ajax Add to Cart e2e Tests
 * 
 */
const { test, expect } = require('@playwright/test');

// Ajax add to cart on shop catalog
test('Ajax add to cart on shop catalog', async ({ page }) => {
    await page.goto('http://localhost:6062/?post_type=product');
    await page.locator( 'body.woocommerce-shop .site-main .products .product' ).first().hover();
    await page.locator( 'body.woocommerce-shop .site-main .products .product .add_to_cart_button' ).first().click();

    const responsePromise = page.waitForResponse('http://localhost:6062/?wc-ajax=add_to_cart');
    const response = await responsePromise;

    await expect( response.status() ).toBe( 200 );
});

// Ajax add to cart on single product pages
test('Ajax add to cart on single product pages', async ({ page }) => {
    await page.goto('http://localhost:6062/?product=eternal-sunset-collection-lip-and-cheek-set-with-jojoba-oil');
    await page.locator( 'body.single-product .site-main .single_add_to_cart_button' ).click();

    const responsePromise = page.waitForResponse('http://localhost:6062/?wc-ajax=botiga_single_ajax_add_to_cart');
    const response = await responsePromise;

    await expect( response.status() ).toBe( 200 );
});

// Ajax add to cart on single product (related products grid)
test('Ajax add to cart on single product (related products grid)', async ({ page }) => {
    await page.goto('http://localhost:6062/?product=eternal-sunset-collection-lip-and-cheek-set-with-jojoba-oil');
    await page.locator( 'body.single-product .site-main .related.products .products .product' ).first().hover();
    await page.locator( 'body.single-product .site-main .related.products .products .product .add_to_cart_button' ).first().click();

    const responsePromise = page.waitForResponse('http://localhost:6062/?wc-ajax=add_to_cart');
    const response = await responsePromise;

    await expect( response.status() ).toBe( 200 );
});

// Ajax add to cart on custom pages (woocommerce block)
test('Ajax add to cart on custom pages (woocommerce block)', async ({ page }) => {
    await page.goto('http://localhost:6062/');
    await page.locator( 'body.home .site-main .wc-block-grid__products .wc-block-grid__product' ).first().hover();
    await page.locator( 'body.home .site-main .wc-block-grid__products .wc-block-grid__product .add_to_cart_button' ).first().click();

    const responsePromise = page.waitForResponse('http://localhost:6062/?wc-ajax=add_to_cart');
    const response = await responsePromise;

    await expect( response.status() ).toBe( 200 );
});

// Ajax add to cart on search page (with results as grid)
test('Ajax add to cart on search page (with results as grid)', async ({ page }) => {
    await page.goto('http://localhost:6062/?s=a&post_type=product');
    await page.locator( 'body.search .site-main .products .product' ).first().hover();
    await page.locator( 'body.search .site-main .products .product .add_to_cart_button' ).first().click();

    const responsePromise = page.waitForResponse('http://localhost:6062/?wc-ajax=add_to_cart');
    const response = await responsePromise;

    await expect( response.status() ).toBe( 200 );
});

// Ajax add to cart on search page (no results/popular products)
test('Ajax add to cart on search page (no results/popular products)', async ({ page }) => {
    await page.goto('http://localhost:6062/?s=randomsearch&post_type=product');
    await page.locator( 'body.search .site-main .products .product' ).first().hover();
    await page.locator( 'body.search .site-main .products .product .add_to_cart_button' ).first().click();

    const responsePromise = page.waitForResponse('http://localhost:6062/?wc-ajax=add_to_cart');
    const response = await responsePromise;

    await expect( response.status() ).toBe( 200 );
});