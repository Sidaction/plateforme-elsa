
// les dépendances du fichier gulp
const { src, dest , series , watch } = require("gulp");
const sass = require("gulp-sass")(require('sass'));
const rename = require("gulp-rename");
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const sourcemaps = require('gulp-sourcemaps');
sass.compiler = require("sass");


// VARIABLES
var app_folder = './';
var theme_folder = app_folder + 'wp-content/themes/elsa.v3/';
var assets_folder = theme_folder + 'assets/';

var jsfolder = assets_folder + 'js/';
var mainjs = jsfolder + 'script.js';
var libjs = jsfolder + 'libs/*.js';
var alljs = [libjs, mainjs];

var sassfolder = assets_folder + 'styles/';
var sassfiles = sassfolder + '**/*.scss';
var sassMain = sassfolder + 'style.scss';


// task2 : compiler les fichiers dans le dossier scss => style.css
function sassMainTask(){
    const flags = {outputStyle: 'compressed'};
    return src( sassMain )
    .pipe(sourcemaps.init())
    .pipe(sass(flags).on('error', sass.logError))
    .pipe(sourcemaps.write('./maps'))
    .pipe(rename("./style.css"))
    .pipe(dest(assets_folder));
}


// task3.1
const jsBundle = () =>
  src(alljs)
    .pipe(concat('all.js'))
    .pipe(dest(assets_folder))
    .pipe(rename('all.min.js'))
    .pipe(uglify())
    .pipe(dest(assets_folder));


// task4 : mettre en série les tasks 1, 2 et 3
// pas possible serie() dans une fonction, il FAUT l'associer à une variable 
const run = series( sassMainTask, jsBundle ); 
const runjs = series( jsBundle ); 
const runcss = series( sassMainTask ); 


// task5 : si modification dans le dossier scss , lancer la task4
function watchCSS(){
    watch(sassfiles, runcss);
}
// task6 : si modification dans le dossier JS , lancer la task4
function watchJS(){
    watch(alljs, runjs);
}

function defaultTask() {
    watchCSS();
    watchJS();
}


// Ensemble des tâches pouvant être appelée via la commande npx gulp 
module.exports = {
    sassmain : sassMainTask,
    jsBundle : jsBundle,
    run : run,
    default : defaultTask,
    watchcss : watchCSS,
    watchjs : watchJS,
  }