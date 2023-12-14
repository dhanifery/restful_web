<?php

use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_mobil extends CI_Model
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
                        'mobil',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        public function get_data($id_mobil)
        {
                $response = $this->_client->request(
                        'GET',
                        'mobil',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_mobil' => $id_mobil
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        // done 
        //  tambah data
        public function add($data)
        {
                $response = $this->_client->request(
                        'POST',
                        'mobil',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'nama_mobil' => $data['nama_mobil'],
                                        'jenis_mobil' => $data['jenis_mobil'],
                                        'no_mesin' => $data['no_mesin'],
                                        'no_plat' => $data['no_plat'],
                                        'deskripsi_mobil' => $data['deskripsi_mobil'],
                                        'image_mobil' => $data['image_mobil']

                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }
        // done 
        // update data
        public function update($data)
        {
                $response = $this->_client->request(
                        'PUT',
                        'mobil',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_mobil' => $data['id_mobil'],
                                        'nama_mobil' => $data['nama_mobil'],
                                        'jenis_mobil' => $data['jenis_mobil'],
                                        'no_mesin' => $data['no_mesin'],
                                        'no_plat' => $data['no_plat'],
                                        'deskripsi_mobil' => $data['deskripsi_mobil'],

                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }

        // done 
        // update data
        public function update_gambar($data)
        {
                $response = $this->_client->request(
                        'PUT',
                        'mobil/update_gambar',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_mobil' => $data['id_mobil'],
                                        'nama_mobil' => $data['nama_mobil'],
                                        'jenis_mobil' => $data['jenis_mobil'],
                                        'no_mesin' => $data['no_mesin'],
                                        'no_plat' => $data['no_plat'],
                                        'deskripsi_mobil' => $data['deskripsi_mobil'],
                                        'image_mobil' => $data['image_mobil'],

                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }

        // belum 
        // hapus data
        public function delete($data)
        {
                $response = $this->_client->request(
                        'DELETE',
                        'mobil',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_mobil' => $data['id_mobil'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }
}
