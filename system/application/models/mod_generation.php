<?php
	class Mod_generation extends Model{
		function Mod_generation(){
			parent::Model();
		}
		//get ngo
		function getGen($num, $uri3){
			$this->db->select('*');
			$this->db->from('tbl_generations');
			$this->db->join("tbl_terms","gen_id=ter_gen_id");
			//if user search
			$this->input->post("txt_search1")==true?$this->db->like('gen_year',trim($this->input->post("txt_search1"))):"";
			$this->db->where('gen_id > ',0);
			$this->db->where('gen_status',1);
			$this->db->order_by("gen_year", "DESC"); 
			$this->db->group_by('gen_id');
			$this->db->limit($num, $uri3);
			return $this->db->get();
		}
		
		//get all ngo which use for pagenation
		function getNum(){
			$this->db->select('*');
			$this->db->from('tbl_generations');
			$this->db->join("tbl_terms","gen_id=ter_gen_id");
			//if user search
			$this->input->post("txt_search1")==true?$this->db->like('gen_year',trim($this->input->post("txt_search1"))):"";
			$this->db->where('gen_id > ',0);
			$this->db->where('gen_status',1);
			$this->db->group_by('gen_id');
			return $this->db->get()->num_rows();
		}
		
		//add new ngo
		function addnew(){
			if($this->dataexist("tbl_generations","gen_year",$this->session->userdata('gen_year'))) return false;
			else{
				$num=$this->session->userdata('gen_numterm');
				$data=array(
							'gen_year'=>$this->session->userdata('gen_year'),
							'gen_description'=>$this->session->userdata('gen_des'),
							);
				if($this->db->insert("tbl_generations",$data)) {
					$cur_id=$this->db->insert_id();
					for($i=1;$i<=$num;$i++){
						$data=array(
									'ter_gen_id'=>$cur_id,
									'ter_start_date'=>$this->input->post("txt_terSDate".$i),
									'ter_end_date'=>$this->input->post("txt_terEDate".$i),
									'ter_name'=>'Term '.$i,
									);
						if($this->db->insert("tbl_terms",$data)){
							continue;
						}
						else{
							//delete data if error occur
							$this->db->where('get_id',$cur_id);
							$this->db->delete('tbl_generations');
							return false;
						}
					}
					return true;
				}
			}
		}
		//get term
		function getTerm($where){
			$this->db->select("*");
			$this->db->where("ter_gen_id",$where);
			$this->db->where('ter_status',1);
			$this->db->from("tbl_terms");
			return $this->db->get();
		}
		//get one term
		function getOneTerm($where){
			$this->db->select("*");
			$this->db->where("ter_id",$where);
			$this->db->from("tbl_terms");
			return $this->db->get();
		}
		//edit term
		function editTerm($where){
			if(trim($this->input->post("txt_tersdate"))=="" || trim($this->input->post("txt_teredate"))=="") return false;
			$this->db->where('ter_gen_id',$this->session->userdata('gen_id'));
			$this->db->where('ter_status',1);
			$this->db->order_by('ter_id','ASC');
			//if date exist
			$data=$this->db->get('tbl_terms');
			$num=$data->num_rows();
			$i=0;
			$t=0;
			foreach($data->result() as $row){
				$i++;
				$terms[$i]=$row->ter_id;
				$sDate[$i]=$row->ter_start_date;
				$eDate[$i]=$row->ter_end_date;
				//if term 1
				if($terms[$i]==$where && $i==1){
					$t=1;
					continue;
				}
				//if term 2, 3, 4, 5, ...
				else if($terms[$i]==$where && $i>1) {
					$t=2;
					continue;
				}
				if ($t==1 || $t==2){
					break;
				}
			}
			$can=false;//can not update
			if($t==1 && $num>1){// if it is the first
				if(strtotime($sDate[$i])*1000 >= strtotime($this->input->post("txt_teredate"))*1000){//can update
						$can=true;
				}
			}else if($num==1) {// if it is only one
				$can=true;
			}else if($t==2 && $num==$i){//if it is the last
				//echo $eDate[$i-1].'/'.$this->input->post("txt_tersdate").'<br />';
				if(strtotime($eDate[$i-1])*1000<= strtotime($this->input->post("txt_tersdate"))*1000){
					$can=true;
				}
			}else if($t==2 && $i<$num){//if it is in the middle
				if(strtotime($eDate[$i-2])*1000<= strtotime($this->input->post("txt_tersdate"))*1000 && strtotime($sDate[$i])*1000 >= strtotime($this->input->post("txt_teredate"))*1000){
					$can=true;
				}
			}
			if($can==true){
				$data=array(
							'ter_start_date'=>$this->input->post("txt_tersdate"),
							'ter_end_date'=>$this->input->post("txt_teredate"),
							//'ter_name'=>$this->input->post("txt_tername"),
							);
				$this->db->where('ter_id',$where);
				if($this->db->update('tbl_terms',$data)) return true;
			}
			else {
				//echo $t.'/'.$num.'/'.$i;die();
				$this->session->set_userdata("ms_error","Can not update to that day. This period will we esist in another term. Please try other days!");
				return false;
			}
		}
		//add new term
		function addTerm($ter_id,$genId){
			//get all term in one generation
			$this->db->where('ter_status',1);
			$this->db->where('ter_gen_id',$genId);
			$num=$this->db->get('tbl_terms')->num_rows();
			$this->db->where('ter_gen_id',$genId);
			$this->db->where('ter_id',$ter_id);
			$this->db->where('ter_status',1);
			$this->db->where('ter_end_date >=',$this->input->post('txt_tersdate'));
			$data=$this->db->get('tbl_terms');
			if($data->num_rows()>0){
				$this->session->set_userdata("ms_error","Can not update to that day. This period will we esist in another term. Please try other days!");
				return false;
			}else{
				$data=array(
						'ter_start_date'=>$this->input->post("txt_tersdate"),
						'ter_end_date'=>$this->input->post("txt_teredate"),
						'ter_gen_id'=>$genId,
						'ter_name'=>"Term ".($num+1),
						);
					if($this->db->insert('tbl_terms',$data)) return true;
					else return false;
			}
			/*foreach($data->result() as $row){
				if(strtotime($row->ter_end_date)*1000 <= strtotime($this->input->post('txt_tersdate'))*1000){
					$data=array(
						'ter_start_date'=>$this->input->post("txt_tersdate"),
						'ter_end_date'=>$this->input->post("txt_teredate"),
						'ter_gen_id'=>$genId,
						'ter_name'=>$this->input->post("txt_tername"),
						);
					if($this->db->insert('tbl_terms',$data)) return true;
					else return false;
				}else return false;
			}*/
			
		}
		//delete term
		function deleteTerm($where){
			$data=array(
						'ter_status'=>0
						);
			$this->db->where('ter_id',$where);
			if($this->db->update('tbl_terms',$data)) return true;
			else return false;
		}
		//get ngo
		function getOneGen($where=""){
			$this->db->select("*");
			$this->db->where("gen_id",$where);
			$this->db->from("tbl_generations");
			return $this->db->get();
		}
		
		//update ngo
		function update($where){
			if($this->dataexist("tbl_generations","gen_year",$this->input->post("txt_genyear"))) return false;
			else{
				$data=array(
							'gen_year'=>$this->input->post("txt_genyear"),
							'gen_description'=>$this->input->post("txt_gendes"),
							);
				
				$this->db->where("gen_id",$where);
				if($this->db->update("tbl_generations",$data))return true;
			}
		}
		
		//function delete
		function delete($con){
			$data=array(
						'gen_status'=>0
						);
			$this->db->where("gen_id",$con);
			if($this->db->update("tbl_generations",$data))return true;
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
						if($row->gen_id==$this->session->userdata("condition")) return false;
					}
				}
				$this->session->set_userdata("ms_error","Data Exist!"); 
				return true;
			}
			else return false;
		}
	}