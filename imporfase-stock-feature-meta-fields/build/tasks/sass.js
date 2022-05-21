module.exports = function(grunt) {

	const sass = require('node-sass');

	var findupNodeModules = require('findup-node-modules');
						console.log( 'processing' );

	grunt.config('sass', {
		// Compile SASS
		build: {
			// Compile the most frequently changed files, for use in development
			options: {
				implementation: sass,
				outputStyle:    'expanded',
				sourceMap:      true,
				includePaths: [
					findupNodeModules('susy/sass'),
					findupNodeModules('breakpoint-sass/stylesheets'),
					findupNodeModules('sass-mq')
				],
			},
			files: {
				'../dist/css/<%= pkg.shortname %>.css': '../assets/scss/main.scss',
				'../dist/css/styleguide.css': '../assets/scss/styleguide.scss'
			}
		},
		prod: {
			options: {
				implementation: sass,
				sourceMap:      true,
				includePaths:   [
					findupNodeModules('susy/sass'),
					findupNodeModules('breakpoint-sass/stylesheets'),
					findupNodeModules('sass-mq')
				],
			},
			files: {
				'../dist/css/<%= pkg.shortname %>.css': '../assets/scss/main.scss'
			}
		}
	});

	console.log( 'processing <%= pkg.shortname %>' );

	grunt.loadNpmTasks('grunt-sass');

};