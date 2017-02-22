<?php
/**
 * The template part for displaying latest news section on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package louis
 */

?>

<div id="blogposts">
<div class="wrapper">

<div class="row home-posts">
<?php
while ( have_posts() ) :
the_post();
?>

<div class="col-1-3">
      <div class="wrap-col">
      
      <div class="blogpost">
      <div class="blogimage">
       <a href="<?php the_permalink();?>" class="blogimagelink"><?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'louis-blog-thumb', array( 'class' => 'louis-featured-image' ) );
								} else { ?>
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/default.gif" alt="<?php the_title_attribute(); ?>" />
						<?php } ?><i class="fa fa-chevron-right"></i></a>
      </div><!-- Blogimage -->
                        
      <h3 class="blogposttitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <div class="blogposttext"><?php the_excerpt(); ?></div>
      <p class="blogpostmeta"><i class="fa fa-calendar"></i> <a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></p>
      </div><!-- Blogpost -->

 
</div><!-- end wrap-col -->      
</div><!-- end col-1-3 -->

<?php endwhile; ?>
</div><!-- end row -->

 
 
<?php the_posts_pagination(); ?>

</div><!-- End Wrapper -->
</div><!-- End Wrapper -->


</div><!-- End blogposts -->