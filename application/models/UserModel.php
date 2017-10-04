<?php

Class UserModel extends CI_Model
{
	public function vendor_fulldata($id,$vendor_type)
	{	
	
	
	 $this->db->select('*');
	 $this->db->from('vendor_form a');
     
      if($vendor_type==4){
       $this->db->join('vendor_individual b', 'b.id=a.id','left');
      }elseif($vendor_type==1){
        $this->db->join('vendor_trust c', 'c.id=a.id','left');
      }elseif($vendor_type==2){
        $this->db->join('vendor_company d', 'd.id=a.id','left');
      }elseif($vendor_type==3){
        $this->db->join('vendor_superfund e', 'e.id=a.id','left');
    }else{

      } 

		$this->db->where('a.id',$id);
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
	public function payment($user_id){
		 $this->db->select('*');
			$this->db->from('vendor_form');
			$this->db->where('user_id',$user_id);
			$this->db->order_by("id", "desc");
			$this->db->limit(1);
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
	
	
	
}
