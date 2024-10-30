<?php
	
    $wss_covid19_color1 = get_option('wss_covid19_color1');
    $wss_covid19_color2 = get_option('wss_covid19_color2');
?>
<div class="wss-covid19-accordion-wrap wss-covid19-bg-pdg">
	<div class="wss-covid19-block-heading">
		<h4><?php echo esc_html( $wss_covid19_label ) ?></h4>
	</div>
	<div class="wss-covid19-accordion" id="wss-covid19-accordion">
	  	<?php foreach ($wss_covid19_state_data as $wss_covid19_state_obj) { ?>
	  		<div class="card">
			    <div class="card-header" id="heading-countryInfo" 
			    	style="background: -moz-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
						background: -webkit-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
						background: -o-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
						background: -ms-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
						background: linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);" 
					>
			      	<h2 type="button" data-toggle="collapse" data-target="#wss-covid19-acc-<?php echo esc_html( str_replace(' ', '-', $wss_covid19_state_obj->state ) )?>" aria-expanded="false" aria-controls="wss-covid19-acc-<?php echo esc_html( str_replace(' ', '-', $wss_covid19_state_obj->state ) )?>">
			      	 <?php echo esc_html( $wss_covid19_state_obj->state ) ?> <i class="fas fa-plus"></i></h2>
			    </div>
			    <div id="wss-covid19-acc-<?php echo str_replace(' ', '-', esc_html( $wss_covid19_state_obj->state) )?>" class="wss-covid19-accordion-content collapse" aria-labelledby="heading-<?php echo str_replace(' ', '-', $wss_covid19_state_obj->state)?>" data-parent="#wss-covid19-accordion">
			      	<div class="card-body">
						<div class="wss-covid19-card wss-covid19-bg-pdg wss-covid19-card-v-1" style="background: <?php echo get_option('wss_covid19_color1') ?>;
							background: -moz-linear-gradient(44deg,<?php echo get_option('wss_covid19_color1') ?> 0%,<?php echo get_option('wss_covid19_color2') ?> 90%);
							background: -webkit-linear-gradient(44deg,<?php echo get_option('wss_covid19_color1') ?> 0%,<?php echo get_option('wss_covid19_color2') ?> 90%);
							background: -o-linear-gradient(44deg,<?php echo get_option('wss_covid19_color1') ?> 0%,<?php echo get_option('wss_covid19_color2') ?> 90%);
							background: -ms-linear-gradient(44deg,<?php echo get_option('wss_covid19_color1') ?> 0%,<?php echo get_option('wss_covid19_color2') ?> 90%);
							background: linear-gradient(44deg,<?php echo get_option('wss_covid19_color1') ?> 0%,<?php echo get_option('wss_covid19_color2') ?> 90%);">
								<div class="wss-covid19-card-inner">
									
									<div class="row">
										<div class="col">
											<div class="wss-covid19-card-number"><?php echo number_format( esc_html( $wss_covid19_state_obj->cases ) ) ?></div>
											<div class="wss-covid19-card-title">
												<?php esc_html_e('Confirmed','wss-covid19'); ?>
											</div>
										</div>
										<div class="col">
											<div class="wss-covid19-card-number"><?php echo number_format( esc_html( $wss_covid19_state_obj->deaths ) ) ?></div>
											<div class="wss-covid19-card-title">
												<?php esc_html_e('Deaths','wss-covid19'); ?>
											</div>
										</div>
										<div class="col">
											<div class="wss-covid19-card-number"><?php echo number_format(esc_html( $wss_covid19_state_obj->active ) ) ?></div>
											<div class="wss-covid19-card-title"><?php esc_html_e('active','wss-covid19'); ?></div>
										</div>
										<div class="col">
											<div class="wss-covid19-card-number"><?php echo number_format( esc_html( $wss_covid19_state_obj->todayCases ) ) ?></div>
											<div class="wss-covid19-card-title"><?php esc_html_e('Today Cases','wss-covid19'); ?></div>
										</div>
									</div>
								</div>
						</div>
			      	</div>
			    </div>
	  		</div>
	  	<?php } ?>
	</div>
</div>









