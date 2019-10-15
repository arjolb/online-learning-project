let gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync').create();

let themeLocation='./wp-content/themes/university-theme/';


function styles() {
    return gulp.src(themeLocation+'css/style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(themeLocation));
}

function cssInject() {
    return gulp.src(themeLocation+'style.css')
        .pipe(browserSync.stream());
}

let cssInjection = gulp.series(styles,cssInject);


function watch() {
    browserSync.init({
        notify: false,
        proxy: 'http://localhost/wordpress-project/',
        open : false
    });

    gulp.watch(themeLocation+'**/*.scss',cssInjection);

    gulp.watch('./**/*.php',function (cb) {
        browserSync.reload();
        cb();
    });

    gulp.watch(themeLocation+'**/*.js',function (cb) {
        browserSync.reload();
        cb();
    });

}

gulp.task('default',watch);