<?php
	class Detail_m extends CI_Model
	{

        public function getlist($text1,$start,$limit)
        {
			if(!$text1)
				$sql="select * from detail order by name limit $start,$limit";     // select문 정의
			else
				$sql = "select * from detail where name like '%$text1%' order by name limit $start,$limit";
            return $this->db->query($sql)->result();              // 쿼리실행, 결과 리턴
		}

		public function rowcount($text1)
		{
			if(!$text1)
			{
				$sql="select * from detail";
			}
			else
			{
				$sql="select * from detail where name like '%$text1%'";
			}
			return $this->db->query($sql)->num_rows();
		}

		public function getrow($no)
		{
			$sql="select * from detail where no=$no";
			return $this->db->query($sql)->result(); 
		}	

		public function deleterow($no)
		{
			$sql="delete from detail where no=$no";
			return $this->db->query($sql);
		}

		public function insertrow($row)
		{

			return $this->db->insert("detail",$row);
		}

		public function updaterow($row,$no)
		{
			$where = array("no"=>$no);
			return $this->db->update("detail",$row,$where);
		}
	}

?>