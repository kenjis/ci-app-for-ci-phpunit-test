<?php

class MY_Config extends CI_Config
{
	public function site_url($uri = '', $protocol = NULL)
	{
		if ($uri === 'testingtesting')
		{
			return 'http://this.is.my.config/';
		}

		return parent::site_url($uri, $protocol);
	}
}
