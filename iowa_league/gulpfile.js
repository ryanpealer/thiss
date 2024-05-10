// Gulp.js configuration
'use strict';

const

// source and build folders
dir = {
    src: 'resource/',
    build: 'assets/'
},

// Gulp and plugins
gulp = require('gulp'),
plumber = require('gulp-plumber'),
newer = require('gulp-newer'),
imagemin = require('gulp-imagemin'),
sass = require('gulp-sass')(require('sass')),
sourcemaps = require('gulp-sourcemaps'),
postcss = require('gulp-postcss'),
deporder = require('gulp-deporder'),
concat = require('gulp-concat'),
uglify = require('gulp-uglify');

// Browser-sync
var webserver = require('browser-sync').create();

/* server settings */
var config = {
    proxy: {
        target: "http://localhost:8888/iowa-league-wp-site",
        ws: true // enables websockets
    }
  };
  
  gulp.task("webserver", function() {
    webserver.init(config);
  });

// image settings
const images = {
  src: dir.src + 'images/**/*',
  build: dir.build + 'images/'
};

// image processing
gulp.task('images', () => {
  return gulp.src(images.src)
      .pipe(plumber())
      .pipe(newer(images.build))
      .pipe(imagemin())
      .pipe(gulp.dest(images.build));
});

// CSS settings
var css = {
  src: dir.src + 'scss/*.scss',
  watch: [dir.src + 'scss/**/*', dir.src + 'scss/*', 'template-parts/gblocks/**/*.scss', 'template-parts/gblocks/**/**/*.scss'],
  build: dir.build + 'css',
  sassOpts: {
    outputStyle: 'compressed',
    imagePath: images.build,
    precision: 3,
    errLogToConsole: true
  },
  processors: [
    require('postcss-assets')({
      loadPaths: ['images/'],
      basePath: dir.build,
      baseUrl: '/wp-content/themes/iowa_league/'
    }),
    require('autoprefixer')({
      overrideBrowserslist: ['last 2 versions', '> 2%']
    }),
    require('css-mqpacker'),
    require('cssnano')
  ]
};

// CSS processing
gulp.task('css', gulp.series(['images'], () => {
  return gulp.src(css.src)
      .pipe(plumber())
      .pipe(sourcemaps.init())
      .pipe(sass(css.sassOpts))
      .pipe(postcss(css.processors))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest(css.build))
      .pipe(
        webserver.reload({
            stream: true
        })
      );
}));
sass().on('error', sass.logError)

// JavaScript settings
const js = {
  src: dir.src + 'js/**/*',
  build: dir.build + 'js/',
  filename: 'scripts.js'
};

// JavaScript processing
gulp.task('js', () => {
  return gulp.src(js.src)
      .pipe(plumber())
      .pipe(deporder())
      .pipe(concat(js.filename))
      .pipe(uglify())
      .pipe(gulp.dest(js.build))
      .pipe(
        webserver.reload({
            stream: true
        })
      );
});

// Fonts
gulp.task('fonts', function() {
    return gulp.src([
        dir.src + 'fonts/*'])
        .pipe(gulp.dest(dir.build+'fonts/'));
});



gulp.task('build', gulp.series(['css', 'js', 'fonts']));


// watch for file changes
gulp.task('watch', gulp.series([], () => {

  // image changes
  gulp.watch(images.src, gulp.series(['images']));

  // CSS changes
  gulp.watch(css.watch, gulp.series(['css']));

  // JavaScript main changes
  gulp.watch(js.src, gulp.series(['js']));

}));


gulp.task('default', gulp.parallel(['webserver', 'watch', 'build']));