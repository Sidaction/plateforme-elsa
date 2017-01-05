<?php

/**
 *
 * Plugin Name: Plugin pour le site de la Plateforme ELSA
 * Plugin URI: http://plateforme-elsa.org/
 * Description: Post types, metas, etc.
 * Version: 1.0.0
 * Author: Thomas Florentin
 * Author URI: http://thomasflorentin.net
 * Text Domain: elsa-plugin
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;


/**
 * DEFINE PATHS
 */
define('ODY_PATH', plugin_dir_path(__FILE__));
define('ODY_FUNC_PATH', ODY_PATH . 'functions/');
define('ODY_PT_PATH', ODY_PATH . 'post_types/');
define('ODY_UTILS_PATH', ODY_PATH . 'utils/');
define('ODY_METAS_PATH', ODY_PATH . 'metas/');


/**
 * DEFINE SOCIAL ACCOMPTS
 */
define('FACEBOOK', '');
define('TWITTER', '');


/**
 * Post Types & Taxonomies & metas
 */
require_once(ODY_PT_PATH . 'post-types.php');
require_once(ODY_METAS_PATH . 'metas.php');








