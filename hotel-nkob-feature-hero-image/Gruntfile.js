module.exports = function( grunt ) {

  require('es6-promise').polyfill();

  var browserSync = require('browser-sync');
  var findupNodeModules = require('findup-node-modules');

  'use strict';

  // Project configuration
  grunt.initConfig( {

    pkg: grunt.file.readJSON( 'package.json' ),

    copy: {
      js: {
        expand: true,
        cwd:    'assets/js/externals',
        src:    '**/*',
        dest:   'dist/js/',
      },
      images: {
        expand: true,
        cwd:    'assets/images',
        src:    '**/*',
        dest:   'dist/images/',
      },
      fonts: {
        expand: true,
        cwd:    'assets/fonts',
        src:    '**/*',
        dest:   'dist/fonts/',
      },
      css: {
        expand: true,
        cwd:    'assets/css',
        src:    'main.css',
        dest:   'dist/css/',
      }
    },

    // Compile SASS
    sass: {

      // Compile the most frequently changed files, for use in development
      options: {
        outputStyle:  'expanded',
        sourceMap:    true,
        includePaths: [
          findupNodeModules('susy/sass'),
          findupNodeModules('breakpoint-sass/stylesheets'),
          findupNodeModules('sass-mq')
        ],
        require: 'susy',
      },

      dev: {
        files: {
          'dist/css/astra_theme.css':       'assets/css/scss/main.scss',
          'dist/css/astra_theme-admin.css': 'assets/css/scss/admin.scss',
          'dist/css/astra_theme-edit.css':  'assets/css/scss/edit.scss'
        }
      },

      styleguide: {
        files: {
          'dist/css/styleguide.css': 'assets/css/scss/styleguide.scss'
        }
      }
    },

    // Post process css for production: add prefixes and rem fallbacks, make sure it's minified correctly
    postcss: {

      dev: {
        options: {
          processors: [
            require('autoprefixer')({browsers: 'last 2 versions'}), // add vendor prefixes
          ],
          map: true
        },
        src:  'dist/css/astra_theme.css',
        dest: 'dist/css/astra_theme.css'
      },

      build: {
        options: {
          processors: [
            require('pixrem')(), // add fallbacks for rem units
            require('autoprefixer')({browsers: 'last 5 versions'}), // add vendor prefixes
            require('cssnano')() // minify the result
          ]
        },
        files: {
          'dist/css/astra_theme.min.css':       'dist/css/astra_theme.css',
          'dist/css/astra_theme-admin.min.css': 'dist/css/astra_theme-admin.css',
          'dist/css/astra_theme-edit.min.css':  'dist/css/astra_theme-edit.css',
          'dist/css/styleguide.min.css':     'dist/css/styleguide.css',
        }
      }
    },

    // Concatenate js files
    concat: {
      options: {
        separator:        ';',
        preserveComments: true,
        sourceMap:        function(dest) {
          return dest + '.map'
        },
        sourceMappingURL: function(dest) {
          return dest.replace(/^.*[\\\/]/, '') + '.map'
        },
        sourceMapRoot: '/',
        beautify:      true
      },

      dist: {
        src: [

        // Include custom scripts
        'assets/js/**/*.js',

        // Individually include scripts to load after all the other js
        // These should be located in 'assets/js/delayed/'
        ],

        // Finally, concatenate all the files above into one single file
        dest: 'dist/js/astra_theme.js',
      },
    },

    // Minify js
    terser: {

      prod: {
        format: {
          comments: false,
          preamble: '/* <%= pkg.homepage %> * Copyright (c) <%= grunt.template.today("yyyy") %> */\n',
        },
        options: {

          mangle:   { reserved: ['jQuery'] }
        },
        files: {
          'dist/js/astra_theme.min.js': ['dist/js/astra_theme.js']
        }
      }
    },

    // Create svg sprite
    svgstore: {
      options: {
        prefix:              'shape-',
        cleanup:             true,
        includeTitleElement: false,
        svg:                 {
          style: 'display: none;'
        }
      },
      default: {
        files: {
          'dist/images/sprite.svg': ['assets/images/svg-sprite-src/*.svg']
        }
      }
    },

    sasslint: {
      options: {
        outputFile: 'assets/css/reports/sass-lint.html',
        formatter:  'html',
      },
      target: 'assets/css/*/**/*.scss',
    },

    // Watch for changes
    watch: {

      // Watch for the frontend scss files changes
      sass_dev: {
        files: [
          'assets/css/**/*.scss',

          // if needed, exclude files to avoid delaying watch task
          // example: '!assets/css/scss/file.scss'
        ],
        tasks:   ['sasslint', 'sass:dev', 'postcss:dev', 'bs-inject-css'],
        options: {
          spawn: false
        }
      },

      // Watch for the js files changes
      scripts: {
        files: [
          'assets/js/*/**/*.js'
        ],
        tasks:   ['concat', 'bs-reload'],
        options: {
          spawn: false
        }
      },

      // Watch for svg sprite source files changes
      sprite: {
        files:   ['assets/images/svg-sprite-src/*.*'],
        tasks:   ['svgstore', 'bs-reload'],
        options: {
          spawn: false
        }
      },

      // Watch for the php files changes to trigger browsersync reload
      php: {
        files: [
          './**/*.php'
        ],
        tasks:   ['bs-reload'],
        options: {
          spawn: false
        }
      }
    },

    notify: {
      build: {
        options: {
          title:   'Build complete',
          message: 'All assets are ready for merge and deploy'
        }
      }
    }
  } );

  // load modules
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-terser');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-notify');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-sass-lint');
  grunt.loadNpmTasks('grunt-svgstore');

  // Init BrowserSync manually
  grunt.registerTask('bs-init', function () {
    var done = this.async();
    browserSync({
      open:       false,
      timestamps: true,
      proxy:      {
        target: 'https://kasbah_nkob.test'
      }
    }, function (err, bs) {
      done();
    });
  });
  // Inject CSS files to the browser
  grunt.registerTask('bs-inject-css', function () {
    browserSync.reload([
      'dist/css/astra_theme.css'
    ]);
  });
  // Reload browser
  grunt.registerTask('bs-reload', function () {
    browserSync.reload([
      'dist/js/astra_theme.js',
      './**/*.php'
    ]);
  });

  // Default task.
  grunt.registerTask( 'default', ['concat', 'sasslint', 'sass:dev', 'postcss:dev', 'svgstore', 'copy', 'bs-init', 'watch'] ); // runs watch tasks one time and then activates watch
  grunt.registerTask( 'bs-php',  ['bs-init', 'watch:php'] ); // Starts browsersync and then activates watch
  grunt.registerTask( 'css',     ['sass:dev', 'postcss:dev'] ); // compiles css for dev environment
  grunt.registerTask( 'js',      ['concat'] ); // compiles js for dev environment
  grunt.registerTask( 'sprite',  ['svgstore'] ); // builds the svg sprite
  grunt.registerTask( 'prod',    ['concat', 'terser', 'sass', 'postcss:build', 'svgstore', 'copy', 'notify:build' ] ); // compiles all files for staging/production
  grunt.registerTask( 'build',   ['prod', 'sasslint' ] ); // same, but runs sasslint

  grunt.util.linefeed = '\n';

};
