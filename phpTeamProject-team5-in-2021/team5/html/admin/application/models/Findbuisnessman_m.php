<?php
	class Findbuisnessman_m extends CI_Model
	{

        public function getlist($text1,$start,$limit)
        {
			if(!$text1)
				$sql="select * from member where rank=1 order by name limit $start,$limit";     // select문 정의
			else
				$sql = "select * from member where rank=1 and name like '%$text1%' order by name limit $start,$limit";
            return $this->db->query($sql)->result();              // 쿼리실행, 결과 리턴
		}

		public function rowcount($text1)
		{
			if(!$text1)
			{
				$sql="select * from member where rank=1";
			}
			else
			{
				$sql="select * from member where rank=1 and name like '%$text1%'";
			}
			return $this->db->query($sql)->num_rows();
		}

	}

?>