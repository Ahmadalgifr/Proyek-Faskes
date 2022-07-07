<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->title = 'Kecamatan';
		$this->table = 'kecamatan';

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

	public function form($id = null) {
		if ($this->input->method(TRUE) == 'POST') {
			$nama = $this->input->post('nama');
			
			$data   = ['nama' => $nama];
            $msg    = 'Berhasil tambah data';
            if (!empty($id)) {
                $where  = ['id' => $id];
                $edit   = $this->M_Master->edit($this->table, $data, $where);
                $msg    = 'Berhasil ubah data';
            } else {
                $add    = $this->M_Master->add($this->table, $data);
            }

            $this->M_Master->success($msg);
            redirect('admin/kecamatan');
		}
		$data['detail'] = $id ? $this->M_Master->get_id($this->table, ['id' => $id])->row() : null;
		$data['title'] = $this->title;
		$data['view'] = $this->table.'/form';

		$this->load->view('template/index', $data);
	}

	public function delete($id)
	{
		$where  = ['id' => $id];
		$del    = $this->M_Master->del($this->table, $where);
		$this->M_Master->success('Berhasil hapus data');
		
		redirect('admin/kecamatan');
	}
}
