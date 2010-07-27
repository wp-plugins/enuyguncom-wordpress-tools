<?php
	/*
	Plugin Name: Enuygun.com
	Plugin URI: http://www.enuygun.com/enuygun_wordpress.zip
	Description: Enuygun.com Wordpress Tools 
	Author: Ismail ASCI
	Version: 0.1
	Author URI: http://www.ismailasci.com/
	*/
	
	function enuygun_widget()	{
		//echo "My First Wordpress Plugin Works Fine.";
		$active_widget = get_option('enuygun_active_widget');
		$affiliate_code = get_option('enuygun_affiliate_code');
		
		$parameters  = 'utm_source=affiliate&utm_medium=wordpress&utm_campaign='.$_SERVER['HTTP_HOST'].'&affiliate='.$affiliate_code;
		
		if ($active_widget=='personal_loan')	{
			echo <<<STR
<li class="widget-container" style="text-align: center;list-style: none;">
<iframe src="http://www.enuygun.com/tools/wordpress/widgets/1/?type=personal_loan&{$parameters}" style="border:0px #FFFFFF none;" name="enuygun_iframe" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="222px" width="250px"></iframe>
</li>
STR;
		}
		
		elseif ($active_widget=='mortgage_loan')	{
			echo <<<STR
<li class="widget-container" style="text-align: center;list-style: none;">
<iframe src="http://www.enuygun.com/tools/wordpress/widgets/1/?type=mortgage_loan&{$parameters}" style="border:0px #FFFFFF none;" name="enuygun_iframe" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="272px" width="250px"></iframe>
</li>
STR;
		}
		
		elseif ($active_widget=='flight')	{
			echo <<<STR
<li class="widget-container" style="text-align: center;list-style: none;">
<iframe src="http://www.enuygun.com/tools/wordpress/widgets/1/?type=flight&{$parameters}" style="border:0px #FFFFFF none;" name="enuygun_iframe" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="280px" width="250px"></iframe>
</li>
STR;
		}
	}
	
	/* When plugin is activated */

	register_activation_hook(__FILE__,'enuygun_install');

	/* When plugin is deactivation*/

	register_deactivation_hook( __FILE__, 'enuygun_remove' );

	function enuygun_install()	{
		/* Creates new database field */
		add_option("enuygun_active_widget", 'personal_loan', '', 'yes');
		register_sidebar_widget(__('Enuygun.com Widget'), 'enuygun_widget');
	}
	
	add_action("plugins_loaded", "enuygun_install");

	function enuygun_remove()	{
		/* Deletes the database field */
		delete_option('enuygun_active_widget');
	}
	
	if ( is_admin() )	{
		
		/* Call the html code */
		add_action('admin_menu', 'enuygun_admin_menu');

		function enuygun_admin_menu() {
			add_options_page('Enuygun.Com Admin Menü', 'Enuygun.com', 'administrator', 'enuygun', 'enuygun_plugin_page');
		}
		
		function enuygun_plugin_page() {
?>
<div class="wrap">
	<div class="icon32" id="icon-options-general"><br/></div>
	<h2>Enuygun.com Eklenti Ayarları</h2>
	<form action="options.php" method="post">
		<?php wp_nonce_field('update-options'); ?>
		<table class="form-table">
			<tr>
				<th valign="top" scope="row">Öntanımlı Form</th>
				<td>
                    <input name="enuygun_active_widget" type="radio" value="personal_loan" 
                    	<?php if (get_option('enuygun_active_widget')=='personal_loan') echo 'checked="checked"'; ?> />
                    <label for="enuygun_active_widget">İhtiyaç Kredisi</label><br/>
                    <input name="enuygun_active_widget" type="radio" value="mortgage_loan" 
                    	<?php if (get_option('enuygun_active_widget')=='mortgage_loan') echo 'checked="checked"'; ?> />
                    <label for="enuygun_active_widget">Konut Kredisi</label><br/>
                    <input name="enuygun_active_widget" type="radio" value="flight" 
                    	<?php if (get_option('enuygun_active_widget')=='flight') echo 'checked="checked"'; ?> />
                    <label for="enuygun_active_widget">Uçak Bileti</label>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">Affiliate Kodu</th>
				<td>
					<input type="text" name="enuygun_affiliate_code" value="<?php echo get_option('enuygun_affiliate_code'); ?>" />
					<span class="description">Enuygun.com affiliate kodunuz yoksa bilgi@enuygun.com adresinden bize ulaşabilirsiniz.</span>
				</td>
			</tr>
			<!--
			<tr>
				<th valign="top" scope="row">Yönlendirme Parametreleri</th>
				<td>
					<input type="text" name="enuygun_extra_param_1" value="<?php echo get_option('enuygun_extra_param_1'); ?>" /> = <input type="text" name="enuygun_extra_value_1" value="<?php echo get_option('enuygun_extra_value_1'); ?>" /> <br/>
					<input type="text" name="enuygun_extra_param_2" value="<?php echo get_option('enuygun_extra_param_2'); ?>" /> = <input type="text" name="enuygun_extra_value_2" value="<?php echo get_option('enuygun_extra_value_2'); ?>" /> <br/>
					<input type="text" name="enuygun_extra_param_3" value="<?php echo get_option('enuygun_extra_param_3'); ?>" /> = <input type="text" name="enuygun_extra_value_3" value="<?php echo get_option('enuygun_extra_value_3'); ?>" /> <br/>
					<input type="text" name="enuygun_extra_param_4" value="<?php echo get_option('enuygun_extra_param_4'); ?>" /> = <input type="text" name="enuygun_extra_value_4" value="<?php echo get_option('enuygun_extra_value_4'); ?>" /> <br/><br/>
					<span class="description">Parametre Adı = Parametre Değeri</span><br/>
				</td>
			</tr>
			-->
			<tr>
				<th valign="top" scope="row"></th>
				<td>
					<input type="submit" value="Kaydet"/>
				</td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="enuygun_active_widget,enuygun_affiliate_code" />
	</form>
</div>
<?php		
		}
		
	}
	
	
?>
