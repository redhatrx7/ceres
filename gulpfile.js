var gulp = require('gulp');
var react = require('gulp-react');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var babel = require('gulp-babel');
var concat = require('gulp-concat');
var minify = require('gulp-minify-css');
var fs = require('fs');

var node_modules_js = [
   'node_modules/react/dist/react-with-addons.min.js',
   'node_modules/react-dom/dist/react-dom.min.js',
   'node_modules/jquery/dist/jquery.min.js',
   'node_modules/jquery-ui-dist/jquery-ui.min.js',
   'node_modules/bootstrap/dist/js/bootstrap.min.js'
];

var node_modules_css = [
   	'node_modules/jquery-ui-dist/jquery-ui.min.css',
   	'node_modules/bootstrap/dist/css/bootstrap-theme.min.css'
];

function getArg(key) {
  var index = process.argv.indexOf(key);
  var next = process.argv[index + 1];
  return (index < 0) ? null : (!next || next[0] === "-") ? true : next;
}

var cts = getArg("--controllers");
var ctscss = getArg("--controllerscss");

var controller_js = {};
var controller_css = {};

if (ctscss)
{
	var ctscss_1 = ctscss.replace(/{|}/gi, '').split('],');
	ctscss_1.forEach(function(ctscss_2, index){
		var ctscss_3 = ctscss_2.split(':');
		controller_css[ctscss_3[0].trim()] = ctscss_3[1].replace(/\[|\]/gi, '').split(',');
		
	});
	
	for ( prop in controller_css)
	{
		controller_css[prop].forEach( function( file, index ){
			controller_css[prop][index] = file.trim();
			if ( !controller_css[prop][index] )
			{
				controller_css[prop].splice(index, 1);
			}
		} );
	}
}

if (cts)
{
	var cts_1 = cts.replace(/{|}/gi, '').split('],');
	cts_1.forEach(function(cts_2, index){
		var cts_3 = cts_2.split(':');
		controller_js[cts_3[0].trim()] = cts_3[1].replace(/\[|\]/gi, '').split(',');
		
	});
	
	for ( prop in controller_js)
	{
		controller_js[prop].forEach( function( file, index ){
			controller_js[prop][index] = file.trim();
			if ( !controller_js[prop][index] )
			{
				controller_js[prop].splice(index, 1);
			}
		} );
	}
}

var files = fs.readdirSync('WebContent/application/controllers');
var controllers = [];
files.forEach(function(file, index){
	if (file.split('.').pop() === 'php')
	{
		controllers.push(file.split('.')[0].toLowerCase());
	}
});

gulp.task('copy', function(){
  gulp.src(node_modules_js)
  .pipe(gulp.dest('WebContent/assets/js/third_party'));

  gulp.src(node_modules_css)
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
	    gulp.src(controller_js[controller])
	    .pipe(babel({presets: ['es2015']}))
	    .pipe(concat(controller + ".min.js"))
	    .pipe(uglify().on('error', function(e){
	         console.log(e);
	    }))
	    .pipe(gulp.dest("WebContent/assets/js/"))
	});
});

gulp.task('minify', function () {
	controllers.forEach(function(controller, index){
    gulp.src(controller_css[controller])
    .pipe(minify({keepBreaks: true}))
    .pipe(concat(controller+'.min.css'))
    .pipe(gulp.dest('WebContent/assets/css'))
	});
});