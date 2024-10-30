<?php
/*
    Exit if accessed directly
*/
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Approve_Form_Class' ) ) {

class WSS_Covid19_Class extends WSS_Covid19_Base_Class{
    /**
     * Setup the plugin data
     *
     * @since 1.0.0
     */
    public function __construct() {
      
      $this->wss_covid19_add_action( 'wp_loaded', 'wss_covid19_front_reg_scripts' );
      $this->wss_covid19_add_action( 'admin_menu','wss_covid19_admin_menus' );
      $this->wss_covid19_add_action( 'wp_enqueue_scripts','wss_covid19_front_scripts' );   
      $this->wss_covid19_add_action( 'admin_enqueue_scripts','wss_covid19_admin_scripts' );   
      $this->wss_covid19_add_action( 'wp_enqueue_scripts','wss_covid19_front_styles' );
      
      $this->wss_covid19_register_shortcode( 'covid19-global-updates','wss_covid19_global_updates' );
      
      $this->wss_covid19_register_shortcode( 'covid19-country-updates','wss_covid19_country_updates' );        
      $this->wss_covid19_register_shortcode( 'covid19-state-updates','wss_covid19_state_updates' );        
      $this->wss_covid19_register_shortcode( 'covid19-list-countries','wss_covid19_list_countries' );        
      $this->wss_covid19_register_shortcode( 'covid19-countries-text','wss_covid19_countries_text_data' );      
      $this->wss_covid19_add_action( 'plugins_loaded','wss_covid19_localizations' );  
    }
    /**
     * Setup localization 
     * @access public
     * @param void
     * @since 1.0.0
     */
    public function wss_covid19_localizations(){

        $plugin_dir = basename(dirname(dirname( __FILE__ )));
        load_plugin_textdomain( 'wss-covid19', false , $plugin_dir . '/lang/');
    }
    /**
     * Get World Data
     *
     * @since 1.0.0
     */
    public function wss_covid19_global_updates($atts){
      extract(shortcode_atts(
                array(

                  'label'         => '',
                  
                ), $atts)); 
      
      $covid19_global_data =  json_decode( $this->wss_covid19_get_global_data() );
            
      return $this->wss_covid19_get_template( 'global-updates.php',

                array( 

                  'wss_covid19_global_data' => $covid19_global_data,
                  'wss_covid19_label'       => $label,
                  'wss_covid19_mode'        => $mode,
                  'wss_covid19_colors'      => explode(',', $colors),

                ) );
    }
    /**
     * Get Single Country data
     *
     * @since 1.0.0
    */
    public function wss_covid19_country_updates( $atts ){


      extract(shortcode_atts(
                array(

                  'country'       => 'USA',
                  'label'         => ''
                  
                  
                ), $atts)); 

      $covid19_country_data         =  json_decode( $this->wss_covid19_get_countries_data() );
      $covid19_default_country_data =  json_decode( $this->wss_covid19_get_countries_data($country) );
      return $this->wss_covid19_get_template( 'country-updates.php',

                        array(  
                                'wss_covid19_country_data'          => $covid19_country_data,
                                'wss_covid19_default_country_data'  => $covid19_default_country_data,
                                'wss_covid19_country_list'          => $country_list,
                                'wss_covid19_layout'                => $layout,
                                'wss_covid19_defaul_country'        => $country,
                                'wss_covid19_mode'                  => $mode,
                                'wss_covid19_colors'                => explode(',' , $colors),
                                'wss_covid19_label'                 => $label,
                            ) );
    }
    /**
     * Get USA State data
     *
     * @since 1.0.0
    */
    public function wss_covid19_state_updates( $atts ){


      extract(shortcode_atts(
                array(

                  'label'    => '',
                  
                ), $atts)); 

      $covid19_state_data  =  json_decode( $this->wss_covid19_get_state_data() );
      return $this->wss_covid19_get_template( 'state-list.php',

                        array(  
                                'wss_covid19_state_data'    => $covid19_state_data,
                                'wss_covid19_label'         => $label,
                            ) );
    }
    /**
     * Get All countries data in drop down format
     *
     * @since 1.0.0
    */
    public function wss_covid19_list_countries( $atts ){


      extract(shortcode_atts(
                array(
                  
                  'label'    => '',
                ), $atts)); 
      
      $covid19_country_data =  json_decode( $this->wss_covid19_get_countries_data() );

      return $this->wss_covid19_get_template( 'countries-list.php',

                        array(  'wss_covid19_country_data'  => $covid19_country_data,
                                'wss_covid19_label'         => $label,
                            ) );
    }
    /**
     * Get single world Text based data
     *
     * @since 1.0.0
    */
    public function wss_covid19_countries_text_data( $atts ){
      extract(shortcode_atts(
                array(
                  
                  'country'      => '',
                  'type'         => '',
                  'type_label'   => ''
                  
                ), $atts)); 
      $text_to_return = '';
      if(!empty($country)){

        $covid19_country_data =  json_decode( $this->wss_covid19_get_countries_data( $country ) );

       }else{

         $covid19_country_data =  json_decode( $this->wss_covid19_get_global_data() );
       }
     
      
      if( $type == "deaths_percent" ){
        
        $text_to_return = '<span class="wss-covid19-text">'.number_format(( $covid19_country_data->deaths / $covid19_country_data->cases )*100,1).'%</span>';
      
      }else if( $type == "recovered_percent" ){

        $text_to_return = '<span class="wss-covid19-text">'.number_format(( $covid19_country_data->recovered / $covid19_country_data->cases )*100,1).'%</span>';
      
      }else{

        $text_to_return =  '<span class="wss-covid19-text">'.$covid19_country_data->{$type}.'</span>';
      }
      return $text_to_return;

    }
    
    /**
     * Create admin menus
     *
     * @since 1.0.0
    */
    public static function wss_covid19_admin_menus() {
            
      add_menu_page( 'Covid19 Stats', __( 'Covid19 Stats' , 'wss-covid19' ), 'manage_options', 'wss-covid19-settings', array(
                       __CLASS__,
                      'wss_covid19_plugin_settings_page',

      ), plugins_url( 'images/wss-covid19.png',dirname(__FILE__) ) );
            
    }
    /**
     * Add Settings Page
     *
     * @access public
     * @param void
     * @return void
     * @since 1.0.0
     */
    public static function wss_covid19_plugin_settings_page() {
       
       require_once WSS_COVID19_ROOT_PATH . '/admin-pages/wss-covid19-settings.php';
    }
    /**
     * Add css on front end
     *
     * @since 1.0.0
    */
    public function wss_covid19_front_styles( ){

      wp_enqueue_style( 'bootstrap-style', plugins_url( 'css/bootstrap.css', dirname(__FILE__) ),false, WSS_COVID19_VERSION );
      wp_enqueue_style( 'fontawesome-style', plugins_url( 'css/fontawesome.min.css', dirname(__FILE__)),false, WSS_COVID19_VERSION );
      wp_enqueue_style( 'datatables-style',  plugins_url( 'css/datatables.min.css', dirname(__FILE__)), false, WSS_COVID19_VERSION );
      wp_enqueue_style( 'responsive-datatables-style',  plugins_url( 'css/responsive.bootstrap.min.css', dirname(__FILE__)), false, WSS_COVID19_VERSION );     
      wp_enqueue_style( 'select2-style', plugins_url( 'css/select2.min.css', dirname(__FILE__) ), false, WSS_COVID19_VERSION );
      wp_enqueue_style( 'wss-covid19-main-style', plugins_url( 'css/covid19-main.css', dirname(__FILE__) ), false, WSS_COVID19_VERSION );
    
    }
    /**
     * Add Scripts in Front site
     *
     * @access public
     * @param void
     * @return void
     * @since 1.0.0
     */
    public function wss_covid19_front_reg_scripts(){
        /*$wss_ajax_array = array(
                                        
                            'wss_ajaxurl'    => admin_url('admin-ajax.php'),
                          );*/
        wp_register_script ( 'wss-covid19-script', plugins_url('js/wss-covid19-script.js', dirname(__FILE__)), false, WSS_COVID19_VERSION,true );
        //wp_localize_script ( 'wss-covid19-script','wss_ajax_params', $wss_ajax_array);
    }
    /**
     * Add css on front end
     *
     * @since 1.0.0
    */
    public function wss_covid19_front_scripts(){
      
             
        wp_enqueue_script ( 'popper-js', plugins_url('js/popper.js', dirname(__FILE__)),  false, WSS_COVID19_VERSION,true);        
        wp_enqueue_script ( 'bootstrap-js', plugins_url('js/bootstrap.min.js', dirname(__FILE__)),  false, WSS_COVID19_VERSION,true);        
        wp_enqueue_script ( 'datatables-js', plugins_url('js/datatables.min.js', dirname(__FILE__)),  false, WSS_COVID19_VERSION,true);        
        wp_enqueue_script ( 'responsive-datatables-js', plugins_url('js/dataTables.responsive.min.js', dirname(__FILE__)),  false, WSS_COVID19_VERSION,true);        
        wp_enqueue_script ( 'wss-covid19-script');
    }
    /**
     * Add css on front end
     *
     * @since 1.0.0
    */
    public function wss_covid19_admin_scripts(){
       
      wp_enqueue_script(  'wp-color-picker' );     
      wp_enqueue_script ( 'wss-covid19-admin-script', plugins_url('js/wss-covid19-admin-script.js', dirname(__FILE__)), false, WSS_COVID19_VERSION,true );        
    }
    /**
     * Search for template and include it
     *
     * @since 1.0.0
    */
    public function wss_covid19_locate_template( $wss_template_name, $wss_template_path = '', $wss_default_path = '' ){

      // Set variable to search in  wss-covid19 folder of theme.
      if ( ! $wss_template_path ) :
        $wss_template_path = 'covid19-templates/';
      endif;

      // Set default plugin templates path.
      if ( ! $wss_default_path ) :
        $wss_default_path = WSS_COVID19_ROOT_PATH . '/wss-covid19-templates/'; // Path to the template folder
      endif;

      // Search template file in theme folder.
      $template = locate_template( array(
        $wss_template_path . $wss_template_name,
        $wss_template_name
      ) );

      // Get plugins template file.
      if ( ! $template ) :
        $template = $wss_default_path . $wss_template_name;
      endif;

      return apply_filters( 'wss_covid19_locate_'.$template, $template, $wss_template_name, $wss_template_path, $wss_default_path );

    }
    public function wss_covid19_get_template( $wss_template_name, $args = array(), $wss_tempate_path = '', $wss_default_path = '' ) {

      if ( is_array( $args ) && isset( $args ) ) :
        extract( $args );
      endif;

      $wss_template_file = $this->wss_covid19_locate_template( $wss_template_name, $wss_tempate_path, $wss_default_path );

      if ( ! file_exists( $wss_template_file ) ) :
        _doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $wss_template_file ), '1.0.0' );
        return;
      endif;

      ob_start();

      include( $wss_template_file );

      return ob_get_clean();

    }
      
  }
}