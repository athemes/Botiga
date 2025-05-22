/**
 * Gulpfile.
 * Gulp with WordPress.
 */

/**
 * Load WPGulp Configuration.
 */
const config = require('./wpgulp.config.js');

/**
 * Load Plugins.
 */
const gulp = require('gulp');
const { exec } = require('child_process');

// CSS related plugins.
const nodesass     = require('sass')
const sass         = require('gulp-sass')(nodesass);
const minifycss    = require('gulp-uglifycss');
const autoprefixer = require('gulp-autoprefixer');
const mmq          = require('gulp-merge-media-queries');
const rtlcss       = require('gulp-rtlcss');

// JS related plugins.
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const babel  = require('gulp-babel');

// Utility related plugins.
const rename      = require('gulp-rename');
const lineec      = require('gulp-line-ending-corrector');
const filter      = require('gulp-filter');
const wpPot       = require('gulp-wp-pot');
const sort        = require('gulp-sort');
const cache       = require('gulp-cache');
const remember    = require('gulp-remember');
const plumber     = require('gulp-plumber');
const beep        = require('beepbeep');
const zip         = require('gulp-zip');
 
/**
 * Custom Error Handler.
 */
const errorHandler = r => {
	beep();
};
 
/**
 * Task: `styles`.
 */
const styleTasks = config.styles.map((style) => {
	const taskName = style.name + 'StyleTask';

	gulp.task(taskName, () => {
		return gulp
			.src(style.src, {allowEmpty: true})
			.pipe(plumber(errorHandler))
			.pipe(
				sass({
					errLogToConsole: config.errLogToConsole,
					outputStyle: 'expanded',
					precision: config.precision
				})
			)
			.on('error', sass.logError)
			.pipe(autoprefixer(config.BROWSERS_LIST))
			.pipe(lineec())
			.pipe(
				rename({
					basename: style.file
				})
			)
			.pipe(gulp.dest(style.destination))
			.pipe(filter('**/*.css'))
			.pipe(mmq({log: true}));
	});

	return taskName;
});
 
/**
 * Task: StylesMin.
 */
const styleMinTasks = config.styles.map((style) => {
	const taskName = style.name + 'StyleMinTask';

	gulp.task(taskName, () => {
		return gulp
			.src(style.src, {allowEmpty: true})
			.pipe(plumber(errorHandler))
			.pipe(
				sass({
					errLogToConsole: config.errLogToConsole,
					outputStyle: 'compressed',
					precision: config.precision
				})
			)
			.on('error', sass.logError)
			.pipe(autoprefixer(config.BROWSERS_LIST))
			.pipe(lineec())
			.pipe(
				rename({
					basename: style.file,
					suffix: '.min'
				})
			)
			.pipe(gulp.dest(style.destination))
			.pipe(filter('**/*.css'))
			.pipe(mmq({log: true}));
	});

	return taskName;
});

/**
 * Task: Scripts.
 */
const scriptTasks = config.scripts.map((script) => {
	const taskName = script.name + 'ScriptTask';

	gulp.task(taskName, () => {
		return gulp
			.src(script.src, {since: gulp.lastRun(taskName)})
			// .pipe(newer(script.destination))
			.pipe(plumber(errorHandler))
			.pipe(
				babel({
					presets: [
						[
							'@babel/preset-env',
							{
								targets: {browsers: config.BROWSERS_LIST}
							}
						]
					]
				})
			)
			.pipe(remember(script.src))
			.pipe(concat(script.file + '.js'))
			.pipe(lineec())
			.pipe(gulp.dest(script.destination))
			.pipe(
				rename({
					basename: script.file,
					suffix: '.min'
				})
			)
			.pipe(uglify())
			.pipe(lineec())
			.pipe(gulp.dest(script.destination));
	});

	return taskName;
});

/**
 * Task: `clearCache`.
 */
gulp.task('clearCache', function (done) {
	return cache.clearAll(done);
});

/**
 * Task: `translate`.
 */
gulp.task('translate', () => {
	return gulp
		.src(config.watchPhp)
		.pipe(sort())
		.pipe(
			wpPot({
				domain: config.textDomain,
				package: config.packageName,
				bugReport: config.bugReport,
				lastTranslator: config.lastTranslator,
				team: config.team
			})
		)
		.pipe(gulp.dest(config.translationDestination + '/' + config.translationFile))
});

/**
 * Task: `zip`.
 */
gulp.task('zip', () => {
	const src = [...config.zipIncludeGlob, ...config.zipIgnoreGlob];
	return gulp.src(src).pipe(zip(config.zipName)).pipe(gulp.dest(config.zipDestination));
});

/**
 * Task: `copy-file-to-remote`.
 * Command args: --local-path /home/rodrigo/docker/athemes/dev/wp-content/themes/ --remote-path /var/www/html/wp-content/themes/ --file-name botiga.zip
 */
gulp.task('copy-file-to-remote', async function () {
	const localPath = process.argv[4];
	const remotePath = process.argv[6];
	const fileName = process.argv[8];

	exec(`docker cp ${ localPath }${ fileName } ddev-athemesdev-web:${ remotePath }${ fileName }`, (err, stdout, stderr) => {
		if (err) {
			console.error(`Error copying file: ${stderr}`);
		} else {
			console.log(`File copied successfully: ${stdout}`);
		}
	})
});

 /**
 * Task: `unzip-remote-file`.
 * Command args: --local-path /home/rodrigo/docker/athemes/athemesdev/ --remote-path /var/www/html/wp-content/themes/ --file-name botiga.zip
 */
gulp.task('unzip-remote-file', async function () {
	const localPath = process.argv[4];
	const remotePath = process.argv[6];
	const fileName = process.argv[8];

	exec(`cd ${ localPath }; ddev exec "unzip -o ${ remotePath }${ fileName } -d ${ remotePath }"`, (err, stdout, stderr) => {
		if (err) {
			console.error(`Error copying file: ${stderr}`);
		} else {
			console.log(`File copied successfully: ${stdout}`);
		}
	})
});

/**
 * Watch Tasks.
 */
gulp.task(
	'default',
	gulp.parallel(
		...styleTasks,
		...styleMinTasks,
		...scriptTasks, () => {

		// Global.
		gulp.watch(config.watchPhp);
		
		// Styles.
		for (const style of config.styles) {
			gulp.watch(config.watchStyles, gulp.parallel(style.name + 'StyleTask'));
			gulp.watch(config.watchStyles, gulp.parallel(style.name + 'StyleMinTask'));
		}

		// Scripts.
		for (const script of config.scripts) {
			gulp.watch(config.watchScripts, gulp.series(script.name + 'ScriptTask'));
		}

	})
);

/**
 * Production Tasks.
 *
 * Compile all assets files and exit.
 */
gulp.task( 'production', gulp.parallel( ...styleTasks, ...styleMinTasks, ...scriptTasks ) );