<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notfound extends CI_Controller
{
    public function index()
    {
        $this->load->view('errors/notfound404');
    }
}
