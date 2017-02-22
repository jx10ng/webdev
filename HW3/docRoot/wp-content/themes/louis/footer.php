<div id="footer">
	<div class="wrapper">
		<div class="row">
			<?php dynamic_sidebar( 'louis-footer' ); ?>
		</div>
	</div>



<div id="bottom">
	<div class="wrapper">

		<p class="bottomtext">
			&copy; <?php bloginfo( 'name' ); ?> <?php echo date_i18n( __( 'Y', 'louis' ) ); ?> / <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'louis' ), 'Louis', '<a href="http://themefurnace.com" rel="designer">ThemeFurnace</a>' ); ?>
		</p>
	</div>
	<!-- End wrapper -->
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>