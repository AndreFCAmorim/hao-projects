module.exports = function(grunt) {

	// Post process css for production: add prefixes and rem fallbacks,
	grunt.config('postcss', {
		build: {
			options: {
				processors: [
					require('autoprefixer')({browsers: 'last 3 versions'}),
					require('cssnano')() // minify the result
				]
			},
			files: {
				'../dist/css/<%= pkg.shortname %>.min.css': '../dist/css/<%= pkg.shortname %>.css',
			}
		},
		prod: {
			options: {
				processors: [
				require('autoprefixer')({browsers: 'last 3 versions'}),
				require('cssnano')() // minify the result
				]
			},
			files: {
				'../dist/css/<%= pkg.shortname %>.min.css': '../dist/css/<%= pkg.shortname %>.css',
			}
		}
	});

	grunt.loadNpmTasks('grunt-postcss');

};