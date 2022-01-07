<?php
	class Administrator_Model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}

		public function adminLogin($email, $encrypt_password){
			//Validate
			$this->db->where('email', $email);
			$this->db->where('password', $encrypt_password);
			$this->db->where('role_id', 1);

			$result = $this->db->get('users');

			if ($result->num_rows() == 1) {
				return $result->row(0);
			}else{
				return false;
			}
		}

		public function get_posts($slug = FALSE)
		{
			if($slug === FALSE){
				$query = $this->db->order_by('id', 'DESC');
				$query = $this->db->get('posts');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('posts', array('slug' => $slug));
			return $query->row_array();
		}

		public function create_post()
		{
			$slug = url_title($this->input->post('title'), "dash", TRUE);

			$data = array(
				'title' => $this->input->post('title'), 
			    'slug' => $slug,
			    'body' => $this->input->post('body'),
			    'category_id' => $this->input->post('category_id')
			    );
			return $this->db->insert('posts', $data);
		}

		public function delete($id,$table)
		{
			$this->db->where('id', $id);
			$this->db->delete($table);
			return true;
		}

		public function get_categories(){
			$this->db->order_by("id", "DESC");
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function add_user($post_image,$password)
		{
			$data = array('name' => $this->input->post('name'), 
							'email' => $this->input->post('email'),
							'password' => $password,
							'username' => $this->input->post('username'),
							'zipcode' => $this->input->post('zipcode'),
							'contact' => $this->input->post('contact'),
							'address' => $this->input->post('address'),
							'gender' => $this->input->post('gender'),
							'role_id' => '2',
							'status' => $this->input->post('status'),
							'dob' => $this->input->post('dob'),
							'image' => $post_image,
							'password' => $password,
							'register_date' => date("Y-m-d H:i:s")

						  );
			return $this->db->insert('users', $data);
		}

		public function get_users($username = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				$this->db->order_by('users.id', 'DESC');
				$query = $this->db->where('role_id', 1);
				$query = $this->db->get('users');
				
				return $query->result_array(); 
			}

			$query = $this->db->get_where('users', array('username' => $username));
		//	$query = $this->db->where('role_id', 1);

		
			return $query->row_array();
		}

		public function get_customers($username = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				$this->db->order_by('customers.id', 'DESC');
				$query = $this->db->get('customers');
				
				return $query->result_array(); 
			}

			$query = $this->db->get_where('customers', array('username' => $username));
		//	$query = $this->db->where('role_id', 1);

		
			return $query->row_array();
		}

		public function get_payments($username = FALSE, $limit = FALSE, $offset = FALSE)
		{
		
		
			if($username === FALSE){

				
			$this->db->select('customers.id,customers.name as cuname,email,plans.name as plname,created');
			$this->db->from('customers_subscriptions');
			$this->db->join('customers', 'customers.id = customers_subscriptions.cus_id');
			$this->db->order_by('customers_subscriptions.plan_period_start', 'DESC');
			$this->db->join('plans', 'plans.id = customers_subscriptions.plan_id');
			$query = $this->db->get();

		
			
				return $query->result_array(); 
			}

			$query = $this->db->get_where('customers', array('username' => $username));
		

		
			return $query->row_array();
		}

		public function get_paymentview($id)

		{
			$this->db->select('customers_subscriptions.id,customers.name as cuname,email,plans.name as plname,created,stripe_subscription_id,stripe_customer_id,plan_amount,plan_period_start,plan_period_end,customers_subscriptions.status as paystatus');
			$this->db->from('customers_subscriptions');
			$this->db->join('customers', 'customers.id = customers_subscriptions.cus_id','LEFT');
			$this->db->join('plans', 'plans.id = customers_subscriptions.plan_id');

			$this->db->where('customers.id',$id);
			
			$query = $this->db->get();

			
			return $query->result(); 
		}


		public function get_userDetails($id)
		{
			$this->db->select('customers.name as cuname,email');
			$this->db->from('customers_subscriptions');
			$this->db->join('customers', 'customers.id = customers_subscriptions.cus_id');
		
			$this->db->where('customers.id',$id);
			
			$query = $this->db->get();

			
				return $query->row(); 
		}

	

		public function get_user($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('users');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('users', array('id' => $id));
			return $query->row_array();
		}

		public function update_user_data($post_image)
		{ 
			$data = array('name' => $this->input->post('name'),
							'zipcode' => $this->input->post('zipcode'),
							'contact' => $this->input->post('contact'),
							'address' => $this->input->post('address'),
							'gender' => $this->input->post('gender'),
							'status' => $this->input->post('status'),
							'dob' => $this->input->post('dob'),
							'image' => $post_image,
							'register_date' => date("Y-m-d H:i:s")
						  );

			$this->db->where('id', $this->input->post('id'));
			$d = $this->db->update('users', $data);
		}



		// function start fron forget password

		public function email_exists(){
    $email = $this->input->post('email');
    $query = $this->db->query("SELECT email, password FROM users WHERE email='$email'");    
    if($row = $query->row()){
        return TRUE;
    }else{
        return FALSE;
    }
}
public function temp_reset_password($temp_pass){
    $data =array(
                'email' =>$this->input->post('email'),
                'reset_pass'=>$temp_pass);
                $email = $data['email'];

    if($data){
        $this->db->where('email', $email);
        $this->db->update('users', $data);  
        return TRUE;
    }else{
        return FALSE;
    }

}
public function is_temp_pass_valid($temp_pass){
    $this->db->where('reset_pass', $temp_pass);
    $query = $this->db->get('users');
    if($query->num_rows() == 1){
        return TRUE;
    }
    else return FALSE;
}

	}