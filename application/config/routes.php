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
$route["staff/(:num)/families/index"] = "families/index";
$route["staff/(:num)/families/index/(:num)"] = "families/index";
$route["staff/(:num)/families/add"] = "families/add";
$route["staff/(:num)/families/edit/(:num)"] = "families/edit/";
$route["staff/(:num)/families/delete/(:num)"] = "families/delete";
$route["staff/(:num)/families/save"] = "families/save";
$route["staff/(:num)/families/update"] = "families/update";

$route["staff/(:num)/educations/index"] = "educations/index";
$route["staff/(:num)/educations/index/(:num)"] = "educations/index";
$route["staff/(:num)/educations/add"] = "educations/add";
$route["staff/(:num)/educations/edit/(:num)"] = "educations/edit";
$route["staff/(:num)/educations/delete/(:num)"] = "educations/delete";
$route["staff/(:num)/educations/save"] = "educations/save";
$route["staff/(:num)/educations/update"] = "educations/update";

$route["staff/(:num)/work_histories/index"] = "work_histories/index";
$route["staff/(:num)/work_histories/index/(:num)"] = "work_histories/index";
$route["staff/(:num)/work_histories/add"] = "work_histories/add";
$route["staff/(:num)/work_histories/edit/(:num)"] = "work_histories/edit";
$route["staff/(:num)/work_histories/delete/(:num)"] = "work_histories/delete";
$route["staff/(:num)/work_histories/save"] = "work_histories/save";
$route["staff/(:num)/work_histories/update"] = "work_histories/update";

$route["staff/(:num)/medical_histories/index"] = "medical_histories/index";
$route["staff/(:num)/medical_histories/index/(:num)"] = "medical_histories/index";
$route["staff/(:num)/medical_histories/add"] = "medical_histories/add";
$route["staff/(:num)/medical_histories/edit/(:num)"] = "medical_histories/edit";
$route["staff/(:num)/medical_histories/delete/(:num)"] = "medical_histories/delete";
$route["staff/(:num)/medical_histories/save"] = "medical_histories/save";
$route["staff/(:num)/medical_histories/update"] = "medical_histories/update";

$route["assets/(:num)/details/index"] = "assets_details/index";
$route["assets/(:num)/details/index/(:num)"] = "assets_details/index";
$route["assets/(:num)/details/add"] = "assets_details/add";
$route["assets/(:num)/details/edit/(:num)"] = "assets_details/edit";
$route["assets/(:num)/details/delete/(:num)"] = "assets_details/delete";
$route["assets/(:num)/details/save"] = "assets_details/save";
$route["assets/(:num)/details/update"] = "assets_details/update";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */