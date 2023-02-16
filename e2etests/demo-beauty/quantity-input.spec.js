/**
 * Quantity Input e2e Tests
 * 
 */
const { test, expect } = require('@playwright/test');

test( 'Quantity Input - Shop Catalog: Product cards with quantity input are functional', async ({ page }) => {
    await page.goto('http://localhost:1000/?post_type=product');
    await page.locator( 'body.post-type-archive-product .site-main .products .product .quantity .botiga-quantity-plus.show' ).first().waitFor();
    await page.locator( 'body.post-type-archive-product .site-main .products .product .quantity .botiga-quantity-plus.show' ).first().click( { clickCount: 4 } );
    await expect( page.locator( 'body.post-type-archive-product .site-main .products .product .quantity .qty' ).first() ).toHaveValue( '5' );
});

test( 'Quantity Input - Single Product: Related products cards with quantity input are functional', async ({ page }) => {
    await page.goto('http://localhost:1000/?product=eternal-sunset-collection-lip-and-cheek-set-with-jojoba-oil');
    await page.locator( 'body.single-product .site-main .related.products .products .product .quantity .botiga-quantity-plus.show' ).first().waitFor();
    await page.locator( 'body.single-product .site-main .related.products .products .product .quantity .botiga-quantity-plus.show' ).first().click( { clickCount: 4 } );
    await expect( page.locator( 'body.single-product .site-main .related.products .products .product .quantity .qty' ).first() ).toHaveValue( '5' );
});

test( 'Quantity Input - Search Page: No results page popular products cards with quantity input are functional', async ({ page }) => {
    await page.goto('http://localhost:1000/?s=randomsearch&post_type=product');
    await page.locator( 'body.search .site-main .products .product .quantity .botiga-quantity-plus.show' ).first().waitFor();
    await page.locator( 'body.search .site-main .products .product .quantity .botiga-quantity-plus.show' ).first().click( { clickCount: 4 } );
    await expect( page.locator( 'body.search .site-main .products .product .quantity .qty' ).first() ).toHaveValue( '5' );
});

test( 'Quantity Input - Search Page: Results page products cards with quantity input are functional', async ({ page }) => {
    await page.goto('http://localhost:1000/?s=a&post_type=product');
    await page.locator( 'body.search .site-main .products .product .quantity .botiga-quantity-plus.show' ).first().waitFor();
    await page.locator( 'body.search .site-main .products .product .quantity .botiga-quantity-plus.show' ).first().click( { clickCount: 4 } );
    await expect( page.locator( 'body.search .site-main .products .product .quantity .qty' ).first() ).toHaveValue( '5' );
});

test( 'Quantity Input - Add to cart button is disabled if quantity == 0', async ({ page }) => {
    await page.goto('http://localhost:1000/?post_type=product');
    await page.locator( 'body.post-type-archive-product .site-main .products .product .quantity .botiga-quantity-minus.show' ).first().waitFor();
    await page.locator( 'body.post-type-archive-product .site-main .products .product .quantity .botiga-quantity-minus.show' ).first().click( { clickCount: 1 } );
    await expect( page.locator( 'body.post-type-archive-product .site-main .products .product .quantity + .add_to_cart_button' ).first() ).toHaveClass( /disabled/ );
});

test( 'Quantity Input - Single Product: Quantity button is increasing values (functional)', async ({ page }) => {
    await page.goto('http://localhost:1000/?product=eternal-sunset-collection-lip-and-cheek-set-with-jojoba-oil');
    await page.locator( 'body.single-product .site-main .entry-summary .quantity .botiga-quantity-plus.show' ).first().waitFor();
    await page.locator( 'body.single-product .site-main .entry-summary .quantity .botiga-quantity-plus.show' ).first().click( { clickCount: 4 } );
    await expect( page.locator( 'body.single-product .site-main .entry-summary .quantity .qty' ).first() ).toHaveValue( '5' );
});

test('Quantity Input - Mini Cart: Quantity input is functional', async ({ page }) => {
    await page.goto('http://localhost:1000/?post_type=product');
    await page.locator( 'body.post-type-archive-product .site-main .products .product .add_to_cart_button' ).first().click();
    await page.locator( '#site-header-cart' ).hover();
    await page.locator( '#site-header-cart' ).getByRole( 'button', { name: '+' } ).click();
    await expect( page.locator( '#site-header-cart .qty' ) ).toHaveValue( '2' );
});

test( 'Quantity Input - Cart Page: Quantity button is functional', async ({ page }) => {
    await page.goto('http://localhost:1000/?post_type=product');
    await page.locator( 'body.post-type-archive-product .site-main .products .product .add_to_cart_button' ).first().click();
    await page.locator( '#site-header-cart' ).first().hover();
    await page.locator( '#site-header-cart .quantity' ).first().waitFor();
    await page.goto('http://localhost:1000/?page_id=28');
    await page.locator( 'body.woocommerce-cart .site-main .product-quantity .quantity .botiga-quantity-plus.show' ).first().waitFor();
    await page.locator( 'body.woocommerce-cart .site-main .product-quantity .quantity .botiga-quantity-plus.show' ).first().click( { clickCount: 4 } );
    await expect( page.locator( 'body.woocommerce-cart .site-main .product-quantity .quantity .qty' ).first() ).toHaveValue( '5' );
});