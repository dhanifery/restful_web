<?php

use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_instruktur extends CI_Model
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
                        'instruktur',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        public function get_instruktur($id_user)
        {
                $response = $this->_client->request(
                        'GET',
                        'courses/instruktur',
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

        public function get_join_data()
        {
                $response = $this->_client->request(
                        'GET',
                        'instruktur/join',
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
                        'instruktur',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'username_instr' => $data['username_instr'],
                                        'email_instr' => $data['email_instr'],
                                        'TTL' => $data['TTL'],
                                        'no_telp' => $data['no_telp'],
                                        'deskripsi_instr' => $data['deskripsi_instr'],
                                        'honor' => $data['honor'],
                                        'JK' => $data['JK'],
                                        'image_instr' => $data['image_instr'],

                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(),true);

                return $result;
        }

        public function get_data($id_instruktur)
        {
                $response = $this->_client->request(
                        'GET',
                        'instruktur',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_instruktur' => $id_instruktur
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        // update data
        public function update($data)
        {
                $response = $this->_client->request(
                        'PUT',
                        'instruktur',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_instruktur' => $data['id_instruktur'],
                                        'username_instr' => $data['username_instr'],
                                        'email_instr' => $data['email_instr'],
                                        'TTL' => $data['TTL'],
                                        'no_telp' => $data['no_telp'],
                                        'deskripsi_instr' => $data['deskripsi_instr'],
                                        'honor' => $data['honor'],
                                        'JK' => $data['JK']
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }

        // update data dgn gambar
        public function update_gambar($data)
        {
                $response = $this->_client->request(
                        'PUT',
                        'instruktur/update_gambar',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_instruktur' => $data['id_instruktur'],
                                        'username_instr' => $data['username_instr'],
                                        'email_instr' => $data['email_instr'],
                                        'image_instr' => $data['image_instr'],
                                        'TTL' => $data['TTL'],
                                        'no_telp' => $data['no_telp'],
                                        'deskripsi_instr' => $data['deskripsi_instr'],
                                        'honor' => $data['honor'],
                                        'JK' => $data['JK']
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
                        'instruktur',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_instruktur' => $data['id_instruktur'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }
}
