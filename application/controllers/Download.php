<?php

class Download extends CI_Controller
{
	public function force_download()
	{
		$this->load->helper('download');

		$filename = 'test.csv';
		$csv = 'Header1,Header2,Header3'."\n";
		$csv .= 'Data1,Data2,Data3'."\n";
		
		force_download($filename, $csv);
	}

	public function set_output()
	{
		$csv = 'Header1,Header2,Header3'."\n";
		$csv .= 'Data1,Data2,Data3'."\n";

		$this->output
			->enable_profiler(false)
			->set_status_header(200)
			->set_content_type('application/csv', 'utf-8')
			->set_output($csv);
	}
}
