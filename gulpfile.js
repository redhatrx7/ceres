var gulp = require('gulp');
var react = require('gulp-react');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var babel = require('gulp-babel');
var concat = require('gulp-concat');
var minify = require('gulp-minify-css');
var fs = require('fs');

var files = fs.readdirSync('WebContent/application/controllers');
var controllers = [];
files.forEach(function(file, index){
	if (file.split('.').pop() === 'php')
	{
		controllers.push(file.split('.')[0].toLowerCase());
	}
});

var node_modules = [
    'node_modules/react/dist/react-with-addons.min.js',
    'node_modules/react-dom/dist/react-dom.min.js',
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/jquery-ui-dist/jquery-ui.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js'
];

gulp.task('copy', function(){
  gulp.src(node_modules)
  .pipe(gulp.dest('WebContent/assets/js/third_party'));

  gulp.src([
            'node_modules/jquery-ui-dist/jquery-ui.min.css',
            'node_modules/bootstrap/dist/css/bootstrap-theme.min.css'
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

gulp.task('compress', function () {
	controllers.forEach(function(controller, index){
	    gulp.src(node_modules.concat([
	    	"WebContent/assets/js/general/**/*.js",
	    	"WebContent/assets/js/react/general/**/*.js",
	    	"WebContent/assets/js/controllers/"+controller+".js",
	    	"WebContent/assets/js/react/controllers/"+controller+".js",
	    ]))
	    .pipe(babel({presets: ['es2015']}))
	    .pipe(concat(controller + ".min.js"))
	    .pipe(uglify().on('error', function(e){
	         console.log(e);
	    }))
	    .pipe(gulp.dest("WebContent/assets/js/"))
	});
});

gulp.task('minify', function () {
    gulp.src('WebContent/assets/css/**/*.css')
        .pipe(minify({keepBreaks: true}))
        .pipe(concat('production.min.css'))
        .pipe(gulp.dest('WebContent/assets/css'))
    ;
});