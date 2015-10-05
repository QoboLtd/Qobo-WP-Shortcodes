<?php
namespace Qobo\Shortcodes;

class Text
{
    
    public static function trim($atts, $content=null)
    {
        $atts = shortcode_atts( array(
            'chars' => 0,
            'words' => 0,
            'suffix' => '',
            'strip_html' => 0,
            'strip_shortcodes' => 0,
            ), $atts );
    
        if ($content) {
            $content = do_shortcode($content);
            $is_trimmed = 0;
    
            if (!empty($atts['chars']) && strlen($content)>$atts['chars']) {
                $content = substr($content, 0, $atts['chars']);
                $is_trimmed = 1;
            }
            if (!empty($atts['words'])) {
                $content_bywords = explode(' ', $content);
                if (sizeof($content_bywords)>$atts['words']) {
                    $content = implode(' ', array_slice($content_bywords, 0, $atts['words']));
                    $is_trimmed = 1;
                }
            }
            if (!empty($atts['strip_html']))
                $content = wp_strip_all_tags($content);
            if ($is_trimmed)
            	$content = rtrim($content).$atts['suffix'];
            if (!empty($atts['strip_shortcodes']))
                $content = strip_shortcodes($content);
        }
    
        return $content;
    }
    
}
