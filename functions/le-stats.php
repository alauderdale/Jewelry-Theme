<?php

// Hook for adding admin menus

add_action('admin_menu', 'launch_stats_page');


// Action function for above hook to add a new top-level menu

function launch_stats_page() {
    add_menu_page(__('Launch Stats','le_stats-page'), __('Launch Stats','le_stats-page'), 'manage_options', 'launch_stats_page', 'le_toplevel_page' );
}


// Get a stylesheet up in here

add_action('admin_head', 'admin_registers_head');
function admin_registers_head() {
	$url = get_bloginfo('template_directory') . '/functions/splash.css';
	echo "<link rel='stylesheet' href='$url' />\n";
}


// Displays the page content for the Launch Stats top-level menu

function le_toplevel_page() {

    // Check that the user has the required capability 
    
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

	$wordpressapi_db_version = "1.0";
	 
	global $wpdb;
	global $wordpressapi_db_version;

?>

<div class="wrap">

	<div id="stats-wrapper">
	
	<?php 
	
	$stats_table = $wpdb->prefix . 'launcheffect';
		
	if (isset($_GET['view'])) { 
		
		// SHOW THE VISITOR DETAIL PAGE
		
		$view = $_GET['view'];
	
		$results = getDetail($stats_table, 'referred_by', $view);
		
		if (!$results) : ?>
		
			<h2>Stats: <a href="?page=launch_stats_page">Sign-ups</a>: Detail</h2>    	
			<p>Nothing to see here yet. <a href="?page=launch_stats_page">Go to Sign-Ups Stats.</a></p>
	
		<?php else: ?>
	
			<h2>Stats: <a href="?page=launch_stats_page">Sign-ups</a>: Detail</h2> 
		
			<table id="individual">
				<thead>
					<th>ID</th>
					<th>Time</th>
					<th>Converted To</th>
					<th>IP</th>
				</thead>
				
				<?php foreach ($results as $result) : ?>
				
					<tr>
						<td><?php echo $result->id; ?></td>
						<td style="white-space:nowrap;"><?php echo $result->time; ?></td>
						<td><a href="?page=launch_stats_page&view=<?php echo $result->code; ?>"><?php echo $result->email; ?></a></td>
						<td><?php echo $result->ip; ?></td>
					</tr>	
			
				<?php endforeach; ?>
			</table> 
			
	<?php 
	
	endif;
	
	} else {
		
		// SHOW THE MAIN STATS PAGE
		
	?>
		<h2>Stats: Sign-Ups</h2>
	
		<table id="signups">
			<thead>	
				<th>ID</a></th>
				<th>Time</a></th>
				<th>Email</a></th>
				<th>Visits</a></th>
				<th>Conversions</a></th>
				<th>Conversion Rate</th>
				<th>IP</th>
			</thead>
			
			<?php
			
			$results = getData($stats_table);
			foreach ($results as $result) : 
			
			?>
			
			<tr>
				<td><?php echo $result->id; ?></td>
				<td style="white-space:nowrap;"><?php echo $result->time; ?></td>
				<td><a href="?page=launch_stats_page&view=<?php echo $result->code; ?>"><?php echo $result->email; ?></a></td>
				<td><?php if($result->visits != 0) { echo $result->visits; }?></td>
				<td><?php if($result->conversions != 0) { echo $result->conversions; } ?></td>
				<td><?php 
				
					// calculate the conversion rate: divide conversions by results and multiply it by 100.  show up to 2 decimal places.
					
					if($result->visits + $result->conversions != 0 ) { 
						$conversionRate = ($result->conversions/$result->visits) * 100; 
						echo round($conversionRate, 2) . '%'; 
					} ?>
				</td>
				<td><?php echo $result->ip; ?></td>
			</tr>	
		
			<?php endforeach;?>
			
		</table>
		
	<?php } ?>
	
	</div>

</div>

<?php

	add_option("wordpressapi_db_version", $wordpressapi_db_version);
 
}

?>