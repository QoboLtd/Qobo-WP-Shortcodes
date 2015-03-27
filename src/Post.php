<?php
namespace Qobo\Shortcodes;

class Post
{
    public static function get_post_field($atts)
    {
        $atts = shortcode_atts( array(
            'id' => null,
            'field' => 'post_title',
            'do_shortcode' => 1,
            ), $atts );
        if (!$atts['id'])
            $atts['id'] = get_the_ID();
        
    	$result = get_post_field($atts['field'], $atts['id']);
        if (!empty($atts['do_shortcode']))
        	return do_shortcode($result); 
    
        return $result;
    }
    
    public static function get_post_thumbnail($atts)
    {
        $atts = shortcode_atts( array(
            'id' => null,
            'size' => 'post-thumbnail',
            'src' => null,
            'class' => null,
            'alt' => null,
            'title' => null,
            ), $atts );
        if (!$atts['id'])
            $atts['id'] = get_the_ID();
    
        $thumb_attr = array();
        if ($atts['src'])
            $thumb_attr['src'] = $atts['src'];
        if ($atts['class'])
            $thumb_attr['class'] = $atts['class'];
        if ($atts['alt'])
            $thumb_attr['alt'] = $atts['alt'];
        if ($atts['title'])
            $thumb_attr['title'] = $atts['title'];
    
        return get_the_post_thumbnail($atts['id'], $atts['size'], $thumb_attr);
    }
    
    public static function get_post_anchor($atts, $content=null)
    {
        $atts = shortcode_atts( array(
            'id' => null,
            ), $atts );
        if (!$atts['id'])
            $atts['id'] = get_the_ID();
    
        if ($content) {
            $content = do_shortcode($content);
    
            $post_href = get_permalink($atts['id']);
            $post_title = get_post_field('post_title', $atts['id']);
            $content = "<a href=\"$post_href\" title=\"$post_title\">$content</a>";
        }
    
        return $content;
    }
    
}
