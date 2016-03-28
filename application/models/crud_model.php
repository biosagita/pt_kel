<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {
	
	function where($where = '') {
		if($where != '') $this->db->where($where);
		return $this;
	}

	function where_in($fieldname = '', $where = '') {
		if($where != '' AND $fieldname != '') $this->db->where_in($fieldname, $where);
		return $this;
	}

	function where_not_in($fieldname = '', $where = '') {
		if($where != '' AND $fieldname != '') $this->db->where_not_in($fieldname, $where);
		return $this;
	}
	
	function set_limit($limit, $start = 0) {
    	$this->db->limit($limit, $start);
        return $this;
    }
	
	function order_by($field, $direction = 'asc') {
		$this->db->order_by($field, $direction);
		return $this;
	}
	
	function like($field, $keyword, $pattern = 'both') {
		$this->db->like($field, $keyword, $pattern);
		return $this;
	}
	
	function or_like($field, $keyword = '', $pattern = 'both'){
		if($keyword != '') $this->db->or_like($field, $keyword, $pattern);
		else  $this->db->or_like($field);
		return $this;
	}
	
	function group_by($group_by = ''){
		$this->db->group_by($group_by);
		return $this;
	}
	
	/* ---------------------------------------- All About Admin ------------------------- */

	//adminusers
	function get_row_adminusers(){
		return $this->db->get('adminusers')->row_array();
	}
	
	function get_all_adminusers(){
		return $this->db->get('adminusers')->result_array();
	}
	
	function posts_adminusers($data){
		return $this->db->insert('adminusers', $data);
	}
	
	function puts_adminusers($data){
		return $this->db->update('adminusers', $data);
	}
	
	function delete_adminusers($data){
		return $this->db->delete('adminusers', $data);
	}

	//adminuserlevels
	function get_row_adminuserlevels(){
		return $this->db->get('adminuserlevels')->row_array();
	}
	
	function get_all_adminuserlevels(){
		return $this->db->get('adminuserlevels')->result_array();
	}
	
	function posts_adminuserlevels($data){
		return $this->db->insert('adminuserlevels', $data);
	}
	
	function puts_adminuserlevels($data){
		return $this->db->update('adminuserlevels', $data);
	}
	
	function delete_adminuserlevels($data){
		return $this->db->delete('adminuserlevels', $data);
	}

	function get_option_adminuserlevels() {
		$res = $this->get_all_adminuserlevels();
		$data = array();
		foreach ($res as $key => $value) {
			$data[] = array(
				'name' 	=> $value['aulv_name'],
				'value' => $value['aulv_id'],
			); 
		}
		return $data;
	}

	function get_option_info_adminuserlevels() {
		$res = $this->get_all_adminuserlevels();
		$data = array();
		foreach ($res as $key => $value) {
			$data[$value['aulv_id']] = $value['aulv_name']; 
		}
		return $data;
	}

	//grouplayanan
	function get_row_grouplayanan(){
		return $this->db->get('grouplayanan')->row_array();
	}
	
	function get_all_grouplayanan(){
		return $this->db->get('grouplayanan')->result_array();
	}
	
	function posts_grouplayanan($data){
		return $this->db->insert('grouplayanan', $data);
	}
	
	function puts_grouplayanan($data){
		return $this->db->update('grouplayanan', $data);
	}
	
	function delete_grouplayanan($data){
		return $this->db->delete('grouplayanan', $data);
	}

	function get_option_grouplayanan() {
		$res = $this->get_all_grouplayanan();
		$data = array();
		foreach ($res as $key => $value) {
			$data[] = array(
				'name' 	=> $value['gly_name'],
				'value' => $value['gly_id'],
			); 
		}
		return $data;
	}

	function get_option_info_grouplayanan() {
		$res = $this->get_all_grouplayanan();
		$data = array();
		foreach ($res as $key => $value) {
			$data[$value['gly_id']] = $value['gly_name']; 
		}
		return $data;
	}

	//layanan
	function get_row_layanan(){
		return $this->db->get('layanan')->row_array();
	}
	
	function get_all_layanan(){
		return $this->db->get('layanan')->result_array();
	}
	
	function posts_layanan($data){
		return $this->db->insert('layanan', $data);
	}
	
	function puts_layanan($data){
		return $this->db->update('layanan', $data);
	}
	
	function delete_layanan($data){
		return $this->db->delete('layanan', $data);
	}

	function get_option_layanan() {
		$res = $this->get_all_layanan();
		$data = array();
		foreach ($res as $key => $value) {
			$data[] = array(
				'name' 	=> $value['lyn_name'],
				'value' => $value['lyn_id'],
			); 
		}
		return $data;
	}

	function get_option_info_layanan() {
		$res = $this->get_all_layanan();
		$data = array();
		foreach ($res as $key => $value) {
			$data[$value['lyn_id']] = $value['lyn_name']; 
		}
		return $data;
	}

	//persyaratanlayanan
	function get_row_persyaratanlayanan(){
		return $this->db->get('persyaratanlayanan')->row_array();
	}
	
	function get_all_persyaratanlayanan(){
		return $this->db->get('persyaratanlayanan')->result_array();
	}
	
	function posts_persyaratanlayanan($data){
		return $this->db->insert('persyaratanlayanan', $data);
	}
	
	function puts_persyaratanlayanan($data){
		return $this->db->update('persyaratanlayanan', $data);
	}
	
	function delete_persyaratanlayanan($data){
		return $this->db->delete('persyaratanlayanan', $data);
	}

	//berkaslayanan
	function get_row_berkaslayanan(){
		return $this->db->get('berkaslayanan')->row_array();
	}
	
	function get_all_berkaslayanan(){
		return $this->db->get('berkaslayanan')->result_array();
	}
	
	function posts_berkaslayanan($data){
		return $this->db->insert('berkaslayanan', $data);
	}
	
	function puts_berkaslayanan($data){
		return $this->db->update('berkaslayanan', $data);
	}
	
	function delete_berkaslayanan($data){
		return $this->db->delete('berkaslayanan', $data);
	}

	//userlog
	function get_row_userlog(){
		return $this->db->get('userlog')->row_array();
	}
	
	function get_all_userlog(){
		return $this->db->get('userlog')->result_array();
	}
	
	function posts_userlog($data){
		return $this->db->insert('userlog', $data);
	}
	
	function puts_userlog($data){
		return $this->db->update('userlog', $data);
	}
	
	function delete_userlog($data){
		return $this->db->delete('userlog', $data);
	}

	function log_userlog_logout($user_id) {
		$res = $this->where('usrlog_user_id = "'.$user_id.'" AND (usrlog_logout_date = "0000-00-00 00:00:00" OR usrlog_logout_date = "") AND usrlog_login_type = "backend"')->order_by('usrlog_login_date', 'DESC')->get_row_userlog();

		if(!empty($res['usrlog_log_id'])) {
			$data = array(
				'usrlog_logout_date'	=> date('Y-m-d H:i:s')
			);
			$this->where(array('usrlog_log_id' => $res['usrlog_log_id']))->puts_userlog($data);
		}
	}

	//templatesertifikat
	function get_row_templatesertifikat(){
		return $this->db->get('templatesertifikat')->row_array();
	}
	
	function get_all_templatesertifikat(){
		return $this->db->get('templatesertifikat')->result_array();
	}
	
	function posts_templatesertifikat($data){
		return $this->db->insert('templatesertifikat', $data);
	}
	
	function puts_templatesertifikat($data){
		return $this->db->update('templatesertifikat', $data);
	}
	
	function delete_templatesertifikat($data){
		return $this->db->delete('templatesertifikat', $data);
	}

	function get_option_templatesertifikat() {
		$res = $this->get_all_templatesertifikat();
		$data = array();
		foreach ($res as $key => $value) {
			$data[] = array(
				'name' 	=> $value['tpsr_name'],
				'value' => $value['tpsr_id'],
			); 
		}
		return $data;
	}

	//groupnomorsertifikat
	function get_row_groupnomorsertifikat(){
		return $this->db->get('groupnomorsertifikat')->row_array();
	}
	
	function get_all_groupnomorsertifikat(){
		return $this->db->get('groupnomorsertifikat')->result_array();
	}
	
	function posts_groupnomorsertifikat($data){
		return $this->db->insert('groupnomorsertifikat', $data);
	}
	
	function puts_groupnomorsertifikat($data){
		return $this->db->update('groupnomorsertifikat', $data);
	}
	
	function delete_groupnomorsertifikat($data){
		return $this->db->delete('groupnomorsertifikat', $data);
	}

	function get_option_groupnomorsertifikat() {
		$res = $this->get_all_groupnomorsertifikat();
		$data = array();
		foreach ($res as $key => $value) {
			$data[] = array(
				'name' 	=> $value['grno_nama'],
				'value' => $value['grno_id'],
			); 
		}
		return $data;
	}

	//daftartamu
	function get_row_daftartamu(){
		return $this->db->get('daftartamu')->row_array();
	}
	
	function get_all_daftartamu(){
		return $this->db->get('daftartamu')->result_array();
	}
	
	function posts_daftartamu($data){
		return $this->db->insert('daftartamu', $data);
	}
	
	function puts_daftartamu($data){
		return $this->db->update('daftartamu', $data);
	}
	
	function delete_daftartamu($data){
		return $this->db->delete('daftartamu', $data);
	}

	function get_daftartamu_layanan() {
		$this->db->select("daftartamu.*, lyn_name");
		$this->db->from('daftartamu');
		$this->db->join('layanan', 'dftm_lyn_id = lyn_id', 'left');

		return $this->db->get()->result_array();
	}

	//daftartamunonlayanan
	function get_row_daftartamunonlayanan(){
		return $this->db->get('daftartamunonlayanan')->row_array();
	}
	
	function get_all_daftartamunonlayanan(){
		return $this->db->get('daftartamunonlayanan')->result_array();
	}
	
	function posts_daftartamunonlayanan($data){
		return $this->db->insert('daftartamunonlayanan', $data);
	}
	
	function puts_daftartamunonlayanan($data){
		return $this->db->update('daftartamunonlayanan', $data);
	}
	
	function delete_daftartamunonlayanan($data){
		return $this->db->delete('daftartamunonlayanan', $data);
	}

	//formisian
	function get_row_formisian(){
		return $this->db->get('formisian')->row_array();
	}
	
	function get_all_formisian(){
		return $this->db->get('formisian')->result_array();
	}
	
	function posts_formisian($data){
		return $this->db->insert('formisian', $data);
	}
	
	function puts_formisian($data){
		return $this->db->update('formisian', $data);
	}
	
	function delete_formisian($data){
		return $this->db->delete('formisian', $data);
	}

	function get_nomorsertifikat_layanan() {
		$this->db->select("COUNT(*) as no_terakhir", true);
		$this->db->from('daftartamu');
		$this->db->join('layanan', 'dftm_lyn_id = lyn_id', 'left');
		$this->db->group_by('lyn_grno_id');

		return $this->db->get()->row_array();
	}

}

?>