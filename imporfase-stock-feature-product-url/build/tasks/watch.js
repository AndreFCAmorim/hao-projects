module.exports = function(grunt) {

	// Watch for changes
	grunt.config('watch', {
		// Watch for the frontend scss files changes
		sass_dev: {
			files: [
				'../assets/scss/**/*.scss',

				// if needed, exclude files to avoid delaying watch task
				// example: '!assets/css/scss/file.scss'
			],
			tasks:   ['sass:build', 'postcss:build', 'bs-inject-css'],
			options: {
				spawn: false
			}
		},
		// Watch for the js files changes
		scripts: {
			files: [
				'../assets/js/*/**/*.js'
			],
			tasks:   ['concat', 'bs-reload'],
			options: {
				spawn: false
			}
		},

		// Watch for the php files changes to trigger browsersync reload
		php: {
			files: [
				'../**/*.php'
			],
			tasks:   ['bs-reload'],
			options: {
				spawn: false
			}
		}
	});
	grunt.loadNpmTasks('grunt-contrib-watch');

};

