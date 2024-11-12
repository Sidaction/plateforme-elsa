<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
  'key' => 'group_5f198fc48726f',
  'title' => 'Détails de l\'offre d\'emploi',
  'fields' => array(
    array(
      'key' => 'field_5f198fdbe9a5b',
      'label' => 'Description courte',
      'name' => 'description_courte',
      'type' => 'textarea',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '50',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'maxlength' => '',
      'rows' => 4,
      'new_lines' => '',
    ),
    array(
      'key' => 'field_5f198fdbe9a5z',
      'label' => 'Entreprise / Organisation / Association',
      'name' => 'emploi_place',
      'type' => 'wysiwyg',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '50',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'maxlength' => '',
      'rows' => 4,
      'new_lines' => '',
    ),
    array(
      'key' => 'field_5f1ec627c5606',
      'label' => 'Lien pour postuler',
      'name' => 'emploi_link',
      'type' => 'url',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '50',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
    ),
    array(
      'key' => 'field_5f1ec641c5607',
      'label' => 'Fiche emploi',
      'name' => 'emploi_fiche',
      'type' => 'file',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '50',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'url',
      'library' => 'all',
      'min_size' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'emploi',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
));

endif;
