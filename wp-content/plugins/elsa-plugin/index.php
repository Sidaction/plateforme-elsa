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
define('RESS_PATH', plugin_dir_path(__FILE__));
define('RESS_FUNC_PATH', RESS_PATH . 'functions/');
define('RESS_PT_PATH', RESS_PATH . 'post_types/');
define('RESS_UTILS_PATH', RESS_PATH . 'utils/');
define('RESS_METAS_PATH', RESS_PATH . 'metas/');
define('RESS_CLASSES_PATH', RESS_PATH . 'classes/');


/**
 * DEFINE SOCIAL ACCOMPTS
 */
define('FACEBOOK', '');
define('TWITTER', '');


/**
 * Post Types & Taxonomies & metas
 */
require_once(RESS_PT_PATH . 'post-types.php');
require_once(RESS_METAS_PATH . 'metas.php');


/**
 * Post Types & Taxonomies & metas
 */
require_once(RESS_UTILS_PATH . 'seo.php');
require_once(RESS_UTILS_PATH . 'lib.php');
require_once(RESS_UTILS_PATH . 'roles.php');
require_once(RESS_UTILS_PATH . 'acf.php');
//require_once(RESS_UTILS_PATH . 'acf-extras.php');




/**
 * Save and Load ACF JSON Files
 */
function custom_acf_load_json($paths)
{
    $paths = array(
        RESS_PATH . '/acf-json'
    );

    return $paths;
}

function custom_acf_save_json($paths)
{

    $paths = RESS_PATH . '/acf-json';

    return $paths;
}


add_filter('acf/settings/save_json', 'custom_acf_save_json');
add_filter('acf/settings/load_json', 'custom_acf_load_json');

add_filter('acf/save_post', function ($post_id) {
    $format = function (&$date) {
        $tmp = sanitize_text_field($date);
        if (!empty($tmp)) {
            preg_match('~(\d{4})(\d{2})(\d{2})~', $tmp, $match);
            array_shift($match);
            $date = implode('-', $match);
        }
    };

    $format($_POST['acf']['field_58eb82d838d59']);
    $format($_POST['acf']['field_58eb835538d5a']);
}, 1, 1);




