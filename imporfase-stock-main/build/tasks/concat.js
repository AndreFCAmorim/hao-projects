module.exports = function(grunt) {

	// Minify js
	grunt.config('concat', {
		// Concatenate js files
		build: {
			options: {
				separator:        ';',
				preserveComments: true,
				sourceMapRoot:    '/',
				beautify:         true,
				sourceMap:        function(dest) {
					return dest + '.map'
				},
				sourceMappingURL: function(dest) {
					return dest.replace(/^.*[\\\/]/, '') + '.map'
				},
			},
			src: [
				// Include custom scripts
				'../assets/js/src/**/*.js',

				// Individually include scripts to load after all the other js
				// These should be located in 'assets/js/delayed/'
			],
			// Finally, concatenate all the files above into one single file
			dest: '../dist/js/<%= pkg.shortname %>.js',
		},
		prod: {
			options: {
				separator:        ';',
				preserveComments: true,
				beautify:         true,
				sourceMap:        false,
				sourceMapRoot:    '/',
			},
			src: [
				'../assets/js/src/**/*.js',
			],
			dest: '../dist/js/<%= pkg.shortname %>.js',
		},
	});
	grunt.loadNpmTasks('grunt-contrib-concat');

};

