<?php

class Mail extends CI_Controller
{
	public function send()
	{
		$mail = [];
		$mail['from_name'] = $this->input->post('name');
		$mail['from']      = $this->input->post('email');
		$mail['to']        = 'info@example.jp';
		$mail['subject']   = 'Test Mail';
		$mail['body']      = $this->input->post('body');

		if ($this->_sendmail($mail))
		{
			echo 'Mail sent';
		}
		else
		{
			echo 'Error';
		}
	}

	private function _sendmail($mail)
	{
		$this->load->library('email');
		$config = [];
		$config['protocol'] = 'mail';
		$config['wordwrap'] = FALSE;
		$this->email->initialize($config);

		$from_name = $mail['from_name'];
		$from      = $mail['from'];
		$to        = $mail['to'];
		$subject   = $mail['subject'];
		$body      = $mail['body'];

		$this->email->from($from, $from_name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($body);

		if ($this->email->send())
		{
			return TRUE;
		}
		else
		{
//			echo $this->email->print_debugger();
			return FALSE;
		}
	}
}
