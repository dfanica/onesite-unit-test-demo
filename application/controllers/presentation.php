<?php

class Presentation_Controller extends Controller
{
	public function action_index()
	{
		return View::make('layouts.default')->nest('content', 'presentation.index');
	}
}
