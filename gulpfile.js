var gulp   = require('gulp'),
    sass   = require('gulp-sass'),
    minify = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename');

var path = {
    'resources': {
        'sass': './resources/assets/sass',
        'js': './resources/assets/js'
    },
    'public': {
        'css': './public/assets/css',
        'js': './public/assets/js'
    },
    'sass': './resources/assets/sass/**/*.scss',
    'js': './resources/assets/js/**/*.js'
};

gulp.task('sass_task', function()
{
    return gulp.src(path.resources.sass+'/app.scss')
               .pipe(sass({
                   onError: console.error.bind(console, 'SASS ERROR')
               }))
               .pipe(minify())
               .pipe(rename({suffix:'.min'}))
               .pipe(gulp.dest(path.public.css))
});

gulp.task('knacss_task', function()
{
    return gulp.src(path.resources.sass+'/knacss/sass/knacss.scss')
        .pipe(sass())
        .pipe(minify())
        .pipe(rename({suffix:'.min'}))
        .pipe(gulp.dest(path.public.css))
});

gulp.task('js_task', function()
{
    return gulp.src(path.resources.js+'/app.js')
        .pipe(uglify())
        .pipe(rename({suffix:'.min'}))
        .pipe(gulp.dest(path.public.js))
});

gulp.task('watch', function()
{
    gulp.watch(path.sass, ['sass_task', 'knacss_task']);
    gulp.watch(path.js, ['js_task']);
});

gulp.task('default', ['watch']);