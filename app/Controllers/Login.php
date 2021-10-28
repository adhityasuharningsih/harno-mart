<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Login | Harno-Mart',
			'validation' => \Config\Services::validation()
		];
		return view('login', $data);
	}

	public function admin()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$user = (new UserModel())->where('username', $username)->first();

		if (empty($user)) {
			session()->setFlashdata('gagal', 'Username atau Password Salah');
			return redirect()->to('/login');
		}

		if ($user['password'] != $password) {
			session()->setFlashdata('gagal', 'Password yang diisi salah');
			return redirect()->to('/login');
		}


		session()->set('username', $username);
		return redirect()->to('/admin');
	}

	public function logout()
	{
		return redirect()->to('/login');
	}
}
