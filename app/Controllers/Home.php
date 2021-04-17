<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$session = session();
		if ($session->get('is_logged_in') === null)
		{
			$session->set('is_logged_in', false);
		}

		if ($session->get('is_logged_in'))
		{
			if ($session->get('access_level') == 'admin')
			{
				return redirect()->to('/dashboard/admin');
			}
			else
			{
				return redirect()->to('/dashboard');
			}

		}
		else
		{
			return view('home/index', array('is_logged_in' => false));
		}
	}

	public function show_dashboard()
	{
		$userModel = model('App\Models\User', false);
		$users['users'] = $userModel->get_all_users();
		return view('home/dashboard', $users);
	}
}
