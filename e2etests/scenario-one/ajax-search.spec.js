/**
 * Ajax Search e2e Tests
 * 
 */
const { test, expect } = require('@playwright/test');

test('Ajax Search - Header Search Form: Functional', async ({ page }) => {
    await page.goto('http://localhost:6062/');
    await page.locator( 'body.home .bhfb-desktop .bhfb-component-search .header-search' ).first().click();
    await page.locator( 'body.home .bhfb-desktop .header-search-form .search-field' ).first().fill( 'eternal' );

    await expect( page.locator( 'body.home .bhfb-desktop .header-search-form .botiga-ajax-search__wrapper' ) ).not.toBeEmpty();
});