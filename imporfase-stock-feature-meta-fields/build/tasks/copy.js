module.exports = function(grunt) {

	// Minify js
	grunt.config('copy', {
		js: {
			expand: true,
			cwd:    '../assets/js/externals',
			src:    '**/*',
			dest:   '../dist/js/',
		},
		fonts: {
			expand: true,
			cwd:    '../assets/type',
			src:    '**/*',
			dest:   '../dist/type/',
		}
	});
	grunt.loadNpmTasks('grunt-contrib-copy');

};

