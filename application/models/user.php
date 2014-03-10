<?php

class user extends CI_Model
{

	function get_user_by_email($email)
	{
		$query = $this->db->query("SELECT * FROM users WHERE email = ?", array($email));
		return $query->row_array();
	}

	function create($post)
	{
		$sql = "INSERT INTO users (name,alias,email,password,dob,created_at,updated_at) VALUES (?,?,?,?,?,NOW(),NOW())";
		$this->db->query($sql, array($post['name'],$post['alias'],$post['emailaddress'],md5($post['rpassword']),$post['dob']));
		$userid = $this->db->insert_id();
		return $this->get_user_by_id($userid);
	}

	function get_user_by_id($id)
	{
		$query = $this->db->query("SELECT * FROM users WHERE id = ?", array($id));
		return $query->row_array();
	}

}

?>