<?php
	
/****************************************************/
/*                       Hooks                       /
/****************************************************/

/* Create or update columns */
add_action( 'acf/save_post', 'silverless_checklist' );

/* AJAX calls */
add_action('wp_ajax_update_checklist', 'update_checklist' );
add_action('wp_ajax_nopriv_update_checklist', 'update_checklist' );


/****************************************************/
/*                     Functions                     /
/****************************************************/

function silverless_checklist($type) {
	
	$screen = get_current_screen();
	
	if($type == "options" && $screen->id == "toplevel_page_checklist") {
	
		global $wpdb;
		
		// Create table
		$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}checklist (
			ID bigint unsigned NOT NULL PRIMARY KEY
		) ENGINE='InnoDB' COLLATE 'utf8mb4_unicode_ci'");
	   
		// Create columns
		
		$columns = $wpdb->get_col("DESC {$wpdb->prefix}checklist", 0);
	
		$groups = get_field("group" ,"options");
		
		$items = array();
		
		// Add columns
		
		$actions = array();
		
		foreach($groups as $group) {
			
			foreach($group["item"] as $item) {
				
				if(!in_array($item["name"], $columns)) {
					array_push($actions, " ADD {$item['name']} tinyint(1) NOT NULL DEFAULT '0'");
				}
				
				array_push($items, $item["name"]);
			}
		}
		
		// Drop columns
		
		foreach($columns as $column) {
			
			if($column != "ID" && !in_array($column, $items)) {
				array_push($actions, " DROP {$column}");
			}
		}
		
		// Alter table
		
		if(sizeof($actions) > 0) {
			$alter_table = "ALTER TABLE {$wpdb->prefix}checklist" . implode(", ", $actions);
			$wpdb->query($alter_table);
		}
	}
}

function update_checklist() {
	global $wpdb;
	
	$postID = $_POST["postID"];
	$column = $_POST["name"];
	$value  = $_POST["value"] == "true" ? 1 : 0;
	
	$wpdb->query("INSERT INTO {$wpdb->prefix}checklist (ID, $column) VALUES($postID, $value) ON DUPLICATE KEY UPDATE $column = $value");
	
	die();
}

?>
