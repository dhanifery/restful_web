<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_kursus extends CI_Controller
{


        public function __construct()
        {
                parent::__construct();
                $this->user_login->proteksi_halaman();
                $this->load->model(['m_user', 'm_peserta', 'm_instruktur']);
        }


        // done
        public function daftar_peserta()
        {
                $email = $this->session->userdata('email');
                $id_user = $this->session->userdata('id_user');
                $value = $this->m_peserta->get_peserta($id_user);
                if ($value) {
                        $data = array(
                                'title' => 'B I S T I R | Daftar ',
                                'user' => $this->m_user->cek_data($email),
                                'daftar_peserta' => $this->m_peserta->get_peserta($id_user),
                                'isi' => 'peserta/v_rinci_daftar',
                        );
                } else {
                        $data = array(
                                'title' => 'B I S T I R | Daftar ',
                                'user' => $this->m_user->cek_data($email),
                                'isi' => 'peserta/v_daftar',
                        );
                }

                $this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
        }

        // done
        public function daftar_instruktur()
        {
                $email = $this->session->userdata('email');
                $id_user = $this->session->userdata('id_user');
                $value = $this->m_instruktur->get_instruktur($id_user);
                if ($value) {
                        $data = array(
                                'title' => 'B I S T I R | Daftar ',
                                'user' => $this->m_user->cek_data($email),
                                'daftar_instruktur' => $this->m_instruktur->get_instruktur($id_user),
                                'isi' => 'instruktur/v_rinci_daftar',
                        );
                } else {
                        $data = array(
                                'title' => 'B I S T I R | Daftar ',
                                'user' => $this->m_user->cek_data($email),
                                'isi' => 'instruktur/v_daftar',
                        );
                }

                $this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
        }

        // done
        public function add_peserta()
        {
                $this->form_validation->set_rules(
                        'username_peserta',
                        'Username',
                        'required|min_length[3]',
                        array(
                                'required' => '%s Harus Diisi !!!!',
                                'min_length' => '%s Minimal 3 karakter !'
                        )
                );
                $this->form_validation->set_rules(
                        'TTL',
                        'Tanggal Lahir',
                        'required',
                        array(
                                'required' => '%s Harus Diisi !!!!'
                        )
                );
                $this->form_validation->set_rules(
                        'email_peserta',
                        'Email',
                        'required',
                        array(
                                'required' => '%s Harus Diisi !!!!'
                        )
                );
                $this->form_validation->set_rules(
                        'no_telp',
                        'No Telp',
                        'required',
                        array(
                                'required' => '%s Harus Diisi !!!!'
                        )
                );
                $this->form_validation->set_rules(
                        'alamat',
                        'ALamat',
                        'required',
                        array(
                                'required' => '%s Harus Diisi !!!!'
                        )
                );
                $this->form_validation->set_rules(
                        'JK',
                        'Jenis Kelamin',
                        'required',
                        array(
                                'required' => '%s Harus Diisi !!!!'
                        )
                );

                $email = $this->session->userdata('email');
                $id_user = $this->session->userdata('id_user');

                if ($this->form_validation->run() == TRUE) {
                        $config['upload_path'] = './assets/images/gambar/';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|ico';
                        $config['max_size']     = '5000';
                        $config['file_name'] = 'img' . time();
                        $this->upload->initialize($config);

                        $field_name = "image_peserta";
                        if (!$this->upload->do_upload($field_name)) {
                                $data = array(
                                        'title' => 'B I S T I R | Daftar ',
                                        'user' => $this->m_user->cek_data($email),
                                        'error_upload' => $this->upload->display_errors(),
                                        'isi' => 'peserta/v_daftar',

                                );
                                $this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
                        } else {
                                $upload_data = array('uploads' => $this->upload->data());
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = './assets/images/gambar/' . $upload_data['uploads']['file_name'];
                                $this->load->library('image_lib', $config);
                                $data = array(
                                        'id_user' => $id_user,
                                        'username_peserta' => $this->input->post('username_peserta'),
                                        'email_peserta' => $this->input->post('email_peserta'),
                                        'TTL' => $this->input->post('TTL'),
                                        'alamat' => $this->input->post('alamat'),
                                        'no_telp' => $this->input->post('no_telp'),
                                        'JK' => $this->input->post('JK'),
                                        'image_peserta' => $upload_data['uploads']['file_name'],
                                );
                                $this->m_peserta->add_online($data);
                                $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan !!!!');
                                redirect('jadwal/daftar_jadwal_peserta');
                        }
                }
                $data = array(
                        'title' => 'B I S T I R | Daftar ',
                        'user' => $this->m_user->cek_data($email),
                        'isi' => 'peserta/v_daftar',
                );
                $this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
        }


        // Add a new item
        public function add_instruktur()
        {
                $this->form_validation->set_rules(
                        'username_instr',
                        'Username',
                        'required|min_length[3]',
                        array(
                                'required' => '%s Harus Diisi !!!!',
                                'min_length' => '%s Minimal 3 karakter !'
                        )
                );
                $this->form_validation->set_rules(
                        'TTL',
                        'Tanggal Lahir',
                        'required',
                        array(
                                'required' => '%s Harus Diisi !!!!'
                        )
                );
                $this->form_validation->set_rules(
                        'email_instr',
                        'Email',
                        'required|is_unique[tbl_instruktur.email_instr]',
                        array(
                                'required' => '%s Harus Diisi !!!!',
                                'is_unique' => '%s Sudah terdaftar....!'
                        )
                );
                $this->form_validation->set_rules(
                        'no_telp',
                        'No Telp',
                        'required',
                        array(
                                'required' => '%s Harus Diisi !!!!'
                        )
                );
                $this->form_validation->set_rules(
                        'JK',
                        'Jenis Kelamin',
                        'required',
                        array(
                                'required' => '%s Harus Diisi !!!!'
                        )
                );
                $this->form_validation->set_rules(
                        'deskripsi_instr',
                        'Deskripsi',
                        'required',
                        array(
                                'required' => '%s Harus Diisi !!!!'
                        )
                );


                if ($this->form_validation->run() == TRUE) {
                        $config['upload_path'] = './assets/images/gambar/';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|ico';
                        $config['max_size']     = '5000';
                        $config['file_name'] = 'img' . time();
                        $this->upload->initialize($config);

                        $field_name = "image_instr";
                        if (!$this->upload->do_upload($field_name)) {
                                $data = array(
                                        'title' => 'B I S T I R | Daftar ',
                                        'user' => $this->m_user->cek_data(['email' => $this->session->userdata('email')])->row_array(),
                                        'error_upload' => $this->upload->display_errors(),
                                        'isi' => 'instruktur/v_daftar',

                                );
                                $this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
                        } else {
                                $upload_data = array('uploads' => $this->upload->data());
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = './assets/images/gambar/' . $upload_data['uploads']['file_name'];
                                $this->load->library('image_lib', $config);
                                $data = array(
                                        'id_user' => $this->session->userdata('id_user'),
                                        'username_instr' => $this->input->post('username_instr'),
                                        'email_instr' => $this->input->post('email_instr'),
                                        'TTL' => $this->input->post('TTL'),
                                        'no_telp' => $this->input->post('no_telp'),
                                        'deskripsi_instr' => $this->input->post('deskripsi_instr'),
                                        'honor' => 50000,
                                        'JK' => $this->input->post('JK'),
                                        'image_instr' => $upload_data['uploads']['file_name'],
                                );
                                $this->m_instruktur->add($data);
                                $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan !!!!');
                                redirect('daftar_kursus/daftar_instruktur');
                        }
                }
                $data = array(
                        'title' => 'B I S T I R | Daftar ',
                        'user' => $this->m_user->cek_data(['email' => $this->session->userdata('email')])->row_array(),
                        'isi' => 'instruktur/v_daftar',
                );
                $this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
        }

        //  done
        public function update_instruktur($id_instruktur = NULL)
        {
                $this->form_validation->set_rules(
                        'username_instr',
                        'Username',
                        'required|min_length[3]',
                        array(
                                'required' => '%s Harus Diisi !!!!',
                                'min_length' => '%s Minimal 3 karakter !'
                        )
                );
                $this->form_validation->set_rules(
                        'TTL',
                        'Tanggal Lahir',
                        'required',
                        array(
                                'required' => '%s Harus Diisi !!!!'
                        )
                );
                $this->form_validation->set_rules(
                        'no_telp',
                        'No Telp',
                        'required',
                        array(
                                'required' => '%s Harus Diisi !!!!'
                        )
                );
                $this->form_validation->set_rules(
                        'deskripsi_instr',
                        'Deskripsi',
                        'required',
                        array(
                                'required' => '%s Harus Diisi !!!!'
                        )
                );
                $email = $this->session->userdata('email');
                if ($this->form_validation->run() == TRUE) {
                        $config['upload_path'] = './assets/images/gambar/';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|ico';
                        $config['max_size']     = '5000';
                        $config['file_name'] = 'img' . time();
                        $this->upload->initialize($config);

                        $field_name = "image_instr";
                        if (!$this->upload->do_upload($field_name)) {
                                $data = array(
                                        'title' => 'B I S T I R | Edit data ',
                                        'user' => $this->m_user->cek_data($email),
                                        'instruktur' => $this->m_instruktur->get_data($id_instruktur),
                                        'error_upload' => $this->upload->display_errors(),
                                        'isi' => 'instruktur/v_rinci_daftar',
                                );
                                $this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
                        } else {
                                // Timpa gambar lama jadi baru
                                $instruktur = $this->m_instruktur->get_data($id_instruktur);
                                if ($instruktur->image_instr != "") {
                                        unlink('./assets/images/gambar/' . $instruktur->image_instr);
                                }
                                // end timpa gambar lama jadi baru
                                $upload_data = array('uploads' => $this->upload->data());
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = './assets/images/gambar/' . $upload_data['uploads']['file_name'];
                                $this->load->library('image_lib', $config);

                                $data = array(
                                        'id_instruktur' => $id_instruktur,
                                        'username_instr' => $this->input->post('username_instr'),
                                        'email_instr' => $this->input->post('email_instr'),
                                        'TTL' => $this->input->post('TTL'),
                                        'honor' => $this->input->post('honor'),
                                        'JK' => $this->input->post('JK'),
                                        'no_telp' => $this->input->post('no_telp'),
                                        'deskripsi_instr' => $this->input->post('deskripsi_instr'),
                                        'image_instr' => $upload_data['uploads']['file_name'],
                                );
                                $this->m_instruktur->update_gambar($data);
                                $this->session->set_flashdata('pesan', 'Data berhasil Diganti !!!!');
                                redirect('daftar_kursus/daftar_instruktur');
                        }

                        $data = array(
                                'id_instruktur' => $id_instruktur,
                                'username_instr' => $this->input->post('username_instr'),
                                'email_instr' => $this->input->post('email_instr'),
                                'TTL' => $this->input->post('TTL'),
                                'honor' => $this->input->post('honor'),
                                'JK' => $this->input->post('JK'),
                                'deskripsi_instr' => $this->input->post('deskripsi_instr'),
                                'no_telp' => $this->input->post('no_telp'),
                        );
                        $this->m_instruktur->update($data);
                        $this->session->set_flashdata('pesan', 'Data berhasil Diganti !!!!');
                        redirect('daftar_kursus/daftar_instruktur');
                }


                $data = array(
                        'title' => 'B I S T I R | Daftar ',
                        'user' => $this->m_user->cek_data($email),
                        'instruktur' => $this->m_instruktur->get_data($id_instruktur),
                        'isi' => 'instruktur/v_update_instruktur',
                );
                $this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
        }
}

/* End of file Controllername.php */
