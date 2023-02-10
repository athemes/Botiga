/**
 * Header e2e Tests
 * 
 */
const { test, expect } = require('@playwright/test');

test('header is contains "Sample Page" menu item', async ({ page }) => {
	await page.goto('http://localhost:1000/');

	// Expect a title "to contain" a substring.
	await expect(page.locator( 'li > a' )).toContainText(['Sample Pages']);
});