<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
	function get_all_users()
	{
	return $this->db->query("SELECT * FROM users")->getResultArray();
	}

	function add_user($user)
	{
		$query = "INSERT INTO users (first_name, last_name, email, password, salt, user_level, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?)";
		$values = array($user['first_name'], $user['last_name'], $user['email'], $user['password'], $user['salt'], $user['user_level'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s")); 
		return $this->db->query($query, $values);
	}

	function get_user_by_email($email)
	{
		return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->getRowArray();
	}

	function get_user_by_id($id)
	{
		return $this->db->query("SELECT * FROM users WHERE id = ?", array($id))->getRowArray();
	}

	function update_user($user)
	{
		$query = "UPDATE users 
		SET email=?, first_name=?, last_name=?, description=?, user_level=?
		WHERE id = ?";
		$values = array($user['email'], $user['first_name'], $user['last_name'], $user['description'], $user['user_level'], $user['id']);
		return $this->db->query($query, $values);
	}

	function update_user_password($user)
	{
		$query = "UPDATE users 
		SET password=?, salt=?
		WHERE id = ?";
		$values = array($user['password'], $user['salt'], $user['id']);
		return $this->db->query($query, $values);
	}

	function update_user_description($user)
	{
		$query = "UPDATE users 
		SET description=?
		WHERE id = ?";
		$values = array($user['description'], $user['id']);
		return $this->db->query($query, $values);
	}

	function destroy_user($id)
	{
		return $this->db->query("DELETE FROM users WHERE id=?", array($id));
	}
}
