<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ComplaintModel;
class Pages extends BaseController
{
    function __construct() {
       $this->complaintM = New ComplaintModel();
    }
    public function index()
    {
        $user_login_id = session()->get('user_id');
        $data['stat'] =$this->complaintM->countStatusByUser($user_login_id);
        // dd($data);
        // dd(session()->get('username'));
       return view('Pelanggan/Home', $data); 
    }


    // modul komplaint
    function ComplaintForm() {
        return view('Pelanggan/Complaints/form_complaint');
    }
    //form edit komplaint
    function ComplaintEdit($id) {
        $id = intval ($id);
        $data = $this->complaintM->find($id);
        // dd ($data);

        return view('Pelanggan/Complaints/form_edit_complaint',['d'=>$data]);
    }

   // Simpan & Update Complaint
function ComplaintStore()
{
    if ($this->request->isAJAX()) {

        $validation = \Config\Services::validation();

        // ========= PERUBAHAN: Tambah ID untuk deteksi edit =========
        $id = $this->request->getPost('id'); // Jika ada ID berarti edit

        // Atur rules validasi
        $validate = $this->validate([
            'title' => [
                'label' => 'Judul Komplain',
                'rules' => 'required|min_length[5]|max_length[255]',
                'errors' => [
                    'required'   => '{field} Wajib Diisi',
                    'min_length' => '{field} Minimal 5 Karakter',
                    'max_length' => '{field} Maksimal 255 Karakter',
                ],
            ],
            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required'   => '{field} Wajib Diisi',
                    'min_length' => '{field} Minimal 10 Karakter',
                ],
            ],

            // ========= PERUBAHAN: Lampiran opsional untuk edit =========
            // Jika edit, user boleh tidak upload ulang lampiran
            'attachment' => [
                'label' => 'Lampiran',
                'rules' => 'permit_empty|max_size[attachment,2048]|ext_in[attachment,png,jpg,jpeg,pdf,doc,docx]',
                'errors' => [
                    'max_size' => '{field} Maksimal 2MB',
                    'ext_in'   => 'Format {field} Tidak Didukung',
                ],
            ],
        ]);

        if (!$validate) {
            $response = [
                'status'      => false,
                'title'       => $validation->getError('title'),
                'description' => $validation->getError('description'),
                'attachment'  => $validation->getError('attachment'),
            ];
        } else {

            // ========= PERUBAHAN: Ambil data lama jika edit =========
            $oldData = null;
            if ($id) {
                $oldData = $this->complaintM->find($id);
            }

            // Proses upload lampiran (opsional)
            $attachmentName = $oldData['attachment'] ?? null; // <-- tetap pakai lampiran lama
            $attachment = $this->request->getFile('attachment');

            if ($attachment && $attachment->isValid() && !$attachment->hasMoved()) {

                // Jika edit & ada file lama → hapus file lama
                if ($id && $oldData && !empty($oldData['attachment'])) {
                    $path = ROOTPATH . 'public/uploads/complaints/' . $oldData['attachment'];
                    if (file_exists($path)) unlink($path);
                }

                // Upload file baru
                $attachmentName = $attachment->getRandomName();
                $attachment->move(ROOTPATH . 'public/uploads/complaints', $attachmentName);
            }

            // ========= PERUBAHAN: Gunakan save() untuk insert/update =========
            $this->complaintM->save([
                'id'          => $id, // ID kosong = insert | ada ID = update
                'user_id'     => session()->get('user_id'),
                'title'       => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'attachment'  => $attachmentName,

                // created_at hanya untuk insert
                'created_at'  => $id ? $oldData['created_at'] : date('Y-m-d H:i:s'),

                // updated_at selalu diperbarui
                'updated_at'  => date('Y-m-d H:i:s'),
            ]);

            $response = [
                'status'  => true,

                // ========= PERUBAHAN: Pesan sukses disesuaikan =========
                'message' => $id ? 'Komplain berhasil diperbarui' : 'Komplain berhasil dibuat',
            ];
        }

        return $this->response->setJSON($response);
    }
}

    // list data complaint
    function ComplaintList() {
        $user_login_id = session()->get('user_id');
        $data = $this ->complaintM ->getByUserId($user_login_id);
        //dd($data);


        return view('Pelanggan/Complaints/list_complaint', ['list'=>$data]);
    }
    // Hapus Komplaint
    function ComplainDelete (){
        $id = $this->request->getPost('id');
        if($this->complaintM->delete($id)){
            return $this->response->setJSON(['status'=> true, 'msg'=> 'Data berhasil di hapus']);
        }

    }


    // Informasi Detail
    function ComplainDetail(){
        $id = $this->request->getVar('id');
        $data = $this->complaintM->find($id);
        return $this->response->setJSON(['form_detail'=> view('Pelanggan/complaints/detail_komplaint',['d'=>$data])]);


        echo json_encode($_GET);
    }
    // logout

    function Logout() {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}