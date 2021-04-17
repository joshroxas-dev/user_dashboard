<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
	public function index()
	{
		$session = session();
		return view('auth/index', array('is_logged_in' => $session->get('is_logged_in')));
	}

	public function register()
	{
		$session = session();
		return view('auth/register', array('is_logged_in' => $session->get('is_logged_in')));
	}

	public function new()
	{
		$session = session();
		return view('home/new', array('is_logged_in' => $session->get('is_logged_in')));
	}

	public function show_user($id)
	{
		$session = session();
		$userModel = model('App\Models\User', false);
		$messageModel = model('App\Models\Message', false);
		$commentModel = model('App\Models\Comment', false);
		$data['comments'] = $commentModel->get_comments();
		$data['messages'] = $messageModel->get_messages($id);
		$data['user'] = $userModel->get_user_by_id($id);
		$data['is_logged_in'] =  $session->get('is_logged_in');
		return view('home/show_profile', $data);
	}

	public function update($id)
	{
		$session = session();
		$userModel = model('App\Models\User', false);
		$user = array(
			'email' => $this->request->getPost('email'),
			'first_name' => $this->request->getPost('first_name'),
			'last_name' => $this->request->getPost('last_name'),
			'description' => $this->request->getPost('description'),
			'user_level' => $this->request->getPost('user_level'),
			'id' => $id
		);
		$userModel->update_user($user);
		$session->setFlashdata('success', 'user information successfully updated.');
		return redirect()->to("/dashboard/");
	}

	public function update_password($id)
	{
		$session = session();
		if ($this->request->getMethod() === 'post' && $this->validate([
			'password' => 'required|min_length[8]',
			'confirm_password' => 'required|matches[password]',
        ]))
        {
			$userModel = model('App\Models\User', false);
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$encrypted_password = md5($this->request->getPost('password') . '' . $salt);

			$user = array(
				'password' => $encrypted_password,
				'salt' => $salt,
				'id' => $id
			);

			$userModel->update_user_password($user);
			$session->setFlashdata('success', 'user password successfully updated.');
		}
		else
		{
			$session->setFlashdata('success', 'Passwords must match and longer than 8 characters.');
		}
		return redirect()->to("/users/edit/{$id}");
	}

	public function update_description()
	{
		$session = session();
		$userModel = model('App\Models\User', false);
		$user = array(
			'description' => $this->request->getPost('description'),
			'id' => $session->get('user_id')
		);
		$session->setFlashdata('success', 'description updated.');
		$userModel->update_user_description($user);
		return redirect()->to('/users/edit');
	}

	public function remove_user($id)
	{
		$session = session();
		$data['is_logged_in'] =  $session->get('is_logged_in');
		$data['user_id'] = $id;
		return view('home/confirm_delete', $data);
	}

	public function destroy_user($id)
	{
		$userModel = model('App\Models\User', false);
		$userModel->destroy_user($id);
		return redirect()->to('/dashboard/admin');
	}

	public function edit($id)
	{
		$session = session();
		$userModel = model('App\Models\User', false);
		$data['user'] = $userModel->get_user_by_id($id);
		$data['is_logged_in'] = $session->get('is_logged_in');
		$data['access_level'] = $session->get('access_level');
		return view('home/show_user', $data);
	}

	public function edit_profile()
	{
		$session = session();
		$userModel = model('App\Models\User', false);
		$data['is_logged_in'] =  $session->get('is_logged_in');
		$data['user'] = $userModel->get_user_by_id($session->get('user_id'));
		return view('home/edit_profile', $data);
	}

	public function register_user()
	{
		$session = session();
		if ($this->request->getMethod() === 'post' && $this->validate([
            'first_name' => 'required|min_length[3]|max_length[255]',
			'last_name' => 'required|min_length[3]|max_length[255]',
			'email'=> 'required|valid_email|is_unique[users.email]',
			'password' => 'required|min_length[8]',
			'confirm_password' => 'required|matches[password]',
        ]))
        {
			$userModel = model('App\Models\User', false);
			$user_level = '';
        
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
       		$encrypted_password = md5($this->request->getPost('password') . '' . $salt);
			$check_users = $userModel->get_all_users();

			if (empty($check_users))
			{
				$user_level = 'admin';
			}
			else
			{
				$user_level = 'normal';
			}
			$user = array(
				'first_name' => $this->request->getPost('first_name'),
				'last_name' => $this->request->getPost('last_name'),
				'email' => $this->request->getPost('email'),
				'password' => $encrypted_password,
				'salt' => $salt,
				'user_level' => $user_level
			);
			$session->setFlashdata('success', 'registration successful.');
			$userModel->add_user($user);
			return redirect()->to('/register');
		}
		return view('auth/register', array('is_logged_in' => $session->get('is_logged_in')));
	}

	public function login()
	{
		$session=session();
		$userModel = model('App\Models\User', false);
		$user = $userModel->get_user_by_email($this->request->getPost('email'));

		if ($this->request->getMethod() === 'post' && $this->validate([
			'email'=> 'required|valid_email',
			'password' => 'required|min_length[8]',
        ]))
        {
			if (!empty($user))
			{
				$encrypted_password = md5($this->request->getPost('password') . '' . $user['salt']);
				if ($user['password'] == $encrypted_password )
				{
					$session->set('user_id', $user['id']);
					$session->set('first_name', $user['first_name']);
					$session->set('access_level', $user['user_level']);
					$session->set('is_logged_in', true);
					return redirect()->to('/');
				}
				else
				{
					$session->setFlashdata('error', 'password is incorrect.');
					return redirect()->to('/signin');
				}
			}
			else
			{
				$session->setFlashdata('error', 'user is not yet registered.');
				return redirect()->to('/signin');
			}
		}
		return view('auth/index', array('is_logged_in' => $session->get('is_logged_in')));
	}

	public function logoff()
	{
		$session = session();
		$session->destroy();
		return redirect()->to('/');
	}
}
