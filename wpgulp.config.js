/**
 * WPGulp Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 *
 * @package WPGulp
 */

// General options.
const projectURL      = 'http://localhost/botiga';
const productURL      = './';
const browserAutoOpen = false;
const injectChanges   = true;
const outputStyle     = 'compressed';
const errLogToConsole = true;
const precision       = 10;

// Styles to process.
const styles = [

	// Admin styles. ##############################

	// BHFB.
	{
		name: 'adminBHFB',
		src: './sass/admin/bhfb.scss',
		destination: './assets/css/admin',
	},

	// BHFB Customizer Preview.
	{
		name: 'adminCustPrevBHFB',
		src: './sass/admin/bhfb-customize-preview.scss',
		destination: './assets/css/admin',
	},

	// Dashboard.
	{
		name: 'adminDashboard',
		src: './sass/admin/dashboard.scss',
		destination: './assets/css/admin',
	},

	// Dashboard RTL.
	{
		name: 'adminDashboardRTL',
		src: './sass/admin/dashboard-rtl.scss',
		destination: './assets/css/admin',
	},

	// Notices.
	{
		name: 'adminNotices',
		src: './sass/admin/notices.scss',
		destination: './assets/css/admin',
	},

	// Frontend styles. ##############################

	// Customizer.
	{
		name: 'customizer',
		src: './assets/sass/customizer.scss',
		destination: './assets/css',
	},

	// Customizer RTL.
	{
		name: 'customizerRTL',
		src: './assets/sass/customizer-rtl.scss',
		destination: './assets/css',
	},

	// Metabox.
	{
		name: 'metabox',
		src: './assets/sass/metabox.scss',
		destination: './assets/css',
	},

	// Styles.
	{
		name: 'styles',
		src: './assets/sass/styles.scss',
		destination: './assets/css',
	},

	// Editor.
	{
		name: 'editor',
		src: './assets/sass/editor.scss',
		destination: './assets/css',
	},

	// WooCommerce.
	{
		name: 'woocommerce',
		src: './assets/sass/woocommerce.scss',
		destination: './assets/css',
	},

	// Dokan.
	{
		name: 'dokan',
		src: './assets/sass/dokan.scss',
		destination: './assets/css',
	},

	// Quick View.
	{
		name: 'quickView',
		src: './assets/sass/plugins/woocommerce/quick-view.scss',
		destination: './assets/css',
	},

	// Accordion.
	{
		name: 'accordion',
		src: './assets/sass/accordion.scss',
		destination: './assets/css',
	},

	// Accordion.
	{
		name: 'accordion',
		src: './assets/sass/accordion.scss',
		destination: './assets/css',
	},

];

// Scripts to process.
const scripts = [

	// Admin styles. ##############################

	// Customizer.
	{
		name: 'customizer',
		src: './assets/js/src/customizer.js',
		destination: './assets/js',
		file: 'customizer',
	},

	// Customizer Scripts.
	{
		name: 'customizerScripts',
		src: './assets/js/src/customizer-scripts.js',
		destination: './assets/js',
		file: 'customizer-scripts',
	},

	// Metabox Scripts.
	{
		name: 'metaboxScripts',
		src: './assets/js/src/metabox.js',
		destination: './assets/js',
		file: 'metabox',
	},

	// Admin Functions.
	{
		name: 'adminFunctions',
		src: './assets/js/src/admin-functions.js',
		destination: './assets/js',
		file: 'admin-functions',
	},

	// BHFB.
	{
		name: 'adminBHFB',
		src: './assets/js/src/admin/botiga-bhfb.js',
		destination: './assets/js/admin',
		file: 'botiga-bhfb',
	},

	// BHFB Customizer Preview.
	{
		name: 'adminCustPrevBHFB',
		src: './assets/js/src/admin/botiga-bhfb-customize-preview.js',
		destination: './assets/js/admin',
		file: 'botiga-bhfb-customize-preview',
	},

	// Dashboard.
	{
		name: 'adminDashboard',
		src: './assets/js/src/admin/botiga-dashboard.js',
		destination: './assets/js/admin',
		file: 'botiga-dashboard',
	},

	// Frontend styles. ##############################

	// Accordion.
	{
		name: 'accordion',
		src: './assets/js/src/botiga-accordion.js',
		destination: './assets/js',
		file: 'botiga-accordion',
	},

	// Carousel.
	{
		name: 'carousel',
		src: './assets/js/src/botiga-carousel.js',
		destination: './assets/js',
		file: 'botiga-carousel',
	},

	// Swiper.
	{
		name: 'swiper',
		src: './assets/js/src/botiga-swiper.js',
		destination: './assets/js',
		file: 'botiga-swiper',
	},

	// Gallery.
	{
		name: 'gallery',
		src: './assets/js/src/botiga-gallery.js',
		destination: './assets/js',
		file: 'botiga-gallery',
	},

	// Ajax Add to Cart.
	{
		name: 'ajaxAddToCart',
		src: './assets/js/src/botiga-ajax-add-to-cart.js',
		destination: './assets/js',
		file: 'botiga-ajax-add-to-cart',
	},

	// Popup.
	{
		name: 'popup',
		src: './assets/js/src/botiga-popup.js',
		destination: './assets/js',
		file: 'botiga-popup',
	},

	// Sidebar.
	{
		name: 'sidebar',
		src: './assets/js/src/botiga-sidebar.js',
		destination: './assets/js',
		file: 'botiga-sidebar',
	},

	// Ajax Search.
	{
		name: 'ajaxSearch',
		src: './assets/js/src/botiga-ajax-search.js',
		destination: './assets/js',
		file: 'botiga-ajax-search',
	},

	// Quick View.
	{
		name: 'quickView',
		src: './assets/js/src/botiga-quick-view.js',
		destination: './assets/js',
		file: 'botiga-quick-view',
	},

	// Custom.
	{
		name: 'custom',
		src: './assets/js/src/custom.js',
		destination: './assets/js',
		file: 'custom',
	},

];

// Watch options.
const watchStyles  = './assets/sass/**/*.scss';
const watchScripts = './assets/js/src/**/*.js';
const watchPhp     = './**/*.php';

// Zip options.
const zipName = 'botiga.zip';
const zipDestination = './../'; // Default: Parent folder.
const zipIncludeGlob = ['../@(Botiga|botiga)/**/*'];
const zipIgnoreGlob = [
	'!../@(Botiga|botiga)/**/*{node_modules,node_modules/**/*}',
	'!../@(Botiga|botiga)/**/*.git',
	'!../@(Botiga|botiga)/**/*.svn',
	'!../@(Botiga|botiga)/**/*.code-workspace',
	'!../@(Botiga|botiga)/**/*phpcs.xml',
	'!../@(Botiga|botiga)/**/*gulpfile.babel.js',
	'!../@(Botiga|botiga)/**/*wpgulp.config.js',
	'!../@(Botiga|botiga)/**/*.eslintrc.js',
	'!../@(Botiga|botiga)/**/*.eslintignore',
	'!../@(Botiga|botiga)/**/*.editorconfig',
	'!../@(Botiga|botiga)/**/*phpcs.xml.dist',
	'!../@(Botiga|botiga)/**/*vscode',
	'!../@(Botiga|botiga)/**/*package.json',
	'!../@(Botiga|botiga)/**/*package-lock.json',
	'!../@(Botiga|botiga)/**/*assets/img/raw/**/*',
	'!../@(Botiga|botiga)/**/*assets/img/raw',
	'!../@(Botiga|botiga)/**/*assets/js/src/**/*',
	'!../@(Botiga|botiga)/**/*assets/js/src',
	'!../@(Botiga|botiga)/**/*tests/**/*',
	'!../@(Botiga|botiga)/**/*tests',
	'!../@(Botiga|botiga)/**/*e2etests/**/*',
	'!../@(Botiga|botiga)/**/*e2etests',
	'!../@(Botiga|botiga)/**/*playwright-report/**/*',
	'!../@(Botiga|botiga)/**/*playwright-report',
	'!../@(Botiga|botiga)/**/*test-results/**/*',
	'!../@(Botiga|botiga)/**/*test-results',
	'!../@(Botiga|botiga)/**/*.wp-env.json',
	'!../@(Botiga|botiga)/**/*playwright.config.js',
	'!../@(Botiga|botiga)/**/*composer.json',
	'!../@(Botiga|botiga)/**/*composer.lock',
	'!../@(Botiga|botiga)/{vendor/bin,vendor/bin/**/*}',
	'!../@(Botiga|botiga)/{vendor/dealerdirect,vendor/dealerdirect/**/*}',
	'!../@(Botiga|botiga)/{vendor/phpcompatibility,vendor/phpcompatibility/**/*}',
	'!../@(Botiga|botiga)/{vendor/phpcsstandards,vendor/phpcsstandards/**/*}',
	'!../@(Botiga|botiga)/{vendor/squizlabs,vendor/squizlabs/**/*}',
	'!../@(Botiga|botiga)/{vendor/woocommerce,vendor/woocommerce/**/*}',
	'!../@(Botiga|botiga)/{vendor/wp-coding-standards,vendor/wp-coding-standards/**/*}',
	'!../@(Botiga|botiga)/{vendor/wptrt,vendor/wptrt/**/*}'
];

// Translation options.
const textDomain = 'botiga';
const translationFile = 'botiga.pot';
const translationDestination = './languages';

// Others.
const packageName = 'botiga';
const bugReport = 'https://athemes.com/contact/';
const lastTranslator = 'aThemes <team@athemes.com>';
const team = 'aThemes <team@athemes.com>';
const BROWSERS_LIST = ['last 2 version', '> 1%'];

// Export.
module.exports = {

	// General options.
	projectURL,
	productURL,
	browserAutoOpen,
	injectChanges,
	outputStyle,
	errLogToConsole,
	precision,

	// Style options.
	styles,

	// Script options.
	scripts,

	// Watch options.
	watchStyles,
	watchScripts,
	watchPhp,

	// Zip options.
	zipName,
	zipDestination,
	zipIncludeGlob,
	zipIgnoreGlob,

	// Translation options.
	textDomain,
	translationFile,
	translationDestination,

	// Others.
	packageName,
	bugReport,
	lastTranslator,
	team,
	BROWSERS_LIST,

};