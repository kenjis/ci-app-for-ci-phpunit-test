<?php

class Set_header extends CI_Controller
{
  public function get_request_header()
  {
    echo $this->input->get_request_header('X-Request-Header', TRUE);
  }
}
