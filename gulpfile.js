require('dotenv').config();

const config    = require('./.config');
let gulp        = require('gulp');
let plugins     = require('gulp-load-plugins')();
let browserSync = require('browser-sync').create();

var sassLintHandler = error => {
    plugins.notify.onError({
        title: 'SCSS Linter failed!',
        message: '<%= error.message %>'
    })(error);

    this.emit('end');
};

var buildSass = env => {
    return gulp.src(config.sassPath + '/**/*.scss')
        .pipe(plugins.sassLint({ config: '.sass-lint.yml' }))
        .pipe(plugins.sassLint.format())
        .pipe(plugins.plumber({ errorHandler: sassLintHandler }))
        .pipe(plugins.sassLint.failOnError())
        .pipe(plugins.plumber.stop())
        .pipe(plugins.sass({
            outputStyle: env === 'production' ? 'compressed' : 'expanded',
            includePaths:[
                ...config.vendor.sass,
                config.sassPath,
            ],
            errLogToConsole: true
        }).on('error', plugins.notify.onError(error => {
            return `Error: ${error.message}`
        })))
        .pipe(plugins.autoprefixer('last 10 version'))
        .pipe(gulp.dest( config.destPath + '/css' ))
        .pipe(browserSync.stream());
};

gulp.task('buildDev:sass', () => {
    return buildSass(process.env.NODE_ENV);
});

gulp.task('build:sass', () => {
    return buildSass('production');
});

gulp.task('build:javascript', () => {
    return gulp.src([
        ...config.vendor.js,
        config.jsPath + '/vendor/**/*.js',
        config.jsPath + '/**/_*.js',
        config.jsPath + '/**/*.js',
        config.jsPath + '/_*.js',
        config.jsPath + '/*.js',
    ])
    .pipe(plugins.concat(config.jsName))
    .pipe(gulp.dest(config.destPath + '/js'))
    .pipe(plugins.rename(config.jsNameMin))
    .pipe(plugins.uglify({ mangle: {toplevel: true} }))
    .pipe(gulp.dest(config.destPath + '/js'));
});

gulp.task('build:javascriptadmin', () => {
    return gulp.src([
        config.jsAdminPath + '/**/_*.js',
        config.jsAdminPath + '/**/*.js',
        config.jsAdminPath + '/_*.js',
        config.jsAdminPath + '/*.js',
    ])
    .pipe(plugins.concat('admin.js'))
    .pipe(gulp.dest(config.destPath + '/js'))
    .pipe(plugins.rename('admin.min.js'))
    .pipe(plugins.uglify({ mangle: {toplevel: true} }))
    .pipe(gulp.dest(config.destPath + '/js'));
});

gulp.task('build:vendor', () => {
    return gulp.src([
        config.vendorPath + '/**/*',
    ])
    .pipe(gulp.dest( config.destPath + '/vendor' ));
});

gulp.task('build:image', () => {
    return gulp.src([
        config.imgPath + '/**/*'
    ])
    .pipe(gulp.dest( config.destPath + '/images' ));
});

gulp.task('build:fonts', () => {
    return gulp.src([
        ...config.vendor.fonts,
        config.fontPath + '/**/*'
    ])
    .pipe(gulp.dest( config.destPath + '/fonts' ));
});

gulp.task('clean', () => {
    return gulp.src(
        [
            config.destPath
        ],
        {
            read: false,
            allowEmpty: true
        }
    )
    .pipe(plugins.clean());
});

gulp.task('watch', () => {
    browserSync.init({
      files: [
          '{inc,template-parts}/**/*.php',
          '*.php',
          config.destPath + '**/*'
        ],
      proxy: config.devUrl,
      snippetOptions: {
        whitelist: ['/wp-admin/admin-ajax.php'],
        blacklist: ['/wp-admin/**']
      }
    });
    gulp.watch(config.sassPath + '/**/*.scss', gulp.series('buildDev:sass'));
    gulp.watch(config.jsPath + '/**/*.js', gulp.series('build:javascript'));
    gulp.watch(config.jsAdminPath + '/**/*.js', gulp.series('build:javascriptadmin'));
    gulp.watch(config.imgPath + '/**/*', gulp.series('build:image'));
    gulp.watch(config.fontPath + '/**/*', gulp.series('build:fonts'));
    gulp.watch(config.vendorPath + '/**/*', gulp.series('build:vendor'));
    gulp.watch(config.destPath + "/**/{*.css,*.js}").on('change', browserSync.reload);
});

gulp.task('build:watch', gulp.series(
    'build:javascriptadmin',
    'buildDev:sass',
    'build:fonts',
    'build:javascript',
    'build:image',
    'build:vendor',
    'watch'
));

gulp.task('build', gulp.series(
    'clean',
    gulp.parallel(
    'build:javascriptadmin',
    'build:sass',
        'build:fonts',
        'build:javascript',
        'build:image',
        'build:vendor'
    )
));

gulp.task('default', gulp.series('build'));
