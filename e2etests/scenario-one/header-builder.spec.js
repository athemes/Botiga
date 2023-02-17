/**
 * Header Builder e2e Tests
 * 
 */
const { test, expect } = require('@playwright/test');

// Front-End - Desktop tests
test.describe('Front-End — Desktop tests', () => {

    // Primary Menu - Dropdowns are visibible when mouse hover
    test('Primary Menu - Dropdowns are visibible when mouse hover', async ({ page }) => {
        await page.goto('http://localhost:1000/');
        await page.locator( '.bhfb-desktop #primary-menu .menu-item-has-children' ).first().hover();
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

});

// Front-End - Mobile tests
test.describe('Front-End — Mobile tests', () => {
   
    // Set the viewport to mobile
    test.use({ viewport: { width: 600, height: 900 } });

    // Mobile offcanvas menu toggle is working
    test('Mobile offcanvas menu toggle is working', async ({ page }) => {        
        await page.goto('http://localhost:1000/');
        await page.locator( '.bhfb-component-mobile_hamburger .menu-toggle' ).click();
        await expect(page.locator( '.bhfb-mobile_offcanvas .menu > li:nth-child(1) > a' )).toBeVisible();
    });

    // Mobile offcanvas menu dropdown toggle is working
    test('Mobile offcanvas menu dropdown toggle is working', async ({ page }) => {
        await page.goto('http://localhost:1000/');
        await page.locator( '.bhfb-component-mobile_hamburger .menu-toggle' ).click();
        await page.locator( '.bhfb-mobile_offcanvas .menu > li.menu-item-has-children > .dropdown-symbol' ).click();
        await expect(page.locator( '.bhfb-mobile_offcanvas .menu > li.menu-item-has-children > .sub-menu > li:nth-child(1) > a' )).toBeVisible();
    });

});

// Customizer Tests
test.describe('Customizer Tests', () => {

    test.use({ viewport: { width: 1440, height: 900 } });

    const adminLoginAction = async (page) => {
        await page.locator('#user_login').fill('admin');
        await page.locator('#user_pass').fill('password');
        await page.click('#wp-submit');
    }

    // Components sections open when "edit" button is clicked
    test('Components sections open when "edit" button is clicked', async ({ page }) => {

        // Increase the test timeout
        test.slow();
        
        await page.goto('http://localhost:1000/wp-admin/customize.php');

        // Login to admin
        await adminLoginAction( page );

        // Wait for the page to load
        await page.waitForLoadState( 'networkidle' );

        await page.frameLocator('iframe').first().locator( '.bhfb-desktop .bhfb-main_header_row' ).hover();
        await page.frameLocator('iframe').first().locator( '.bhfb-desktop .bhfb-main_header_row > span > button' ).click();

        await expect(page.locator( '#sub-accordion-section-botiga_section_hb_main_header_row' )).toHaveClass( /open/ );
    });

});