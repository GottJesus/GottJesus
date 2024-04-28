<?php
/**
*	Den 1.04.2024
*/

class Customer extends Controller {

	
	
	public function index(){
		
		$customer = new CustomerModel;
		
		
		
		echo'This is the Customer controller';
		
		$this->view('customer');
		
	}
}
?>