var gulp = require('gulp');
var react = require('gulp-react');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var babel = require('gulp-babel');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var minify = require('gulp-minify-css');
var watch = require('gulp-watch');
var jsdoc = require('gulp-jsdoc3');
var fs = require('fs');

/**
 * Script for running gulp commands for compiling ceres jsx, sass, css, js, etc.
 * @reference compile.py
 */

var controllers = [];

//Current node_module js files that are copied over to assets (Please Maintain)
var node_modules_js = [
   'node_modules/react/dist/react-with-addons.min.js',
   'node_modules/react-dom/dist/react-dom.min.js',
   'node_modules/jquery/dist/jquery.min.js',
   'node_modules/jquery-ui-dist/jquery-ui.min.js',
   'node_modules/tether/dist/js/tether.min.js',
   'node_modules/bootstrap/dist/js/bootstrap.min.js'
];

// Current node module css files that are copied over to assets (Please Maintain)
var node_modules_css = [
   	'node_modules/jquery-ui-dist/jquery-ui.min.css',
   	'node_modules/font-awesome/css/font-awesome.min.css',
   	'node_modules/glyphicons-halflings/css/glyphicons-halflings.css',
   	'node_modules/tether/dist/css/tether.min.css',
   	'node_modules/bootstrap/dist/css/bootstrap.min.css',
   	'node_modules/bootstrap/dist/css/bootstrap-grid.min.css',
   	'node_modules/bootstrap/dist/css/bootstrap-reboot.min.css'
];

var node_modules_fonts = [
    'node_modules/font-awesome/fonts/*'
]

// Gets a command line argument based off of a key
function getArg(key) {
	var index = process.argv.indexOf(key);
	var next = process.argv[index + 1];
	return (index < 0) ? null : (!next || next[0] === "-") ? true : next;
}

// Parse command line arguments
function filterControllerArguments( arguments ){
	var resourceObj = {};
	if (arguments)
	{
		var cleanResources = arguments.replace(/{|}/gi, '').split('],');

		cleanResources.forEach(function(cleanResource, index){
			var resourceList = cleanResource.split(':');
			resourceObj[resourceList[0].trim()] = resourceList[1].replace(/\[|\]/gi, '').split(',');
			
		});
		
		// trim up resourceObj
		for ( property in resourceObj)
		{
			resourceObj[property].forEach( function( filepath, index ){
				// trim the file name
				resourceObj[property][index] = filepath.trim();

				// If this is just an empty string remove from array
				if ( !resourceObj[property][index] )
				{
					resourceObj[property].splice(index, 1);
				}
			} );
		}
	}
	return resourceObj;
}

// Interpret css and js arguments
var jsArgs = getArg("--controllers");
var cssArgs = getArg("--controllerscss");
var controller_js = filterControllerArguments(jsArgs);
var controller_css = filterControllerArguments(cssArgs);

// Get all controller names
var controllerFiles = fs.readdirSync('WebContent/application/controllers');
controllerFiles.forEach(function(file, index){
	if (file.split('.').pop() === 'php')
	{
		controllers.push(file.split('.')[0].toLowerCase());
	}
});

// Copy js and css node modules to their asset third party directory
gulp.task('copy', function(){
  gulp.src(node_modules_js)
  .pipe(gulp.dest('WebContent/assets/js/third_party'));

  gulp.src(node_modules_css)
  .pipe(gulp.dest('WebContent/assets/css/third_party'));

  gulp.src(node_modules_fonts)
  	.pipe(gulp.dest('WebContent/assets/css/fonts'))
  	.pipe(gulp.dest('WebContent/assets/fonts'))
});

// Convert jsx to js copied ti react directory
gulp.task('react', function(){
	return gulp.src('jsx/**/*.jsx')
    .pipe(react())
    .pipe(gulp.dest('WebContent/assets/js/react'));
});

// Convert sass to css to its respective css directory
gulp.task('sass', function(){
	return gulp.src('sass/**/*.sass')
    .pipe(sass({"bundleExec": true}))
    .pipe(gulp.dest('WebContent/assets/css'));
});

// uglify and minify js files for each respective controller
gulp.task('compress', function () {
	controllers.forEach(function(controller, index){
	    gulp.src(controller_js[controller])
	    .pipe(sourcemaps.init())
	    .pipe(sourcemaps.identityMap())
	    .pipe(babel({presets: ['es2015']}))
	    .pipe(concat(controller + ".min.js"))
	    .pipe(uglify().on('error', function(e){
	         console.log(e);
	    }))
	    .pipe(gulp.dest("WebContent/assets/js/"))
	    .pipe(sourcemaps.write('.'))
	    .pipe(gulp.dest("WebContent/assets/js/"))
	});
});

// minify css files for each respective controller
gulp.task('minify', function () {
	controllers.forEach(function(controller, index){
    gulp.src(controller_css[controller])
    .pipe(minify({keepBreaks: true}))
    .pipe(concat(controller + '.min.css'))
    .pipe(gulp.dest('WebContent/assets/css'))
	});
});

gulp.task('watch', function() {
	watch('sass/**/*.sass', function() {
        gulp.start('sass');
    });
	watch('jsx/**/*.jsx', function() {
		gulp.start('react');
    });
});

gulp.task('doc', function (cb) {
    gulp.src(['WebContent/assets/js/general/**/*.js', 'WebContent/assets/js/controllers/**/*.js', 'WebContent/assets/js/controllers/react/**/*.js'], {read: false})
        .pipe(jsdoc(cb));
});