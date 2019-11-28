
Class Review_model extends CI_Model
{
    private $_limit;
    private $_pageNumber;
    private $_offset;

--------------------------------------    
public function view_reviewcard_review(){
  $session_data = $this->session->userdata('logged_in');
  $id = $session_data['a_id'];
  $records = $session_data['type'];
  $type = $session_data['type'];
  $this->load->model('Admin_model');
  $username = $session_data['a_username'];
  $val= $this->Admin_model->fetch_image($username);
  $name=$this->Admin_model->fetch_name($username);
  $this->load->database();

  $this->load->model('Review_model');
  $total_rows = $this->Review_model->getReviewCount();
  $config['total_rows'] = $total_rows->totalCount;
  $data['total_count'] = $config['total_rows'];
  $config['suffix'] = '';
  if($type=="super"||$type=="tech executive"||$type=="csd manager"||$type=="ovp manager"||$type=="csd executive"||$type=="csd manager"||$type=="admin"||$type=="ovp executive"){


  if($config['total_rows'] > 0){
    $page_number = $this->uri->segment(3);
    if($page_number > 0) {
      $config['base_url'] = base_url() . 'home/view_reviewcard_review';
    } else {
      $config['base_url'] = base_url() . 'home/view_reviewcard_review/';
    }
    if (empty($page_number))
    $page_number = 1;
    //print_r($page_number); exit;
    $offset1 = ($page_number - 1) * $this->pagination->per_page;
    $offset = $page_number;
    $this->Review_model->setPageNumber($this->pagination->per_page);
    $this->Review_model->setOffset($offset1);
    $this->pagination->cur_page = $offset;
    //print_r($offset); exit;
    $config['attributes'] = array('class' => 'page-link');
    $this->pagination->initialize($config);
    $page_links = $this->pagination->create_links();
    $record = $this->Review_model->getReviewGuestName();

  }

  $hotels = $this->Review_model->getHotels();

  //$record=$this->Review_model->getReviewGuestName();
} else {
  if($config['total_rows'] > 0){
    $page_number = $this->uri->segment(3);
    if($page_number > 0) {
      $config['base_url'] = base_url() . 'home/view_reviewcard_review';
    } else {
      $config['base_url'] = base_url() . 'home/view_reviewcard_review/';
    }
    if (empty($page_number))
    $page_number = 1;
    //print_r($page_number); exit;
    $offset1 = ($page_number - 1) * $this->pagination->per_page;
    $offset = $page_number;
    $this->Review_model->setPageNumber($this->pagination->per_page);
    $this->Review_model->setOffset($offset1);
    $this->pagination->cur_page = $offset;
    //print_r($offset); exit;
    $config['attributes'] = array('class' => 'page-link');
    $this->pagination->initialize($config);
    $page_links = $this->pagination->create_links();
    $record=$this->Review_model->getReviewExecutive($id,$type);
  }
  $hotels=$this->Review_model->getHotelsExecutive($id,$type);

  //print_r($record); exit;
}
  $this->load->view('super/header',compact('records','val','name'));
  $this->load->view('super/dashboard_header',compact('records','val','name'));
  $this->load->view('super/menu',compact('records','val','name'));
  $this->load->view('super/manage_reviewcard_view',compact('hotels','record', 'page_links'));
  $this->load->view('super/footer');

}

----------------------------------------------------
public function setLimit($limit) {
  $this->_limit = $limit;
}
public function setPageNumber($pageNumber) {
  $this->_pageNumber = $pageNumber;
}
public function setOffset($offset) {
  $this->_offset = $offset;
}
