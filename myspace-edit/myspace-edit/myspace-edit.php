<?php
/*
Plugin Name: My Space Edit
Plugin URI: http://aronlinediary.wordpress.com/
Description: The easiest way to create powerful online communities
Author: Arman Hossain
Author URI: http://aronlinediary.wordpress.com/
Text Domain: My space
Domain Path: /languages
*/
add_action('admin_enqueue_scripts','enqueue_styles');
add_action('admin_enqueue_scripts','enqueue_scripts');
function enqueue_styles(){
	wp_enqueue_style("My Space Edit", plugin_dir_url( __FILE__ ) . 'css/style.css', array(), rand(100,10000), 'all');
}

function enqueue_scripts(){
	wp_enqueue_script("My Space Edit", plugin_dir_url( __FILE__ ) . 'js/mypage-edit.js', array( 'jquery' ), rand(100,10000), TRUE);
}

add_action('admin_menu','myspace_menu');
function myspace_menu(){
	add_menu_page('MySpace Edit', 'My Space Manage','manage_options','myspace-edit/myspace-edit.php','myspace_edit', 6);
}


add_action('edit_user_profile', 'myspace_edit');
function myspace_edit(){
	include_once('views/mypage-manage-view.php');
}

add_action('admin_post_ems_form_response', 'myspace_save');

function myspace_save(){

	if( isset( $_POST['ems_add_user_meta_nonce'] ) && wp_verify_nonce( $_POST['ems_add_user_meta_nonce'], 'ems_add_user_meta_form_nonce') ) {
		$parameter = $_POST['ems'];
		foreach ($parameter['user_select'] as $user_id) {
			foreach ($parameter['text'] as $key => $value) {
			  update_user_meta( $user_id, $key, $value);
			}
		}
		echo '<pre>';					
			print_r( $_POST );
			var_dump( $_FILE );
		echo '</pre>';				
		wp_die();
	} else {
		wp_die( __( 'Invalid nonce specified', "xxx" ), __( 'Error', "xxx" ), array(
						'response' 	=> 403,
						'back_link' => 'admin.php?page=' . "xxx",

				) );
	}

}

 ?>