<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (session()->get('logged_in')) {
            // Redirect based on user role
            $role = session()->get('role');

            if ($role === 'admin') {
                return redirect()->to('/admin/dashboard');
            } elseif ($role === 'pelanggan') {
                return redirect()->to('/user/home');
            }
        }

        // If not logged in, show login form
        return redirect()->to('/login');
    }
}
