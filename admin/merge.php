<?php
/*
	Admin menu
*/

// Add options to database
add_action( "admin_menu", "shm_bbpress_merge_user_menu" );

// Merge users.
if ( !function_exists( "shm_bbpress_merge_user_merge" )){
	function shm_bbpress_merge_user_merge(){
		global $wpdb;
		$user_with_no_equivalent = array();
		$user_with_duplicate_email = array();
		
		// Get imported bbPress users.
		$sql = "SELECT * from $wpdb->users 
			WHERE user_email LIKE 'imported_%'";
		$result = $wpdb->get_results( $sql ); 
		
		foreach ( $result as $row ){
			echo $row->ID;
			echo " ";
			echo $row->user_email;
			echo " => ";

			// Get user to reassign content to.
			$reassign_email = str_replace( "imported_", "", $row->user_email );

			$sql_2 = "SELECT * from $wpdb->users 
				WHERE user_email = '" . $reassign_email . "'
				LIMIT 0, 10";
			$result_2 = $wpdb->get_results( $sql_2 ); 
			
			if ( count( $result_2 ) == 1 ){  
				foreach ( $result_2 as $row_2 ){
					echo $row_2->ID;
					echo " ";
					echo $row_2->user_email;
					wp_delete_user( $row->ID, $row_2->ID );
				}
			} elseif ( count( $result_2 ) > 1 ){
				foreach ( $result_2 as $row_2 ){
					$user_with_duplicate_email[] = array ( "ID" => $row->ID, "user_email" => $row->user_email, "reassign_ID" => $row_2->ID, "reassign_email" => $row_2->user_email );
				}
			} else {
				$user_with_no_equivalent[] = array ( "ID" => $row->ID, "user_email" => $row->user_email );
			}
			
			echo "<br />";
		}
		
		echo "<p>Importing finished.</p>";

		echo "<p>The following users have not been merged because there is no equivalent user: </p> ";
		foreach ( $user_with_no_equivalent as $user ){
			echo $user[ "ID" ];
			echo " ";
			echo $user[ "user_email" ];
			echo "<br />";
		}
		
		echo "<p>The following users have not been merged because there are more than one user with the same email address.</p>";
		foreach ( $user_with_duplicate_email as $user ){
			echo $user[ "ID" ];
			echo " ";
			echo $user[ "user_email" ];
			echo " => ";
			echo $user[ "reassign_ID" ];
			echo " ";
			echo $user[ "reassign_email" ];
			echo "<br />";
		}
	}
}

// Add the menu item to admin dashboard.
if ( !function_exists( "shm_bbpress_merge_user_menu" )){
	function shm_bbpress_merge_user_menu(){	
		add_menu_page( "Merge BBPress Users", "Merge bbPress Users", "manage_options", "shm_bbpress_merge_user", "shm_bbpress_merge_user_page" );
	}
}

// Admin page.
if ( !function_exists( "shm_bbpress_merge_user_page" )){
	function shm_bbpress_merge_user_page(){
		echo "<p>Merging users...</p>";
		shm_bbpress_merge_user_merge();
	}
}