<?php
/**
 * Module Name: Margin
 * Module URI: http://www.siteeditor.org/design-editor/margin
 * Description: Margin Module For Design Editor
 * Author: Site Editor Team
 * Author URI: http://www.siteeditor.org
 * @since 1.0.0
 * @package SiteEditor
 * @category designEditor
 */

/**
 * Class SedDesignEditorMargin
 */
final class SedDesignEditorMargin {

    /**
     * Capability required to access margin fields
     *
     * @var string
     */
    public $capability = 'manage_options';

    /**
     * Margin fields option group
     *
     * @access private
     * @var array
     */
    private $option_group = 'margin';

    /**
     * This group title
     *
     * @access public
     * @var array
     */
    public $title = '';

    /**
     * this group description
     *
     * @access public
     * @var array
     */
    public $description = '';

    /**
     * prefix for controls ids for prevent conflict
     *
     * @var string
     * @access public
     */
    public $control_prefix = 'sed_margin';

    /**
     * SedDesignEditorMargin constructor.
     */
    public function __construct(){

        $this->title = __("Margin" , "site-editor");

        $this->description = __("Add margin To each dom element" , "site-editor");

        add_action( "sed_app_register"          , array( $this , 'register_group' ) , -9999 );

        add_action( "sed_app_register"          , array( $this , 'register_options' ) );

        add_action( "sed_after_init_manager"    , array( $this , 'register_components' ) , 100 , 1 );

    }

    /**
     * Register Controls && Fields
     *
     * @access public
     * @since 1.0.0
     */
    public function register_components(){

        require_once dirname( __FILE__ ) . DS . 'includes' . DS . 'site-editor-margin-top-control.class.php';

        require_once dirname( __FILE__ ) . DS . 'includes' . DS . 'site-editor-margin-top-field.class.php';

        require_once dirname( __FILE__ ) . DS . 'includes' . DS . 'site-editor-margin-right-control.class.php';

        require_once dirname( __FILE__ ) . DS . 'includes' . DS . 'site-editor-margin-right-field.class.php';

        require_once dirname( __FILE__ ) . DS . 'includes' . DS . 'site-editor-margin-bottom-control.class.php';

        require_once dirname( __FILE__ ) . DS . 'includes' . DS . 'site-editor-margin-bottom-field.class.php';

        require_once dirname( __FILE__ ) . DS . 'includes' . DS . 'site-editor-margin-left-control.class.php';

        require_once dirname( __FILE__ ) . DS . 'includes' . DS . 'site-editor-margin-left-field.class.php';

        require_once dirname( __FILE__ ) . DS . 'includes' . DS . 'site-editor-margin-lock-control.class.php';

        require_once dirname( __FILE__ ) . DS . 'includes' . DS . 'site-editor-margin-lock-field.class.php';

    }

    /**
     * Register Default Margin Group
     *
     * @access public
     * @since 1.0.0
     */
    public function register_group(){

        SED()->editor->manager->add_group( $this->option_group , array(
            'capability'        => $this->capability,
            'theme_supports'    => '',
            'title'             => $this->title ,
            'description'       => $this->description ,
            'type'              => 'default',
        ));

    }

    /**
     * Register Options For Margin Group
     *
     * @access public
     * @since 1.0.0
     */
    public function register_options(){

        $panels = array();

        /*$lock_id = "sed_pb_".$this->id."_margin_lock";

        $spinner_class = 'sed-margin-spinner-' . $this->id;
        $spinner_class_selector = '.' . $spinner_class;
        $sh_name = $this->id;
        $sh_name_c = $sh_name. "_margin_";

        $controls = array( $sh_name_c . "top" , $sh_name_c . "right" , $sh_name_c . "left" , $sh_name_c . "bottom" );

        $this->controls['margin'] = array();*/

        $fields = array(

            'margin_top' => array(
                "type"              => "margin-top" ,
                "label"             => __('Top', 'site-editor'),
                "description"       => __("Spacing: Module Spacing from top , left , bottom , right.", "site-editor"),
                /*'atts'  => array(
                    "class" =>   $spinner_class
                ) ,
                'control_param'     =>  array(
                    'lock'    => array(
                        'id'       => $lock_id,
                        'spinner'  => $spinner_class_selector,
                        'controls' => array( $sh_name_c . "right" , $sh_name_c . "left" , $sh_name_c . "bottom" )
                    ),
                    'min'   =>  0 ,
                    
                    //'max'     => 100,
                    //'step'    => 2,
                    //'page'    => 5
                ),*/           
            ),

            'margin_right' => array(
                "type"              => "margin-right" ,
                "label"             => ( is_rtl() ) ? __('Right', 'site-editor') : __('Left', 'site-editor'),
                "description"       => __("Spacing: Module Spacing from top , left , bottom , right.", "site-editor"),
                /*'atts'  => array(
                    "class" =>   $spinner_class
                ) ,
                'control_param'     =>  array(
                    'lock'    => array(
                        'id'       => $lock_id,
                        'spinner'  => $spinner_class_selector,
                        'controls' => array( $sh_name_c . "top" , $sh_name_c . "left" , $sh_name_c . "bottom" )
                    ),
                    'min'   =>  0 ,
                    
                    //'max'     => 100,
                    //'step'    => 2,
                    //'page'    => 5
                ),*/           
            ),

            'margin_bottom' => array(
                "type"              => "margin-bottom" ,
                "label"             => __('Bottom', 'site-editor'),
                "description"       => __("Spacing: Module Spacing from top , left , bottom , right.", "site-editor"),
                /*'atts'  => array(
                    "class" =>   $spinner_class
                ) ,
                'control_param'     =>  array(
                    'lock'    => array(
                        'id'       => $lock_id,
                        'spinner'  => $spinner_class_selector,
                        'controls' => array( $sh_name_c . "top" , $sh_name_c . "right" , $sh_name_c . "left" )
                    ),
                    'min'   =>  0 ,
                    
                    //'max'     => 100,
                    //'step'    => 2,
                    //'page'    => 5
                ),*/           
            ),

            'margin_left' => array(
                "type"              => "margin-left" ,
                "label"             => ( is_rtl() ) ? __('Left', 'site-editor') : __('Right', 'site-editor'),
                "description"       => __("Spacing: Module Spacing from top , left , bottom , right.", "site-editor"),
                /*'atts'  => array(
                    "class" =>   $spinner_class
                ) ,
                'control_param'     =>  array(
                    'lock'    => array(
                        'id'       => $lock_id,
                        'spinner'  => $spinner_class_selector,
                        'controls' => array( $sh_name_c . "top" , $sh_name_c . "right" , $sh_name_c . "bottom" )
                    ),
                    'min'   =>  0 ,
                    
                    //'max'     => 100,
                    //'step'    => 2,
                    //'page'    => 5
                ),*/           
            ),

        );


        $fields = apply_filters( 'sed_margin_options_fields_filter' , $fields );

        $panels = apply_filters( 'sed_margin_options_panels_filter' , $panels );

        $new_options = sed_options()->fix_controls_panels_ids( $fields , $panels , $this->control_prefix );

        $new_params = $new_options['fields'];

        $new_panels = $new_options['panels'];

        sed_options()->add_fields( $new_params );

        sed_options()->add_panels( $new_panels );

    }

}

new SedDesignEditorMargin();
