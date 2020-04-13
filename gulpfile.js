const settings = {
    project: 'minimal-md-theme',

    scripts: true,
    styles: true,
    svgs: true,
    images: true,
    fonts: true,
};

const paths = {
    input: 'src/',
    output: 'assets/',

    scripts: {
        input: 'js/**/*.js',
        output: 'js/',
        minFile: settings.project + '.min.js'
    },

    styles: {
        input: 'scss/**/*.scss',
        output: 'css/',
    },

    svgs: {
        input: 'svg/*.svg',
        output: 'images/'
    },

    images: {
        input: 'images/**/*',
        output: 'images/'
    },

    fonts: {
        input: 'fonts/**/*',
        output: 'fonts/'
    }
};

var {task, src, dest, watch, series, parallel} = require('gulp');

var del        = require('del');
var rename     = require('gulp-rename');
var optimizejs = require('gulp-optimize-js');
var sass       = require('gulp-sass');
var sassLint   = require('gulp-sass-lint');
var postcss    = require('gulp-postcss');
var svgmin     = require('gulp-svgmin');
var concat     = require('gulp-concat');
var uglify     = require('gulp-terser');
var jshint     = require('gulp-jshint');
var stylish    = require('jshint-stylish');
var prefix     = require('autoprefixer');

let cleanAssets = function(done) {
    del.sync([ paths.output ]);
    return done();
};

let buildStyles = function(done) {
    if (!settings.styles) {
        return done();
    }

    return src(paths.input + paths.styles.input)
        .pipe(sassLint())
        .pipe(sassLint.format())
        .pipe(sass({
            outputStyle: 'compressed',
            sourceComments: false,
            errLogToConsole: true
        }))
        .pipe(postcss([
            prefix({
                cascade: true,
                remove: true
            })
        ]))
        .pipe(dest(paths.output + paths.styles.output));
};

let buildScripts = function(done) {
    if (!settings.scripts) {
        return done();
    }

    return src(paths.input + paths.scripts.input)
        .pipe(jshint({ 'esversion': 6 }))
        .pipe(jshint.reporter('jshint-stylish'))
        .pipe(concat(paths.scripts.minFile))
        .pipe(optimizejs())
        .pipe(dest(paths.output + paths.scripts.output))
        .pipe(rename(paths.scripts.minFile))
        .pipe(uglify({
            mangle: {
                toplevel: true
            }
        }))
        .pipe(optimizejs())
        .pipe(dest(paths.output + paths.scripts.output));
};

let buildSVGs = function(done) {
    if (!settings.svgs) {
        return done();
    }

    return src(paths.input + paths.svgs.input)
        .pipe(svgmin())
        .pipe(dest(paths.output + paths.svgs.output))
};

let buildImages = function(done) {
    if (!settings.images) {
        return done();
    }

    return src(paths.input + paths.images.input)
        .pipe(dest(paths.output + paths.images.output))
};

let buildFonts = function(done) {
    if (!settings.fonts) {
        return done();
    }

    return src(paths.input + paths.fonts.input)
        .pipe(dest(paths.output + paths.fonts.output))
};

let watchSource = function() {
    watch(paths.input + paths.styles.input,  series(BuildStyles));
    watch(paths.input + paths.scripts.input, series(BuildScripts));
    watch(paths.input + paths.svgs.input,    series(buildSVGs));
    watch(paths.input + paths.images.input,  series(buildImages));
    watch(paths.input + paths.fonts.input,   series(buildFonts));
};

task('clean',       cleanAssets);
task('build::css',  buildStyles);
task('build::js',   buildScripts);
task('build::svg',  buildSVGs);
task('build::font', buildFonts);
task('build::img',  buildImages);

task('watch', series(
    buildStyles,
    buildScripts,
    buildSVGs,
    buildImages,
    buildFonts,
    watchSource
));

task('build', series(
    cleanAssets,
    parallel(
        buildStyles,
        buildScripts,
        buildSVGs,
        buildImages,
        buildFonts
    )
));

task('default', series('build'));
