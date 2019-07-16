<?php get_header();  
/**
 * ============== Template Name: Home
 *
 * @package Admin Hub
 */
?>

<?php get_template_part('template-parts/hero');?>

<div class="container mt4 mb4">
	
<?php

global $post;

$websites = get_posts(array(
	'numberposts' => -1,
	'orderby'     => 'title',
	'order'       => 'ASC'
));
	
$groups = get_field("group" ,"options");

$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}checklist");

foreach($websites as $post):  setup_postdata($post); $type = get_field("site_type"); ?>

	<div class="website-card mb1 <?php echo $type; ?>">
		
		<div class="type">
			<?php if($type == "flywheel")
				get_template_part("inc/img/flywheel-logo");
			else
				get_template_part("inc/img/wpengine-logo");
			?>
		</div>
		
		<div class="wrapper-card">
			
			<div class="website-header pl1 pr1">
				
				<div class="wrapper-title">
					
					<h2 class="heading heading__md font800"><?php the_title();?></h2>
					
					<?php
						
					$dates = get_field("dates");
					
					if($dates["website"] || $dates["hosting"]): ?>
					
					<div class="dates">
						
						<?php if($dates["website"]): ?>
						
						<div class="heading heading__sm">
							
							<span class="date-label">Site: </span>
							<span><?php echo $dates["website"]; ?></span></div>
						
						<?php endif; if($dates["hosting"]): ?>
						
						<div class="heading heading__sm">
							
							<span class="date-label">Hosting: </span>
							<span><?php echo $dates["hosting"]; ?></span></div>
						
						<?php endif; ?>
						
					</div>
					
					<?php endif; ?>
					
				</div>
				
				<div class="wrapper-buttons pt1 pb1">
					
					<a href="http://<?php the_field('site_url');?>" class="button ml2" target="_blank">Web Site</a>
					
					<a href="http://<?php the_field('site_url');?>/wp-admin" class="button button__ghost ml1" target="_blank">Back End</a>
					
					<div class="icon"><i class="fas fa-chevron-right"></i></div>
					
				</div>
			
			</div>
			
			<div class="wrapper-content pr1 pl1 pb1" style="display: none;">
				
				<!-- FTP Settings -->
			
				<?php if(get_field("site_type") == "wp_engine"): ?>
				
				<div class="website-content">
					
					<?php $ftp = get_field("ftp_settings"); ?>
					
					<div class="settings">
						
						<div class="address mr2">
							
							<label class="highlight"><i class="far fa-clipboard"></i>FTP Address: </label>
							
							<span><?php echo $ftp["ftp_address"]; ?></span>
							
						</div>
						
						<div class="port">
							
							<label class="highlight"><i class="far fa-clipboard"></i>FTP Port: </label>
							
							<span><?php echo $ftp["ftp_port"]; ?></span>
							
						</div>
					
					</div>
					
				</div>
				
				<?php endif; ?>
				
				<!-- Authentication Settings -->
				
				<div class="website-content">
					
					<?php
						
					$auth = get_field("authentication");
					
					$items = array("production", "staging", "wordpress");
					
					foreach($items as $item): ?>
					
					<div class="<?php echo $item; ?>">
						
						<h2 class="heading heading__sm"><?php echo $item; ?></h2>
						
						<div class="username">
							
							<label class="highlight"><i class="far fa-clipboard"></i>User Name: </label>
							
							<span><?php echo $auth[$item]["user_name"]; ?></span>
							
						</div>
						
						<div class="password">
							
							<label class="highlight"><i class="far fa-clipboard"></i>Password: </label>
							
							<span><?php echo $auth[$item]["password"]; ?></span>
							
						</div>
					</div>
					
					<?php endforeach; ?>
					
				</div>
				
				<!-- Checklist -->
				
				<div class="website-content">
					
					
					<h2 class="heading heading__sm">Pre-Launch Checklist</h2>
					
				<?php
				
				$check = findElement($data, $post->ID);
									
				foreach($groups as $group): ?>
				
					<h3 class="heading heading__sm"><?php echo $group["label"]; ?></h3>
					
					<div class="items">
					
					<?php foreach($group["item"] as $item): ?>
						
						<div>
							<input post-id="<?php echo $post->ID; ?>" id="<?php echo $item["name"] . "-" . $post->ID; ?>" type="checkbox" value="<?php echo $item["name"];?>" <?php echo ($check && $check->{$item["name"]}) ? "checked" : ""; ?>>
							<label for="<?php echo $item["name"] . "-" . $post->ID; ?>" class="item-label"><?php echo $item["label"]; ?></label>
						</div>
					
					<?php endforeach; ?>
					
					</div>
				
				<?php endforeach; ?>
					
				</div>
				
			</div>
		
		</div>
		
	</div>

<?php endforeach; ?>

</div>

<?php get_footer(); ?>


<?php
	
function findElement($array, $v) {
	$item = null;
	foreach($array as $struct) {
	    if ($v == $struct->ID) {
	        $item = $struct;
	        break;
	    }
	}
	return $item;
}
?>