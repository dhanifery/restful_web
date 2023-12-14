<?php

use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

        private $_client;

        public function __construct()
        {
                $this->_client = new Client([
                        'base_uri' => 'http://localhost/mysite/restful_server/api/',
                ]);
        }

        public function get_data($id_user)
        {
                $response = $this->_client->request(
                        'GET',
                        'user/id',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_user' => $id_user
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        public function get_all_data()
        {
                $response = $this->_client->request(
                        'GET',
                        'user/id',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        public function cek_data($email)
        {
                $response = $this->_client->request(
                        'GET',
                        'user',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'email' => $email
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }

        public function get_data_row()
        {
                $response = $this->_client->request(
                        'GET',
                        'admin',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        // tambah data
        public function add($data)
        {
                $response = $this->_client->request(
                        'POST',
                        'admin',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'nama_user' => $data['nama_user'],
                                        'email' => $data['email'],
                                        'password' => $data['password'],
                                        'is_active' => $data['is_active'],
                                        'level_user' => $data['level_user'],
                                        'date_created' => $data['date_created'],
                                        'image' => $data['image'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }

        // update data admin tanpa ubah gambar
        public function update($data)
        {
                $response = $this->_client->request(
                        'put',
                        'admin',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_user' => $data['id_user'],
                                        'nama_user' => $data['nama_user'],
                                        'is_active' => $data['is_active'],
                                        'level_user' => $data['level_user'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }
        // update data admin dgn ubah gambar
        public function update_gambar($data)
        {
                $response = $this->_client->request(
                        'put',
                        'admin/update',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_user' => $data['id_user'],
                                        'nama_user' => $data['nama_user'],
                                        'is_active' => $data['is_active'],
                                        'level_user' => $data['level_user'],
                                        'image' => $data['image']

                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }



        // update profil tanpa ubah gambar
        public function update_profil($data)
        {
                $response = $this->_client->request(
                        'put',
                        'user',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_user' => $data['id_user'],
                                        'nama_user' => $data['nama_user'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }
        // update profil admin dgn ubah gambar
        public function update_profil_gambar($data)
        {
                $response = $this->_client->request(
                        'put',
                        'user/update',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_user' => $data['id_user'],
                                        'nama_user' => $data['nama_user'],
                                        'image' => $data['image']

                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }
        // update profil password
        public function update_password($data)
        {
                $response = $this->_client->request(
                        'put',
                        'user/update_pass',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_user' => $data['id_user'],
                                        'password' => $data['password']

                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }

        // hapus data
        public function delete($data)
        {

                $response = $this->_client->request(
                        'DELETE',
                        'admin',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_user' => $data['id_user'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());
                return $result;
        }
}

/* End of file ModelName.php */
