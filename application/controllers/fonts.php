<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fonts extends CI_Controller {



	
		public function __construct(){
		    parent::__construct();
		    
				$this->name = $this->input->post('name');
				$this->code = $this->input->post('code');
				$this->font_id = $this->input->post('font_id');
				$this->table = 'fonts';				    
		    
		}
		
		

		/**
		 * add or update fonts
		 *
		 * {@source }
		 * @package BackEnd
		 * @author James Ming <jamesming@gmail.com>
		 * @path /index.php/fonts/add_update_fonts
		 * @access public
		 **/ 

		public function add_update_fonts(){
		
			/**
			 * Set up the table and the fields
			 *
			 **/ 
		
			$fields_array = array(
			                        'id' => array(
			                                                 'type' => 'INT',
			                                                 'unsigned' => TRUE,
			                                                 'auto_increment' => TRUE
			                                      ),
		
			                        'created' => array(
			                                                 'type' => 'DATETIME'
			                                        ),
			                        'updated' => array(
			                                                 'type' => 'DATETIME'
			                                        )  
			                );
			                
			$primary_key = 'id';
			
			$this->my_database_model->create_table_with_fields(
				$this->table, 
				$primary_key, 
				$fields_array
			);
			
			
			$fields_array = array(
			                        'name' => array(
			                                                 'type' => 'varchar(255)'
			                                      ),
			                        'code' => array(
			                                                 'type' => 'LONGBLOB'
			                                      )
			                );
			
			$this->my_database_model->add_column_to_table_if_exist($this->table, $fields_array);
			
			
		/**
			 * Insert into table if not already exist otherwise do an update
			 *
			 **/ 
			 
		  $where_array = array(
		  	'name' => $this->name
		  );

			
			
			$this->my_database_model->check_if_exist($where_array, $this->table);
			
		
		  if( $this->my_database_model->check_if_exist($where_array, $this->table) ){
		  		
		
					$primary_key = $this->my_database_model->get_primary_key_from_where_array( $where_array, $this->table);
		     
					$set_what_array = array(
											'code' => $this->code
											);			
									
					$this->my_database_model->update_table( $this->table, $primary_key, $set_what_array );
		
		
		     
		  }else{
		      
		      
					$insert_what = array(
								'name' => $this->name,
								'code' => $this->code
								);	
					
					$primary_key = $this->my_database_model->insert_table(
													$this->table, 
													$insert_what
													); 
													
													
		      
		  };
		  
		  
		  $this->form();
		  
		}  /** END ADD_UPDATE FUNCTION **/
		

		/**
		 * get fonts
		 *
		 * {@source }
		 * @package BackEnd
		 * @author James Ming <jamesming@gmail.com>
		 * @path /index.php/crud_fonts/form
		 * @access public
		 **/ 

		public function form(){
		
		$select_what =  '*';
		
		$where_array = array();

		$fonts = $this->my_database_model->select_from_table( $table = $this->table, $select_what, $where_array, $use_order = TRUE, $order_field = 'created', $order_direction = 'desc', $limit = -1);


		$this->load->view('fonts/form_view', array( 'fonts' => $fonts ));
			
		}

	/**
	 * delete_font based on its id
	 *
	 * This is called from a Jquery ajax post
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/crud_fonts/delete_font
	 * @uses My_database_model::delete_from_table()
	 * @access public
	 * */
	 
		function delete_font(){
			
			$where_array = array('id' => $this->font_id );
						
			$this->my_database_model->delete_from_table( $this->table, $where_array);
			
		}




}

/* End of file crud_fonts.php */
/* Location: ./application/controllers/crud_fonts.php */