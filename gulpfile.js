// // Include gulp
// var gulp = require('gulp');

// // Include Our Plugins
// var jshint = require('gulp-jshint');
// var sass = require('gulp-ruby-sass');
// var concat = require('gulp-concat');
// var uglify = require('gulp-uglify');
// var rename = require('gulp-rename');
// var sourcemaps = require('gulp-sourcemaps');
// var cssnano = require('gulp-cssnano');
// var notify = require('gulp-notify');

// // Set up project
// var app_folder = 'wp-content/themes/elsa.v2/';
// var public_folder = 'wp-content/themes/elsa.v2/';
// var theme_folder = 'wp-content/themes/elsa.v2/';

// var jsfolder = theme_folder + '_js/';
// var mainjs = theme_folder + '_js/script.js';
// var vendorsjs = theme_folder + '_js/lib/*.js';
// var alljs = [vendorsjs, mainjs];

// var scssfiles = theme_folder + '_sass/**/*.scss';
// var sassfolder = theme_folder + '_sass/';
// var sassMain = sassfolder + 'style.scss';


// // Lint Task
// gulp.task('lint', function() {
//     return gulp.src(mainjs)
//         .pipe(jshint())
//         .pipe(jshint.reporter('default'));
// });

// // Compile Our Sass
// gulp.task('styles', function() {
//     return sass(sassMain, { style: 'nested', sourcemap: true })
//     .on('error', sass.logError)
//     .pipe(sourcemaps.write())
//     .pipe(gulp.dest(theme_folder))
//     .pipe(rename({suffix: '.min'}))
//     .pipe(cssnano())
//     .pipe(gulp.dest(theme_folder))
//     .pipe(notify({ message: 'Styles task complete' }));
// });

// // Concatenate & Minify JS
// gulp.task('scripts', function() {
//     return gulp.src(alljs)
//         .pipe(concat('all.js'))
//         .pipe(gulp.dest(jsfolder))
//         .pipe(rename('all.min.js'))
//         .pipe(uglify())
//         .pipe(gulp.dest(jsfolder))
//         .pipe(notify({ message: 'Scripts task complete' }));
// });

// // Watch Files For Changes
// gulp.task('watch', function() {
//     gulp.watch(mainjs, ['lint', 'scripts']);
//     gulp.watch(scssfiles, ['styles']);
// });

// // Default Task
// gulp.task('default', ['lint', 'scripts', 'watch']);




// Concatenate & Minify JS
// gulp.task('scripts', function() {
//     return gulp.src(alljs)
//         .pipe(concat('all.js'))
//         .pipe(gulp.dest(jsfolder))
//         .pipe(rename('all.min.js'))
//         .pipe(uglify())
//         .pipe(gulp.dest(jsfolder))
//         .pipe(notify({ message: 'Scripts task complete' }));
// });

// Watch Files For Changes
// gulp.task('watch', function() {
//     gulp.watch(mainjs, ['lint', 'scripts']);
//     gulp.watch(scssfiles, ['styles']);
// });

// Default Task
// gulp.task('default', ['lint', 'scripts', 'watch']);



var gulp = require("gulp"),
    sass = require('gulp-sass')(require('sass')),
    postcss = require("gulp-postcss"),
    autoprefixer = require("autoprefixer"),
    cssnano = require("cssnano"),
    rename = require("gulp-rename"),
    sourcemaps = require("gulp-sourcemaps");
    concat = require("gulp-concat");
    uglify = require("gulp-uglify");
    
var paths = {
    styles: {
        src: "wp-content/themes/elsa.v2/_sass/**/*.scss",
        dest: "wp-content/themes/elsa.v2/"
    },
    scripts: {
        main: "wp-content/themes/elsa.v2/_js/src/script.js",
        all: "wp-content/themes/elsa.v2/_js/src/**/*.js",
        dest: "wp-content/themes/elsa.v2/_js/"
    }
};


    
function style() {
    
    return (
        gulp
            .src(paths.styles.src)
            // Initialize sourcemaps before compilation starts
            .pipe(sourcemaps.init())
            .pipe(sass())
            .on("error", sass.logError)
            .pipe(postcss([autoprefixer()]))
            .pipe(sourcemaps.write())
            .pipe(gulp.dest(paths.styles.dest))
            .pipe(postcss([autoprefixer(), cssnano()]))
            .pipe(rename("style.min.css"))
            .pipe(gulp.dest(paths.styles.dest))
    );
    
}

function scripts() {

    return (
        gulp.src(paths.scripts.all)
            .pipe(concat('all.js'))
            .pipe(gulp.dest(paths.scripts.dest))
            .pipe(rename('all.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest(paths.scripts.dest))
    );
}

    
function watch() {
    style();
    scripts();

    gulp.watch(paths.styles.src, style);
    gulp.watch(paths.scripts.main, scripts);
}

    
exports.watch = watch

