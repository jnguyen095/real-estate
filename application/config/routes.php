<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home_controller';
$route['trang-chu'] = 'home_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Dang nhap
$route['dang-nhap'] = "Login_controller/index";
// Dang ky thanh vien
$route['dang-ky'] = "Register_controller";
// Dang xuat
$route['dang-xuat'] = "Login_controller/logout";
// Dang tin rao
$route['dang-tin'] = "Post_controller";
$route['gui-mail'] = "Email_controller/send_email";
// Xem truoc dang tin rao
$route['xem-truoc-p(:num)'] = "Post_controller/preview/$1";
// Chinh sua tin rao
$route['chinh-sua-p(:num)'] = "Post_controller/edit/$1";
// Dang bai thanh cong
$route['dang-bai-thanh-cong-p(:num)'] = "Post_controller/done/$1";
// Trang quan ly tin rao
$route['quan-ly-tin-rao'] = "ManagePost_controller";
$route['quan-ly-tin-rao.html/(:num)'] = "ManagePost_controller/index/$1";
// Trang quan ly giao dich
$route['quan-ly-giao-dich'] = "ManagePost_controller/transfer";
// Trang thong tin ca nhan
$route['thong-tin-ca-nhan'] = 'UserProfile_controller';
// Trang doi mat khau
$route['doi-mat-khau'] = 'UserProfile_controller/changePassword';

// Search by city
$route['(:any)-ct(:num)'] = "Search_controller/searchByCity/$2";
$route['(:any)-ct(:num).html/(:num)'] = "Search_controller/searchByCity/$2/$3";
// Search by district
$route['(:any)-dt(:num)'] = "Search_controller/searchByDistrict/$2";
$route['(:any)-dt(:num).html/(:num)'] = "Search_controller/searchByDistrict/$2/$3";
// Search by branch
$route['(:any)-b(:num)'] = "Search_controller/searchByBranch/$2";
$route['(:any)-b(:num).html/(:num)'] = "Search_controller/searchByBranch/$2/$3";
// Search by category and city
$route['(:any)-cc(:num)-(:num)'] = "Search_controller/searchByCategoryAndCity/$2/$3";
$route['(:any)-cc(:num)-(:num).html/(:num)'] = "Search_controller/searchByCategoryAndCity/$2/$3/$4";
// Search by category and district
$route['(:any)-c(:num)-d(:num)'] = "Search_controller/searchByCategoryAndDistrict/$2/$3";
$route['(:any)-c(:num)-d(:num).html/(:num)'] = "Search_controller/searchByCategoryAndDistrict/$2/$3/$4";
// Search in the same user
$route['(:any)-u(:num)'] = "Search_controller/searchBySameUser/$2";
$route['(:any)-u(:num).html/(:num)'] = "Search_controller/searchBySameUser/$2/$3";

// Global search
$route['tim-kiem'] = "Search_controller";
$route['tim-kiem.html/(:num)'] = "Search_controller/index/$1";

// Sitemap
$route['sitemap\.xml'] = "Sitemap_controller";
$route['sitemap_(:num)\.xml'] = "Sitemap_controller/viewItems/$1";


// tin tuc
$route['tin-tuc'] = "News_controller";
$route['tin-tuc.html/(:num)'] = "News_controller/index/$1";
$route['(:any)-n(:num)'] = "News_controller/detail/$2";

// Hop tac
$route['hop-tac'] = "Cooperate_controller";
$route['hop-tac.html/(:num)'] = "Cooperate_controller/index/$1";
$route['(:any)-co(:num)'] = "Cooperate_controller/detail/$2";
$route['dang-tin-hop-tac'] = "Cooperate_controller/add";
$route['dang-bai-thanh-cong-cp(:num)'] = "Cooperate_controller/done/$1";

// nha mau dep
$route['nha-mau-dep'] = "SampleHouse_controller";
$route['nha-mau-dep.html/(:num)'] = "SampleHouse_controller/index/$1";
$route['(:any)-s(:num)'] = "SampleHouse_controller/detail/$2";


// View by category
$route['(:any)-c(:num)'] = "Product_controller/listItem/$2";
// View by category with paging
$route['(:any)-c(:num).html/(:num)'] = "Product_controller/listItem/$2/$3";
// View product detail
$route['(:any)-p(:num)'] = "Product_controller/detailItem/$2";
// Moi cap nhat
$route['bat-dong-san-moi-cap-nhat'] = "Product_controller/justUpdateItems";
$route['bat-dong-san-moi-cap-nhat.html/(:num)'] = "Product_controller/justUpdateItems/$1";
// Duoi 1 ty
$route['nha-dat-duoi-mot-ty'] = "Product_controller/underOneBillion";
$route['nha-dat-duoi-mot-ty.html/(:num)'] = "Product_controller/underOneBillion/$1";

// Static Pages
$route['dieu-khoan-su-dung'] = "StaticPage_controller/term";
$route['quy-che-hoat-dong'] = "StaticPage_controller/used";
$route['bao-gia-quang-cao'] = "StaticPage_controller/adv";
$route['tuyen-dung'] = "StaticPage_controller/carer";
$route['bao-gia-dich-vu'] = "StaticPage_controller/payment";
$route['khong-tim-thay'] = "Notfound_controller";

//Advertise handle
$route['redirect-adv-(:num)'] = "Advertise_controller/index/$1";


/* ADMINISTRATOR */
$route['admin/dashboard'] = "admin/Admin_controller";
$route['admin/user/list'] = "admin/UserManagement_controller";
$route['admin/product/list'] = "admin/ProductManagement_controller";
$route['admin/product/edit'] = "admin/ProductManagement_controller/edit";
$route['admin/cooperate/list'] = "admin/CooperateManagement_controller";
$route['admin/feedback/list'] = "admin/FeedBack_controller";
$route['admin/feedback/view-(:num)'] = "admin/FeedBack_controller/view/$1";
$route['admin/static-page/list'] = "admin/StaticPage_controller";
$route['admin/static-page/add'] = "admin/StaticPage_controller/add";
$route['admin/static-page/add-(:num)'] = "admin/StaticPage_controller/add/$1";
$route['admin/transfer'] = "admin/Transfer_controller";
$route['admin/transfer-user-(:num)'] = "admin/Transfer_controller/processUser/$1";
$route['admin/purchase-history/list'] = "admin/PurchaseHistory_controller";
$route['admin/brand/list'] = "admin/BrandManagement_controller";
$route['admin/brand/view-(:num)'] = "admin/BrandManagement_controller/detail/$1";
$route['admin/sitemap'] = "admin/SitemapIndex_controller";
$route['admin/sitemap.html/(:num)'] = "admin/SitemapIndex_controller/index/$1";
$route['admin/sitemap/list'] = "admin/SitemapIndex_controller/listItems";
$route['admin/sitemap/view-(:num)'] = "admin/SitemapIndex_controller/viewItems/$1";
$route['admin/sitemap/sitemap-(:num)'] = "admin/SitemapIndex_controller/xmlView/$1";
$route['admin/sitemap/export-(:num)'] = "admin/SitemapIndex_controller/exportSitemapFile/$1";
$route['admin/sitemap/push'] = "Sitemap_controller/publish2SearchEngine";
$route['admin/banner/list'] = "admin/Banner_controller";
$route['admin/banner/add'] = "admin/Banner_controller/add";
$route['admin/banner/add-(:num)'] = "admin/Banner_controller/add/$1";
$route['admin/banner/analytic-(:num)'] = "admin/Banner_controller/analytic/$1";
