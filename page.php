<?php get_header();  
/*
/   Default Page Template
/   @package Admin Hub
*/ 
?>

<?php get_template_part('template-parts/hero');?>

    <div class="container">
        
    <?php
    global $post;
    $args = array( 'numberposts' => -1, 'orderby'=> 'title', 'order' => 'ASC');
    $myposts = get_posts( $args );
    foreach( $myposts as $post ) :  setup_postdata($post); ?>

        <div class="client-card">
            
            <div class="row">
            
            <div class="col-4">
            
                <h2 class="heading heading__md font800 mb1"><?php the_title();?></h2>
            
                <a href="http://<?php the_field('site_url');?>" class="button mb1" target="_blank">Web Site</a>
            
                <a href="http://<?php the_field('site_url');?>/wp-admin" class="button button__ghost mb1" target="_blank">Back End</a>            
            
            </div>

                <div class="col-4">

                <?php if( have_rows('ftp_details') ): 
                while( have_rows('ftp_details') ): the_row(); ?>

                    <h2 class="heading heading__sm">FTP</h2>

                    <p><span class="client-card__label font800 text-uppercase">Address: </span>
                        <span id="div_1<?php the_sub_field('ftp_address');?>"><?php the_sub_field('ftp_address');?></span>
                        <?php if(get_sub_field('ftp_address')):?>
                        <a id="div_1<?php the_sub_field('ftp_address');?>" href="#" name="copy_pre" class="copy-link"><i class="far fa-clipboard"></i></a>
                    <?php endif;?>       
                    </p>
                    
                    <p><span class="client-card__label font800 text-uppercase">Port: </span>
                        <span id="div_1<?php the_sub_field('ftp_port');?>"><?php the_sub_field('ftp_port');?></span>
                        <?php if(get_sub_field('ftp_port')):?>
                        <a id="div_1<?php the_sub_field('ftp_port');?>" href="#" name="copy_pre" class="copy-link"><i class="far fa-clipboard"></i></a>
                    <?php endif;?>       
                    </p>
                    
                    
                    <p class="heading heading__sm mt1">Production</p>
                    
                    <p><span class="client-card__label font800 text-uppercase">User Name: </span>
                        <span id="div_1<?php the_sub_field('ftp_user_name');?>"><?php the_sub_field('ftp_user_name');?></span>
                        <?php if(get_sub_field('ftp_user_name')):?>
                        <a id="div_1<?php the_sub_field('ftp_user_name');?>" href="#" name="copy_pre" class="copy-link"><i class="far fa-clipboard"></i></a>
                    <?php endif;?>       
                    </p>   
                             
                    <p><span class="client-card__label font800 text-uppercase">Password: </span>
                        <span id="div_1<?php the_sub_field('ftp_password');?>"><?php the_sub_field('ftp_password');?></span>
                        <?php if(get_sub_field('ftp_password')):?>
                        <a id="div_1<?php the_sub_field('ftp_password');?>" href="#" name="copy_pre" class="copy-link"><i class="far fa-clipboard"></i></a>                        
                    <?php endif;?>       
                    </p>

                    <p class="heading heading__sm mt1">Staging</p>

                    <p><span class="client-card__label font800 text-uppercase">User Name: </span>
                        <?php if(get_sub_field('ftp_user_name_staging')):?>
                        <span id="div_1<?php the_sub_field('ftp_user_name_staging');?>"><?php the_sub_field('ftp_user_name_staging');?></span>
                        <a id="div_1<?php the_sub_field('ftp_user_name_staging');?>" href="#" name="copy_pre" class="copy-link"><i class="far fa-clipboard"></i></a>                             
                        <?php endif;?>         
                    </p>   
                             
                    <p><span class="client-card__label font800 text-uppercase">Password: </span>
                        <span id="div_1<?php the_sub_field('ftp_password_staging');?>"><?php the_sub_field('ftp_password_staging');?></span>
                        <?php if(get_sub_field('ftp_password_staging')):?>
                        <a id="div_1<?php the_sub_field('ftp_password_staging');?>" href="#" name="copy_pre" class="copy-link"><i class="far fa-clipboard"></i></a>                           
                    <?php endif;?>       
                    </p>
            
                <?php endwhile; endif; ?>                
    
                </div>

                <div class="col-4">

                <?php if( have_rows('wp_details') ): 
                while( have_rows('wp_details') ): the_row(); ?>

                    <h2 class="heading heading__sm">WP</h2>
                    
                    <p><span class="client-card__label font800 text-uppercase">User Name: </span>
                        <span id="div_1<?php the_sub_field('wp_user_name');?>"><?php the_sub_field('wp_user_name');?></span>
                        <?php if(get_sub_field('wp_user_name')):?>
                        <a id="div_1<?php the_sub_field('wp_user_name');?>" href="#" name="copy_pre" class="copy-link"><i class="far fa-clipboard"></i></a>    
                        <?php endif;?>                  
                    </p>   
                             
                    <p><span class="client-card__label font800 text-uppercase">Password: </span>
                        <span id="div_1<?php the_sub_field('wp_password');?>"><?php the_sub_field('wp_password');?></span>
                        <?php if(get_sub_field('wp_password')):?>
                        <a id="div_1<?php the_sub_field('wp_password');?>" href="#" name="copy_pre" class="copy-link"><i class="far fa-clipboard"></i></a>                  
                    <?php endif;?>       
                    </p>

                <?php endwhile; endif; ?>    

                </div>

            
            </div><!--r-->   

        </div><!--client card-->
        
    <?php endforeach; 
    wp_reset_postdata(); ?>
    
    </div><!--c-->
</div><!--content-->
 
<?php get_footer(); ?>