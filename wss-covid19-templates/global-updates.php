<?php 
      $wss_covid19_color1 = get_option('wss_covid19_color1');
      $wss_covid19_color2 = get_option('wss_covid19_color2');
?>
<div class="wss-covid19-card wss-covid19-bg-pdg wss-covid19-card-v-1 wss-covid19-global"
			style=" 
					background: -moz-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
					background: -webkit-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
					background: -o-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
					background: -ms-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
					background: linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);" 
		
	>
	<div class="wss-covid19-card-img">
		<img src="<?php echo plugins_url('images/wss-covid19-flags/globe.svg',dirname(__FILE__)); ?>" alt="<?php echo esc_html( $default_country_data->country ) ?> Stats">
	</div>
	<div class="wss-covid19-card-heading">
		<h4><?php echo esc_html( $wss_covid19_label ) ?></h4>
	</div>
	<div class="wss-covid19-cards-wrap">
		<div class="row">
			<div class="col todaycases">
				<div class="wss-covid19-card-horizontal">
					<div class="row">

						<div class="col">
							<div class="wss-covid19-card-title"><?php esc_html_e('Total Cases','wss-covid19') ?></div>
							<div class="wss-covid19-card-number"><?php echo number_format( esc_html( $wss_covid19_global_data->cases ) ) ?></div>
						</div>
						<div class="col-auto">
							<i class="far fa-sad-tear fa-2x"></i>
						</div>
					</div>
				</div>
			</div>
			<div class="col recovered">
				<div class="wss-covid19-card-horizontal">
					<div class="row">
						<div class="col">
							<div class="wss-covid19-card-title"><?php esc_html_e('Recovered','wss-covid19') ?></div>
							<div class="wss-covid19-card-number"><?php echo number_format( esc_html( $wss_covid19_global_data->recovered ) ) ?></div>
						</div>
						<div class="col-auto">
							<i class="far fa-smile fa-2x"></i>
						</div>
					</div>
				</div>
			</div>
			<div class="col active-cases">
				<div class="wss-covid19-card-horizontal">
					<div class="row">
						<div class="col">
							<div class="wss-covid19-card-title"><?php esc_html_e('Active Cases','wss-covid19') ?></div>
							<div class="wss-covid19-card-number"><?php echo number_format( esc_html( $wss_covid19_global_data->active ) ) ?></div>
						</div>
						<div class="col-auto">
							<i class="far fa-grimace fa-2x"></i>
						</div>
					</div>
				</div>
			</div>
			<div class="col deaths">
				<div class="wss-covid19-card-horizontal">
					<div class="row">
						<div class="col">
							<div class="wss-covid19-card-title"><?php esc_html_e('Total Deaths','wss-covid19') ?></div>
							<div class="wss-covid19-card-number"><?php echo number_format( esc_html( $wss_covid19_global_data->deaths ) ) ?></div>
						</div>
						<div class="col-auto">
							<i class="far fa-sad-cry fa-2x"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>