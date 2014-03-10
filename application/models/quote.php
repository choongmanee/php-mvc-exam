<?php

class quote extends CI_Model
{

	function get_user_by_email($email)
	{
		$query = $this->db->query("SELECT * FROM users WHERE email = ?", array($email));
		return $query->row_array();
	}

	function create($post)
	{
		$sql = "INSERT INTO quotes (author,message,user_id,postedby,created_at,updated_at) VALUES (?,?,?,?,NOW(),NOW())";
		$this->db->query($sql, array($post['author'],$post['message'],$post['userid'],$post['postedby']));
		return $this->get_quotes();
		// $quoteid = $this->db->insert_id();
		// return $this->get_quote_by_id($quoteid);
	}

	function get_user_by_id($id)
	{
		$query = $this->db->query("SELECT * FROM users WHERE id = ?", array($id));
		return $query->row_array();
	}

	function get_quotes()
	{
		$query = $this->db->query("SELECT * FROM quotes");
		return $query->result_array();
	}

	function add_favorite($data)
	{
		$sql = "INSERT INTO favorites (user_id,quotes_id) VALUES (?,?)";
		$this->db->query($sql, array($data['userid'],$data['quoteid']));
		return $this->get_favorites();
	}

	function get_favorites()
	{
		$query = $this->db->query("SELECT * FROM favorites JOIN quotes ON favorites.quotes_id=quotes.id");
		return $query->result_array();
	}

	function remove_favorite($data)
	{
		$sql = "DELETE FROM favorites WHERE user_id=? AND quotes_id=?";
		$this->db->query($sql,array($data['userid'],$data['quoteid']));
		return $this->get_favorites();
	}
}

?>