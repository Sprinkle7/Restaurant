<?php
/**
* 
*/
class Restaurant extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function addition($table,$data)
	{
		$query = $this->db->insert($table,$data);
		if ($query) {
			return true;
		}
		else {
			return false;
		}
	}
	public function aaddition($table,$item,$quan,$id,$type)
	{
		$data= array_combine($item, $quan);
		foreach ($data as $key => $value) {
			$query = $this->db->query("INSERT INTO `$table` (`oid`,`items`,`quantity`,`cid`,`type`) VALUES ('','$key','$value','$id','$type')");
		}
		if ($query) {
			return true;
		}
		else {
			return false;
		}
	}
	public function iddition($table,$item,$quan,$id,$type)
	{
		$data= array_combine($item, $quan);
		foreach ($data as $key => $value) {
			$query = $this->db->query("INSERT INTO `$table` (`id`,`itemname`,`itemquantity`,`sid`,`type`) VALUES ('','$key','$value','$id','$type')");
		}
		if ($query) {
			return true;
		}
		else {
			return false;
		}
	}
	// paginations here
	public function record_count() {
        return $this->db->count_all("stock");
    }
 	public function stock($table,$limit,$start,$joiner,$jid)
	{
		// $date = array(
		// 			$y=idate("Y"),
		// 			$d=idate("d"),
		// 			$m=idate("m"),
		// 			);
		// $date_in = implode(':', $date);
		$this->db->limit($limit,$start);
		$this->db->order_by('date','desc');
		// $this->db->where('date',$date_in);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($joiner, $joiner.'.'.$jid .' = '. $table.'.'.$jid);
		$query = $this->db->get();
		if ($query) {
			return $query->result();
		}
	}
   // pagiantion here
	public function miscs($table,$item,$quan,$id)
	{
		$data= array_combine($item, $quan);
		foreach ($data as $key => $value) {
			$query = $this->db->query("INSERT INTO `$table` (`mid`,`miscname`,`miscquantity`,`sid`) VALUES ('','$key','$value','$id')");
		}
		if ($query) {
			return true;
		}
		else {
			return false;
		}
	}
	public function updations($table,$id,$cid,$column,$value)
	{
		$this->db->where($id,$cid);
		$this->db->set($column,$value);
		$query = $this->db->update($table);
		if ($query) {
			return true;}
	 	else{
			return false;	
			}
	}
	public function updating($table,$cid,$id)
	{
		$this->db->where('cid',$id);
		$this->db->set($cid,'1');
		$query = $this->db->update($table);
		if ($query) {
			return true;}
	 	else{
			return false;	
			}
	}
	public function date($table,$cid,$id,$value)
	{
		$this->db->where('tid',$value);
		$this->db->set($cid,$id);
		$query = $this->db->update($table);
		if ($query) {
			return true;}
	 	else{
			return false;	
			}
	}
	public function joining($value)
	{
		$this->db->where('recieved','0');
		$this->db->select('*');
		$this->db->from($value);
		$this->db->join('waiters', 'waiters.w_id = '.$value.'.w_id');
		$query = $this->db->get();
		if ($query) {
			return $query->result();
		}
	}
	
	public function joined($value)
	{
		$this->db->select('*');
		$this->db->from($value);
		$this->db->join('user', 'user.u_id = '.$value.'.u_id');
		$query = $this->db->get();
		if ($query) {
			return $query->result();
		}
	}
	public function selection($table)
	{
			$this->db->select('*')->from($table);
			$query 	=	$this->db->get();
			if ($query->num_rows>0) {
				return $query->result();
			}
	}
    function eselection($table,$com,$id)
	{		
			$this->db->where($com,$id);
			$this->db->select('*')->from($table);
			$query 	=	$this->db->get();
			if ($query->num_rows>0) {
				return $query->row();
			}
	}
	// 
	public function oselection($tab,$id,$value)
	{		
			$this->db->where_in($id,$value);
			$this->db->select('*');
			$this->db->from($tab);
			$query = $this->db->get();
			if ($query->num_rows>0) {
				return $query->result();
			 }
	}
	public function orderselction($table,$id,$idvalue,$type,$typevalue,$status,$statusvalue)
	{		
			$this->db->where($id,$idvalue);
			$this->db->where($type,$typevalue);
			$this->db->where($status,$statusvalue);
			$this->db->select('*')->from($table);
			$query 	=	$this->db->get();
			if ($query->num_rows>0) {
				return $query->result();
			}
	}
	public function mselection($table,$com,$id,$value=NULL)
	{		
			$this->db->where($com,$id);
			$this->db->where('type',$value);
			$this->db->select('*')->from($table);
			$query 	=	$this->db->get();
			if ($query->num_rows>0) {
				return $query->result();
			}
	}
	public function eupdate($table,$data,$id,$di)
	{		
			$this->db->where($di,$id);
			$this->db->set($data);
			$query = $this->db->update($table);
			if ($query) {
				return true;
			}
			else
			{
				return false;	
			}
	}
	public function udel($value,$id,$db)
	{
		$this->db->where($db,$id);
		$query = $this->db->delete($value);
		if ($query) {
			return true;			
		}
		else {
			return false;
		}
	}
	public function user_authenticate($table,$data)
	{
		$this->db->where($data);
		$this->db->select('*');
		$this->db->from($table);
		$query= $this->db->get();
		if ($query->num_rows>0) {
			return $query->row();
		}
		else
		{
			return false;
		}
	}
	public function outing_time($table,$data,$id,$u,$i)
	{
		$this->db->where($id,$data);
		$this->db->where($i,$u);
		$this->db->select('*');
		$this->db->from($table);
		$query= $this->db->get();
		if ($query->num_rows>0) {
			return $query->row();
		}
		else
		{
			return false;
		}
	}
	public function out($table,$value,$id,$sid)
	{
		$this->db->where('sid',$sid);
		$this->db->where('u_id',$id);
		$this->db->set('out',$value);
		$this->db->set('status',1);
		$query = $this->db->update($table);
		if ($query) {
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>