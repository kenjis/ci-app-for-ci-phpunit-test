<?php

class MY_Session extends CI_Session
{
	public function __construct(array $params = array())
	{
		if (ENVIRONMENT === 'testing')
		{
			log_message('debug', 'Session: Initialization under testing aborted.');
			return;
		}

		parent::__construct($params);
	}
}
