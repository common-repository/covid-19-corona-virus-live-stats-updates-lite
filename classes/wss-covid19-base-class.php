<?php 

/*
    Exit if accessed directly
*/

if ( ! defined( 'ABSPATH' ) ) exit;

if (! class_exists( 'WSS_Covid19_Base_Class' ) ){
/**
 * General actions class
 *
 * @since 1.0.0
 */
class WSS_Covid19_Base_Class{

        const WSS_AJAX_PREFIX = 'wp_ajax_';
        const WSS_AJAX_NOPRIV_PREFIX = 'wp_ajax_nopriv_';
        const WSS_API_BASE = 'https://9kzzzfwgnwgef8dc.disease.sh/v2';

        /**
         * Setup Connection data
         *
         * @since 1.0.0
         */
        public function __construct(){

        }
        /**
             * Add ajax action for short
             * @param $hook
             * @param $callback
             * @param $priv
             * @param $no_priv
             */
        public function wss_covid19_add_ajax($hook, $callback, $priv = true, $no_priv = true, $priority = 10, $accepted_args = 1) {
                if ($priv) $this->wss_covid19_add_action(self::WSS_AJAX_PREFIX . $hook, $callback, $priority, $accepted_args);
                if ($no_priv) $this->wss_covid19_add_action(self::WSS_AJAX_NOPRIV_PREFIX . $hook, $callback, $priority, $accepted_args);
        }
        /**
         * Add an action hook
         * @param $hook
         * @param $callback
         * @param $priority
         * @param $accepted_args
        */
        public function wss_covid19_add_action($hook, $callback, $priority = 10, $accepted_args = 1) {
            add_action($hook, array(
                $this,
                $callback
            ) , $priority, $accepted_args);
        }
        /**
         * Add a filter hook
         * @param $hook
         * @param $callback
         * @param $priority
         * @param $accepted_args
        */
        public function wss_covid19_add_filter($hook, $callback, $priority = 10, $accepted_args = 1) {
            add_filter($hook, array(
                $this,
                $callback
            ) , $priority, $accepted_args);
        }
        /**
         * enqueue existed style
         * @param $shortcode_name
         * @param $callback_function
        */
        public function wss_covid19_register_shortcode( $shortcode_name,$callback_function ) {
            add_shortcode($shortcode_name,array( 
                      $this,
                      $callback_function
                    ));
        }
        public function wss_covid19_get_countries_data( $country = '',$sort = 'deaths' ){

            if(!empty($country)){

                $wss_country_transient = get_transient( 'wss_covid19_t_api_'.$country );
                    
                if( ! empty(  $wss_country_transient ) ) {
                    
                    // The function will return here every time after the first time it is run, until the transient expires.
                    return  $wss_country_transient;

                    // Need to make api call if transient is empty
                } else {

                        $wss_api_url = self::WSS_API_BASE.'/countries/'.$country;
                        // Call the API.
                        $covid19_data       = wp_remote_get( $wss_api_url );
                        // get API data 
                        if(!empty($covid19_data) &&  !is_wp_error( $covid19_data ) ){

                            $covid19_data_body  = utf8_encode( wp_remote_retrieve_body( $covid19_data ) );
                            
                            // Save the API response so we don't have to call again until tomorrow.
                            set_transient( 'wss_covid19_t_api_'.$country, $covid19_data_body, HOUR_IN_SECONDS );
                        }
                        //The function will return here the first time it is run, and then once again, each time the transient expires.
                        return $covid19_data_body;
                    }
                        
                        
                }else{

                    $wss_transient = get_transient( 'wss_covid19_t_api' );
                    if( ! empty( $wss_transient ) ) {
                
                        // The function will return here every time after the first time it is run, until the transient expires.
                        return $wss_transient;

                    // Need to make api call if transient is empty
                    } else {
              
                        $wss_api_url = self::WSS_API_BASE.'/countries?sort='.$sort;
                        // Call the API.
                        $covid19_data       = wp_remote_get( $wss_api_url );
                        // get API data 
                        if(!empty($covid19_data) &&  !is_wp_error( $covid19_data ) ){
                            
                            $covid19_data_body  = utf8_encode( wp_remote_retrieve_body( $covid19_data ) );
                            // Save the API response so we don't have to call again until tomorrow.
                            set_transient( 'wss_covid19_t_api', $covid19_data_body, HOUR_IN_SECONDS );
                        }
                    }
                    //The function will return here the first time it is run, and then once again, each time the transient expires.
                    return $covid19_data_body;
            }
            
        }
        public function wss_covid19_get_state_data(){

                $wss_state_transient = get_transient( 'wss_covid19_state_api');
                    
                if( ! empty(  $wss_state_transient ) ) {
                    
                    // The function will return here every time after the first time it is run, until the transient expires.
                    return  $wss_state_transient;

                    // Need to make api call if transient is empty
                }else {
              
                        $wss_api_url = self::WSS_API_BASE.'/states';
                        // Call the API.
                        $covid19_data       = wp_remote_get( $wss_api_url );
                        // get API data 
                        if(!empty($covid19_data) &&  !is_wp_error( $covid19_data ) ){
                            $covid19_data_body  = utf8_encode( wp_remote_retrieve_body( $covid19_data ) );
                            // Save the API response so we don't have to call again until tomorrow.
                            set_transient( 'wss_covid19_state_api', $covid19_data_body, HOUR_IN_SECONDS );
                        }
                    }
                    //The function will return here the first time it is run, and then once again, each time the transient expires.
                    return $covid19_data_body;
            
        }
        public function wss_covid19_get_global_data(){

            $wss_transient = get_transient( 'wss_covid19_global_api' );
  
            // Yep!  Just return it and we're done.
            if( ! empty( $wss_transient ) ) {
                
                // The function will return here every time after the first time it is run, until the transient expires.
                return $wss_transient;

                // Need to make api call if transient is empty
            } else {

                $wss_api_url = self::WSS_API_BASE.'/all';
                
                // Call the API.
                $covid19_data       = wp_remote_get( $wss_api_url );
                if(!empty($covid19_data) &&  !is_wp_error( $covid19_data ) ){

                    $covid19_data_body  = wp_remote_retrieve_body( $covid19_data );
                
                    // Save the API response so we don't have to call again until tomorrow.
                    set_transient( 'wss_covid19_global_api', $covid19_data_body, HOUR_IN_SECONDS );
                }
                //The function will return here the first time it is run, and then once again, each time the transient expires.
                return $covid19_data_body;
                
            }
        }
        public function wss_covid19_get_jhucsse_data(){

            $wss_transient = get_transient( 'wss_covid19_jhucsse_api' );
  
            // Yep!  Just return it and we're done.
            if( ! empty( $wss_transient ) ) {
                
                // The function will return here every time after the first time it is run, until the transient expires.
                return $wss_transient;

                // Need to make api call if transient is empty
            } else {

                $wss_api_url = self::WSS_API_BASE.'/v2/jhucsse';
                
                // Call the API.
                $covid19_data       = wp_remote_get( $wss_api_url );
                if(!empty($covid19_data) &&  !is_wp_error( $covid19_data ) ){

                    $covid19_data_body  = wp_remote_retrieve_body( $covid19_data );
                
                    // Save the API response so we don't have to call again until tomorrow.
                    set_transient( 'wss_covid19_jhucsse_api', $covid19_data_body, HOUR_IN_SECONDS );
                }
                // The function will return here the first time it is run, and then once again, each time the transient expires.
                return $covid19_data_body;
                
            }
        }
        public function wss_covid19_get_historical_data(){

            $wss_transient = get_transient( 'wss_covid19_historical_api' );
  
            // Yep!  Just return it and we're done.
            if( ! empty( $wss_transient ) ) {
                
                // The function will return here every time after the first time it is run, until the transient expires.
                return $wss_transient;

                // Need to make api call if transient is empty
            } else {

                $wss_api_url = self::WSS_API_BASE.'/v2/historical';
                
                // Call the API.
                $covid19_data       = wp_remote_get( $wss_api_url );
                if(!empty($covid19_data) &&  !is_wp_error( $covid19_data ) ){

                    $covid19_data_body  = wp_remote_retrieve_body( $covid19_data );
                
                    // Save the API response so we don't have to call again until tomorrow.
                    set_transient( 'wss_covid19_historical_api', $covid19_data_body, HOUR_IN_SECONDS );
                }
                //The function will return here the first time it is run, and then once again, each time the transient expires.
                return $covid19_data_body;
                
            }
        }

    }    

}