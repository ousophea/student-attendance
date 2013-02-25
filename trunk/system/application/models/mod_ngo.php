<?php
	class Mod_ngo extends Model{
		function Mod_ngo(){
			parent::Model();
		}
		//get ngo
		function getNgo($num, $uri3){
			$this->db->select('*');
			$this->db->from('tbl_ngos');
			//if user search
			$this->input->post("txt_ngoname")==true?$this->db->like('ngo_name',$this->input->post("txt_ngoname")):"";
			$this->db->where('ngo_id > ',0);
			$this->db->where('ngo_status',1);
			$this->db->order_by("ngo_name", "ASC"); 
			$this->db->limit($num, $uri3);
			return $this->db->get();
		}
		
		//get all ngo which use for pagenation
		function getNum(){
			$this->db->select('*');
			$this->db->from('tbl_ngos');
			//if user search
			$this->input->post("txt_ngoname")==true?$this->db->like('ngo_name',$this->input->post("txt_ngoname")):"";
			$this->db->where('ngo_id > ',0);
			$this->db->where('ngo_status',1);
			return $this->db->get()->num_rows();
		}
		
		//add new ngo
		function addnew(){
			if($this->dataexist("tbl_ngos","ngo_name",$this->input->post("txt_ngoname"))) return false;
			else{
				$data=array(
							'ngo_name'=>$this->input->post("txt_ngoname"),
							'ngo_address'=>$this->input->post("txt_ngoadd"),
							'ngo_contact_person'=>$this->input->post("txt_ngocontact"),
							'ngo_url'=>$this->input->post("txt_ngourl"),
							'ngo_email'=>$this->input->post("txt_ngoemail"),
							'ngo_sdate'=>$this->input->post("txt_ngosdate"),
							'ngo_edate'=>$this->input->post("txt_ngoedate"),
							'ngo_description'=>$this->input->post("txt_ngodes")
							);
				if($this->db->insert("tbl_ngos",$data)) return true;
			}
		}
		
		//get ngo
		function getOneNgo($where=""){
			$this->db->select("*");
			$this->db->where("ngo_id",$where);
			$this->db->from("tbl_ngos");
			return $this->db->get();
		}
		
		//update ngo
		function update(){
			if($this->input->post("ngo_id")!="")$this->session->set_userdata("condition",$this->input->post("ngo_id"));
			if($this->dataexist("tbl_ngos","ngo_name",$this->input->post("txt_ngoname"))) return false;
			else{
				$data=array(
							'ngo_name'=>$this->input->post("txt_ngoname"),
							'ngo_address'=>$this->input->post("txt_ngoadd"),
							'ngo_contact_person'=>$this->input->post("txt_ngocontact"),
							'ngo_url'=>$this->input->post("txt_ngourl"),
							'ngo_email'=>$this->input->post("txt_ngoemail"),
							'ngo_sdate'=>$this->input->post("txt_ngosdate"),
							'ngo_edate'=>$this->input->post("txt_ngoedate"),
							'ngo_description'=>$this->input->post("txt_ngodes")
							);
				
				$this->db->where("ngo_id",$this->session->userdata("condition"));
				if($this->db->update("tbl_ngos",$data))return true;
			}
		}
		
		//function delete
		function delete($con){
			$data=array(
						'ngo_status'=>0
						);
			$this->db->where("ngo_id",$con);
			if($this->db->update("tbl_ngos",$data))return true;
			else return false;
		}
		
		//check data exist
		function dataexist($tables,$fields,$values){
			$this->db->select("*");
			$this->db->from($tables);
			$this->db->where($fields,$values);
			$data=$this->db->get();
			if($data->num_rows()>0){
				if($this->session->userdata("condition")){
					foreach ($data->result() as $row){
						if($row->ngo_id==$this->session->userdata("condition")) return false;
					}
				}
				$this->session->set_userdata("ms_error","Data Exist!"); 
				return true;
			}
			else return false;
		}
	}
?>