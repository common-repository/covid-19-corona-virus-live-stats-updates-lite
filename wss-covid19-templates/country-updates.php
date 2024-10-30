<?php
    $wss_covid19_color1 = get_option('wss_covid19_color1');
    $wss_covid19_color2 = get_option('wss_covid19_color2');
?>
			
<div class="wss-covid19-card wss-covid19-bg-pdg wss-covid19-card-v-1" style="
			background: -moz-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
				background: -webkit-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
				background: -o-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
				background: -ms-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
				background: linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);" 
		>
		<div class="wss-covid19-block-header">
			<div class="wss-covid19-block-heading">
				<h4><?php echo esc_html( $wss_covid19_label ) ?></h4>
			</div>
		</div>
		<div class="loading_<?php echo esc_html( $unique ) ?>" style="display: none">
			<div class="d-flex align-items-center">
				<strong><?php esc_html_e('Loading...','wss-covid19'); ?></strong>
				<div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
			</div>
		</div>
		<div class="wss-covid19-card-inner" id="covid19_updates_<?php echo esc_html( $wss_covid19_layout ) ?>_<?php echo esc_html( $unique ) ?>">
			<div class="wss-covid19-card-img">
				<img src="<?php echo plugins_url('images/wss-covid19-flags/'.strtolower( $wss_covid19_default_country_data->countryInfo->iso2).'.svg',dirname(__FILE__)); ?>" alt="<?php echo esc_html( $wss_covid19_default_country_data->country ) ?> Stats">
			</div>
			<div class="wss-covid19-card-heading">
				<h4><?php echo esc_html( $wss_covid19_default_country_data->country ) ?></h4>
			</div>
			<div class="row">
				<div class="col">
					<div class="wss-covid19-card-number"><?php echo number_format( esc_html( $wss_covid19_default_country_data->cases ) ) ?></div>
					<div class="wss-covid19-card-title">
						<?php esc_html_e('Confirmed','wss-covid19'); ?>
					</div>
				</div>
				<div class="col">
					<div class="wss-covid19-card-number"><?php echo number_format( esc_html( $wss_covid19_default_country_data->deaths ) ) ?></div>
					<div class="wss-covid19-card-title">
						<?php esc_html_e('Deaths','wss-covid19'); ?>
					</div>
				</div>
				<div class="col">
					<div class="wss-covid19-card-number"><?php echo number_format( esc_html( $wss_covid19_default_country_data->recovered ) ) ?></div>
					<div class="wss-covid19-card-title"><?php esc_html_e('Recovered','wss-covid19'); ?></div>
				</div>
				<div class="col">
					<div class="wss-covid19-card-number"><?php echo number_format( esc_html( $wss_covid19_default_country_data->critical ) ) ?></div>
					<div class="wss-covid19-card-title"><?php esc_html_e('Critical','wss-covid19'); ?></div>
				</div>
				<div class="col">
					<div class="wss-covid19-card-number"><?php echo number_format( esc_html( $wss_covid19_default_country_data->todayCases ) ) ?></div>
					<div class="wss-covid19-card-title"><?php esc_html_e('Today Cases','wss-covid19'); ?></div>
				</div>
			</div>
		</div>
</div>
		