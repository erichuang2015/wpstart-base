# Crowdblink WordPress Theme

## Using Twig Templates

This theme separates logic and view code by implementing twig templating via the Timber plugin. This helps to contextualize the purpose of files: PHP files perform actions, add functionality, and generate the content for templates. Twig files dictate how that content is output, and SCSS files manage how that content looks. 

https://timber.github.io/docs/guides/wp-integration/

https://timber.github.io/docs/guides/acf-cookbook/

### Template Folder Structure

PHP files are located in the root folder of the theme, and all twig files are located in `./views`.

### Rendering Twig files with PHP

This theme includes some basic helper functions: 
* `render_view( 'view-file-name' )`
* `render_template( 'view-file-name' )`
* `compile_view( 'view-file-name' )`
* `compile_template( 'view-file-name' )`

`render_` functions immediatley outputs the view to the page. `compile_` functions get the view output as a string, and returns it.

`_view` functions uses only the specified view file. `_template` functions wrap the specified view with WordPress's native `get_header()` and `get_footer()`.

The view file name passed to these helper functions does not need the file path or extension. For example, to render the home page template: `render_template( 'page-home' )` will render `./views/page-home.twig`.

### Passing content to Twig files

By default, twig files have access to information about the current page template and queried posts. The most often used being `post` and `posts`. 

`post` contains the post object of the current post. In twig files, use syntax such as `{{ post.post_title }}` and `{{ post.content }}`.

`posts` contains an array of post objects, based on the current template query. This is useful for archives, search results, etc. Loop through the posts in twig files with syntax such as:
```twig
{% for post in posts %}
	<h1>{{ post.post_title }}</h1>
	{{ post.content }}
{% endfor %}
```

To make new variables available to twig files, push them into the global `$state` variable in PHP, or pass an array of key/value pairs as the second argument of the helper function.

```php
$state['events'] = [ 'Event #1', 'Event #2', 'Event #3' ];
render_template( 'page-events' );
// OR
render_template( 'page-events', [
	'events' => [ 'Event #1', 'Event #2', 'Event #3' ]
]);
```

```twig
{% for event in events %}
	<h2>{{ event }}</h2>
{% endfor %}
```