module.exports = function(grunt) {

	grunt.config('less', {
		// Compile less
		build: {
			files: {
				"../dist/css/<%= pkg.shortname %>.css": [
					"../assets/less/main.less"
				]
			},
			options: {
				compress: false,
				sourceMap: true,
				sourceMapFilename: "../dist/css/<%= pkg.shortname %>.css.map",

			}
		},
		prod: {
			files: {
				"../dist/css/<%= pkg.shortname %>.min.css": [
					"../assets/less/main.less"
				]
			},
			options: {
				compress: true,
				sourceMap: true,
				sourceMapFilename: "../assets/css/<%= pkg.shortname %>.css.map",
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-less');

};