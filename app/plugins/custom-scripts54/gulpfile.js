// Import important packages
const gulp = require('gulp');
const plumber = require('gulp-plumber');
const rename = require('gulp-rename');
const browserSync = require('browser-sync').create();
const sourcemaps = require('gulp-sourcemaps');
const argv = require('yargs').argv;
const gulpif = require('gulp-if');

// SASS -> CSS
const sass = require('gulp-sass')(require('sass'));
sass.compiler = require('sass');
const postcss = require('gulp-postcss');
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");

// HTML
const htmlmin = require('gulp-htmlmin');

// JavaScript / TypeScript
const buffer = require('vinyl-buffer');
const { createGulpEsbuild } = require('gulp-esbuild')
const gulpEsbuild = createGulpEsbuild({ incremental: false })

// Define important variables
const src = './src';
const dest = './dist';
const mailDest = './functions/booking/processing/mailing'
const wpRoot = '../../../'
const siteName = 'go2places'
const useTypeScript = false;

// Reload the browser
const reload = (done) => {
    browserSync.reload();
    done();
};

// Serve the dev-server in the browser
const serve = (done) => {
    browserSync.init({


        baseDir: `${dest}`,
        proxy: "https://go2places:8890",

        https: {
            key:
                '/Applications/MAMP/Library/OpenSSL/certs/' +
                'go2places.key',
            cert:
                '/Applications/MAMP/Library/OpenSSL/certs/' +
                'go2places.crt',
        }


    });
    done();
};

function isProduction() {
    return argv.production ? true : false
}

// Compile SASS to CSS with gulp
const css = () => {
    // Find SASS
    return gulp.src(`${src}/sass/**/*.{sass,scss}`)
        // Init Plumber
        .pipe(plumber())
        // Start sourcemap
        .pipe(gulpif(!isProduction(), sourcemaps.init()))
        // Compile SASS to CSS
        .pipe(sass({
            includePaths: ['./node_modules']
        }).on('error', sass.logError))
        // Add suffix
        .pipe(rename({ basename: 'main', suffix: '.min' }))
        // Add Autoprefixer & cssNano
        .pipe(postcss([autoprefixer({ add: true }), cssnano()]))
        // Write sourcemap
        .pipe(gulpif(!isProduction(), sourcemaps.write('')))
        // Write everything to destination folder
        .pipe(gulp.dest(`${dest}/css`));
};

const backendCss = () => {
    // Find SASS
    return gulp.src(`${src}/sass/backend.{sass,scss}`)
        // Init Plumber
        .pipe(plumber())
        // Start sourcemap
        .pipe(gulpif(!isProduction(), sourcemaps.init()))
        // Compile SASS to CSS
        .pipe(sass({
            includePaths: ['./node_modules']
        }).on('error', sass.logError))
        // Add suffix
        .pipe(rename({ basename: 'backend', suffix: '.min' }))
        // Add Autoprefixer & cssNano
        .pipe(postcss([autoprefixer({ add: true }), cssnano()]))
        // Write sourcemap
        .pipe(gulpif(!isProduction(), sourcemaps.write('')))
        // Write everything to destination folder
        .pipe(gulp.dest(`${dest}/css`));
};





// Compile .html to minified .html
const html = () => {
    // Find HTML
    return gulp.src(`${src}/*.html`)
        // Init Plumber
        .pipe(plumber())
        // Compile HTML to minified HTML
        .pipe(htmlmin({
            collapseWhitespace: isProduction(),
            removeComments: true,
            html5: true,
            removeEmptyAttributes: true,
            sortAttributes: true,
            sortClassName: true
        }))
        // Write everything to destination folder
        .pipe(gulp.dest(`${dest}`));
};

const typescript = () => {
    return gulp.src(`${src}/script/main.ts`);
};

const javascript = () => {
    return gulp.src(`${src}/script/main.js`);
};

// Compile .js/.ts to minified .js
const script = () => {
    const sourceStream = useTypeScript ? typescript() : javascript();
    return sourceStream
        .pipe(gulpEsbuild({
            outfile: 'main.bundle.js',
            bundle: true,
            minify: true,
            sourcemap: !isProduction(),
            platform: 'browser'
        }))
        .pipe(buffer())
        .pipe(gulp.dest(`${dest}/js`));
};

const scriptBooking = () => {
    const sourceStream = gulp.src(`${src}/script/booking/booking.js`)
    return sourceStream
        .pipe(gulpEsbuild({
            outfile: 'booking.bundle.js',
            bundle: true,
            minify: true,
            sourcemap: !isProduction(),
            platform: 'browser'
        }))
        .pipe(buffer())
        .pipe(gulp.dest(`${dest}/js`));
};

const scriptBookingView = () => {
    const sourceStream = gulp.src(`${src}/script/booking-view/booking-view.js`)
    return sourceStream
        .pipe(gulpEsbuild({
            outfile: 'booking-view.bundle.js',
            bundle: true,
            minify: true,
            sourcemap: !isProduction(),
            platform: 'browser'
        }))
        .pipe(buffer())
        .pipe(gulp.dest(`${dest}/js`));
};

// Copy assets
const assets = () => {
    return gulp.src(`${src}/assets/**`)
        .pipe(gulp.dest(`${dest}/assets`));
};

// Watch changes and refresh page
const watch = () => gulp.watch(
    [
        `${src}/*.html`,
        `${src}/script/**/*.(js|ts)`,
        `${src}/sass/**/*.{sass,scss}`,
        `${dest}/**/*.php`,
        `${src}/assets/**/*.*`,

    ],
    gulp.series(
        assets,
        css,
        backendCss,
        script,
        scriptBooking,
        scriptBookingView,
        html,
        reload
    ));

// Development tasks
const dev = gulp.task('dev', gulp.series(gulp.parallel(assets, css, backendCss, script, scriptBooking, scriptBookingView, html), serve, watch));

// Build tasks
const build = gulp.task('build',
    gulp.parallel(
        assets,
        html,
        css,
        backendCss,
        script,
        scriptBooking,
        scriptBookingView
    ));

// Default function (used when type "gulp")
exports.default = dev;
exports.dev = dev;
exports.build = build;