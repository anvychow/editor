<?php
/**
 * SiteEditor Control: external-background-image.
 *
 * @package     SiteEditor
 * @subpackage  Options
 * @since       1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SiteEditorExternalBackgroundImageControl' ) ) {

    if( ! class_exists( 'SiteEditorTextControl' ) ) {
        require_once SED_EXT_PATH . '/options-engine/includes/controls/site-editor-text-control.class.php';
    }

	/**
	 * External Background Image control
	 *
	 * Class SiteEditorExternalBackgroundImageControl
	 */
	class SiteEditorExternalBackgroundImageControl extends SiteEditorTextControl {

		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'external-background-image';

        /**
         * The control category.
         *
         * @access public
         * @var string
         */
        public $category = 'style-editor';

        /**
         * The control is style option ?
         *
         * @access public
         * @var string
         */
        public $is_style_setting = true;

        /**
         * The control js render type
         *
         * @access public
         * @var string
         */
        public $js_type = "text";

        /**
         * Css Selector for apply style
         *
         * @access public
         * @var string
         */
        public $selector = "";

        /**
         * Css Style Property
         *
         * @access public
         * @var string
         */
        public $style_props = "external-background-image";



        /**
         * Get the data to export to the client via JSON.
         *
         * @since 1.0.0
         *
         * @return array Array of parameters passed to the JavaScript.
         */
        public function json() {

            $json_array = parent::json();
            $json_array['type'] = $this->js_type;

            if( !empty( $this->style_props ) )
                $json_array['style_props'] = $this->style_props;

            if( !empty( $this->selector ) )
                $json_array['selector'] = $this->selector;

            return $json_array;

        }

	}
}

sed_options()->register_control_type( 'external-background-image' , 'SiteEditorExternalBackgroundImageControl' );
