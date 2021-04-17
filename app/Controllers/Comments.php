<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Comments extends BaseController
{
	public function create($id)
	{
		$session = session();
		$commentModel = model('App\Models\Comment', false);
		$content = array(
			'message_id' => $id,
			'writer_id' => $session->get('user_id'),
			'content' => $this->request->getPost('content'),
		);
		$commentModel->create_comment($content);
		return redirect()->to('/users/show/' . $this->request->getPost('id'));
	}
}
