var gulp = require('gulp'),
  less = require('gulp-less'),
  useref = require('gulp-useref'),
  csso = require('gulp-csso'),
  uglify = require('gulp-uglify'),
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
    .pipe(size({title:'less:',showFiles:true}));
});

gulp.task('useref', ['less'], function () {
  return gulp.src(app.src + '*.html')
    .pipe(useref())
    .pipe(gulpif('*.css', csso()))
    .pipe(gulpif('*.js', uglify()))
    .pipe(gulpif('*.css',gulp.dest(app.dist)))
    .pipe(gulpif('*.js',gulp.dest(app.dist)))
    .pipe(size({title:'useref:',showFiles:true}));
});

gulp.task('clean', function (callback) {
  var map = [
    app.dist
  ];
  return del(map, {force: true}, callback);
});

gulp.task('build', ['clean'],function() {
  return gulp.start('useref');
});
