var gulp = require('gulp');
var react = require('gulp-react');
var sass = require('gulp-sass');

gulp.task('copy', function(){
  gulp.src([
            'node_modules/react/dist/react-with-addons.min.js',
            'node_modules/react-dom/dist/react-dom.min.js',
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/jquery-ui-dist/jquery-ui.min.js'
  ])
  .pipe(gulp.dest('WebContent/assets/js/third_party'));

  gulp.src([
            'node_modules/jquery-ui-dist/jquery-ui.min.css',
  ])
  .pipe(gulp.dest('WebContent/assets/css/third_party'));
});

gulp.task('react', function(){
	return gulp.src('jsx/**/*.jsx')
    .pipe(react())
    .pipe(gulp.dest('WebContent/assets/js/react'));
});

gulp.task('sass', function(){
	return gulp.src('sass/**/*.sass')
    .pipe(sass({"bundleExec": true}))
    .pipe(gulp.dest('WebContent/assets/css'));
});