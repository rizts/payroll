<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = "welcome";
// Master link url
$route["staffs/(:num)/families/index"] = "families/index";
$route["staffs/(:num)/families/index/(:num)"] = "families/index";
$route["staffs/(:num)/families/add"] = "families/add";
$route["staffs/(:num)/families/edit/(:num)"] = "families/edit/";
$route["staffs/(:num)/families/delete/(:num)"] = "families/delete";
$route["staffs/(:num)/families/save"] = "families/save";
$route["staffs/(:num)/families/update"] = "families/update";

$route["staffs/(:num)/educations/index"] = "educations/index";
$route["staffs/(:num)/educations/index/(:num)"] = "educations/index";
$route["staffs/(:num)/educations/add"] = "educations/add";
$route["staffs/(:num)/educations/edit/(:num)"] = "educations/edit";
$route["staffs/(:num)/educations/delete/(:num)"] = "educations/delete";
$route["staffs/(:num)/educations/save"] = "educations/save";
$route["staffs/(:num)/educations/update"] = "educations/update";

$route["staffs/(:num)/work_histories/index"] = "work_histories/index";
$route["staffs/(:num)/work_histories/index/(:num)"] = "work_histories/index";
$route["staffs/(:num)/work_histories/add"] = "work_histories/add";
$route["staffs/(:num)/work_histories/edit/(:num)"] = "work_histories/edit";
$route["staffs/(:num)/work_histories/delete/(:num)"] = "work_histories/delete";
$route["staffs/(:num)/work_histories/save"] = "work_histories/save";
$route["staffs/(:num)/work_histories/update"] = "work_histories/update";

$route["staffs/(:num)/medical_histories/index"] = "medical_histories/index";
$route["staffs/(:num)/medical_histories/index/(:num)"] = "medical_histories/index";
$route["staffs/(:num)/medical_histories/add"] = "medical_histories/add";
$route["staffs/(:num)/medical_histories/edit/(:num)"] = "medical_histories/edit";
$route["staffs/(:num)/medical_histories/delete/(:num)"] = "medical_histories/delete";
$route["staffs/(:num)/medical_histories/save"] = "medical_histories/save";
$route["staffs/(:num)/medical_histories/update"] = "medical_histories/update";

$route["assets/(:num)/details/index"] = "assets_details/index";
$route["assets/(:num)/details/index/(:num)"] = "assets_details/index";
$route["assets/(:num)/details/add"] = "assets_details/add";
$route["assets/(:num)/details/edit/(:num)"] = "assets_details/edit";
$route["assets/(:num)/details/delete/(:num)"] = "assets_details/delete";
$route["assets/(:num)/details/save"] = "assets_details/save";
$route["assets/(:num)/details/update"] = "assets_details/update";

// Salaries and Sub Table Salarie
$route["salaries/(:num)/sub_salaries/index"] = "sub_salaries/index";
$route["salaries/(:num)/sub_salaries/index/(:num)"] = "sub_salaries/index";
$route["salaries/(:num)/sub_salaries/add"] = "sub_salaries/add";
$route["salaries/(:num)/sub_salaries/edit/(:num)"] = "sub_salaries/edit";
$route["salaries/(:num)/sub_salaries/delete/(:num)"] = "sub_salaries/delete";
$route["salaries/(:num)/sub_salaries/save"] = "sub_salaries/save";
$route["salaries/(:num)/sub_salaries/update"] = "sub_salaries/update";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */