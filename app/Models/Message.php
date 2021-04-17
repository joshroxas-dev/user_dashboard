<?php

namespace App\Models;

use CodeIgniter\Model;

class Message extends Model
{
	function get_messages($id)
	{
		return $this->db->query("SELECT messages.id, messages.user_id, messages.writer_id, content, concat(users.first_name, ' ' ,users.last_name) as name, messages.updated_at
								 FROM messages
								 LEFT JOIN users
								 ON messages.writer_id = users.id
								 WHERE messages.user_id = ?", array($id))->getResultArray();
	}

	function create_message($content)
	{
		$query = "INSERT INTO messages (user_id, writer_id, content, created_at, updated_at)
		VALUES (?, ?, ?, ?, ?)";
		$values = array($content['user_id'], $content['writer_id'], $content['content'],date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
		return $this->db->query($query, $values);
	}
}
