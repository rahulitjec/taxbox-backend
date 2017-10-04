<?php

Class Common_model extends CI_Model
{
	/*-------------------------
	|	BASIC CRUD USING CI
	|
	|	Core module
	*---------------------------*/

	private static $_time_now = null;
	
	public function __construct()
	{		
		self::$_time_now = time();
				
	}	
		
	public function insert_data($table_name, $data)
	{	
		$data['create_date'] = self::$_time_now;
		$ret = $this->db->insert($table_name, $data);
		
		if($this->db->affected_rows() > 0){
			return $this->db->insert_id();
		}else{
			return false;
		}
		
	}	

   public function update_data($table, $where, $data, $options = null){
		$data['update_date'] = self::$_time_now;
		$this->db->update($table, $data, $where);
		
        if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		} 
	}
	
	public function delete_data($table, $where, $options = null){		
		$this->db->delete($table, $where);		
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}

     }
	 public function select_data($table, $where = null, $limit = null, $select = null,$order = null){
		if($select != null){
			$this->db->select($select);
		}

		$this->db->from($table);

		if($where != null){
			$this->db->where($where);
		}

		if($limit != null){
			$this->db->limit($limit); 
		}

		
		if($order != null){
			$this->db->order_by($order, "desc");
		}

		return $this->db->get()->result();
	}
		
		
		public function doLogin($email, $password, $role)
	{
		$data = $this->db->select('id, role','user_name')
				->from('users')
				->where(array('email'=>$email, 'password'=>$password, 'role'=>$role))
				->get()->result();

				
		if ($data) {
			return $data[0];
		} else {
			return false;
		}
	}
       public function vendordata_subadmin($id)
	{
			$this->db->select('*');
			$this->db->from('allocate_form a'); 
			$this->db->join('vendor_form b','b.id=a.vendor_id'); 
			$this->db->join('users c','c.user_id=b.user_id');
            $this->db->where('a.subadmin_id',$id);			
			$query = $this->db->get(); 
			if($query->num_rows() != 0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
	}
			
	 public function ValidateTFN($tfn)
		{
					$weights = array(10, 7, 8, 4, 6, 3, 5, 2, 1);
				 //echo $tfn; die;
					// strip anything other than digits
					$tfn = preg_replace("/[^\d]/","",$tfn);
				 
					// check length is 9 digits
					if (strlen($tfn)==9) {
						$sum = 0;
						foreach ($weights as $position=>$weight) {
							$digit = $tfn[$position];
							$sum += $weight * $digit;
						}
						return ($sum % 11)==0;
					} 
					return false;
		}
	public function ValidateABN($abn='') 
		{
				$weights = array(10, 1, 3, 5, 7, 9, 11, 13, 15, 17, 19);
			 
				// strip anything other than digits
				$abn = preg_replace("/[^\d]/","",$abn);
			 
				// check length is 11 digits
				if (strlen($abn)==11) {
					// apply ato check method 
					$sum = 0;
					foreach ($weights as $position=>$weight) {
						$digit = $abn[$position] - ($position ? 0 : 1);
						$sum += $weight * $digit;
					}
					return ($sum % 89)==0;
				} 
				return false;
		}	
	
	
	     
	
}