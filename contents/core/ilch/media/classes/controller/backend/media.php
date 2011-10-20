<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Media extends Controller_Backend {
 
	/**
	 * @var  boolean  auto render template
	 **/
	public $auto_render = FALSE;
 
	public function action_index()
	{
		Media::controller($this->request, $this->response, $this->request->param('file'));
	}

}
