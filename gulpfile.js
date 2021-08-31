const gulp = require("gulp"),
  sass = require("gulp-sass"),
  browserSync = require("browser-sync").create(),
  uglify = require("gulp-uglify"),
  concat = require("gulp-concat"),
  rename = require("gulp-rename"),
  del = require("del"),
  autoprefixer = require("autoprefixer"),
  postcss = require("gulp-postcss"),
  path = require("path"),
  fs = require("fs");

gulp.task("clean", async function () {
  del.sync("dist");
});
gulp.task("scss", function () {
  return gulp
    .src("app/scss/**/*.scss")
    .pipe(sass({ outputStyle: "compressed" }))
    .pipe(postcss([autoprefixer()]))
    .pipe(rename({ suffix: ".min" }))
    .pipe(gulp.dest("app/css"))
    .pipe(browserSync.reload({ stream: true }));
});
gulp.task("css", function () {
  return gulp
    .src([
      "node_modules/normalize.css/normalize.css",
      "node_modules/slick-carousel/slick/slick.css",
      "node_modules/animate.css/animate.css",
    ])
    .pipe(concat("_libs.scss"))
    .pipe(gulp.dest("app/scss"))
    .pipe(browserSync.reload({ stream: true }));
});
gulp.task("html", function () {
  return gulp.src("app/*.html").pipe(browserSync.reload({ stream: true }));
});
gulp.task("php", function () {
  return gulp.src("app/*.php").pipe(browserSync.reload({ stream: true }));
});
gulp.task("libsjs", function () {
  return gulp
    .src([
      "node_modules/slick-carousel/slick/slick.js",
      "node_modules/wow.js/dist/wow.js",
    ])
    .pipe(concat("libs.min.js"))
    .pipe(uglify())
    .pipe(gulp.dest("app/js"))
    .pipe(browserSync.reload({ stream: true }));
});
gulp.task("scriptjs", function () {
  return gulp.src("app/js/*.js").pipe(browserSync.reload({ stream: true }));
});

gulp.task("browser-sync", function () {
  browserSync.init({
    proxy: "foresthoney",
    port: 8080,
  });
});

gulp.task("export", async function () {
  let buildHtml = gulp.src("app/**/*.html").pipe(gulp.dest("dist"));
  let buildPhp = gulp.src("app/**/*.php").pipe(gulp.dest("dist"));
  let buildCss = gulp.src("app/css/**/*.css").pipe(gulp.dest("dist/css"));

  let buildJs = gulp.src("app/js/**/*.js").pipe(gulp.dest("dist/js"));

  let buildFonts = gulp.src("app/fonts/**/*.*").pipe(gulp.dest("dist/fonts"));
  let buildImg = gulp.src("app/img/**/*.*").pipe(gulp.dest("dist/img"));
});

gulp.task("watch", function () {
  gulp.watch("app/scss/**/*.scss", gulp.parallel("scss"));
  gulp.watch("app/*.html", gulp.parallel("html"));
  gulp.watch("app/*.php", gulp.parallel("php"));
  gulp.watch("app/js/*.js", gulp.parallel("scriptjs"));
});

gulp.task("build", gulp.series("clean", "export"));

gulp.task(
  "default",
  gulp.parallel("css", "scss", "libsjs", "php", "watch", "browser-sync")
);
