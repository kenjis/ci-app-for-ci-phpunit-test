<?php

class Set_config_test extends TestCase
{
		public function test_set_config()
		{
				$config_key = 'test_key';
				$config_value = 'test_value';
				$this->request->setCallable(
					function ($CI) use ($config_key, $config_value) {
						$CI->config->set_item($config_key, $config_value);
					}
			  );

				$output = $this->request(
					'GET',
					['Set_config', 'config_item'],
					['key' => $config_key]
				);
				$this->assertEquals($output, $config_value);
		}
		
		public function test_unset_config()
		{
				$config_key = 'test_key';
				$this->request->setCallable(
					function ($CI) use ($config_key) {
						$CI->config->set_item($config_key, null);
					}
				);

				$output = $this->request(
					'GET',
					['Set_config', 'config_item'],
					['key' => $config_key]
				);
				$this->assertEquals($output, '');
		}
		
		public function test_set_config_twice()
		{
				$config_key = 'test_key';
				$config_value = 'test_value_2';
				$this->request->setCallable(
					function ($CI) use ($config_key, $config_value) {
						$CI->config->set_item($config_key, $config_value);
					}
				);

				$output = $this->request(
					'GET',
					['Set_config', 'config_item'],
					['key' => $config_key]
				);
				$this->assertEquals($output, $config_value);
		}
}
