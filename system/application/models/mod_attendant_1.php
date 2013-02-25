<?php
	class Mod_attendant extends Model{
		function Mod_attendant(){
			parent::Model();
		}
		//get ngo
		function getNgo(){
			$this->db->select('*');
			$this->db->from('tbl_ngos');
			$this->db->where('ngo_id > ',0);
			$this->db->where('ngo_status',1);
			$this->db->order_by("ngo_name", "ASC"); 
			return $this->db->get();
		}
		//get class
		function getAllCla(){
			$this->db->select('*');
			$this->db->from('tbl_classes');
			$this->db->join('tbl_workloads','cla_id=wor_cla_id');
			$this->db->join('tbl_generations','gen_id=cla_gen_id');
			$this->db->join('tbl_terms','gen_id=ter_gen_id');
			$this->db->where('gen_status',1);
			$this->db->where('ter_status',1);
			$this->db->where('cla_status',1);
			strtolower($this->session->userdata('tea_position'))!='admin'?$this->db->where('wor_tea_id',$this->session->userdata('tea_id')):"";
			$this->db->order_by('gen_year','DESC');
			$this->db->group_by('ter_id');
			return $this->db->get();
		}
		//get class in one term
		function getClaInTer($genId, $terId){
			$this->db->select('*');
			$this->db->from('tbl_classes');
			$this->db->join('tbl_workloads','cla_id=wor_cla_id');
			$this->db->join('tbl_generations','gen_id=cla_gen_id');
			$this->db->join('tbl_terms','gen_id=ter_gen_id');
			$this->db->where('gen_status',1);
			$this->db->where('ter_status',1);
			$this->db->where('cla_status',1);
			$this->db->where('gen_id',$genId);
			$this->db->where('ter_id',$terId);
			strtolower($this->session->userdata('tea_position'))!='admin'?$this->db->where('wor_tea_id',$this->session->userdata('tea_id')):"";
			$this->db->order_by('cla_name','ASC');
			$this->db->group_by('cla_id');
			return $this->db->get();
		}
		//get class where
		function getCla($where){
			$this->db->select('*');
			$this->db->from('tbl_classes');
			$this->db->where('cla_id',$where);
			$this->db->where('cla_status',1);
			return $this->db->get();
		}
		//get generation
		function getGen($where){
			$this->db->select('*');
			$this->db->from('tbl_generations');
			$this->db->where('gen_id',$where);
			$this->db->where('gen_status',1);
			return $this->db->get();
		}
		//get term
		function getTer($where){
			$this->db->select('*');
			$this->db->from('tbl_terms');
			$this->db->where('ter_status',1);
			$this->db->where('ter_id',$where);
			return $this->db->get();
		}
		//get student
		function getSomeStu(){
			$this->db->select("*");
			$this->db->from("tbl_students");
			$this->db->join("tbl_ngos","ngo_id=stu_ngo_id");
			$this->db->join("tbl_classes","cla_id=stu_cla_id");
			$this->db->join("tbl_workloads",'cla_id=wor_cla_id');
			$this->db->join("tbl_generations","gen_id=cla_gen_id");
			$this->db->join("tbl_terms","gen_id=ter_gen_id");
			$this->db->join("tbl_attendances","stu_id=att_stu_id");
			$this->db->where("stu_status",1);
			$this->db->where("ngo_status",1);
			$this->db->where("cla_status",1);
			$this->db->where("gen_status",1);
			$this->db->where("ter_status",1);
			strtolower($this->session->userdata('tea_position'))!='admin'?$this->db->where('wor_tea_id',$this->session->userdata('tea_id')):"";
			$this->db->where("gen_id",$this->session->userdata('gen_id'));
			$this->db->where("cla_id",$this->session->userdata('cla_id'));
			$this->db->where("ter_id",$this->session->userdata('ter_id'));
			$this->db->where("att_date",$this->session->userdata('att_date'));
			$this->db->order_by('stu_first_name',"ASC");
			return $this->db->get();
		}
		//get all student
		function getStu(){
			$this->db->select("*");
			$this->db->from("tbl_students");
			$this->db->join("tbl_ngos","ngo_id=stu_ngo_id");
			$this->db->join("tbl_classes","cla_id=stu_cla_id");
			$this->db->join("tbl_workloads",'cla_id=wor_cla_id');
			$this->db->join("tbl_generations","gen_id=cla_gen_id");
			$this->db->join("tbl_terms","gen_id=ter_gen_id");
			$this->db->where("stu_status",1);
			$this->db->where("ngo_status",1);
			$this->db->where("cla_status",1);
			$this->db->where("gen_status",1);
			$this->db->where("ter_status",1);
			strtolower($this->session->userdata('tea_position'))!='admin'?$this->db->where('wor_tea_id',$this->session->userdata('tea_id')):"";
			$this->db->where("gen_id",$this->session->userdata('gen_id'));
			$this->db->where("cla_id",$this->session->userdata('cla_id'));
			$this->db->where("ter_id",$this->session->userdata('ter_id'));
			$this->db->order_by('stu_first_name',"ASC");
			$data=$this->db->get();
			return $data;
		}
		//add new attendant
		function addnew(){
			$num=$this->session->userdata('num_stu');
			$date=$this->session->userdata('att_date');
			for($i=1;$i<=$num;$i++){
				if($this->input->post('att'.$i)=='1'){$att=1;$abs=0;}
				else{$att=0;$abs=1;}
				$data=array(
							'att_stu_id'=>$this->input->post('stu_id'.$i),
							'att_absent'=>$abs,
							'att_date'=>$date,
							'att_attended'=>$att,
							'att_description'=>$this->input->post('txt_attDes'.$i),
							);
				$this->db->insert('tbl_attendances',$data);
			}
			return true;
		}
		//add new attendant
		function update(){
			$num=$this->session->userdata('num_stu');
			$date=$this->session->userdata('att_date');
			for($i=1;$i<=$num;$i++){
				if($this->input->post('att'.$i)=='1'){$att=1;$abs=0;}
				else{$att=0;$abs=1;}
				$data=array(
							'att_absent'=>$abs,
							'att_attended'=>$att,
							'att_description'=>$this->input->post('txt_attDes'.$i),
							);
				$this->db->where('att_date',$date);
				$this->db->where('att_stu_id',$this->input->post('stu_id'.$i));
				$this->db->update('tbl_attendances',$data);
			}
			return true;
		}
		
		//check date for attendant
		function checkDateTerm($genId,$terId){
			$this->db->select("*");
			$this->db->from('tbl_terms');
			$this->db->where('ter_gen_id',$genId);
			$this->db->where('ter_id',$terId);
			$this->db->where('ter_status',1);
			return $this->db->get();
		}
	}
?>