/**
 * WPGulp Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 *
 * @package WPGulp
 */

// Project options.

// Local project URL of your already running WordPress site.
// > Could be something like "wpgulp.local" or "localhost"
// > depending upon your local WordPress setup.
const projectURL = 'http://localhost:6060';

// Theme/Plugin URL. Leave it like it is; since our gulpfile.js lives in the root folder.
const productURL = './';
const browserAutoOpen = false;
const injectChanges = true;

// >>>>> Style options.
// Path to main .scss file.
const customizerSRC = './sass/customizer.scss';

const customizerRtlSRC = './sass/customizer-rtl.scss';

const metaboxSRC = './sass/metabox.scss';

const styleSRC = './sass/styles.scss';

const editorStyleSRC = './sass/editor.scss';

const woocommerceSRC = './sass/woocommerce.scss';

const dokanSRC = './sass/dokan.scss';

// Path to place the compiled CSS file. Default set to root folder.
const styleDestination = './assets/css';

// Available options → 'compact' or 'compressed' or 'nested' or 'expanded'
const outputStyle = 'compressed';
const errLogToConsole = true;
const precision = 10;

// Path to customizer js file
const custSRC = './assets/js/src/customizer.js';

// Path to place the customizer scripts file.
const custDestination = './assets/js/';

//Path to customizer-scripts js file
const custScriptsSRC = './assets/js/src/customizer-scripts.js';

// Path to place the customizer scripts file.
const custScriptsDestination = './assets/js/';

//Path to metabox-scripts js file
const metaboxScriptsSRC = './assets/js/src/metabox.js';

// Path to place the metabox scripts file.
const metaboxScriptsDestination = './assets/js/';

const custFile = 'customizer';

const custScriptsFile = 'customizer-scripts';

const metaboxScriptsFile = 'metabox';

const jsAdminDestination = './assets/js/admin/';

// JS Admin Functions.
const jsAdminFunctionsSRC = './assets/js/src/admin-functions.js';
const adminFunctionsDestination = './assets/js/';
const adminFunctionsScriptsFile = 'admin-functions';

const adminStyleDestination = './assets/css/admin/';

// Styles BHFB
const BHFBSRC = './sass/bhfb.scss';
const adminBHFBSRC = './sass/admin/bhfb.scss';
const adminCustPrevBHFBSRC = './sass/admin/bhfb-customize-preview.scss';
const adminDashboardSRC = './sass/admin/dashboard.scss';
const adminDashboardRtlSRC = './sass/admin/dashboard-rtl.scss';
const adminNoticesSRC = './sass/admin/notices.scss';

// JS BHFB
const jsAdminBHFBSRC = './assets/js/src/admin/botiga-bhfb.js';
const jsAdminCustPrevBHFBSRC = './assets/js/src/admin/botiga-bhfb-customize-preview.js';
const jsAdminDashboardSRC = './assets/js/src/admin/botiga-dashboard.js';
const jsAdminBHFBFile = 'botiga-bhfb';
const jsAdminCustPrevBHFBFile = 'botiga-bhfb-customize-preview';
const jsAdminDashboardFile = 'botiga-dashboard';

// JS Custom options.

// Path to JS carousel.
const jsCarouselSRC = './assets/js/src/botiga-carousel.js';

// Path to JS swiper.
const jsSwiperSRC = './assets/js/src/botiga-swiper.js';

// Path to JS gallery.
const jsGallerySRC = './assets/js/src/botiga-gallery.js';

// Path to JS ajax add to cart.
const jsAjaxAddToCartSRC = './assets/js/src/botiga-ajax-add-to-cart.js';

// Path to JS popup.
const jsPopupSRC = './assets/js/src/botiga-popup.js';

// Path to JS sidebar.
const jsSidebarSRC = './assets/js/src/botiga-sidebar.js';

// Path to JS ajax search.
const jsAjaxSearchSRC = './assets/js/src/botiga-ajax-search.js';

// Path to JS custom scripts folder.
const jsCustomSRC = './assets/js/src/custom.js';

// Path to place the compiled JS custom scripts file.
const jsCustomDestination = './assets/js/';

// Compiled JS custom file name. Default set to custom i.e. custom.js.
const jsCustomFile = 'custom';

// Compiled JS carousel file name.
const jsCarouselFile = 'botiga-carousel';

// Compiled JS swiper file name.
const jsSwiperFile = 'botiga-swiper';

// Compiled JS gallery file name.
const jsGalleryFile = 'botiga-gallery';

// Compiled JS gallery file name.
const jsAjaxAddToCartFile = 'botiga-ajax-add-to-cart';

// Compiled JS popup file name.
const jsPopupFile = 'botiga-popup';

// Compiled JS sidebar file name.
const jsSidebarFile = 'botiga-sidebar';

// Compiled JS ajax search file name.
const jsAjaxSearchFile = 'botiga-ajax-search';

// Images options.

// Source folder of images which should be optimized and watched.
// > You can also specify types e.g. raw/**.{png,jpg,gif} in the glob.
const imgSRC = './assets/img/raw/**/*';

// Destination folder of optimized images.
// > Must be different from the imagesSRC folder.
const imgDST = './assets/img/';

// >>>>> Watch files paths.
// Path to all *.scss files inside css folder and inside them.
const watchStyles = './sass/**/*.scss';

// Path to all admin JS files.
const watchJsAdmin = './assets/js/src/**/*.js';

// Path to all PHP files.
const watchPhp = './**/*.php';

// >>>>> Zip file config.
// Must have.zip at the end.
const zipName = 'botiga.zip';

// Must be a folder outside of the zip folder.
const zipDestination = './../'; // Default: Parent folder.

//Include all files/folders in current directory.
const zipIncludeGlob = ['../@(Botiga|botiga)/**/*'];

// Default ignored files and folders for the zip file.
const zipIgnoreGlob = [
	'!../@(Botiga|botiga)/**/*{node_modules,node_modules/**/*}',
	'!../@(Botiga|botiga)/**/*.git',
	'!../@(Botiga|botiga)/**/*.svn',
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
	'!../@(Botiga|botiga)/**/*playwright.config.js'
];

// >>>>> Translation options.
// Your text domain here.
const textDomain = 'botiga';

// Name of the translation file.
const translationFile = 'botiga.pot';

// Where to save the translation files.
const translationDestination = './languages';

// Package name.
const packageName = 'botiga';

// Where can users report bugs.
const bugReport = 'https://athemes.com/contact/';

// Last translator Email ID.
const lastTranslator = 'aThemes <team@athemes.com>';

// Team's Email ID.
const team = 'aThemes <team@athemes.com>';

// Browsers you care about for auto-prefixing. Browserlist https://github.com/ai/browserslist
// The following list is set as per WordPress requirements. Though; Feel free to change.
const BROWSERS_LIST = ['last 2 version', '> 1%'];

// Export.
module.exports = {
	projectURL,
	productURL,
	browserAutoOpen,
	injectChanges,
	adminStyleDestination,
	BHFBSRC,
	adminBHFBSRC,
	adminCustPrevBHFBSRC,
	adminDashboardSRC,
	adminDashboardRtlSRC,
	adminNoticesSRC,
	jsAdminBHFBSRC,
	jsAdminCustPrevBHFBSRC,
	jsAdminDashboardSRC,
	jsAdminBHFBFile,
	jsAdminCustPrevBHFBFile,
	jsAdminDashboardFile,
	styleSRC,
	customizerSRC,
	customizerRtlSRC,
	metaboxSRC,
	editorStyleSRC,
	woocommerceSRC,
	dokanSRC,
	styleDestination,
	outputStyle,
	errLogToConsole,
	precision,
	custSRC,
	custDestination,
	custScriptsSRC,
	metaboxScriptsSRC,
	custScriptsFile,
	metaboxScriptsFile,
	adminFunctionsScriptsFile,
	custFile,
	jsCarouselSRC,
	jsSwiperSRC,
	jsGallerySRC,
	jsAjaxAddToCartSRC,
	jsPopupSRC,
	jsSidebarSRC,
	jsAjaxSearchSRC,
	jsCustomSRC,
	jsAdminDestination,
	jsAdminFunctionsSRC,
	jsCustomDestination,
	custScriptsDestination,
	metaboxScriptsDestination,
	adminFunctionsDestination,
	jsCarouselFile,
	jsSwiperFile,
	jsGalleryFile,
	jsAjaxAddToCartFile,
	jsPopupFile,
	jsSidebarFile,
	jsAjaxSearchFile,
	jsCustomFile,
	imgSRC,
	imgDST,
	watchStyles,
	watchJsAdmin,
	watchPhp,
	zipName,
	zipDestination,
	zipIncludeGlob,
	zipIgnoreGlob,
	textDomain,
	translationFile,
	translationDestination,
	packageName,
	bugReport,
	lastTranslator,
	team,
	BROWSERS_LIST
};
