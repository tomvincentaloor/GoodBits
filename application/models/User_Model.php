<?php
	class User_Model extends CI_Model{
		public function register($encrypt_password){

			$data = array('name' => $this->input->post('name'), 
						  'email' => $this->input->post('email'),
						  'password' => $encrypt_password,
						  'username' => $this->input->post('username'),
						  'zipcode' => $this->input->post('zipcode')
						  );

			return $this->db->insert('customers', $data);
		}

		public function login($username, $encrypt_password){
			//Validate
			$this->db->where('username', $username);
			$this->db->where('password', $encrypt_password);

			$result = $this->db->get('customers');

			if ($result->num_rows() == 1) {
				return $result->row(0);
			}else{
				return false;
			}
		}

		// Check Username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('customers', array('username' => $username));

			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('customers', array('email' => $email));

			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		public function packDetails(){

			$this->db->select('*');
			$this->db->from('plans');
			$this->db->where('status', 1);
			
			$query = $this->db->get();

			return $query->result(); 

		}

		public function add_package_data(){

			$packageid= $this->input->post('packageid');

			$this->db->select('*');
			$this->db->from('plans');
			$this->db->where('id', $packageid);
			$packDetails = $this->db->get()->row();
			
			$strexpiry = date('Y/m/d H:i:s', strtotime('+' . $packDetails->intervalduration . ' days', strtotime(date("Y/m/d H:i:s"))));
	
			$data = array(
				'cus_id' => $this->session->userdata('user_id'),
				'plan_id' => $packageid	,
				'plan_amount' => $packDetails->price,
				'plan_amount_currency' => 'INR',
				'plan_period_start' =>  date('Y/m/d H:i:s'),
				'plan_period_end' => $strexpiry,
				'created' => date('Y/m/d H:i:s'),
				'status' => 0,
			    );
			 $this->db->insert('customers_subscriptions', $data);
			 return $this->db->insert_id();
		}

		public function paidData($insertId){

			$this->db->select('plan_amount,plan_amount_currency');
			$this->db->from('customers_subscriptions');
			$this->db->where('id', $insertId);
			
			$query = $this->db->get();

			return $query->row(); 

		}
	}