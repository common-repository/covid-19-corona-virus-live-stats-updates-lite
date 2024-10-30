<?php
    $wss_covid19_color1 = get_option('wss_covid19_color1');
    $wss_covid19_color2 = get_option('wss_covid19_color2');
?>
<div class="wss-covid19-table-sheet wss-covid19-bg-pdg" id="wss-covid19-table-sheet">
				<div class="wss-covid19-table-sheet-wrap">
				  	<div class="wss-covid19-table-sheet-header" 
				  		 	style="
								background: -moz-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
								background: -webkit-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
								background: -o-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
								background: -ms-linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);
								background: linear-gradient(44deg,<?php echo esc_html( $wss_covid19_color1 ) ?> 0%,<?php echo esc_html( $wss_covid19_color2 ) ?> 90%);" 
						>
				    	<h4><?php echo esc_html( $wss_covid19_label ) ?></h4>
				  	</div>
				  	<div class="wss-covid19-table-wrap">
					    <div class="table-wrapper">
					      	<table class="display responsive nowrap wss-covid19-table" id="wss-covid19-table">
						        <thead>
						          	<tr>
						            	<th><?php esc_html_e('Country','wss-covid19') ?></th>
						            	<th><?php esc_html_e('Cases','wss-covid19') ?> </th>
						            	<th><?php esc_html_e('Today','wss-covid19') ?> </th>
						            	<th><?php esc_html_e('Active','wss-covid19') ?> </th>
						            	<th><?php esc_html_e('Deaths','wss-covid19') ?> </th>
						            	<th><?php esc_html_e('Today','wss-covid19') ?> </th>
						            	<th><?php esc_html_e('Recovered','wss-covid19') ?> </th>
						          	</tr>
						        </thead>
						        <tbody>
						        	<?php foreach ($wss_covid19_country_data as $wss_covid19_country_obj) { ?>
							          	<tr>
								            <td><?php echo esc_html( $wss_covid19_country_obj->country ) ?></td>
								            <td><?php echo number_format( esc_html( $wss_covid19_country_obj->cases ) ) ?></td>
								            <td><?php echo number_format( esc_html( $wss_covid19_country_obj->todayCases ) ) ?></td>
								            <td><?php echo number_format( esc_html( $wss_covid19_country_obj->active ) ) ?></td>
								            <td><?php echo number_format( esc_html( $wss_covid19_country_obj->deaths ) ) ?></td>
								            <td><?php echo number_format( esc_html( $wss_covid19_country_obj->todayDeaths ) ) ?></td>
								            <td><?php echo number_format( esc_html( $wss_covid19_country_obj->recovered ) ) ?></td>
							          	</tr>
							        <?php } ?>
						        </tbody>
					      	</table>
					    </div>
				  	</div>
				</div>
			</div>