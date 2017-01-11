// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var jshint = require('gulp-jshint');
var sass = require('gulp-ruby-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var sourcemaps = require('gulp-sourcemaps');
var cssnano = require('gulp-cssnano');
var notify = require('gulp-notify');

// Set up project
var app_folder = 'wp-content/themes/elsa.v2/';
var public_folder = 'wp-content/themes/elsa.v2/';
var theme_folder = 'wp-content/themes/elsa.v2/';

var jsfolder = theme_folder + '_js/';
var mainjs = theme_folder + '_js/script.js';
var vendorsjs = theme_folder + '_js/lib/*.js';
var alljs = [vendorsjs, mainjs];

var scssfiles = theme_folder + '_sass/**/*.scss';
var sassfolder = theme_folder + '_sass/';
var sassMain = sassfolder + 'style.scss';


// Lint Task
gulp.task('lint', function() {
    return gulp.src(mainjs)
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Compile Our Sass
gulp.task('styles', function() {
    return sass(sassMain, { style: 'nested', sourcemap: true })
    .on('error', sass.logError)
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(theme_folder))
    .pipe(rename({suffix: '.min'}))
    .pipe(cssnano())
    .pipe(gulp.dest(theme_folder))
    .pipe(notify({ message: 'Styles task complete' }));
});

// Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src(alljs)
        .pipe(concat('all.js'))
        .pipe(gulp.dest(jsfolder))
        .pipe(rename('all.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(jsfolder))
        .pipe(notify({ message: 'Scripts task complete' }));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch(mainjs, ['lint', 'scripts']);
    gulp.watch(scssfiles, ['styles']);
});

// Default Task
gulp.task('default', ['lint', 'scripts', 'watch']);

