<?php

class Upload_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'upload');
		$this->assertContains('<input type="file" name="userfile"', $output);
	}

	public function test_post_do_upload()
	{
		$filename = 'ci-phpuni-test-downloads-777.png';
		$filepath = APPPATH.'tests/fixtures/'.$filename;

		$files = [
			'userfile' => [
				'name'     => $filename,
				'type'     => 'image/png',
				'tmp_name' => $filepath,
			],
		];
		$this->request->setFiles($files);
		$output = $this->request('POST', 'upload/do_upload');
		$this->assertContains('<h3>Your file was successfully uploaded!</h3>', $output);
	}
}
