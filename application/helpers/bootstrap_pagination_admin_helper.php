<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/21/2017
 * Time: 12:29 PM
 */
// application/config/bootstrap_pagination_helper.php
if( ! function_exists('pagination'))
{
	function pagination($container){
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><span>';
		$config['cur_tag_close'] = '</span></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['per_page'] = MAX_PAGE_ITEM;
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$config['searchFor'] = ($container->input->get('query')) ? $container->input->get('query') : NULL;
		$config['orderField'] = ($container->input->get('orderField')) ? $container->input->get('orderField') : '';
		$config['orderDirection'] = ($container->input->get('orderDirection')) ? $container->input->get('orderDirection') : '';
		$config['page'] = ($container->input->get('per_page')) ? $container->input->get('per_page') : 0;

		return $config;
	}
}

?>
