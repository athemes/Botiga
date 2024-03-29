/**
 * Footer Builder e2e Tests
 * 
 */
const { test, expect } = require('@playwright/test');

// Front-End - Desktop tests
test.describe('Front-End — Desktop tests', () => {

    // Footer menu - Dropdowns are visibible when mouse hover
    test('Footer menu - Dropdowns are visibible when mouse hover', async ({ page }) => {
        await page.goto('http://localhost:6062/');
        await page.locator( '.bhfb-desktop #footer-copyright-menu .menu-item-has-children' ).hover();
        await expect(page.locator( '.bhfb-desktop #footer-copyright-menu li.menu-item-has-children > .sub-menu > li:nth-child(1) > a' )).toBeVisible();
    });

});

// Front-End - Mobile tests
test.describe('Front-End — Mobile tests', () => {
   
    // Set the viewport to mobile
    test.use({ viewport: { width: 600, height: 900 } });

    // Mobile footer menu dropdown toggle is working
    test('Mobile footer menu dropdown toggle is working', async ({ page }) => {
        await page.goto('http://localhost:6062/');
        await page.locator( '.bhfb-component-footer_menu .menu > li.menu-item-has-children > .dropdown-symbol' ).click();
        await expect(page.locator( '.bhfb-component-footer_menu .menu > li.menu-item-has-children > .sub-menu > li:nth-child(1) > a' )).toBeVisible();
    });

});

// Customizer Tests
test.describe('Customizer Tests', () => {

    test.use({ viewport: { width: 1440, height: 900 } });

    const adminLoginAction = async (page) => {
        await page.locator('#user_login').fill('admin');
        await page.locator('#user_pass').fill('admin');
        await page.click('#wp-submit');
    }

    // Components sections open when "edit" button is clicked
    test('Components sections open when "edit" button is clicked', async ({ page }) => {

        // Increase the test timeout
        test.slow();
        
        await page.goto('http://localhost:6062/wp-admin/customize.php');

        // Login to admin
        await adminLoginAction( page );

        // Wait for the page to load
        await page.waitForLoadState( 'networkidle' );

        await page.frameLocator('iframe').first().locator( '.bhfb-desktop .bhfb-main_footer_row' ).hover();
        await page.frameLocator('iframe').first().locator( '.bhfb-desktop .bhfb-main_footer_row > span > button' ).click();

        await expect(page.locator( '#sub-accordion-section-botiga_section_fb_main_footer_row' )).toHaveClass( /open/ );
    });

});