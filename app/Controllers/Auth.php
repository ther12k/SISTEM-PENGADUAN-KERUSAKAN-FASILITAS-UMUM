<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
// panggil Model User
Use App\Models\UserModel;
// panggil libraries Hash
use App\Libraries\Hash;

class Auth extends BaseController
{

    function __construct(){
        $this->userM = new UserModel();
    }
    public function index()
    {
        //
    }
    // Formulir Register
    function RegisterForm() {
        return view('Auth/form_register');
    }
    // Proses Registrasi
    function RegisterProses() {
        if ($this->request->isAJAX()) {
            //panggil fungsi validasi
            $this->validate = \config\services::validation();
            //atue rules
            $validate = $this->validate(
                [
                    'username'=>[
                    'label'=> 'Username',
                    'rules'=> 'required|max_length[60]',
                    'errors'=> [
                        'required'=> '{field} Wajib Diisi',
                        'max_length'=> '{field} Maksimal 60 Karakter',
                    ]
                    ],
                    'email'=>[
                    'label'=> 'email',
                    'rules'=> 'required|valid_email|max_length[60]',
                    'errors'=> [
                        'required'=> '{field} Wajib Diisi',
                        'valid_email'=> 'Format {field} Tidak sesuai',
                        'max_length'=> '{field} Maksimal 60 Karakter',
                    ]
                    ],
                    'new_password'=>[
                    'label'=> 'Password Baru',
                    'rules'=> 'required|max_length[30]',
                    'errors'=> [
                        'required'=> '{field} Wajib Diisi',
                        'max_length'=> '{field} Maksimal 30 karakter',
                    ]
                    ],
                    'conf_password'=>[
                    'label'=> 'Konfirmasi Password',
                    'rules'=> 'required|max_length[30]|matches[new_password]',
                    'errors'=> [
                        'required'=> '{field} Wajib Diisi',
                        'max_length'=> '{field} Maksimal 30 karakter',
                        'matches'=> '{field} Tidak Sesuai', 
                    ]
                    ],
                ]


            );

            //cek validasi
            if (!$validate) {
                $response = [
                    'status'=> false,
                    'username'=> $this->validate->getError('username'),
                    'email'=> $this->validate->getError('email'),
                    'new_password'=> $this->validate->getError('new_password'),
                    'conf_password'=> $this->validate->getError('conf_password'),
                ];
            }else{
                $data = [
                    'email'=> $this->request->getPost('email'),
                    'username'=> $this->request->getPost('username'),
                    'password'=> Hash::make($this->request->getPost('conf_password')),
                    'role'=>'pelanggan'
                ];  
                // simpan data ke tabel users
                $this->userM->save($data);


                $response = [
                    'status'=> true,
                    'msg'=>'Pendaftaran Akun Berhasil. Silahkan Login',
                    'url'=> base_url('login')
                ];
            }

            return $this->response->setJSON($response);

           
        }
    }
    // Login form

    function LoginForm() {
        return view('Auth/form_login');
    }
    //login proses
    function LoginProses() {
        if ($this->request->isAJAX()) {
            // service validasi
            $this->validate = \Config\Services::validation();
            // def rules
            $validate = $this->validate([
                'email'=>[
                    'label'=>'Email Address',
                    'rules'=> 'required|valid_email|max_length[60]',
                    'errors'=>[
                        'required'=>'{field} Harus di isi',
                        'valid_email'=>'{field} Tidak Valid',
                        'max_length'=>'{field} Maksimal 60 Karakter',
                    ]
                ],
                'password'=>[
                    'label'=>'password',
                    'rules'=> 'required',
                    'errors'=>[
                        'required'=>'{field} Harus di isi',
                    ]
                ],
            ]);
            // jika gagal
            if (!$validate){
                $response = [
                    'status'=> false,
                    'email'=> $this->validate->getError('email'),
                    'password'=> $this->validate->getError('password'),
                ];
            }else{
            // jika lolos validasi
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // === CEK USER BERDASARKAN EMAIL ===
            // Cari user tanpa memfilter role terlebih dahulu
            $user = $this->userM
            ->where('email', $email)
            ->first();

            if (!$user){
                return $this->response->setJSON([
                    'status'=> false,
                    'email'=> 'Akun tidak terdaftar',
                    'password'=>''
                ]);
            }

            // === CEK PASSWORD ===
            if(!Hash::verify($password, $user['password'])) {
                return $this->response->setJSON([
                'status'=> false,
                'password'=>'Password Salah',
                'email'=> '',

                ]);
            }

            //== SET SESSION
            session()->set([
                'user_id'=> $user['id'],
                'username'=> $user['username'],
                'email'=> $user['email'],
                'role'=> $user['role'],
                'logged_in'=> true,

            ]);

            // Redirect ke halaman masing role user
            $redirectURL = ($user['role']=='admin') ? base_url('admin/dashboard'):base_url('user/home');

            $response = [
                'status'=> true,
                'redirect'=> $redirectURL
            ];
            }
            return $this->response->setJSON($response);
        }  
    }

    function Forbidden() {
        return View('errors/html/forbidden');
        // return " Akses ditolak -- Anda tidak memiliki akses";
    }
}
