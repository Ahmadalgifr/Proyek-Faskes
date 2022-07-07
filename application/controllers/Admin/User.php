<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->title = 'User';
		$this->table = 'users';

		$this->load->model('M_Master');

		if (!$this->session->userdata('user')) {
			$this->M_Master->warning('Silahkan login terlebih dahulu');
			redirect('login');
		}
	}

	public function index() {
        $data['data'] = $this->M_Master->get($this->table)->result();
		$data['title'] = $this->title;
		$data['view'] = $this->table.'/index';

		$this->load->view('template/index', $data);
	}

    public function status($id, $status)
    {
        $where  = ['id' => $id];
        $del    = $this->M_Master->edit($this->table, ['status' => $status ? 0 : 1], $where);
		$msg = $status ? 'menonaktifkan' : 'mengaktifkan';
        $this->M_Master->success("Berhasil ".$msg." akun");

        redirect('admin/user');
    }

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}