<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_peserta extends CI_Model
{

        private $_client;

        public function __construct()
        {
                $this->_client = new Client([
                        'base_uri' => 'http://localhost/mysite/restful_server/api/',
                ]);
        }

        public function get_all_data()
        {
                $response = $this->_client->request(
                        'GET',
                        'peserta',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        public function get_peserta($id_user)
        {

                $response = $this->_client->request(
                        'GET',
                        'courses/peserta',
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

        // tambah data
        public function add($data)
        {
                $response = $this->_client->request(
                        'POST',
                        'peserta',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'username_peserta' => $data['username_peserta'],
                                        'email_peserta' => $data['email_peserta'],
                                        'TTL' => $data['TTL'],
                                        'alamat' => $data['alamat'],
                                        'no_telp' => $data['no_telp'],
                                        'JK' => $data['JK'],
                                        'image_peserta' => $data['image_peserta'],

                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }

        // tambah data
        public function add_online($data)
        {
                $response = $this->_client->request(
                        'POST',
                        'peserta/add_online',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'username_peserta' => $data['username_peserta'],
                                        'id_user' => $data['id_user'],
                                        'email_peserta' => $data['email_peserta'],
                                        'TTL' => $data['TTL'],
                                        'alamat' => $data['alamat'],
                                        'no_telp' => $data['no_telp'],
                                        'JK' => $data['JK'],
                                        'image_peserta' => $data['image_peserta'],

                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }

        public function get_data($id_peserta)
        {
                $response = $this->_client->request(
                        'GET',
                        'peserta',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_peserta' => $id_peserta
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }



        // update data peserta tanpa gambar
        public function update($data)
        {
                $response = $this->_client->request(
                        'put',
                        'peserta',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_peserta' => $data['id_peserta'],
                                        'username_peserta' => $data['username_peserta'],
                                        'TTL' => $data['TTL'],
                                        'alamat' => $data['alamat'],
                                        'no_telp' => $data['no_telp'],
                                        'JK' => $data['JK'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }


        // update data peserta dgn gambar
        public function update_gambar($data)
        {
                $response = $this->_client->request(
                        'put',
                        'peserta/update_gambar',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_peserta' => $data['id_peserta'],
                                        'username_peserta' => $data['username_peserta'],
                                        'TTL' => $data['TTL'],
                                        'alamat' => $data['alamat'],
                                        'no_telp' => $data['no_telp'],
                                        'JK' => $data['JK'],
                                        'image_peserta' => $data['image_peserta'],
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
                        'peserta',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_peserta' => $data['id_peserta'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }
}

/* End of file ModelName.php */
