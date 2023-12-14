<?php
use GuzzleHttp\Client;

defined('BASEPATH') OR exit('No direct script access allowed');
// done
class M_auth extends CI_Model {

        private $_client;   

        public function __construct()
        {
             $this->_client = new Client([
                  'base_uri' => 'http://localhost/mysite/restful_server/api/',
             ]);
        }

        public function login_user($email, $password)
        {
        $response = $this->_client->request('POST','auth',
        [
                'form_params' =>[
                        'kursus_key' => 'apaya',
                        'email' => $email,
                        'password' => $password
                ]
                ]);

                $result = json_decode($response->getBody()->getContents(),true);

                return $result;
        } 

        public function registrasi()
        {
                $data = array(
                        'nama_user' => $this->input->post('nama_user'),
                        'email' => $this->input->post('email'),
                        'image' => 'default.jpg',
                        'password' => $this->input->post('password'),
                        'level_user' => '2',
                        'is_active' => '1',
                        'date_created' =>time(),
                        'kursus_key' =>'apaya'
                    );
                   $response = $this->_client->request('POST','auth/regis',
                   [
         
                        'form_params' => $data
                        ]);
         
                        $result = json_decode($response->getBody()->getContents(),true);
         
                        return $result;
        }

        

}

/* End of file ModelName.php */
