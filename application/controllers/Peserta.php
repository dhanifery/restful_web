<?php
defined('BASEPATH') or exit('No direct script access allowed');
// done
class Peserta extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->user_login->proteksi_halaman();
		$this->load->model(['m_user', 'm_home']);
	}

	// done
	public function index()
	{
		$email = $this->session->userdata('email');
		$data = array(
			'title' => 'B I S T I R | Home',
			'sub_heading' => 'Peserta',
			'user' => $this->m_user->cek_data($email),
			'isi' => 'peserta/v_peserta',
		);
		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}

	// done
	public function about()
	{
		$email = $this->session->userdata('email');
		$data = array(
			'title' => 'B I S T I R | About',
			'sub_heading' => 'Peserta',
			'total_peserta' => $this->m_home->total_peserta(),
			'total_instruktur' => $this->m_home->total_instruktur(),
			'user' => $this->m_user->cek_data($email),
			'isi' => 'peserta/v_about',
		);
		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}

	// done
	public function contact()
	{
		$email = $this->session->userdata('email');
		$data = array(
			'title' => 'B I S T I R | Contact',
			'user' => $this->m_user->cek_data($email),
			'isi' => 'peserta/v_contact',
		);
		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}

	// done
	public function my_profil()
	{
		$email = $this->session->userdata('email');
		$data = array(
			'title' => 'B I S T I R | My Profil',
			'sub_heading' => 'Peserta',
			'user' => $this->m_user->cek_data($email),
			'isi' => 'peserta/v_profil',
		);
		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}

	// done
	public function update_profil($id_user = NULL)
	{
		$this->form_validation->set_rules(
			'nama_user',
			'Nama User',
			'required',
			array(
				'required' => '%s Harus Diisi !!!!'
			)
		);

		$email = $this->session->userdata('email');
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/images/user/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|ico';
			$config['max_size']     = '5000';
			$config['file_name'] = 'img' . time();
			$this->upload->initialize($config);

			$field_name = "image";
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
					'id_user' => $id_user,
					'nama_user' => $this->input->post('nama_user'),

				);
				$this->m_user->update_profil($data);
				$this->session->set_flashdata('pesan', 'Profil berhasil diedit !!!!');
				redirect('peserta/my_profil');
			} else {
				// Timpa gambar lama jadi baru
				$user = $this->m_user->get_data($id_user);
				if ($user->image == "default.jpg") {
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/images/user/' . $upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'id_user' => $id_user,
						'nama_user' => $this->input->post('nama_user'),
						'image' => $upload_data['uploads']['file_name'],
					);
					$this->m_user->update_profil_gambar($data);
					$this->session->set_flashdata('pesan', 'Profil berhasil diedit !!!!');
					redirect('peserta/my_profil');
				} else {
					unlink('./assets/images/user/' . $user->image);
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/images/user/' . $upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'id_user' => $id_user,
						'nama_user' => $this->input->post('nama_user'),
						'image' => $upload_data['uploads']['file_name'],
					);
					$this->m_user->update_profil_gambar($data);
					$this->session->set_flashdata('pesan', 'Profil berhasil diedit !!!!');
					redirect('peserta/my_profil');
				}
			}

			$data = array(
				'title' => 'B I S T I R | Edit My Profil',
				'sub_heading' => 'Peserta',
				'user' => $this->m_user->cek_data($email),
				'error_upload' => $this->upload->display_errors(),
				'isi' => 'peserta/v_edit_profil',

			);
			$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
		}
		$data = array(
			'title' => 'B I S T I R | Edit My Profil',
			'sub_heading' => 'Peserta',
			'user' => $this->m_user->cek_data($email),
			'isi' => 'peserta/v_edit_profil',
		);
		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}


	// done 
	public function ganti_password($id_user = NULL)
	{
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required',
			array(
				'required' => '%s Harus Diisi !!!!'
			)
		);
		$this->form_validation->set_rules(
			'ulangi_password',
			'Password',
			'required|matches[password]',
			array(
				'required' => '%s Harus Diisi !!!!',
				'matches' => '%s Tidak Sama !!!'
			)
		);

		$email = $this->session->userdata('email');

		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'title' => 'B I S T I R | Ganti Password',
				'sub_heading' => 'Peserta',
				'user' => $this->m_user->cek_data($email),
				'isi' => 'peserta/v_ganti_password',
			);
			$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
		} else {
			$data = array(

				'id_user' => $id_user,
				'password' => $this->input->post('password'),


			);
			$this->m_user->update_password($data);

			$this->session->set_flashdata('pesan', 'Password berhasil diganti!');
			redirect('peserta/my_profil');
		}
		$data = array(
			'title' => 'B I S T I R | Ganti Password',
			'sub_heading' => 'Peserta',
			'user' => $this->m_user->cek_data($email),
			'isi' => 'peserta/v_ganti_password',
		);
		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}
}
