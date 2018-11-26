var gulp = require('gulp');
var sass = require('gulp-sass');
var css = require('gulp-clean-css');
var browserSync = require('browser-sync');
var uglifyJs = require('gulp-uglifyjs');
var useref = require('gulp-useref');
var gulpif = require('gulp-if');
var image = require('gulp-imagemin');

var config = {
  app: {
      sass: './app/sass/**/*.sass',
      css: './app/css/**/*.css',
      js: './app/js/**/*.js',
      json: './app/**/*.json',
      img: './app/img/**/*.+(png|jpg)',
      html: './app/**/*.html'
  },
  dest: {
      sass: './app/css',
      img: './dest/img',
      root: './dest'
  }
};

// компилируем sass в папку css в app
gulp.task('sassCompile', function () {
    return gulp.src(config.app.sass)   // для синхронизации задачи sassCompile и useref поток в sassCompile нужно вернуть
        .pipe(sass())
        .pipe(gulp.dest(config.dest.sass))
        .pipe(browserSync.reload({stream:true}));
    //console.log('sassCompile completed!');
});

// переносим json
gulp.task('jsonCopy', function () {
    gulp.src(config.app.json)
        .pipe(gulp.dest(config.dest.root))
        .pipe(browserSync.reload({stream:true}));
    console.log('jsonCopy completed!');
});

// сжимаем и переносим изображения
gulp.task('imageMin', function () {
    gulp.src(config.app.img)
        .pipe(image())
        .pipe(gulp.dest(config.dest.img))
        .pipe(browserSync.reload({stream:true}));
    console.log('imageMin completed!');
});

// соединяем и минифицируем js-файлы и css-файлы, полученные после компиляции sass,
// переносим html-файл, параллельно прописывая в нем пути к объединенным js и css файлам
// для этого нужно прописать соответствующие комментарии в исходном html-файле
// в квадратных скобках указываем задачу sassCompile, т. к. без нее при первом запуске не появятся исходные файлы css,
// которые затем нужно будет объединить и минифицировать
gulp.task('useref', ['sassCompile'], function () {

    //var assets = useref.assets(); // - ошибка  TypeError: useref.assets is not a function,
                                    // однако без assets задача выполняется

    gulp.src(config.app.html)
                //.pipe(assets) // - без useref.assets() не функционально
                .pipe(useref())
                .pipe(gulpif('*.js', uglifyJs()))
                .pipe(gulpif('*.css', css()))
                //pipe(assets.restore())  - без useref.assets() не функционально
                .pipe(gulp.dest(config.dest.root))
                .pipe(browserSync.reload({stream:true}));
    console.log('useref completed!');
});

// следим за изменениями всех файлов проекта
gulp.task('watch', function () {
    gulp.watch(config.app.sass, ['useref']);
    gulp.watch(config.app.js, ['useref']);
    gulp.watch(config.app.json, ['jsonCopy']);
    gulp.watch(config.app.html, ['useref']);
    gulp.watch(config.app.img, ['imageMin']);
});


// запускаем сервер
gulp.task('server', function () {
    browserSync({
        server: {
            baseDir: config.dest.root
        }
    })
});

// объединяем задачи для дефолтного запуска gulp
gulp.task('default', ['imageMin', 'jsonCopy', 'useref', 'watch', 'server'], function () {
    console.log('All tasks completed!');
});