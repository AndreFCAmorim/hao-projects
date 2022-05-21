module.exports = function( grunt ) {

  'use strict';

  // Project configuration
  var localenv = grunt.file.readJSON( 'localenv.json' );
  var localconfig = grunt.file.readJSON( 'config.json' );
  var localpkg = grunt.file.readJSON( 'package.json' );

  var grunt_config = {
    pkg: localpkg,
    cfg: localconfig,
    env: localenv,
  };
  grunt.initConfig( grunt_config );

  // load modules & tasks
  grunt.loadTasks( 'tasks' );

  // Main tasks.

  // runs the build tasks one time and then activates watch
  grunt.registerTask( 'default', ['dev', 'i18n', 'bs-init', 'watch'] );
  // Starts browsersync and then activates watch for php files only
  grunt.registerTask( 'bs-php',  ['bs-init', 'watch:php'] );
  // compiles css for dev environment
  grunt.registerTask( 'css',     ['less:build', 'sass:build','postcss:build'] );
  // compiles js for dev environment
  grunt.registerTask( 'js',      ['concat:build'] );
  // internationalization
  grunt.registerTask( 'i18n',    ['checktextdomain', 'makepot'] );
  // compiles all files for dev
  grunt.registerTask( 'dev',   ['concat:build', 'less:build', 'sass:build', 'postcss:build', 'copy', 'notify:build'] );

  grunt.registerTask( 'build',   ['concat:build', 'uglify', 'less:build', 'sass:build', 'postcss:build', 'copy', 'notify:build'] );
  // compiles all files for staging/production
  grunt.registerTask( 'prod',    ['concat:prod', 'uglify', 'less:prod', 'sass:prod', 'postcss:prod', 'composer:update', 'copy', 'i18n'] );

  grunt.util.linefeed = '\n';

};

/*
versionReplace: {
				files:[
				// copy stylesheets and insert version number from package.json.
				{
					expand: true,
					src: ['style.css', 'assets/css/style.css'],
					dest: 'dist/best-reloaded/'
				}],
				options: {
					process: function (content, srcpath) {
						console.log( 'processing' );
						var pkgVersion = grunt.file.readJSON( 'package.json' ).version;
						return content.replace( '{{ VERSION }}', pkgVersion );
					},
				},
			}
*/