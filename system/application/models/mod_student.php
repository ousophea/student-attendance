<?php
	class Mod_student extends Model{
		function Mod_student(){
			parent::Model();
		}
		//get ngo
		function getStudent($num, $uri3){
			$this->db->select('*');
			$this->db->from('tbl_students');
			//if user search
			$this->input->post("txt_stuName")==true?$this->db->like('stu_first_name',$this->input->post("txt_stuName")):"";
			$this->input->post("txt_ngoName")==true?$this->db->like('ngo_name',$this->input->post("txt_ngoName")):"";
			$this->input->post("txt_claName")==true?$this->db->like('cla_name',$this->input->post("txt_claName")):"";
			$this->db->where('stu_id > ',0);
			$this->db->where('stu_status',1);
			$this->db->where('cla_status',1);
			$this->db->where("ngo_status",1);
			$this->db->join('tbl_ngos','stu_ngo_id=ngo_id');
			$this->db->join('tbl_classes','stu_cla_id=cla_id');
			$this->db->order_by("stu_first_name", "ASC"); 
			$this->db->limit($num, $uri3);
			return $this->db->get();
		}
		
		//get one student to edit
		function getStu($con){
			$this->db->select('*');
			$this->db->from('tbl_students');
			$this->db->where('stu_id',$con);
			$this->db->where('stu_status',1);
			$this->db->where('cla_status',1);
			$this->db->where("ngo_status",1);
			$this->db->join('tbl_ngos','stu_ngo_id=ngo_id');
			$this->db->join('tbl_classes','stu_cla_id=cla_id');
			$this->db->order_by("stu_first_name", "ASC");
			return $this->db->get();
		}
		//get all ngo which use for pagenation
		function getNum(){
			$this->db->select('*');
			$this->db->from('tbl_students');
			//if user search
			$this->input->post("txt_stuName")==true?$this->db->like('stu_first_name',$this->input->post("txt_stuName")):"";
			$this->input->post("txt_ngoName")==true?$this->db->like('ngo_name',$this->input->post("txt_ngoName")):"";
			$this->input->post("txt_claName")==true?$this->db->like('cla_name',$this->input->post("txt_claName")):"";
			$this->db->where('stu_id > ',0);
			$this->db->where('stu_status',1);
			$this->db->where('cla_status',1);
			$this->db->where("ngo_status",1);
			$this->db->join('tbl_ngos','stu_ngo_id=ngo_id');
			$this->db->join('tbl_classes','stu_cla_id=cla_id');
			return $this->db->get()->num_rows();
		}
		
		//add new ngo
		function addnew(){
			//if($this->dataexist("tbl_students","stut_name",$this->input->post("txt_ngoname"))) return false;
			//else{
				$data=array(
							'stu_khmer_name'=>$this->input->post("txt_stukhmer"),
							'stu_first_name'=>$this->input->post("txt_stufirst"),
							'stu_last_name'=>$this->input->post("txt_stulast"),
							'stu_photo'=>$this->session->userdata("filename"),
							'stu_sex'=>$this->input->post("dro_stusex"),
							'stu_dob'=>$this->input->post("txt_studob"),
							'stu_age'=>$this->input->post("txt_stuage"),
							'stu_ngo_id'=>$this->input->post("dro_stungoid"),
							'stu_cla_id'=>$this->input->post("dro_stuclaid")
							);
				if($this->db->insert("tbl_students",$data)) return true;
			//}
		}
		//get ngo
		function getNgo(){
			$this->db->select("*");
			$this->db->where("ngo_id >",0);
			$this->db->where("ngo_status",1);
			$this->db->order_by('ngo_name','ASC');
			$this->db->from("tbl_ngos");
			return $this->db->get();
		}
		//get class
		function getCla(){
			$this->db->select("*");
			$this->db->where("cla_id >",'0');
			$this->db->where('cla_status',1);
			$this->db->order_by('cla_name','ASC');
			$this->db->from("tbl_classes");
			return $this->db->get();
		}
		//function delete
		function delete($con){
			$data=array(
						'stu_status'=>0
						);
			$this->db->where("stu_id",$con);
			if($this->db->update("tbl_students",$data))return true;
			else return false;
		}
		//update student
		function update($con){
			$data=array(
					'stu_khmer_name'=>$this->input->post("txt_stukhmer"),
					'stu_first_name'=>$this->input->post("txt_stufirst"),
					'stu_last_name'=>$this->input->post("txt_stulast"),
					'stu_sex'=>$this->input->post("dro_stusex"),
					'stu_dob'=>$this->input->post("txt_studob"),
					'stu_age'=>$this->input->post("txt_stuage"),
					'stu_ngo_id'=>$this->input->post("dro_stungoid"),
					'stu_cla_id'=>$this->input->post("dro_stuclaid")
					);
			//if user choose new file 
			if($this->session->userdata("filename")!='default.png'){
				$data1=array('stu_photo'=>$this->session->userdata("filename"));
				$data=array_merge((array)$data1, (array)$data);
			}
			$this->db->where("stu_id",$con);
			if($this->db->update("tbl_students",$data))return true;
			else return false;
		}
		
		//==============================================not use=====================//
	}