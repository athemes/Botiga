/**
 * Wishlist e2e Tests
 * 
 */
const { test, expect, chromium } = require('@playwright/test');

test('Wishlist - Shop Catalog: Add to wishlist (ajax)', async ({ page }) => {
    await page.goto('http://localhost:6064/?post_type=product');
    await page.locator( 'body.post-type-archive-product .site-main .products .product .botiga-wishlist-button' ).first().click();

    const responsePromise = page.waitForResponse('http://localhost:6064/wp-admin/admin-ajax.php');
    const response = await responsePromise;

    await expect( response.status() ).toBe( 200 );
});

test('Wishlist - Shop Catalog: Product that is already added to wishlist heart link redirect to the product page', async ({ page }) => {
    await page.goto('http://localhost:6064/?post_type=product');
    await page.locator( 'body.post-type-archive-product .site-main .products .product .botiga-wishlist-button' ).first().click();
    await expect( page.locator( 'body.post-type-archive-product .site-main .products .product .botiga-wishlist-button' ).first() ).toHaveClass( /active/ );
});

test('Wishlist - Wishlist page: Product removal works', async ({ page }) => {
    const cookieObject = {
        name: 'woocommerce_items_in_cart_botiga_wishlist',
        value: '218',
        url: 'http://localhost:6064/'
    }

    const browser = await chromium.launch({ headless: true });
    const browserContext = await browser.newContext();
    const newPage = await browserContext.newPage();
    await browserContext.addCookies( [cookieObject] );
    await newPage.goto('http://localhost:6064/?page_id=977');
    await newPage.locator( 'body.page-template-template-wishlist .site-main .botiga-wishlist-wrapper .botiga-wishlist-remove-item' ).first().click();
    await expect( newPage.locator( 'body.page-template-template-wishlist .site-main .botiga-wishlist-wrapper .botiga-wishlist-remove-item' ).first() ).not.toBeVisible();
    await browserContext.close();
});

test('Wishlist - Single Product: Add to wishlist on the product summary works (ajax)', async ({ page }) => {
    await page.goto('http://localhost:6064/?product=crystal-filigree-earrings-with-pearls');
    await page.locator( 'body.single-product .entry-summary .botiga-wishlist-button' ).first().click();

    const responsePromise = page.waitForResponse('http://localhost:6064/wp-admin/admin-ajax.php');
    const response = await responsePromise;

    await expect( response.status() ).toBe( 200 );
});

test('Wishlist - Single Product: Add to wishlist (related products)', async ({ page }) => {
    await page.goto('http://localhost:6064/?product=crystal-filigree-earrings-with-pearls');
    await page.locator( 'body.single-product .related.products .products .product .botiga-wishlist-button' ).first().click();

    const responsePromise = page.waitForResponse('http://localhost:6064/wp-admin/admin-ajax.php');
    const response = await responsePromise;

    await expect( response.status() ).toBe( 200 );
});

test('Wishlist - WooCommerce Blocks: Add to wishlist', async ({ page }) => {
    await page.goto('http://localhost:6064/');
    await page.locator( 'body.home .site-main .wc-block-grid__products .wc-block-grid__product .botiga-wishlist-button' ).first().click();

    const responsePromise = page.waitForResponse('http://localhost:6064/wp-admin/admin-ajax.php');
    const response = await responsePromise;

    await expect( response.status() ).toBe( 200 );
});

test('Wishlist - Search page (with results): Add to wishlist', async ({ page }) => {
    await page.goto('http://localhost:6064/?s=a&post_type=product');
    await page.locator( 'body.search .site-main .products .product .botiga-wishlist-button' ).first().click();

    const responsePromise = page.waitForResponse('http://localhost:6064/wp-admin/admin-ajax.php');
    const response = await responsePromise;

    await expect( response.status() ).toBe( 200 );
});