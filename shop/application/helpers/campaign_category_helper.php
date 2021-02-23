<?php
function campaign_category($limit) {
    $CI = &get_instance();
    $CI->load->model('category_model', 'Category');
    
    $categories = $CI->Category->result(array('conditions' => array('is_active' => 1), 'order' => array('sort_order' => "ASC"),'limit'=>$limit));
//    pr($categories);
//    exit();
    return $categories;
}

function successful_camp() {
   $CI = &get_instance();

    $CI->db->select('*');
       $CI->db->from('fmp_projects camp'); 
       $CI->db->where('camp.status','completed');        
       $query = $CI->db->get();
       $success_camp = $query->num_rows();

       return $success_camp;
    }
function fund_amount() {
   $CI = &get_instance();
   
   $CI->db->select_sum('collected_amount');
   //$CI->db->from('fmp_projects');        
   $query = $CI->db->get('fmp_projects');
   $funded_amount = $query->row()->collected_amount;

   return $funded_amount;
}
?>
