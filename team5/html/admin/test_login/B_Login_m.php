<?php
	class B_Login_m extends CI_Model
	{
		function getrow($uid, $pwd)
		{
			$sql="select * from member where uid6='$uid' and pwd6='$pwd'";
			return $this->db->query($sql)->row();
		}


	}
?>