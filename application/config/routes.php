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
$route['default_controller'] 	= 'LoginController';
$route['login'] 				= 'LoginController';
$route['login/update_login'] 	= 'LoginController/update_login';
$route['logout'] 				= 'LoginController/logout';
$route['chkLogin'] 				= 'LoginController/chkLogin';
$route['maintenance'] 			= 'LoginController/maintenance';

$route['main'] 					= 'MainController';
$route['main/(:any)'] 			= 'MainController/$1';
$route['mainPage'] 				= 'MainController/mainPage';

$route['manage_quotation/(:any)']  			= 'QuotationController/$1';
$route['manage_quotation/(:any)/(:any)']  	= 'QuotationController/$1/$2';
$route['manage_importorder/(:any)']			= 'ImportOrderController/$1';
$route['manage_importorder/(:any)/(:any)']  = 'ImportOrderController/$1/$2';

## test
$route['test'] 				= 'MainController/test';
##--


## autocomplete
{
	$route['autoc/(:any)'] 		= 'MainController/autoc/$1';
}

## import
{
	// $route['importOrder'] 		= 'ImportOrderController/index';
	// $route['saveImportOrder'] 	= 'ImportOrderController/saveImportOrder';
}

## member
{
	$route['adminList'] 			= 'MainController/adminList';
	// $route['changeLang/(:any)'] 	= 'MainController/changeLang/$1';
}
##--

## product
{
	$route['product'] 				= 'Product/ProductController/index';
	$route['productList'] 			= 'Product/ProductController/productList';
	$route['addProduct'] 			= 'Product/ProductController/addProduct';
	$route['saveProduct'] 			= 'Product/ProductController/saveProduct';
	$route['editProduct/(:any)'] 	= 'Product/ProductController/editProduct/$1';
	$route['delProduct'] 			= 'Product/ProductController/delProduct';
}
##--

## stock
{
	$route['stock'] 				= 'Stock/StockController/index';
	$route['stockList'] 			= 'Stock/StockController/stockList';
	$route['addStock'] 				= 'Stock/StockController/addStock';
	$route['saveStock'] 			= 'Stock/StockController/saveStock';
	$route['editStock/(:any)'] 		= 'Stock/StockController/editStock/$1';
	$route['delStock'] 				= 'Stock/StockController/delStock';
}
##--

## Product type
{
	$route['producttype'] 				= 'Producttype/ProducttypeController/index';
	$route['producttypeList'] 			= 'Producttype/ProducttypeController/producttypeList';
	$route['addProducttype'] 			= 'Producttype/ProducttypeController/addProducttype';
	$route['saveProducttype'] 			= 'Producttype/ProducttypeController/saveProducttype';
	$route['editProducttype/(:any)'] 		= 'Producttype/ProducttypeController/editProducttype/$1';
	$route['delProducttype'] 				= 'Producttype/ProducttypeController/delProducttype';
}
##--

## Language
{
	// $route['language/(:any)'] 			= 'LanguageController/$1';
	$route['language/(:any)']  			= 'Language/LanguageController/$1';
}
##--

## Unit
{
	$route['unit'] 				= 'Unit/UnitController/index';
	$route['unitList'] 			= 'Unit/UnitController/unitList';
	$route['addUnit']			= 'Unit/UnitController/addUnit';
	$route['saveUnit']			= 'Unit/UnitController/saveUnit';
	$route['editUnit/(:any)']	= 'Unit/UnitController/editUnit/$1';
	$route['delUnit']			= 'unit/UnitController/delUnit';
}
##--

## Unit
{
	$route['distributor'] 				= 'Distributor/DistributorController/index';
	$route['distributorList'] 			= 'Distributor/DistributorController/distributorList';
	$route['addDistributor']			= 'Distributor/DistributorController/addDistributor';
	$route['saveDistributor']			= 'Distributor/DistributorController/saveDistributor';
	$route['editDistributor/(:any)']	= 'Distributor/DistributorController/editDistributor/$1';
	$route['delDistributor']			= 'Distributor/DistributorController/delDistributor';
}
##--


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
