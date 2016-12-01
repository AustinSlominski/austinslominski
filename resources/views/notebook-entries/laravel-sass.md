## Installing and configuring SASS for Laravel

A component of Laravel is Elixir. It provides an API for gulp tasks within a Laravel project, which will allow us to compile SASS.

### Installation

Node.js is required, so first get that package. You can check first with `node -v` in your terminal. I prefer using Brew to install packages on my Macbook, and the command for that is:

```
brew install node
```

Now, install Gulp globally, using Node.

```
npm install --global gulp
```

And install the dependencies.

```
npm install
```

### Usage

The files you need to handle are in two places. There is *gulpfile.js* located at the project root, and *resources/assets/sass*. 

Gulpfile.js is where you want to point to your sass files, which by default will be your app.scss within resources/assets/sass. It's within app.scss that I usually point to all of the other scss files that I want to compile.

For example, this app.scss from Mumble (which could definitely use some cleanup)

```
@import "node_modules/bootstrap-sass/assets/stylesheets/bootstrap";

//GLOBAL VARIABLES
	$hover_color: orange;
	$toolbar_color: #333333;
	$toolbar_hovercolor: orange;
	$secondary_toolbar_color: #ebebeb;
//----------------

@import "mixins";
@import "global";
@import "dropzone";

@import "glyph";
@import "toolbar";
@import "navigation";
@import "tags";
@import "photos";
@import "forum";
@import "index";
@import "profile";
@import "forum";
@import "home";
@import "footer";
```

And a sample from profile.scss

```
.status {
	@extend .row, .center-block, .panel, .panel-default;
	margin-bottom:0px;
	div{
		@extend .panel-body;
		padding:0px !important;
		h2 {
			margin-top:0px;
		}
		.status-left{
			padding:15px !important;
			@extend .col-md-6, .col-sm-6;
		}
		.status-right{
			padding:15px !important;
			@extend .col-md-6, .col-sm-6;
		}
	}
}

.profile-content {
	@extend .row, .center-block;
	.profile-avatar {
		@extend .pull-left, .col-md-4;
	}
	.profile-info {
		@extend .pull-right, .col-md-8;
	}
}
```

Finally, there are a few commands you need to call from the terminal, using either `gulp` to run tasks, or `gulp watch` to detect changes and run tasks automatically. 

If you are extending your classes with bootstrap classes, make sure the first line of app.scss is uncommented (it is commented out by default). @import "node_modules/bootstrap-sass/assets/stylesheets/bootstrap";

### Errors

(5.3) You might run into this error when you try to run gulp watch:

```
Error: Cannot find module 'laravel-elixir'
``` 

(Question about this found [here][1])

It's possible that the version of elixir in the package.json file is incorrect. Go into the packages.json file and try these values:

```
{
  "private": true,
  "scripts": {
    "prod": "gulp --production",
    "dev": "gulp watch"
  },
  "devDependencies": {
    "bootstrap-sass": "^3.3.7",
    "gulp": "^3.9.1",
    "jquery": "^3.1.0",
    "laravel-elixir": "^6.0.0-9",
    "laravel-elixir-vue-2": "^0.2.0",
    "laravel-elixir-webpack-official": "^1.0.9",
    "lodash": "^4.16.2",
    "vue": "^2.0.1",
    "vue-resource": "^1.0.3"
  }
}

```

and then run:

```
npm install laravel-elixir-webpack-official --save-dev
```

[1]: https://laracasts.com/discuss/channels/general-discussion/cannot-find-module-vendorlaravelelixirelixir
