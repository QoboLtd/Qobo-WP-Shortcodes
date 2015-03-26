<?php
/**
 * Register custom shortcodes/functions to plugin 'Shortcodes Ultimate'
 * (reference: http://gndev.info/kb/shortcodes-ultimate-api-overview/)
 */

add_action( 'plugins_loaded', 'qbsc_filter_su' );
function qbsc_filter_su() {
  if ( class_exists( QBSC__SU_CLASS ) ) {
    add_filter( 'su/data/groups', 'qbsc_group_su' );
    add_filter( 'su/data/shortcodes', 'qbsc_register_su' );
  }
}

function qbsc_group_su( $groups ) {
  $groups[QBSC__GROUP_CUSTOM_KEY] = __( QBSC__GROUP_CUSTOM, QBSC__TEXT_DOMAIN );
  
  return $groups;
}

function qbsc_register_su( $shortcodes ) {
  $shortcodes = qbsc_get_post_field_su( $shortcodes );
  $shortcodes = qbsc_get_post_thumbnail_su( $shortcodes );
  $shortcodes = qbsc_get_post_anchor_su( $shortcodes );
  $shortcodes = qbsc_trim_su( $shortcodes );

  return $shortcodes;
}

function qbsc_get_post_field_su( $shortcodes ) {
  $shortcodes['qbsc_get_post_field'] = array(
    'name' => __( 'Post Field', QBSC__TEXT_DOMAIN ),
    'type' => 'single',
    'group' => QBSC__GROUP_CUSTOM,
    'atts' => array(
      'id' => array(
        'default' => '',
        'name' => __( 'Post ID', QBSC__TEXT_DOMAIN ),
        'desc' => __( 'You can specify custom post ID. Leave this field empty to use an ID of the current post. Current post ID may not work in Live Preview mode', QBSC__TEXT_DOMAIN ),
      ),
      'field' => array(
        'type' => 'select',
        'values' => array(
          'ID'                    => __( 'Post ID', QBSC__TEXT_DOMAIN ),
          'post_author'           => __( 'Post author', QBSC__TEXT_DOMAIN ),
          'post_date'             => __( 'Post date', QBSC__TEXT_DOMAIN ),
          'post_date_gmt'         => __( 'Post date', QBSC__TEXT_DOMAIN ) . ' GMT',
          'post_content'          => __( 'Post content', QBSC__TEXT_DOMAIN ),
          'post_title'            => __( 'Post title', QBSC__TEXT_DOMAIN ),
          'post_excerpt'          => __( 'Post excerpt', QBSC__TEXT_DOMAIN ),
          'post_status'           => __( 'Post status', QBSC__TEXT_DOMAIN ),
          'comment_status'        => __( 'Comment status', QBSC__TEXT_DOMAIN ),
          'ping_status'           => __( 'Ping status', QBSC__TEXT_DOMAIN ),
          'post_name'             => __( 'Post name', QBSC__TEXT_DOMAIN ),
          'post_modified'         => __( 'Post modified', QBSC__TEXT_DOMAIN ),
          'post_modified_gmt'     => __( 'Post modified', QBSC__TEXT_DOMAIN ) . ' GMT',
          'post_content_filtered' => __( 'Filtered post content', QBSC__TEXT_DOMAIN ),
          'post_parent'           => __( 'Post parent', QBSC__TEXT_DOMAIN ),
          'guid'                  => __( 'GUID', QBSC__TEXT_DOMAIN ),
          'menu_order'            => __( 'Menu order', QBSC__TEXT_DOMAIN ),
          'post_type'             => __( 'Post type', QBSC__TEXT_DOMAIN ),
          'post_mime_type'        => __( 'Post mime type', QBSC__TEXT_DOMAIN ),
          'comment_count'         => __( 'Comment count', QBSC__TEXT_DOMAIN ),
          'other'         => __( 'Other', QBSC__TEXT_DOMAIN ),
        ),
        'default' => 'post_title',
        'name' => __( 'Field', QBSC__TEXT_DOMAIN ),
        'desc' => __( 'Post data field name', QBSC__TEXT_DOMAIN )
      ),
      'field_other' => array(
        'default' => '',
        'name' => __( 'Field Other', QBSC__TEXT_DOMAIN ),
        'desc' => __( 'Post data field name if selected Field is Other', QBSC__TEXT_DOMAIN ),
      ),
    ),
    'desc' => __( 'Retrieve data from a post field based on post ID.', QBSC__TEXT_DOMAIN ),
    'icon' => 'align-justify',
    'function' => 'qbsc_get_post_field_pre_su',
  );
  
  return $shortcodes;
}

function qbsc_get_post_field_pre_su( $atts ) {
  if($atts['field']==='other')
    $atts['field'] = $atts['field_other'];
  
  return qbsc_get_post_field( $atts );
}

function qbsc_get_post_thumbnail_su( $shortcodes ) {
  $shortcodes['qbsc_get_post_thumbnail'] = array(
    'name' => __( 'Post Thumbnail', QBSC__TEXT_DOMAIN ),
    'type' => 'single',
    'group' => QBSC__GROUP_CUSTOM,
    'atts' => array(
      'id' => array(
        'default' => '',
        'name' => __( 'Post ID', QBSC__TEXT_DOMAIN ),
        'desc' => __( 'You can specify custom post ID. Leave this field empty to use an ID of the current post. Current post ID may not work in Live Preview mode', QBSC__TEXT_DOMAIN ),
      ),
      'size' => array(
        'type' => 'select',
        'values' => array(
          'thumbnail' => __( 'Thumbnail', QBSC__TEXT_DOMAIN ),
          'medium' => __( 'Medium', QBSC__TEXT_DOMAIN ),
          'large' => __( 'Large', QBSC__TEXT_DOMAIN ),
          'full' => __( 'Full', QBSC__TEXT_DOMAIN ) . ' GMT',
          'post-thumbnail' => __( 'Post Thumbnail', QBSC__TEXT_DOMAIN ),
        ),
        'default' => 'thumbnail',
        'name' => __( 'Size', QBSC__TEXT_DOMAIN ),
        'desc' => __( 'Thumbnail size', QBSC__TEXT_DOMAIN )
      ),
      'src' => array(
        'default' => '',
        'name' => __( 'Attribute Source', QBSC__TEXT_DOMAIN ),
        'desc' => __( 'Thumbnail attribute source (src)', QBSC__TEXT_DOMAIN ),
      ),
      'class' => array(
        'default' => '',
        'name' => __( 'Attribute Class', QBSC__TEXT_DOMAIN ),
        'desc' => __( 'Thumbnail attribute class', QBSC__TEXT_DOMAIN ),
      ),
      'alt' => array(
        'default' => '',
        'name' => __( 'Attribute Alternative', QBSC__TEXT_DOMAIN ),
        'desc' => __( 'Thumbnail attribute alternative (alt)', QBSC__TEXT_DOMAIN ),
      ),
      'title' => array(
        'default' => '',
        'name' => __( 'Attribute Title', QBSC__TEXT_DOMAIN ),
        'desc' => __( 'Thumbnail attribute title', QBSC__TEXT_DOMAIN ),
      ),
    ),
    'desc' => __( 'Gets the Featured Image (formerly called Post Thumbnail) as set in post\'s or page\'s edit screen and returns an HTML image element representing a Featured Image, if there is any, otherwise an empty string.', QBSC__TEXT_DOMAIN ),
    'icon' => 'file-image-o',
    'function' => 'qbsc_get_post_thumbnail',
  );

  return $shortcodes;
}

function qbsc_get_post_anchor_su( $shortcodes ) {
  $shortcodes['qbsc_get_post_anchor'] = array(
      'name' => __( 'Post Anchor', QBSC__TEXT_DOMAIN ),
      'type' => 'single',
      'group' => QBSC__GROUP_CUSTOM,
      'atts' => array(
        'id' => array(
          'default' => '',
          'name' => __( 'Post ID', QBSC__TEXT_DOMAIN ),
          'desc' => __( 'You can specify custom post ID. Leave this field empty to use an ID of the current post. Current post ID may not work in Live Preview mode', QBSC__TEXT_DOMAIN ),
        ),
      ),
      'desc' => __( 'Retrieve an anchor element linking to the paremeterised post ID.', QBSC__TEXT_DOMAIN ),
      'icon' => 'link',
      'function' => 'qbsc_get_post_anchor',
  );

  return $shortcodes;
}

function qbsc_trim_su( $shortcodes ) {
  $shortcodes['qbsc_trim'] = array(
      'name' => __( 'Trim', QBSC__TEXT_DOMAIN ),
      'type' => 'content',
      'group' => QBSC__GROUP_CUSTOM,
      'atts' => array(
        'chars' => array(
          'type' => 'number',
          'min' => 0,
          'max' => 100000,
          'step' => 1,
          'default' => 0,
          'name' => __( 'Characters', QBSC__TEXT_DOMAIN ),
          'desc' => __( 'Maximum nubmer of characters', QBSC__TEXT_DOMAIN ),
        ),
        'words' => array(
          'type' => 'number',
          'min' => 0,
          'max' => 100000,
          'step' => 1,
          'default' => 0,
          'name' => __( 'Words', QBSC__TEXT_DOMAIN ),
          'desc' => __( 'Maximum nubmer of words', QBSC__TEXT_DOMAIN ),
        ),
        'suffix' => array(
          'default' => '',
          'name' => __( 'Suffix', QBSC__TEXT_DOMAIN ),
          'desc' => __( 'Use the following suffix if text was trimmed (for e.g. \'...\')', QBSC__TEXT_DOMAIN ),
        ),
        'strip_html' => array(
          'type' => 'bool',
          'default' => 'yes',
          'name' => __( 'Strip HTML', QBSC__TEXT_DOMAIN ),
          'desc' => __( 'Maximum nubmer of characters', QBSC__TEXT_DOMAIN ),
        ),
      ),
      'content' => __( '', QBSC__TEXT_DOMAIN ),
      'desc' => __( 'Trim content using various factors.', QBSC__TEXT_DOMAIN ),
      'icon' => 'scissors',
      'function' => 'qbsc_trim',
  );

  return $shortcodes;
}