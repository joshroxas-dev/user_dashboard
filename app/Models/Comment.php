<?php

namespace App\Models;

use CodeIgniter\Model;

class Comment extends Model
{
	function get_comments()
	{
		return $this->db->query("SELECT comments.id, comments.message_id, comments.writer_id, comments.content, CONCAT(users.first_name, ' ',users.last_name) AS name, comments.updated_at
								 FROM comments
								 LEFT JOIN users
								 ON comments.writer_id = users.id")->getResultArray();
	}

	function create_comment($content)
	{
		$query = "INSERT INTO comments (message_id, writer_id, content, created_at, updated_at)
		VALUES (?, ?, ?, ?, ?)";
		$values = array($content['message_id'], $content['writer_id'], $content['content'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
		return $this->db->query($query, $values);
	}
}
