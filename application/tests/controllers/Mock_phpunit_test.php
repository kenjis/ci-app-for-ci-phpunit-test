<?php

class Mock_phpunit_test extends TestCase
{
	public function test_send_okay()
	{
		$output = $this->request(
			'POST',
			['Mock_phpunit', 'send'],
			[
				'name' => 'Mike Smith',
				'email' => 'mike@example.jp',
				'body' => 'This is test mail.',
			],
			function ($CI) {
				$email = $this->getDouble('CI_Email', ['send' => TRUE]);
				$this->verifyInvokedOnce($email, 'send');
				$CI->email = $email;
			}
		);
		$this->assertContains('Mail sent', $output);
	}

	public function test_send_error()
	{
		$output = $this->request(
			'POST',
			['Mock_phpunit', 'send'],
			[
				'name' => 'Mike Smith',
				'email' => 'mike@example.jp',
				'body' => 'This is test mail.',
			],
			function ($CI) {
				$email = $this->getDouble('CI_Email', ['send' => FALSE]);
				$this->verifyInvokedOnce($email, 'send');
				$CI->email = $email;
			}
		);
		$this->assertContains('Error', $output);
	}
}
