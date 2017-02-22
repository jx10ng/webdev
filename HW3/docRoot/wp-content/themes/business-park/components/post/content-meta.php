		<div class="entry-meta">
			<?php
			if ( ! ( ( is_home() || is_archive() ) && ! has_post_thumbnail() ) )  {
				business_park_posted_on();
			}
			business_park_entry_footer();
			?>
		</div><!-- .entry-meta -->