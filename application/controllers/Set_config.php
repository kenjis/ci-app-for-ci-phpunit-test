<?php

class Set_config extends CI_Controller
{
	public function config_item()
	{
    $config_key = $this->input->get('key');
		echo $this->config->item($config_key);
	}
}
