The following are needed to work with this project:
 1.   [Composer](https://getcomposer.org/) to manage PHP dependencies
 2.   [Node.js](https://nodejs.org/en/) to handle release tasks using [grunt](https://gruntjs.com/)

## To start development:

1.  Open the build folder in the terminal and run: `composer install` and `npm install`
2.  And now the fun part: edit the files in src/models to create your own model. Check [Saltus Framework Documentation](https://github.com/SaltusDev/saltus-framework) to understand how to use models.

We are working on providing a more simple way to start using this demo for less experienced developers.


## Available Grunt Tasks

All grunt tasks run inside the build folder.

**Main Release Tasks:**


`grunt bump` - Will do a minor increase in the plugin version


`grunt release` - Runs multiple tasks to prepare your plugin for release, creating in the end a release folder and zip file inside the build/release folder. These files should be ready for distribution.


**Other Development tasks:**
`grunt bs` - browser sync
`grunt i18n` - internationalization
`grunt build` - compiles files
`grunt dev` - compiles files
`grunt prod` - compiles files
