<?php
	class Register_m extends CI_Model
	{

		public function insertrow($row)
		{

			return $this->db->insert("member",$row);
		}

		
	}

?>