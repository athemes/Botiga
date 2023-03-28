/**
 * PHP Errors e2e Tests
 * 
 */
const { test, expect } = require('@playwright/test');

const adminLoginAction = async (page) => {
	await page.waitForLoadState( 'networkidle' );
	await page.locator('#user_login').fill('admin');
	await page.locator('#user_pass').fill('password');
	await page.click('#wp-submit');
}

test('Home - No PHP Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('Shop Catalog - No PHP Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/?post_type=product');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('Single Product - No PHP Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/?product=deep-sweep-2-bha-pore-cleaning-toner-with-moringa');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('Cart (empty) - No PHP Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/?page_id=28');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('Cart (not empty) - No PHP Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/?post_type=product');
    await page.locator( 'body.post-type-archive-product .site-main .products .product .add_to_cart_button' ).first().click();
    await page.locator( '#site-header-cart' ).first().hover();
    await page.locator( '#site-header-cart .quantity' ).first().waitFor();
    await page.goto('http://localhost:1000/?page_id=28');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('My Account (logged-in) - No PHP Errors', async ({ page }) => {
	test.slow();
	await page.goto('http://localhost:1000/wp-admin/');

	// Login to admin
	await adminLoginAction( page );

	await page.goto('http://localhost:1000/?page_id=30');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('My Account (not logged-in) - No PHP Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/?page_id=30');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('Checkout (cart empty) - No PHP Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/?page_id=29');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('Checkout (cart not empty) - No PHP Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/?post_type=product');
    await page.locator( 'body.post-type-archive-product .site-main .products .product .add_to_cart_button' ).first().click();
    await page.locator( '#site-header-cart' ).first().hover();
    await page.locator( '#site-header-cart .quantity' ).first().waitFor();
    await page.goto('http://localhost:1000/?page_id=29');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('Search Page - No PHP Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/?s=a&post_type=product');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('404 Page - No PHP Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/?page_id=404notfound');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('Blog - No PHP Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/?page_id=393');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('Blog Post - No PHP Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/?p=119');
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

/**
 * Customizer e2e Tests
 * 
 */

test('Admin Dashboard - No PHP Errors', async ({ page }) => {
	test.slow();
	await page.goto('http://localhost:1000/wp-admin/');
	await adminLoginAction( page );
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('Customizer - No PHP Errors', async ({ page }) => {
	test.slow();
	await page.goto('http://localhost:1000/wp-admin/customize.php');
	await adminLoginAction( page );
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('Customizer (iframe) - No PHP Errors', async ({ page }) => {
	test.slow();
	await page.goto('http://localhost:1000/wp-admin/customize.php');
	await adminLoginAction( page );
	await page.waitForLoadState( 'networkidle' );
	await expect( page.frameLocator('iframe').first().locator( 'html' ) ).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});

test('Appearance > Menus - No PHP Errors', async ({ page }) => {
	test.slow();
	await page.goto('http://localhost:1000/wp-admin/nav-menus.php');
	await adminLoginAction( page );
	await page.waitForLoadState( 'networkidle' );
	await expect(page.locator( 'html' )).not.toContainText(/(Fatal error:|Warning:|Notice:)/);
});