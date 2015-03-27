<?php
namespace Qobo\Shortcodes;

class Shortcodes
{
    const SC_SUFFIX = 'qbsc-';
    
    public static function add_shortcodes()
    {
        add_shortcode(self::SC_SUFFIX.'get-post-field', 'Qobo\\Shortcodes\\Post::get_post_field');
        add_shortcode(self::SC_SUFFIX.'get-post-thumbnail', 'Qobo\\Shortcodes\\Post::get_post_thumbnail');
        add_shortcode(self::SC_SUFFIX.'get-post-anchor', 'Qobo\\Shortcodes\\Post::get_post_anchor');
        add_shortcode(self::SC_SUFFIX.'trim', 'Qobo\\Shortcodes\\Text::trim');
    }
    
    public static function add_shortcodes_ultimate()
    {
        add_action('plugins_loaded', 'Qobo\\Shortcodes\\Shortcodes::add_shortcodes_ultimate_pl');
    }
    
    public static function add_shortcodes_ultimate_pl()
    {
        if (class_exists(ShortcodesUltimate::SU_CLASS)) {
            add_filter('su/data/groups', 'Qobo\\Shortcodes\\ShortcodesUltimate::add_groups');
            add_filter('su/data/shortcodes', 'Qobo\\Shortcodes\\ShortcodesUltimate::register_shortcodes');
            add_filter('su/data/shortcodes', 'Qobo\\Shortcodes\\ShortcodesUltimate::sort_shortcodes');
        }
    }
}
