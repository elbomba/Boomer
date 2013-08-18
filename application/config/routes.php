<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

$route['admin/statistiche/load/(:any)'] = 'statistiche/load/$1';

$route['admin/categorie/modifica_categoria/(:any)'] = 'categorie/modifica_categoria/$1';
$route['admin/categorie/elimina_categoria/(:any)'] = 'categorie/elimina_categoria/$1';

$route['admin/media/modifica_media/(:any)'] = 'media/modifica_media/$1';
$route['admin/media/elimina_media/(:any)'] = 'media/elimina_media/$1';

$route['admin/menu/modifica_menu/(:any)'] = 'menu/modifica_menu/$1';
$route['admin/menu/elimina_menu/(:any)'] = 'menu/elimina_menu/$1';
$route['admin/menu/nuova_voce/(:any)'] = 'menu/nuova_voce/$1';
$route['admin/menu/modifica_voce/(:any)'] = 'menu/modifica_voce/$1';
$route['admin/menu/elimina_voce/(:any)'] = 'menu/elimina_voce/$1';

$route['admin/post/modifica_post/(:any)'] = 'post/modifica_post/$1';
$route['admin/post/elimina_post/(:any)'] = 'post/elimina_post/$1';

$route['admin/utenti/modifica_utente/(:any)'] = 'utenti/modifica_utente/$1';
$route['admin/utenti/elimina_utente/(:any)'] = 'utenti/elimina_utente/$1';

$route['admin/(:any)'] = 'admin/$1';
$route['home/to_desktop'] = 'home/to_desktop';
$route['home/to_mobile'] = 'home/to_mobile';

$route['(:any)/(:any)'] = 'home/index/$2';
$route['(:any)'] = 'home/index/$1';

$route['admin/statistiche/dati_demografici'] = 'statistiche/dati_demografici';
$route['admin/statistiche/device'] = 'statistiche/device';

$route['admin/categorie/nuova_categoria'] = 'categorie/nuova_categoria';
$route['admin/categorie/modifica_categoria'] = 'categorie/modifica_categoria';
$route['admin/categorie/elimina_categoria'] = 'categorie/elimina_categoria';

$route['admin/media/nuovo_media'] = 'media/nuovo_media';
$route['admin/media/modifica_media'] = 'media/modifica_media';
$route['admin/media/elimina_media'] = 'media/elimina_media';

$route['admin/menu/nuovo_menu'] = 'menu/nuovo_menu';
$route['admin/menu/modifica_menu'] = 'menu/modifica_menu';
$route['admin/menu/elimina_menu'] = 'menu/elimina_menu';

$route['admin/post/nuovo_post'] = 'post/nuovo_post';
$route['admin/post/modifica_post'] = 'post/modifica_post';
$route['admin/post/elimina_post'] = 'post/elimina_post';

$route['admin/utenti/nuovo_utente'] = 'utenti/nuovo_utente';
$route['admin/utenti/modifica_utente'] = 'utenti/modifica_utente';
$route['admin/utenti/elimina_utente'] = 'utenti/elimina_utente';

$route['admin'] = 'admin';

$route['default_controller'] = 'home';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */