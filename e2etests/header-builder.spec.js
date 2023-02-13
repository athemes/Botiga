/**
 * Header Builder e2e Tests
 * 
 */
const { test, expect } = require('@playwright/test');

// No PHP Fatal Errors
test('No PHP Fatal Errors', async ({ page }) => {
	await page.goto('http://localhost:1000/');
	await expect(page.locator( 'html' )).not.toContainText(['Fatal error:']);
});

// No PHP Notices
test('No PHP Notices', async ({ page }) => {
	await page.goto('http://localhost:1000/');
	await expect(page.locator( 'html' )).not.toContainText(['Warning:']);
});

// Primary Menu - Dropdowns are visibible when mouse hover
test('Primary Menu - Dropdowns are visibible when mouse hover', async ({ page }) => {
    await page.goto('http://localhost:1000/');
    await page.locator( '.bhfb-desktop #primary-menu .menu-item-has-children' ).hover();
    await expect(page.locator( '.bhfb-desktop #primary-menu li.menu-item-has-children > .sub-menu > li:nth-child(1) > a' )).toBeVisible();
});

// Secondary Menu - Dropdowns are visibible when mouse hover
test('Secondary Menu - Dropdowns are visibible when mouse hover', async ({ page }) => {
    await page.goto('http://localhost:1000/');
    await page.locator( '.bhfb-desktop #secondary .menu-item-has-children' ).hover();
    await expect(page.locator( '.bhfb-desktop #secondary li.menu-item-has-children > .sub-menu > li:nth-child(1) > a' )).toBeVisible();
});

// Search form toggle is working
test('Search form toggle is working', async ({ page }) => {
    await page.goto('http://localhost:1000/');
    await page.getByRole('link', { name: 'Search for a product' }).click();
    await expect( page.getByRole('searchbox', { name: 'Search for:' }) ).toBeVisible();
});

// Mini cart appear when we mouse hover the mini cart
test('Mini cart appear when we mouse hover the mini cart icon', async ({ page }) => {
    await page.goto('http://localhost:1000/');
    await page.locator( '#site-header-cart' ).hover();
    await expect(page.locator( '#site-header-cart .widget_shopping_cart' )).toBeVisible();
});