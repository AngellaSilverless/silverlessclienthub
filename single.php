<?php get_header();  
/*
/   Default Post Template
/   @package Admin Hub
*/ 
?>

<div class="hero mb3 h50" style="background-color: #23282d;">

    <div class="container">
    
        <div class="row">
                
            <div class="hero__content">       
                
                <h1 class="heading heading__xl heading__light font800"><?php the_title();?></h1>            
                                
            </div>       
                
        </div>
    
    </div>
    
</div><!--hero-->

    <div class="container">
    
        <div class="row mb5 w75 font400">

<?php 

// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<h2><?php the_title(); ?></h2>
	<?php endwhile; ?>
	<!-- end of the loop -->

	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>




            <div class="col-sm-6">
        
            <?php if( have_rows('ftp_details') ): 
            while( have_rows('ftp_details') ): the_row(); ?>
            
                <p><span class="mr1 font800 text-uppercase">FTP Address: </span><?php the_sub_field('ftp_address');?></p>
                <p><span class="mr1 font800 text-uppercase">FTP Port: </span><?php the_sub_field('ftp_port');?></p>
                <p><span class="mr1 font800 text-uppercase">FTP User Name: </span><?php the_sub_field('ftp_user_name');?></p>            
                <p><span class="mr1 font800 text-uppercase">FTP Password: </span><?php the_sub_field('ftp_password');?></p>
            
            <?php endwhile; endif; ?>
    
            </div>
    
        </div><!--r-->
      
    </div><!--c-->


 
<?php get_footer(); ?>