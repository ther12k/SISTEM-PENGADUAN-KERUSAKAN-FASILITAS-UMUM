<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ComplaintModel;
use App\Models\UserModel;
use App\Models\ResponseModel;

class Pages extends BaseController
{
    function __construct() {
        $this->complaintM = New ComplaintModel();
        $this->userM = New UserModel();
        $this->responseM = New ResponseModel();
    }

    public function dashboard()
    {
        // Get statistics for dashboard
        $data['stats'] = [
            'total_complaints' => $this->complaintM->countAllResults(),
            'baru' => $this->complaintM->where('status', 'baru')->countAllResults(),
            'proses' => $this->complaintM->where('status', 'proses')->countAllResults(),
            'selesai' => $this->complaintM->where('status', 'selesai')->countAllResults(),
            'total_users' => $this->userM->where('role', 'pelanggan')->countAllResults(),
        ];

        // Get recent complaints
        $data['recent_complaints'] = $this->complaintM
            ->select('complaints.*, users.username')
            ->join('users', 'users.id = complaints.user_id')
            ->orderBy('complaints.created_at', 'DESC')
            ->limit(5)
            ->find();

        return view('Admin/Dashboard', $data);
    }

    public function komplaint()
    {
        // Get all complaints with user info
        $data['complaints'] = $this->complaintM
            ->select('complaints.*, users.username')
            ->join('users', 'users.id = complaints.user_id')
            ->orderBy('complaints.created_at', 'DESC')
            ->findAll();

        return view('Admin/Komplaint', $data);
    }

    
    public function profil()
    {
        $data['user'] = $this->userM->find(session()->get('user_id'));
        return view('Admin/Profil', $data);
    }

    public function detail()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = $this->complaintM->find($id);

            if(!$data) {
                return $this->response->setJSON(['error' => 'Data tidak ditemukan']);
            }

            // Get username from user table
            $data['username'] = $this->userM->find($data['user_id'])['username'] ?? 'Unknown';

            return $this->response->setJSON(['form_detail'=> view('Admin/Complaints/detail_komplaint',['d'=>$data])]);
        }
    }

    public function updateStatus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $status = $this->request->getPost('status');

            $this->complaintM->update($id, ['status' => $status]);

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Status berhasil diperbarui'
            ]);
        }
    }

    
    public function saveTanggapan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $validate = $this->validate([
                'complaint_id' => [
                    'label' => 'Komplain ID',
                    'rules' => 'required|is_natural_no_zero',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'is_natural_no_zero' => '{field} harus valid'
                    ]
                ],
                'message' => [
                    'label' => 'Tanggapan',
                    'rules' => 'required|min_length[10]',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                        'min_length' => '{field} minimal 10 karakter'
                    ]
                ]
            ]);

            if (!$validate) {
                return $this->response->setJSON([
                    'status' => false,
                    'complaint_id' => $validation->getError('complaint_id'),
                    'message' => $validation->getError('message')
                ]);
            }

            $data = [
                'complaint_id' => $this->request->getPost('complaint_id'),
                'user_id' => session()->get('user_id'),
                'message' => $this->request->getPost('message'),
                'craeted_at' => date('Y-m-d H:i:s'),
                'update_at' => date('Y-m-d H:i:s')
            ];

            $this->responseM->save($data);

            // Update complaint status to 'proses' if still 'baru'
            $complaint = $this->complaintM->find($data['complaint_id']);
            if ($complaint['status'] == 'baru') {
                $this->complaintM->update($data['complaint_id'], ['status' => 'proses']);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Tanggapan berhasil ditambahkan'
            ]);
        }
    }

    public function getTanggapanForm()
    {
        if ($this->request->isAJAX()) {
            $complaint_id = $this->request->getVar('complaint_id');
            $complaint = $this->complaintM->find($complaint_id);

            if (!$complaint) {
                return $this->response->setJSON(['error' => 'Komplain tidak ditemukan']);
            }

            return $this->response->setJSON([
                'form' => view('Admin/Complaints/tanggapan_form', ['complaint' => $complaint])
            ]);
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}