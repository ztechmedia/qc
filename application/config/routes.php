<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'AppController';
$route['404_override'] = 'AppController/pageNotFound';
$route['translate_uri_dashes'] = false;

//web routes
$route['home'] = 'web/WebController/home';

//admin routes
$route['admin'] = 'AppController';

/* home routes */
//@view
$route['admin/performance/slitting/(:num)/(:num)'] = "HomeController/slitting/$1/$2";
$route['admin/performance/cpp/(:num)/(:num)'] = "HomeController/cpp/$1/$2";
$route['admin/performance/metalize/(:num)/(:num)'] = "HomeController/metalize/$1/$2";
$route['myip'] = "AuthController/myip";
$route['admin/developer'] = "HomeController/developer";

$route['admin/productions/ncr/(:any)/(:any)'] = 'productions/SlittingController/ncr/$1/$2';
$route['admin/productions/print-ncr/(:any)/(:any)/(:any)'] = 'productions/SlittingController/printNcr/$1/$2/$3';

/* auth routes */
//@view
$route['login'] = 'AuthController/login';
$route['forgot-password'] = 'AuthController/forgotPassword';
$route['reset-password/(:any)'] = 'AuthController/resetPassword/$1';
//@action
$route['auth/login'] = 'AuthController/authLogin';
$route['auth/send-link-forgot'] = 'AuthController/sendLinkForgot';
$route['auth/reset/(:any)'] = 'AuthController/reset/$1';
$route['logout'] = 'AppController/logout';

/* customer alias routes */
//@view
$route['admin/master/customer-alias'] = 'master/MasterController/customerAlias';
$route['admin/master/customer-alias-table'] = 'master/MasterController/customerAliasTable';
$route['admin/master/customer-alias/create'] = 'master/MasterController/create';
$route['admin/master/customer-alias/(:num)/edit'] = 'master/MasterController/edit/$1';
//@action
$route['admin/master/customer-alias/add'] = 'master/MasterController/add';
$route['admin/master/customer-alias/(:num)/update'] = 'master/MasterController/update/$1';
$route['admin/master/customer-alias/(:num)/delete'] = 'master/MasterController/delete/$1';

/* defect alias routes */
//@view
$route['admin/master/defect-alias'] = 'master/MasterController/defectAlias';
$route['admin/master/defect-alias-table'] = 'master/MasterController/defectAliasTable';
$route['admin/master/defect-alias/create'] = 'master/MasterController/createDefect';
$route['admin/master/defect-alias/(:num)/edit'] = 'master/MasterController/editDefect/$1';
//@action
$route['admin/master/defect-alias/add'] = 'master/MasterController/addDefect';
$route['admin/master/defect-alias/(:num)/update'] = 'master/MasterController/updateDefect/$1';
$route['admin/master/defect-alias/(:num)/delete'] = 'master/MasterController/deleteDefect/$1';

/* users routes */
//@view
$route['admin/users/(:num)'] = 'UsersController/users/$1';
$route['admin/users-table/(:num)'] = 'UsersController/usersTable/$1';
$route['admin/users/create/(:num)'] = 'UsersController/create/$1';
$route['admin/users/(:num)/edit'] = 'UsersController/edit/$1';
//@action
$route['admin/users/add'] = 'UsersController/add';
$route['admin/users/(:num)/update'] = 'UsersController/update/$1';
$route['admin/users/(:num)/delete'] = 'UsersController/delete/$1';

/* slitting routes */
//@view
$route['admin/productions/slitting/main/(:num)/(:num)/(:num)'] = 'productions/SlittingController/slitting/$1/$2/$3';
$route['admin/productions/slitting/tab/(:any)/(:num)/(:num)/(:num)/(:any)'] = 'productions/SlittingController/tab/$1/$2/$3/$4/$5';
$route['admin/productions/slitting/slitting-table'] = 'productions/SlittingController/slittingTable';
$route['admin/productions/slitting/change-status/(:num)'] = 'productions/SlittingController/changeStatus/$1';
$route['admin/productions/slitting/cof'] = 'productions/SlittingController/changeCof';
$route['admin/productions/slitting/change-defect/(:num)'] = 'productions/SlittingController/changeDefect/$1';
$route['admin/productions/slitting/change-od/(:num)'] = 'productions/SlittingController/changeOd/$1';
//@action
$route['admin/productions/slitting/desc'] = 'productions/SlittingController/changeDesc';
$route['admin/productions/slitting/corona'] = 'productions/SlittingController/changeCorona';
$route['admin/productions/slitting/change-status-action'] = 'productions/SlittingController/changeStatusAction';
$route['admin/productions/slitting/change-defect/(:num)/action'] = 'productions/SlittingController/changeDefectAction/$1';
$route['admin/productions/slitting/change-od/(:num)/action'] = 'productions/SlittingController/changeOdAction/$1';
$route['admin/productions/slitting/(:any)/(:num)/edit'] = 'productions/SlittingController/edit/$1/$2';
$route['admin/productions/slitting/(:num)/update'] = 'productions/SlittingController/update/$1';

/* metalize routes */
//@view
$route['admin/productions/metalize/main/(:num)/(:num)/(:num)'] = 'productions/MetalizeController/metalize/$1/$2/$3';
$route['admin/productions/metalize/tab/(:any)/(:num)/(:num)/(:num)/(:any)'] = 'productions/MetalizeController/tab/$1/$2/$3/$4/$5';
$route['admin/productions/metalize/metalize-table'] = 'productions/MetalizeController/metalizeTable';
$route['admin/productions/metalize/change-status/(:num)'] = 'productions/MetalizeController/changeStatus/$1';
$route['admin/productions/metalize/change-defect/(:num)'] = 'productions/MetalizeController/changeDefect/$1';
$route['admin/productions/metalize/change-od/(:num)'] = 'productions/MetalizeController/changeOd/$1';
$route['admin/productions/metalize/change-eaa/(:num)'] = 'productions/MetalizeController/changeEaa/$1';
//@action
$route['admin/productions/metalize/change-status-action'] = 'productions/MetalizeController/changeStatusAction';
$route['admin/productions/metalize/corona'] = 'productions/MetalizeController/changeCorona';
$route['admin/productions/metalize/change-defect/(:num)/action'] = 'productions/MetalizeController/changeDefectAction/$1';
$route['admin/productions/metalize/change-od/(:num)/action'] = 'productions/MetalizeController/changeOdAction/$1';
$route['admin/productions/metalize/change-eaa/(:num)/action'] = 'productions/MetalizeController/changeEaaAction/$1';
$route['admin/productions/metalize/desc'] = 'productions/MetalizeController/changeDesc';

/* cpp routes */
//@view
$route['admin/productions/cpp/main/(:num)/(:num)/(:num)'] = 'productions/CppController/cpp/$1/$2/$3';
$route['admin/productions/cpp/tab/(:any)/(:num)/(:num)/(:num)/(:any)'] = 'productions/CppController/tab/$1/$2/$3/$4/$5';
$route['admin/productions/cpp/cpp-table'] = 'productions/CppController/cppTable';
$route['admin/productions/cpp/change-status/(:num)'] = 'productions/CppController/changeStatus/$1';
//@action
$route['admin/productions/cpp/desc'] = 'productions/CppController/changeDesc';
$route['admin/productions/cpp/haze'] = 'productions/CppController/changeHaze';
$route['admin/productions/cpp/corona'] = 'productions/CppController/changeCorona';
$route['admin/productions/cpp/change-status-action'] = 'productions/CppController/changeStatusAction';
$route['admin/productions/cpp/(:any)/(:num)/edit'] = 'productions/CppController/edit/$1/$2';
$route['admin/productions/cpp/(:num)/update'] = 'productions/CppController/update/$1';

/* palet routes */
//@view
$route['admin/productions/packing/palet'] = 'productions/PackingController/palet';
$route['admin/productions/packing/palet-table'] = 'productions/PackingController/paletTable';
$route['admin/productions/packing/palet/(:num)/edit'] = 'productions/PackingController/edit/$1';
//@action
$route['admin/productions/packing/palet/(:num)/update'] = 'productions/PackingController/update/$1';
$route['admin/productions/packing/palet/(:num)/delete'] = 'productions/PackingController/delete/$1';

/* rleeased routes */
//@view
$route['admin/productions/released/(:num)/(:num)'] = 'productions/ReleasedController/released/$1/$2';
$route['admin/productions/released-table/(:num)/(:num)'] = 'productions/ReleasedController/releasedTable/$1/$2';
$route['admin/productions/released/(:num)/(:num)/(:num)/edit'] = 'productions/ReleasedController/edit/$1/$2/$3';
//@actions
$route['admin/productions/released/(:num)/update'] = 'productions/ReleasedController/update/$1/$2';
$route['admin/productions/released/(:num)/delete'] = 'productions/ReleasedController/delete/$1';

//cron route at server
$route['last-id/(:any)'] = 'CronController/lastId/$1';
$route['update-data'] = 'CronController/updateDataServer';

//cron route at client
$route['push_start'] = "CronController/pushStart";

//delivery
//@view
$route['admin/delivery/(:num)/(:num)'] = "DeliveryController/delivery/$1/$2";
$route['admin/waste/(:num)/(:num)'] = "DeliveryController/waste/$1/$2";