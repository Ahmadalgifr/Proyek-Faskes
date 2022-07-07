<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faskes extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title = 'Faskes';
        $this->table = 'faskes';

        $this->load->model('M_Master');

		if (!$this->session->userdata('user')) {
			$this->M_Master->warning('Silahkan login terlebih dahulu');
			redirect('login');
		}
    }

    public function index()
    {
        $select = "{$this->table}.*, jenis_faskes.nama as nama_jenis_faskes, kecamatan.nama as nama_kecamatan";
        $data['data'] = $this->M_Master->get_join_id(
            $this->table,
            array(
                array(
                    'table' => 'jenis_faskes',
                    'fk'    => $this->table . '.jenis_id=jenis_faskes.id'
                ),
                array(
                    'table' => 'kecamatan',
                    'fk'    => $this->table . '.kecamatan_id=kecamatan.id'
                ),
            ),
            null,
            $select)->result();
        $data['title'] = $this->title;
        $data['view'] = $this->table . '/index';

        $this->load->view('template/index', $data);
    }

    public function form($id = null)
    {
        if ($this->input->method(TRUE) == 'POST') {
            $jenis_faskes   = $this->input->post('jenis_faskes');
            $nama           = $this->input->post('nama');
            $alamat         = $this->input->post('alamat');
            $latlong        = $this->input->post('latlong');
            $deskripsi      = $this->input->post('deskripsi');
            $skor_rating    = $this->input->post('skor_rating');
            $kecamatan_id   = $this->input->post('kecamatan_id');
            $website        = $this->input->post('website');
            $jumlah_dokter  = $this->input->post('jumlah_dokter');
            $jumlah_pegawai = $this->input->post('jumlah_pegawai');

            $data   = [
                'jenis_id'          => $jenis_faskes,
                'nama'              => $nama,
                'alamat'            => $alamat,
                'latlong'           => $latlong,
                'deskripsi'         => $deskripsi,
                'skor_rating'       => $skor_rating,
                'kecamatan_id'      => $kecamatan_id,
                'website'           => $website,
                'jumlah_dokter'     => $jumlah_dokter,
                'jumlah_pegawai'    => $jumlah_pegawai,
            ];
            $msg    = 'Berhasil tambah data';
            
            if ($_FILES['foto1']['name']) {
                $new_name = time() . $_FILES['foto1']['name'];
                $config['file_name'] = $new_name;
                $config['upload_path'] = './public/foto/';
                $config['allowed_types'] = 'gif|jpg|png';
                $this->load->library('upload', $config);

                create_folder(FCPATH . str_replace('./', '', $config['upload_path']));
                $data['foto1'] = $new_name;
                if (!$this->upload->do_upload('foto1')) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->M_Master->warning(implode('<br>', $error));
                    $id = $id ? $id : '';
                    redirect('admin/kegiatan/form/' . $id);
                } else {
                    $upload_data = array('upload_data' => $this->upload->data());
                }
            }

            if ($_FILES['foto2']['name']) {
                $new_name = time() . $_FILES['foto2']['name'];
                $config['file_name'] = $new_name;
                $config['upload_path'] = './public/foto/';
                $config['allowed_types'] = 'gif|jpg|png';
                $this->load->library('upload', $config);

                create_folder(FCPATH . str_replace('./', '', $config['upload_path']));
                $data['foto2'] = $new_name;
                if (!$this->upload->do_upload('foto2')) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->M_Master->warning(implode('<br>', $error));
                    $id = $id ? $id : '';
                    redirect('admin/kegiatan/form/' . $id);
                } else {
                    $upload_data = array('upload_data' => $this->upload->data());
                }
            }

            if ($_FILES['foto3']['name']) {
                $new_name = time() . $_FILES['foto3']['name'];
                $config['file_name'] = $new_name;
                $config['upload_path'] = './public/foto/';
                $config['allowed_types'] = 'gif|jpg|png';
                $this->load->library('upload', $config);

                create_folder(FCPATH . str_replace('./', '', $config['upload_path']));
                $data['foto3'] = $new_name;
                if (!$this->upload->do_upload('foto3')) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->M_Master->warning(implode('<br>', $error));
                    $id = $id ? $id : '';
                    redirect('admin/kegiatan/form/' . $id);
                } else {
                    $upload_data = array('upload_data' => $this->upload->data());
                }
            }

            if (!empty($id)) {

                $where  = ['id' => $id];
                $detail = $this->M_Master->get_id($this->table, $where)->row();
                $edit   = $this->M_Master->edit($this->table, $data, $where);
                $msg    = 'Berhasil ubah data';
            
            } else {
                $add    = $this->M_Master->add($this->table, $data);
            }

            $this->M_Master->success($msg);
            redirect('admin/faskes');
        }

        $data['jenis_faskes']   = $this->M_Master->get('jenis_faskes')->result();
        $data['kecamatan']      = $this->M_Master->get('kecamatan')->result();
        $data['detail']         = $id ? $this->M_Master->get_id($this->table, ['id' => $id])->row() : null;
        $data['title']          = $this->title;
        $data['view']           = $this->table . '/form';

        $this->load->view('template/index', $data);
    }

    public function komentar($faskes_id)
    {

        $select = "komentar.*, users.username, nilai_rating.nama as nilai_rating";
        $data['data'] = $this->M_Master->get_join_id(
            'komentar',
            array(
                array(
                    'table' => 'users',
                    'fk'    => 'komentar.users_id=users.id'
                ),
                array(
                    'table' => 'nilai_rating',
                    'fk'    => 'komentar.nilai_rating_id=nilai_rating.id'
                ),
            ),
            null,
        $select)->result();
        $data['title'] = "Komentar";
        $data['view'] = $this->table . '/komentar';

        $this->load->view('template/index', $data);
    }

    public function delete($id)
    {
        $where  = ['id' => $id];
        $del    = $this->M_Master->del($this->table, $where);
        $this->M_Master->success('Berhasil hapus data');

        redirect('admin/faskes');
    }
}
