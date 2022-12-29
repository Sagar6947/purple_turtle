<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['franchise'] = 'Home/franchise';
$route['blog'] = 'Home/blog';
$route['blog_view'] = 'Home/blog_view';
$route['news_view'] = 'Home/news_view';
$route['event_view'] = 'Home/event_view';
$route['blogdetails/(:any)/(:any)'] = 'Home/blog/$1/$2';
$route['newsdetails/(:any)/(:any)'] = 'Home/news/$1/$2';
$route['eventdetails/(:any)/(:any)'] = 'Home/event/$1/$2';
$route['about'] = 'Home/about';
$route['foundation'] = 'Home/foundation';
$route['faqs'] = 'Home/faqs';
$route['gallery'] = 'Home/gallery';
$route['animated-videos'] = 'Home/animated_videos';
$route['viewmore/(:any)/(:any)'] = 'Home/all_videos/$1/$2';
$route['series/(:any)/(:any)/(:any)'] = 'Home/all_classes/$1/$2/$3';
$route['grievance'] = 'Home/grievance';

$route['restore_page'] = 'Home/restore_page';
