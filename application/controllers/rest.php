<?php
/**
* 
*/
class Rest extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('uri');
		$this->load->library('pagination');
		if($this->session->userdata('logged_in') != TRUE)
		{
			redirect('login?Action=2');			
		}
	}

	public function index()
	{
		$this->load->view('includes/menu');
		$this->load->view('index');
	}
	public function user()
	{
		$data['sage'] = $this->output($this->input->get('msg'));
		$data['waiters'] = $this->restaurant->selection('waiters','w_id');
		$this->load->view('includes/menu');
		$this->load->view('user',$data);
	}
	public function waiter()
	{
		if($this->input->post('employee'))
		{
			$name = $this->input->post('name');
			if (empty($name)) {
				redirect(base_url().'rest/user?msg=3');
			}
			$data = array('name'=>$name);
		}
		$query = $this->restaurant->addition('waiters',$data);
		if ($query) {
			redirect(base_url().'rest/user?msg=1');
		}
		else {
			redirect(base_url().'rest/user?msg=2');
		}
	}
	public function udel()
	{
		$id = $this->uri->segment(3);
		$query = $this->restaurant->udel('waiters',$id,'w_id');
		if ($query) {
			redirect(base_url().'rest/user?msg=11');
		}
		else{
			redirect(base_url().'rest/user?msg=22');
		}
	}
	public function euser()
	{
		$id=$this->uri->segment(3);
		$data['emp'] = $this->restaurant->eselection('waiters','w_id',$id);
		$this->load->view('includes/menu');
		$this->load->view('euser',$data);
	}
	public function ewaiter()
	{
		if ($this->input->post('employee')) {
			$name = $this->input->post('name');
			$id = $this->input->post('id');
			if (empty($name)) {
				redirect(base_url().'rest/user?msg=3');
			}
			$data = array('name'=>$name);
		}
		$query = $this->restaurant->eupdate('waiters',$data,$id,'w_id');
		if ($query) {
			redirect(base_url().'rest/user?msg=5');
		}
		else {
			redirect(base_url().'rest/user?msg=6');
		}
	}
	//  stocks 
	public function stock()
	{
		$data['sage'] = $this->output($this->input->get('msg'));
		$config = array();
		$config['base_url'] = base_url().'rest/stock';
		$config["total_rows"] = $this->restaurant->record_count();
        $config["per_page"] = 8;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
		// $data['display']  = $this->restaurant->stock('stock',$config["per_page"], $page);
		$data['display']  = $this->restaurant->stock('stock',$config["per_page"], $page,'waiters','w_id');
		$data['item'] = $this->restaurant->selection('items');
		$data['miscitem'] = $this->restaurant->selection('miscitem');
		$data["emp"] = $this->restaurant->selection('waiters');
		$this->load->view('includes/menu');

		$this->load->view('stocks',$data);
	}
	public function addmiscq()
	{
		if ($this->input->post('miscs')) {
				$misc_name = $this->input->post('misc');
				$misc_quantity = $this->input->post('mquantity');
				$time = array(
					$h=idate("h"),
					$m=idate("i"),
					$s=idate("s"),
					);
			$time_in = implode(':',$time);
			$date = array(
					$y=idate("Y"),
					$d=idate("d"),
					$m=idate("m"),
					);
			$date_in = implode(':',$date);
			$data = array(
						'from'=>$this->input->post('from'),
						'type'=>$this->input->post('type'),
						'price'=>$this->input->post('price'),
						'payed'=>$this->input->post('payed'),
						'time'=>$time_in,
						'date'=>$date_in,
						'w_id'=>$this->input->post('by'),
						'status'=> 0,
						);
				$query = $this->restaurant->addition('stock',$data);
				$select['stock'] = $this->restaurant->eselection('stock','time',$time_in);
				$sid = $select['stock']->sid;
				$price = $select['stock']->price;
				$payed = $select['stock']->payed;
				$Remaining = $price - $payed;
				$query = $this->restaurant->iddition('product',$misc_name,$misc_quantity,$sid,'1');
				$totalquant['quant'] = $this->restaurant->oselection('product','sid',$sid);
				foreach ($totalquant['quant'] as $total) {
					$totalsuming[] = $total->itemquantity;
					$totalsum = array_sum($totalsuming);
				}
            	$query = $this->restaurant->updations('stock','sid',$sid,'existing_quantity',$totalsum);
            	$query = $this->restaurant->updations('stock','sid',$sid,'remaining',$Remaining); 
            	if ($query) {
					redirect(base_url().'rest/stock?msg=1');
				}
				else
				{
					redirect(base_url().'rest/stock?msg=2');
				}         
		}
	}
	public function addstock()
	{
		if ($this->input->post('stock')) {
			$time = array(
					$h=idate("h"),
					$m=idate("i"),
					$s=idate("s"),
					);
			$time_in = implode(':',$time);
			$date = array(
					$y=idate("Y"),
					$d=idate("d"),
					$m=idate("m"),
					);
			$date_in = implode(':',$date);

				
			$data = array(
						'from'=>$this->input->post('from'),
						'type'=>$this->input->post('type'),
						'price'=>$this->input->post('price'),
						'payed'=>$this->input->post('payed'),
						'time'=>$time_in,
						'date'=>$date_in,
						'w_id'=>$this->input->post('by'),
						'status'=> 1,
						);

				$query = $this->restaurant->addition('stock',$data);
				$item_name = $this->input->post('item');
				$item_quantity = $this->input->post('quantity');
				$select['stock'] = $this->restaurant->eselection('stock','time',$time_in);
				// misc additions
				$sid = $select['stock']->sid;
				$price = $select['stock']->price;
				$payed = $select['stock']->payed;
				$Remaining = $price - $payed;
				$query = $this->restaurant->iddition('product',$item_name,$item_quantity,$sid,'0');
				$totalquant['quant'] = $this->restaurant->oselection('product','sid',$sid);
				foreach ($totalquant['quant'] as $total) {
					$totalsuming[] = $total->itemquantity;
					$totalsum = array_sum($totalsuming);
				}
            	$query = $this->restaurant->updations('stock','sid',$sid,'existing_quantity',$totalsum);          
				// misc additions
            	$query = $this->restaurant->updations('stock','sid',$sid,'remaining',$Remaining);          
				if ($query) {
					redirect(base_url().'rest/stock?msg=1');
				}
				else
				{
					redirect(base_url().'rest/stock?msg=2');
				}
		} 
	}
	//  order starts here
	public function order()
	{
		$data['sage'] = $this->output($this->input->get('msg'));
		$data['order']  = $this->restaurant->joining('clients');
		$data['emp'] = $this->restaurant->selection('waiters');
		$data['miscitem'] = $this->restaurant->selection('miscitem');
		$data['rates'] = $this->restaurant->selection('items');
		$this->load->view('includes/menu');
		$this->load->view('order',$data);
	}
	public function addordermisc()
	{
		if ($this->input->post('reorder')) {
			$cid = $this->input->post('ssid');
			$misc_item = $this->input->post('mitem');
			$misc_quantity = $this->input->post('mquantity');
			$date = array(
					$i=idate("h"),
					$m=idate("i"),
					$y=idate("s"),
					);
			$khan = implode(':', $date);
			// Selecting data from record saved 
            $summing = $this->restaurant->eselection('clients','cid',$cid);
            $one_price = $summing->total_payment;
            // the payment saved is #one_price 
            //Now adding data to the database
			$query = $this->restaurant->aaddition('order',$misc_item,$misc_quantity,$cid,'1');
			// now selecting the price of current added items which are 
			// here the type means to differentiate between the miscs and the foood items
            $data['two'] = $this->restaurant->orderselction('order','cid',$cid,'type','1','status','0');
            if (!empty($data['two'])) {
                        foreach ($data['two'] as $current) {
                          $name = $current->items;
                          $itemsplus[] = $current->items;
                          // here the quantity is derived to remove it from the product in order to
                          // find the remainig quantities because the sold quantity will be removed from
                          // the database
                          $quantityplus[] = $current->quantity;
                          $data['selection'] = $this->restaurant->oselection('miscitem','m_id',$name);
                          foreach ($data['selection'] as $itemes) {
                          $price = $itemes->price;
                          }
                          $cut = $current->quantity;
                          $price_second[] = $price*$cut; 
                        }
            $two_price = array_sum($price_second);
                    }   
           // here we will find the second price
            $date = array(
					$y=idate("Y"),
					$d=idate("d"),
					$m=idate("m"),
					);
			$date_in = implode(':',$date);
			// here we find the current data
            $selction['id'] = $this->restaurant->outing_time('stock',$date_in,'date','0','status');	
			$stockid = $selction['id']->sid;
			$selctionofitems['data'] = $this->restaurant->oselection('product','sid',$stockid);
			if (!empty($selctionofitems['data'])) {
			foreach ($selctionofitems['data'] as $items_tobe) {
				$quantity_sub[] = $items_tobe->itemquantity;
				$productids[] = $items_tobe->id;
			}
			$countedvalues = count($quantityplus);
			for ($i=0; $i < $countedvalues ; $i++) { 
				$last = $quantityplus[$i];
				$first = $quantity_sub[$i];
				$Subtraction[] = $first-$last;
			}
			// updating each result So 
			$countedsubtractions = count($Subtraction);
			for ($i=0; $i < $countedsubtractions ; $i++) { 
				$updation = $Subtraction[$i];
				$ids = $productids[$i];
				$updations = $this->restaurant->updations('product','id',$ids,'itemquantity',$updation);
				$updations = $this->restaurant->updations('order','cid',$cid,'status','1');
			}
		}
            if (empty($one_price)) {
            	$one_price = 0;
            }
             if (empty($two_price)) {
            	$two_price = 0;
            }
            $updated_price = $one_price + $two_price;    
            //$exsiting_price = $query->total_payment;
            //$total_payment = $exsiting_price + $updated_price;  
            $query = $this->restaurant->updations('clients','cid',$cid,'total_payment',$updated_price);          
				if ($query) {
				redirect(base_url().'rest/order?msg=1');
			}
			else
			{
				redirect(base_url().'rest/order?msg=2');
			}
		}
	}
	public function addorder()
	{
		if ($this->input->post('order')) {
			$date = array(
					$i=idate("h"),
					$m=idate("i"),
					$y=idate("s"),
					);
			$khan = implode(':', $date);
			$date = array(
					$y=idate("Y"),
					$d=idate("d"),
					$m=idate("m"),
					);
			$date_in = implode(':',$date);
			
			$quantity_get = $this->input->post('quantity');
			// $quantity = implode(':',$quantity_get);
			$item_get= $this->input->post('item');
			// $item = implode(':',$item_get);
			$cname = $this->input->post('name');
			$data = array(
					'table_no'=>$this->input->post('table'),
					'cname'=>$cname,
					'w_id'=>$this->input->post('serve'),
					'order_time'=>$khan,
					'recieved'=>$this->input->post('recieved'),
					);
			$query = $this->restaurant->addition('clients',$data);
			$time = $this->restaurant->outing_time('clients',$cname,'cname',$khan,'order_time');
			$clientid = $time->cid;
			$query = $this->restaurant->aaddition('order',$item_get,$quantity_get,$clientid,'0');	
			$data['querying'] = $this->restaurant->oselection('order','cid',$clientid);
            if (!empty($data['querying'])) {
                        foreach ($data['querying'] as $current) {
                          $name = $current->items;
                          $itemsplus[] = $current->items;
                          $quantityplus[] = $current->quantity;
                          $data['double'] = $this->restaurant->oselection('items','id',$name);
                          foreach ($data['double'] as $itemes) {
                          $price = $itemes->item_price;
                          }
                          $cut = $current->quantity;
                          $price_second[] = $price*$cut; 
                        }
            		$updated = array_sum($price_second);
            }
			$selctionofproduct = $this->restaurant->outing_time('stock',$date_in,'date','1','status');	
			$stockid = $selctionofproduct->sid;
			$selctionofitems = $this->restaurant->oselection('product','sid',$stockid);
			foreach ($selctionofitems as $items_tobe) {
				$quantity_sub[] = $items_tobe->itemquantity;
				$productids[] = $items_tobe->id;
			}
			$countedvalues = count($quantityplus);
			for ($i=0; $i < $countedvalues ; $i++) { 
				$last = $quantityplus[$i];
				$first = $quantity_sub[$i];
				$Subtraction[] = $first-$last;
			}
			$countedsubtractions = count($Subtraction);
			for ($i=0; $i < $countedsubtractions ; $i++) { 
				$updation = $Subtraction[$i];
				$ids = $productids[$i];
				$updations = $this->restaurant->updations('product','id',$ids,'itemquantity',$updation);
				$updations = $this->restaurant->updations('order','cid',$clientid,'status','1');
			}
            $updated_price = $updated;    
            $query = $this->restaurant->updations('clients','cid',$clientid,'total_payment',$updated_price); 
			if ($query) {
				redirect(base_url().'rest/order?msg=1');
			}
			else
			{
				redirect(base_url().'rest/order?msg=2');
			}
		}
	}
	public function eorder()
	{
		if ($this->input->post('details')) {
			$one_price = 0;
			$two_price = 0;
			$data = array(
					'items' => $this->input->post('it'),
					'quantity' => $this->input->post('quant'),
					'cid' => $this->input->post('oid'),
					'status' => 0,
					);
			$query = $this->restaurant->addition('order',$data);	
			$cid = $this->input->post('oid');
			$data['one'] = $this->restaurant->orderselction('order','cid',$cid,'type','0','status','0');
            foreach ($data['one'] as $current) {
              $name = $current->items;
              $quantityplus = $current->quantity;
              $data['selction'] = $this->restaurant->oselection('items','id',$name);
              foreach ($data['selction'] as $items) {
              $price = $items->item_price;
              }
              $quat = $current->quantity;
              $price_first[] = $price*$quat; 
            }  
             $one_price = array_sum($price_first);
            $summing = $this->restaurant->eselection('clients','cid',$cid);
            $two_price = $summing->total_payment;
            $itemtoberemoved = $this->input->post('it');
            $quantityOfTheItem = $this->input->post('quant');
            $date = array(
			  $y=idate("Y"),
			  $d=idate("d"),
			  $m=idate("m"),
			  );
			$date_in = implode(':',$date);
            $selction['id'] = $this->restaurant->outing_time('stock',$date_in,'date','0','status');
			$stockid = $selction['id']->sid;
			$selctionofitems['data'] = $this->restaurant->oselection('product','itemname',$itemtoberemoved);
				if (!empty($selctionofitems['data'])) {
				foreach ($selctionofitems['data'] as $items_tobe) {
					 $firstquantity = $items_tobe->itemquantity;
					 $IdOfTheItem = $items_tobe->id;
				}
					$resultOfremovingQuantity = $firstquantity - $quantityOfTheItem; 
					$updations = $this->restaurant->updations('product','id',$IdOfTheItem,'itemquantity',$resultOfremovingQuantity);
					$updations = $this->restaurant->updations('order','cid',$cid,'status','1');
				}
            if (empty($one_price)) {
            	$one_price = 0;
            }
             if (empty($two_price)) {
            	$two_price = 0;
            }
            $updated_price = $one_price + $two_price;   
            $query = $this->restaurant->updations('clients','cid',$cid,'total_payment',$updated_price);
			if ($query) {
				redirect(base_url().'rest/order?msg=1');
			}
			else{
				redirect(base_url().'rest/order?msg=2');
			}
		}
	}
	// Payment to be done
	public function paid()
	{
		if ($this->input->get('ID')) {
			$id = $this->input->get('ID');
			$dates = date("Y-d-m");
			$date = $this->restaurant->eselection('total','date',$dates);
			if (!empty($date)) {
			$find = $date->date;
			if ($find == $dates) {
			}
			}
			else{
				$data = array(
						'date' => $dates,
						);
				$query = $this->restaurant->addition('total',$data);
			}
			$selction = $this->restaurant->eselection('clients','cid',$id);
			$payment = $selction->total_payment;
			$query= $this->restaurant->updations('clients','cid',$id,'recieved','1');
			$existPayment = $this->restaurant->selection('total');
			foreach ($existPayment as $totalMoney) {
				$foundTotal = $totalMoney->total;
				$id = $totalMoney->tid;           
				 }
				$updateTotal = $foundTotal + $payment;
				$uopdatedata = array('total'=>$updateTotal,);
				$query = $this->restaurant->eupdate('total',$uopdatedata,$id,'tid');
			if ($query) 
			{
				redirect(base_url().'rest/order?msg=7','refresh');
			}
			else
			{
				redirect(base_url().'rest/order?msg=8','refresh');
			}
		}
	}
	// Admin starts here
	public function admin()
	{
		$data['emp'] = $this->restaurant->Joined('use_status');
		$this->load->view('includes/menu');
		$this->load->view('admin',$data);

	}
	public function admin_add()
	{
		if ($this->input->post('admin')) {
			$data =	array(
				'name' => $this->input->post('username'),
				'password' =>md5($this->input->post('password')),
				);
		}
		$query = $this->restaurant->addition('user',$data);
		if ($query) {
			redirect(base_url().'rest/admin?msg=1');
		}
		else
		{
			redirect(base_url().'rest/admin?msg=2');
		}
		
	}
	public function rates()
	{
		$data['rate'] = $this->restaurant->selection('rates');
		$this->load->view('includes/menu');
		$this->load->view('rates',$data);
	}
	public function add_rates()
	{
		if ($this->input->post('Rates')) {
			$data =	array(
				'rname' => $this->input->post('name'),
				'rquantity' => $this->input->post('quantity'),
				'rprice' =>$this->input->post('price'),
				);
		}
		$query = $this->restaurant->addition('rates',$data);
		if ($query) {
			redirect(base_url().'rest/rates?msg=1');
		}
		else
		{
			redirect(base_url().'rest/rates?msg=2');
		}
	}
	// items adding deletion updation insertion starts here
	public function items()
	{
		$data['sage'] = $this->output($this->input->get('msg'));
		$data['items'] = $this->restaurant->selection('items');
		$this->load->view('includes/menu');
		$this->load->view('items',$data);
	}
	public function additems()
	{
		if($this->input->post('item'))
		{
			$name = $this->input->post('name');
			if (empty($name)) {
				redirect(base_url().'rest/items?msg=3');
			}
			$data = array('item_name'=>$name,'item_price'=>$this->input->post('price'));
		}
		$query = $this->restaurant->addition('items',$data);
		if ($query) {
			redirect(base_url().'rest/items?msg=1');
		}
		else {
			redirect(base_url().'rest/items?msg=2');
		}
	}
	public function eitem()
	{
		$id=$this->uri->segment(3);
		$data['items'] = $this->restaurant->eselection('items','id',$id);
		$this->load->view('includes/menu');
		$this->load->view('eitems',$data);
	}
	public function uitem()
	{
		$id = $this->uri->segment(3);
		$query = $this->restaurant->udel('items',$id,'id');
		if ($query) {
			redirect(base_url().'rest/items?msg=1');
		}
		else{
			redirect(base_url().'rest/items?msg=2');
		}
	}
	public function updateitem()
	{
		if ($this->input->post('upitem')) {
			$id = $this->input->post('id');
			$data = array(
					'item_name' =>$this->input->post('name'),
					'item_price' =>$this->input->post('price'),
					);
			$query = $this->restaurant->eupdate('items',$data,$id,'id');
			if ($query) {
			redirect(base_url().'rest/items?msg=1');
			}
			else{
				redirect(base_url().'rest/items?msg=2');
			}
		}
	}
	//  Ends Item & Types Here
	// items adding deletion updation insertion starts here
	public function misc()
	{
		$data['sage'] = $this->output($this->input->get('msg'));
		$data['misc'] = $this->restaurant->selection('miscitem');
		$this->load->view('includes/menu');
		$this->load->view('misc',$data);
	}
	public function addmisc()
	{
		if($this->input->post('itema'))
		{
			$name = $this->input->post('name');
			if (empty($name)) {
				redirect(base_url().'rest/misc?msg=3');
			}
			$data = array('item'=>$name,'price'=>$this->input->post('price'));
		}
		$query = $this->restaurant->addition('miscitem',$data);
		if ($query) {
			redirect(base_url().'rest/misc?msg=11');
		}
		else {
			redirect(base_url().'rest/misc?msg=22');
		}
	}
	public function emisc()
	{
		$id=$this->uri->segment(3);
		$data['misc'] = $this->restaurant->eselection('miscitem','m_id',$id);
		$this->load->view('includes/menu');
		$this->load->view('emisc',$data);
	}
	public function umisc()
	{
		$id = $this->uri->segment(3);
		$query = $this->restaurant->udel('miscitem',$id,'m_id');
		if ($query) {
			redirect(base_url().'rest/misc?msg=11');
		}
		else{
			redirect(base_url().'rest/misc?msg=22');
		}
	}
	public function updatemisc()
	{
		if ($this->input->post('upitem')) {
			$id = $this->input->post('id');
			$data = array(
					'item' =>$this->input->post('name'),
					'price' =>$this->input->post('price'),
					);
			$query = $this->restaurant->eupdate('miscitem',$data,$id,'m_id');
			if ($query) {
			redirect(base_url().'rest/misc?msg=5');
			}
			else{
				redirect(base_url().'rest/misc?msg=6');
			}
		}
	}
	public function output($List)
	{
		if ($List==1) {
			$value = "Added Successfully";
			return $value;
		}
		elseif ($List==2) {
			$value = "Addition Failed";
			return $value;
		}
		elseif ($List==3) {
			$value = "Please Fill The Field";
			return $value;
		}
		elseif ($List==5) {
			$value = "Changes Saved";
			return $value;
		}
		elseif ($List==6) {
			$value = "Changes Saving Failed";
			return $value;
		}
		elseif ($List==11) {
			$value = "Deletion Successful";
			return $value;
		}
		elseif ($List==7) {
			$value = "Payment Successful";
			return $value;
		}
		elseif ($List==8) {
			$value = "Payment Receiving Failed";
			return $value;
		}
		elseif ($List==22) {
			$value = "Deletion Failed";
			return $value;
		}
	}
	public function sales()
	{
		$date = array(
					$y=idate("Y"),
					$d=idate("d"),
					$m=idate("m"),
					);
		$date_in = implode(':',$date);
		$data['sale'] = $this->restaurant->eselection('total','date',$date_in);
		$data['sold'] = $this->restaurant->selection('total');
		$this->load->view('includes/menu');
		$this->load->view('sale',$data);
	}
}
?>