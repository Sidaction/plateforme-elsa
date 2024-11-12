<?php

if( function_exists('acf_add_options_page') ) {
  acf_add_options_page();
}

add_filter('acf/location/rule_types', 'acf_location_rules_types');
function acf_location_rules_types( $choices ) {
    $choices['Taxonomies']['taxonomy'] = 'taxonomy';
    return $choices;
}

if( function_exists('acf_add_local_field_group') ):


  acf_add_local_field_group(array (
    'key' => 'group_587dd3fac6c22',
    'title' => 'Détails sur la Thématique / Boite à outils',
    'fields' => array (
      array (
        'key' => 'field_589458cbca39a',
        'label' => 'Texte de présentation',
        'name' => 'presentation',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 1,
        'default_value' => '',
        'delay' => 0,
      ),
      array (
        'key' => 'field_587dd44a8c61e',
        'label' => 'Image principale',
        'name' => 'image',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'id',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array (
        'key' => 'field_5894503910b39',
        'label' => 'Mots clefs liés',
        'name' => 'tags_linked',
        'type' => 'taxonomy',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'taxonomy' => 'post_tag',
        'field_type' => 'checkbox',
        'multiple' => 0,
        'allow_null' => 1,
        'return_format' => 'object',
        'add_term' => 0,
        'load_terms' => 0,
        'save_terms' => 0,
      ),
      array (
        'key' => 'field_5894506910b3a',
        'label' => 'Thématiques liées',
        'name' => 'themes_linked',
        'type' => 'taxonomy',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'taxonomy' => 'category',
        'field_type' => 'checkbox',
        'multiple' => 0,
        'allow_null' => 1,
        'return_format' => 'object',
        'add_term' => 0,
        'load_terms' => 0,
        'save_terms' => 0,
      ),
      array (
        'key' => 'field_5894508510b3b',
        'label' => 'Boites à outils liées',
        'name' => 'boites_linked',
        'type' => 'taxonomy',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'taxonomy' => 'boiteoutils',
        'field_type' => 'checkbox',
        'multiple' => 0,
        'allow_null' => 1,
        'return_format' => 'object',
        'add_term' => 0,
        'load_terms' => 0,
        'save_terms' => 0,
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'taxonomy',
          'operator' => '==',
          'value' => 'category',
        ),
      ),
      array (
        array (
          'param' => 'taxonomy',
          'operator' => '==',
          'value' => 'boiteoutils',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
  ));

endif;