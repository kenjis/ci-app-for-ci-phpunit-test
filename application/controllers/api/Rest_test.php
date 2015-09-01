<?php

require_once APPPATH . '/libraries/REST_Controller.php';

class Rest_test extends REST_Controller
{
	public function index_get()
	{
		$data['get']   = $this->get();
		$data['query'] = $this->query();
		$this->response($data, REST_Controller::HTTP_OK);
	}

	public function index_post()
	{
		$data['post']  = $this->post();
		$data['query'] = $this->query();
		$this->response($data, REST_Controller::HTTP_OK);
	}

	public function index_put()
	{
		$data['put']   = $this->put();
		$data['query'] = $this->query();
		$this->response($data, REST_Controller::HTTP_OK);
	}

	public function index_delete()
	{
		$data['delete'] = $this->delete();
		$data['query']  = $this->query();
		$this->response($data, REST_Controller::HTTP_OK);
	}
}
