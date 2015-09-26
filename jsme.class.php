<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

class JSME
{
    private $instances = array();

    public function __construct() {
        add_action('plugins_loaded', array($this, 'init'));
        add_action('init', array($this, 'register_shortcodes'));
        add_action('wp_footer', array($this, 'footer'));
    }

    public function init() {
        // set text domain
        //load_plugin_textdomain('osi', false, basename(dirname(__FILE__)).'/languages' );
    }

    public function register_shortcodes() {
        add_shortcode('jsme', array($this, 'process_shortcode'));
        add_filter('wpcf7_form_elements', array($this, 'wpcf7_form_elements'));
    }

    public function process_shortcode($atts) {
        $atts = shortcode_atts(array(
            'id' => $this->generate_id(),
            'width' => 380,
            'height' => 340,
            'export' => 'molfile'
        ), $atts);
        $this->instances[$atts['id']] = $atts;

        wp_register_script( 'jsme.nocache.js', plugins_url( 'jsme/jsme.nocache.js', __FILE__ ), array(), '2015-06-14' );
        wp_enqueue_script( 'jsme.nocache.js' );

        return $this->include_template('instance.php', $atts, true);
    }

    public function footer() {
        $this->include_template('footer.php', array(
            'instances' => $this->instances
        ));
    }

    public function wpcf7_form_elements($form) {
        $form = do_shortcode($form);
        return $form;
    }

    protected function include_template($template, $vars = array(), $return = false) {
        if ($return) ob_start();
        extract($vars);
        include("templates/".$template);
        if ($return) return ob_get_clean();
    }

    protected function generate_id($prefix = 'my_jsme') {
        $i = 1;
        do {
            $id = $prefix . $i;
            $i++;
        } while (isset($this->instances[$id]));
        return $id;
    }
}

new JSME;