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
const projectURL = 'http://localhost/at-development';

// Theme/Plugin URL. Leave it like it is; since our gulpfile.js lives in the root folder.
const productURL = './';
const browserAutoOpen = false;
const injectChanges = true;

// >>>>> Style options.
// Path to main .scss file.
const customizerSRC = './sass/customizer.scss';

const styleSRC = './sass/styles.scss';

const editorStyleSRC = './sass/editor.scss';

const woocommerceSRC = './sass/woocommerce.scss';

const multiStepCheckoutSRC = './sass/multi-step-checkout.scss';

// Path to place the compiled CSS file. Default set to root folder.
const styleDestination = './assets/css';

// Available options → 'compact' or 'compressed' or 'nested' or 'expanded'
const outputStyle = 'compressed';
const errLogToConsole = true;
const precision = 10;

// JS Vendor options.

// Path to JS vendor folder.
const jsVendorSRC = './assets/js/vendor/*.js';

// Path to customizer js file
const custSRC = './assets/js/src/customizer.js';

// Path to place the customizer scripts file.
const custDestination = './assets/js/';

//Path to customizer-scripts js file
const custScriptsSRC = './assets/js/src/customizer-scripts.js';

// Path to place the customizer scripts file.
const custScriptsDestination = './assets/js/';

// Path to place the compiled JS vendors file.
const jsVendorDestination = './assets/js/';

// Compiled JS vendors file name. Default set to vendors i.e. vendors.js.
const jsVendorFile = 'vendor';

const custFile = 'customizer';

const custScriptsFile = 'customizer-scripts';

// JS Custom options.

// Path to JS carousel.
const jsCarouselSRC = './assets/js/src/botiga-carousel.js';

// Path to JS multi step checkout.
const jsMultiStepCheckoutSRC = './assets/js/src/botiga-multi-step-checkout.js';

// Path to JS sidebar.
const jsSidebarSRC = './assets/js/src/botiga-sidebar.js';

// Path to JS custom scripts folder.
const jsCustomSRC = './assets/js/src/custom.js';

// Path to place the compiled JS custom scripts file.
const jsCustomDestination = './assets/js/';

// Compiled JS custom file name. Default set to custom i.e. custom.js.
const jsCustomFile = 'custom';

// Compiled JS carousel file name.
const jsCarouselFile = 'botiga-carousel';

// Compiled JS multi step checkout file name.
const jsMultiStepCheckoutFile = 'botiga-multi-step-checkout';

// Compiled JS sidebar file name.
const jsSidebarFile = 'botiga-sidebar';

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

const watchEditorStyles = './sass/editor.scss';

// Path to all vendor JS files.
const watchJsVendor = './assets/js/vendor/*.js';

// Path to all custom JS files.
const watchJsCustom = './assets/js/src/custom.js';

// Path to all carousel JS files.
const watchJsCarousel = './assets/js/src/botiga-carousel.js';

// Path to all multi step checkout JS files.
const watchJsMultiStepCheckout = './assets/js/src/botiga-multi-step-checkout.js';

// Path to all sidebar JS files.
const watchJsSidebar = './assets/js/src/botiga-sidebar.js';

// Path to all custom JS files.
const watchJsCustomizer = './assets/js/src/*.js';

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
	'!../@(Botiga|botiga)/**/*assets/js/src'
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
	styleSRC,
	customizerSRC,
	editorStyleSRC,
	woocommerceSRC,
	multiStepCheckoutSRC,
	styleDestination,
	outputStyle,
	errLogToConsole,
	precision,
	jsVendorSRC,
	custSRC,
	custDestination,
	custScriptsSRC,
	jsVendorDestination,
	jsVendorFile,
	custScriptsFile,
	custFile,
	jsCarouselSRC,
	jsMultiStepCheckoutSRC,
	jsSidebarSRC,
	jsCustomSRC,
	jsCustomDestination,
	custScriptsDestination,
	jsCarouselFile,
	jsMultiStepCheckoutFile,
	jsSidebarFile,
	jsCustomFile,
	imgSRC,
	imgDST,
	watchStyles,
	watchEditorStyles,
	watchJsVendor,
	watchJsCarousel,
	watchJsMultiStepCheckout,
	watchJsSidebar,
	watchJsCustom,
	watchJsCustomizer,
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
