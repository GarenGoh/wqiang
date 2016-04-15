var gulp = require('gulp'),
  less = require('gulp-less'),
  useref = require('gulp-useref'),
  csso = require('gulp-csso'),
  minify = require('gulp-minify-css'),
  gulpif = require('gulp-if'),
  size = require('gulp-size'),
  del = require('del'),
  autoprefixer = require('gulp-autoprefixer');

var app = {
  src: './',
  dist: 'dist/'
};

gulp.task('less', function () {
  gulp.src(app.src + 'lesses/*.less')
    .pipe(less())
    .pipe(autoprefixer())
    .pipe(gulp.dest(app.src + 'styles'))
    .pipe(size());
});

gulp.task('useref', ['less'], function () {
  return gulp.src(app.src + '*.html')
    .pipe(useref())
    .pipe(gulpif('*.css', csso()))
    .pipe(gulp.dest(app.src + 'dist'))
    .pipe(size());
});

gulp.task('del', function (callback) {
  var map = [
    app.dist
  ];
  return del(map, {force: true}, callback);
});

gulp.task('build', ['del'],function() {
  return gulp.start('useref');
});
