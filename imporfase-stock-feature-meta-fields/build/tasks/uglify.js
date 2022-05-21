module.exports = function(grunt) {

	// Minify js
	grunt.config('uglify', {
		prod: {
			options: {
				sourceMap: false,
				preserveComments: false,
				banner:           '/* <%= pkg.name %> * Copyright (c) <%= grunt.template.today("yyyy") %> */\n',
				mangle:           { reserved: ['jQuery'] }
			},
			files: {
				'../dist/js/<%= pkg.shortname %>.min.js': ['../dist/js/<%= pkg.shortname %>.js']
			}
		}
	});
	grunt.loadNpmTasks('grunt-contrib-uglify');

};

