<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Messages extends BaseController
{
	public function create($id)
	{
		$session = session();
		$messageModel = model('App\models\Message', false);
		$content = array(
			'user_id' => $id,
			'writer_id' => $session->get('user_id'),
			'content' => $this->request->getPost('content'),
		);

		$messageModel->create_message($content);
		return redirect()->to('/users/show/' . $id);
	}
}
