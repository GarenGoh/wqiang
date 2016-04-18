var gulp = require('gulp'),
  less = require('gulp-less'),
  useref = require('gulp-useref'),
  csso = require('gulp-csso'),
  uglify = require('gulp-uglify'),
  minify = require('gulp-minify-css'),
  gulpif = require('gulp-if'),
  size = require('gulp-size'),
  del = require('del'),
  connect = require('gulp-connect'),
  watch = require('gulp-watch'),
  autoprefixer = require('gulp-autoprefixer');

var app = {
  src: './',
  dist: '../dist/app/',
  frontend: '../',
  bower: 'vendor/bower/'
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
    .pipe(gulpif('*.js', uglify()))
    .pipe(gulpif('*.css', csso()))
    .pipe(gulpif('*.js', gulp.dest(app.dist)))
    .pipe(gulpif('*.css', gulp.dest(app.dist)))
    .pipe(size());
});

gulp.task('del', function (callback) {
  var map = [
    app.dist
  ];
  return del(map, {force: true}, callback);
});

gulp.task('copy', function () {
  gulp.src(app.bower + 'font-awesome/fonts/*')
    .pipe(gulp.dest(app.dist + 'fonts'))
    .pipe(size());

  gulp.src(app.src + 'images/*')
    .pipe(gulp.dest(app.dist + 'images'))
    .pipe(size());
});

gulp.task('connect', function () {
  connect.server({
    root: app.frontend,
    port: 5000,
    livereload: true
  });
});

gulp.task('watch', function () {
  gulp.watch([app.src + 'lesses/**/*.less'], ['less', 'reload']);
  gulp.watch([app.src + '*.html'], ['reload']);
  gulp.watch([app.frontend + '*.html'], ['reload'])
});

gulp.task('reload', function () {
  gulp.src(app.src + '*.html')
    .pipe(connect.reload())
    .pipe(size({title:'reload:',showFiles:true}));
  gulp.src(app.frontend + 'index.html')
    .pipe(connect.reload())
});

gulp.task('build', ['del'],function() {
  return gulp.start('useref','copy');
});

gulp.task('default', ['less', 'copy', 'connect', 'watch']);
