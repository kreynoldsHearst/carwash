<?php

/*
 * Replicates WP post tables for anything ya want.
 */

if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Rich_Reviews_Table extends WP_List_Table {
	var $flag = 'all';

	function _construct() {
		global $status, $page;
		parent::__construct( array(
			'singular'  => 'review',
			'plural'    => 'reviews',
			'ajax'      => false
		));
	}

	function column_default($item, $column_name){
		return print_r($item,true); //Show the whole array for troubleshooting purposes
	}
	function column_id($item){
		$actions = array(
			'edit' => sprintf('<a href="?page=%s&action=%s&review=%s">Edit</a>',$_REQUEST['page'],'pending',$item->id),
			'delete' => sprintf('<a href="?page=%s&action=%s&review=%s">Delete</a>',$_REQUEST['page'],'delete',$item->id),
		);
		return sprintf('%1$s%2$s',$item->id,$this->row_actions($actions));
	}
	function column_date_time($item) {
		return $item->date_time;
	}
	function column_reviewer_name($item) {
		return $item->reviewer_name;
	}
	function column_reviewer_email($item) {
		return $item->reviewer_email;
	}
	function column_review_title($item) {
		return $item->review_title;
	}
	function column_review_rating($item) {
		return $item->review_rating;
	}
	function column_review_text($item) {
		$output = $item->review_text;
		$output = '<span class="rr_review_text">' . $output . '</span>';
		return $output;
	}
	function column_review_status($item) {
		return $item->review_status;
	}
	function column_reviewer_ip($item) {
		return $item->reviewer_ip;
	}
	function column_post_id($item) {
		return $item->post_id;
	}
	function column_review_category($item) {
		return $item->review_category;
	}
	function column_cb($item){
		return sprintf('<input type="checkbox" name="review[]" value="%1$s" />',$item->id);
	}

	function column_edit($item){
		return sprintf('<a href="/wp-admin/admin.php?page=fp_admin_add_edit&rr_id=' . $item->id . '"><span class="button rr-button">Edit</span></a>',$item->id);
	}

	function get_columns() {
		return $columns = array(
			'cb'        		  => '<input type="checkbox" />',
			//'id'              => 'ID',
			'date_time'       => 'Date',
			'reviewer_name'   => 'Name',
			'reviewer_email'  => 'Email',
			'review_title'    => 'Title',
			'review_rating'   => 'Rating',
			'review_text'     => 'Text',
			//'review_status'   => 'Status',
			//'reviewer_ip'     => 'IP',
			'post_id'         => 'Page ID',
			'review_category' => 'Category',
			'edit'            => 'Edit',
		);
	}

	function get_sortable_columns() {
		return $sortable = array(
			//'id'              => array('id',false),
			'date_time'       => array('date_time',false),
			'reviewer_name'   => array('reviewer_name',false),
			//'reviewer_email'  => array('reviewer_email',false),
			//'review_title'    => array('review_title',false),
			'review_rating'   => array('review_rating',false),
			//'review_text'     => array('review_text',false),
			//'review_status'   => array('review_status',false),
			//'reviewer_ip'     => array('reviewer_ip',false),
			'post_id'         => array('post_id',false),
			'review_category' => array('review_category',false)
		);
	}

	function get_bulk_actions() {
		$actions = array();
		if ($this->flag == 'all' || $this->flag == 'approved') {
			$actions['pending'] = 'Set to Pending';
		}
		if ($this->flag == 'all' || $this->flag == 'pending') {
			$actions['approve'] = 'Approve';
		}
		$actions['delete'] = 'Delete';
		return $actions;
	}

	function process_bulk_action() {
		global $wpdb, $richReviews;
		$output = '';
		if (isset($_REQUEST['review'])) {
			$ids = is_array($_REQUEST['review']) ? $_REQUEST['review'] : array($_REQUEST['review']);
			$this_action = '';
			if ('approve' === $this->current_action()) {
				$this_action = 'approve';
				$action_alert_type = 'approved';
			} else if ('pending' === $this->current_action()) {
				$this_action = 'pending';
				$action_alert_type = 'set to pending';
			} else if ('delete' === $this->current_action()) {
				$this_action = 'delete';
				$action_alert_type = 'deleted';
			} else if (false === $this->current_action()) {
				$this_action = 'false';
				$action_alert_type = 'false';
			}
			if (!empty($ids)) {
				foreach ($ids as $id) {
					$output .= $id . ' ';
					switch ($this_action) {
						case 'approve':
							$wpdb->update($richReviews->sqltable, array('review_status' => '1'), array('id' => $id));
							break;
						case 'pending':
							$wpdb->update($richReviews->sqltable, array('review_status' => '0'), array('id' => $id));
							break;
						case 'delete':
							$wpdb->query("DELETE FROM $richReviews->sqltable WHERE id=\"$id\"");
							break;
					}
				}
				if (count($ids) == 1) {
					$action_alert = '1 review has been successfully ' . $action_alert_type . '.';
				} else {
					$action_alert = count($ids) . ' reviews have been successfully ' . $action_alert_type . '.';
				}
				if ($this_action === 'false') { 
					$action_alert = 'You must select an action.';
				}
				echo '<div class="updated" style="padding: 10px;">' . $action_alert . '</div>';
			}
		}
	}

	function prepare_items($flag = 'pending') {
		$this->flag = $flag;
		global $wpdb, $richReviews;
		//$page = (isset($_GET['page'])) ? esc_attr($_GET['page']) : false;
		$per_page = 10;
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->process_bulk_action();
		$whereStatement = ($this->flag == 'approved') ? ' WHERE review_status="1"' : ' WHERE review_status="0"';
		$orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'id';
		$order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';
		$orderStatement = ' ORDER BY ' . $orderby . ' ' . $order;
		$data = $wpdb->get_results("SELECT * FROM " . $richReviews->db->sqltable . $whereStatement . $orderStatement);
		$current_page = $this->get_pagenum();
		$total_items = count($data);
		$data = array_slice($data,(($current_page-1)*$per_page),$per_page);
		$this->items = $data;
		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'per_page'    => $per_page,
			'total_pages' => ceil($total_items/$per_page)
		));
	}
}
?>