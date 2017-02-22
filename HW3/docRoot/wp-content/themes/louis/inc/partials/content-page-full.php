<?php
/**
 * @package louis
 */
?>
<div class="row">
		<div class="col-1-1"><div class="wrap-col test postcontent">
        
       <?php the_post_thumbnail( 'louis-blog-thumb' ); ?>
        <div id="content">


<h1 class="postcontenttitle"><?php the_title() ?></h1>
        
<?php
		the_content();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'louis' ),
			'after'  => '</div>',
		) );
		
		edit_post_link( esc_html__( 'Edit', 'louis' ), '<span class="edit-link">', '</span>' );
		?>
        <br>
</div>
</div></div>

	


</div>