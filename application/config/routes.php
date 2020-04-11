<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * APIs
 */

 $route['api/check-token'] = 'API/User/check_token';
 $route['api/login-user'] = 'API/User/login';
 $route['api/register-user'] = 'API/User/register';
 $route['api/edit-user'] = 'API/User/edit';
 $route['api/delete-user'] = 'API/User/delete';
 $route['api/get-user'] = 'API/User/get';
 $route['api/add-user'] = 'API/User/add';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
