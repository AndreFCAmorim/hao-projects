/* global module */
module.exports = function(grunt) {

	//
	grunt.config('makepot', {
		target: {
			options: {
				cwd: '../',
				domainPath: 'languages',
				potFilename: '<%= cfg.i18n.potFilename %>.pot',
				mainFile: 'functions.php',
				exclude: [
					'.*bkp-.*',
					'.*del-.*',
					'assets/',
					'bin/',
					'build/',
					'languages/',
					'lib',
					'node_modules',
					'release/',
					'svn/',
					'tests/',
					'tmp',
					'vendor',
				],
				potComments: '',
				potHeaders: {
					'poedit':                true,
					'x-poedit-keywordslist': true,
					'language':              'en_US',
					'report-msgid-bugs-to':  '<%= cfg.i18n.support %>',
					'last-translator':       '<%= cfg.i18n.author %>',
					'language-Team':         '<%= cfg.i18n.author %>',
				},
				type: 'wp-theme',
				updateTimestamp: true,
				updatePoFiles: true,
				processPot: null,
			},
		},
	});
	grunt.loadNpmTasks('grunt-wp-i18n');

}
