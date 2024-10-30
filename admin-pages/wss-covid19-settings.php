<?php
  /*
  * Exit if accessed directly
  */
  if ( ! defined( 'ABSPATH' ) ) exit;
  
  global $wss_covid19_obj;
  if(isset($_POST['save_setting'])){

    $wss_covid19_color1    = sanitize_text_field( $_POST['wss_covid19_color1'] );
    $wss_covid19_color2    = sanitize_text_field( $_POST['wss_covid19_color2'] );
    update_option('wss_covid19_color1', $wss_covid19_color1);
    update_option('wss_covid19_color2', $wss_covid19_color2);
    $update_msg = esc_html__('Settings have been Saved','wss-covid19');
  }
?>

<div class="wrap">

  <h2 class='opt-title' id="title">
    
    <span class="intro-text"><?php esc_html_e( 'Covid-19 Settings Page', 'wss-covid19' ); ?></span>
  </h2>

    <?php

      if ( isset( $update_msg ) ){

        echo '<div id="setting-error-settings_updated" class="notice updated below-h2"><p>'.$update_msg.'</p></div>';
      } 
      
      if(isset($msg)){

        echo '<div id="setting-error-settings_updated" class="updated below-h2"><p>'.$msg.'</p></div>';

      }

    ?>
    <form action="" method="post">
    
      <table width="100%">
        <tr>
          <td><?php esc_html_e('Plugin Primary Color', 'wss-covid19'); ?></td>
          <td><input type="text" value="<?php echo get_option('wss_covid19_color1') ?>" class="colors" name="wss_covid19_color1"/></td>
        </tr>
        <tr>
          <td><?php esc_html_e('Plugin Secondary Color', 'wss-covid19'); ?></td>
           <td><input type="text" value="<?php echo get_option('wss_covid19_color2') ?>" class="colors" name="wss_covid19_color2"/></td>
        </tr>
        
        <tr>
          <td><input type="submit" name="save_setting" class="button button-primary" value="Save Setting"></td>
        </tr>
      </table>
    </form> 
      <p><?php esc_html_e('Use below cuntry to fetch country updates','wss-covid19'); ?></p>
      
      [covid19-country-updates country=France country_list=0 layout=3 label="France Covid19 Data" colors="#d80027,#0052b4"] or [covid19-country-updates country=FR country_list=0 layout=3 label="France Covid19 Data" colors="#d80027,#0052b4"]


    <h2><?php esc_html_e('Countries Reference','wss-covid19'); ?></h2>
    <table style="width: 50%" class="wp-list-table widefat fixed striped">
      <tr>
        <td  width="70"><b> <?php esc_html_e('Country','wss-covid19'); ?></b></td>
        <td  width="50"><b> <?php esc_html_e('ID','wss-covid19'); ?></b></td>
        <td  width="50"><b> <?php esc_html_e('iso2','wss-covid19'); ?></b></td>
        <td  width="50"><b> <?php esc_html_e('iso3','wss-covid19'); ?></b></td>
      </tr>
      <?php 
      $covid19_country_data = json_decode( $wss_covid19_obj->wss_covid19_get_countries_data() ); 
      foreach ($covid19_country_data as $country) {
      ?>
      <tr>
        <td>
          <?php echo esc_html( $country->country ) ?>
        </td>
        <td width="50">
          <?php echo esc_html( $country->countryInfo->_id ) ?>
        </td>
        <td  width="50">
          <?php echo esc_html( $country->countryInfo->iso2 ) ?>
        </td>
        <td  width="50">
          <?php echo esc_html( $country->countryInfo->iso3 ) ?>
        </td>
      </tr>
    <?php } ?>
    </table>
    <h2><?php esc_html_e('State Reference','wss-covid19'); ?></h2>
    <p><?php  esc_html_e('Use below State to fetch State updates','wss-covid19'); ?></p>

    <table style="width: 50%" class="wp-list-table widefat fixed striped">
      <tr>
        <td><b><?php esc_html_e('Country','wss-covid19'); ?></b></td>
        <td><b><?php esc_html_e('Province','wss-covid19'); ?></b></td>
        
      </tr>
      <?php 
      $covid19_state_data = json_decode( $wss_covid19_obj->wss_covid19_get_countries_hostory_data() ); 
      foreach ($covid19_state_data as $state) {
      ?>
      <tr>
        <td>
          <?php echo esc_html( $state->country ) ?>
        </td>
        <td>
          <?php echo esc_html( $state->province ) ?>
        </td>
      </tr>
    <?php } ?>
    </table>
</div>
    