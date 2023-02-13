/**
 * General e2e Tests
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