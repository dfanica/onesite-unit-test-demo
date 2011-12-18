<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| View Names & Composers
	|--------------------------------------------------------------------------
	|
	| Named views give you beautiful syntax when working with your views.
	|
	| Here's how to define a named view:
	|
	|		'home.index' => array('name' => 'home')
	|
	| Now, you can create an instance of that view using the very expressive
	| View::of dynamic method. Take a look at this example:
	|
	|		return View::of_home();
	|
	| View composers provide a convenient way to add common elements to a view
	| each time it is created. For example, you may wish to bind a header and
	| footer partial each time the view is created.
	|
	| The composer will receive an instance of the view being created, and is
	| free to modify the view however you wish. Here is how to define one:
	|
	|		'home.index' => function($view)
	|		{
	|			//
	|		}
	|
	| Of course, you may define a view name and a composer for a single view:
	|
	|		'home.index' => array('name' => 'home', function($view)
	|		{
	|			//
	|		})	
	|
	*/

    'layouts.default' => function($view)
    {
        Asset::add('bootstrap', 'http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css');
        Asset::add('prettify', 'prettify/prettify.js');
        Asset::add('prettify-css', 'prettify/prettify.css', 'prettify');
        Asset::add('jquery', 'js/fancybox/jquery-1.4.3.min.js');
        Asset::add('fancybox', 'js/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js', 'jquery');
        Asset::add('fancybox-css', '/js/fancybox/fancybox/jquery.fancybox-1.3.4.css', 'fancybox');
    },
);