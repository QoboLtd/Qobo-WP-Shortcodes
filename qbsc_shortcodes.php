<?php
function qbsc_get_post_field( $atts ) {
    $atts = shortcode_atts( array(
        'id' => '1',
        'field' => 'title',
        'do_shortcode' => 1,
        ), $atts );

	$result = get_post_field($atts['field'], $atts['id']);
    if(!empty($atts['do_shortcode']))
    	return do_shortcode($result); 

    return $result;
}
add_shortcode( 'qbsc-get-post-field', 'qbsc_get_post_field' );

function qbsc_get_post_thumbnail( $atts ) {
    $atts = shortcode_atts( array(
        'id' => '1',
        'size' => 'post-thumbnail',
        'src' => null,
        'class' => null,
        'alt' => null,
        'title' => null,
        ), $atts );

    $thumb_attr = array();
    if($atts['src'])
        $thumb_attr['src'] = $atts['src'];
    if($atts['class'])
        $thumb_attr['class'] = $atts['class'];
    if($atts['alt'])
        $thumb_attr['alt'] = $atts['alt'];
    if($atts['title'])
        $thumb_attr['title'] = $atts['title'];

    return get_the_post_thumbnail($atts['id'], $atts['size'], $thumb_attr);
}
add_shortcode( 'qbsc-get-post-thumbnail', 'qbsc_get_post_thumbnail' );

function qbsc_get_post_anchor( $atts, $content=null ) {
    $atts = shortcode_atts( array(
        'id' => '1',
        ), $atts );

    if($content) {
        $content = do_shortcode($content);

        $post_href = get_permalink($atts['id']);
        $post_title = get_post_field('post_title', $atts['id']);
        $content = "<a href=\"$post_href\" title=\"$post_title\">$content</a>";
    }

    return $content;
}
add_shortcode( 'qbsc-get-post-anchor', 'qbsc_get_post_anchor' );

function qbsc_trim( $atts, $content=null ) {
    $atts = shortcode_atts( array(
        'chars' => 0,
        'words' => 0,
        'suffix' => '',
        'strip_html' => 0,
        ), $atts );

    if($content) {
        $content = do_shortcode($content);
        $is_trimmed = 0;

        if(!empty($atts['chars']) && strlen($content)>$atts['chars']){
            $content = substr($content, 0, $atts['chars']);
            $is_trimmed = 1;
        }
        if(!empty($atts['words'])){
            $content_bywords = explode(' ', $content);
            if(sizeof($content_bywords)>$atts['words']){
                $content = implode(' ', array_slice($content_bywords, 0, $atts['words']));
                $is_trimmed = 1;
            }
        }
        if(!empty($atts['strip_html']))
            $content = wp_strip_all_tags($content);
        if($is_trimmed)
        	$content .= $atts['suffix'];
    }

    return $content;
}
add_shortcode( 'qbsc-trim', 'qbsc_trim' );