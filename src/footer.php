<!-- *f* -->
</div>

<footer>
	<h2 class="hidden">More Content</h2>
	<div class="footer-search">
		<h3 class="hidden">Search</h3>
		<form role="search" method="get" class="search-form" action="/">
			<label><span class="screen-reader-text">Search for:</span>
			<input type="search" class="search-field" placeholder="Search …" value="" name="s">
			</label>
			<input type="submit" value="Go" />
		</form>
	</div>
	<div class="footer-grid">

		<div>
			<h3>Recent Posts</h3>
			<ul>
			<?php
				$args = array( 'numberposts' => '10', 'post_status' => 'publish' );
				$recent_posts = wp_get_recent_posts($args);
				foreach( $recent_posts as $recent ){
					echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
				}
			?>
			</ul>
		</div>
		
		<div>
			<h3>Categories</h3>
			<ul>
				<?php
					$args = array('orderby' => 'name', 'parent' => 0);
					$categories = get_categories( $args );
					foreach ( $categories as $category ) {
						echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
					}
				?>
			</ul>
		</div>
		
		<div>
			<h3>Pages</h3>
			<ul>
			<?php
				$args = array(
					'sort_column' => 'post_title',
					'post_type' => 'page',
					'post_status' => 'publish',
					'parent' => 0
				);
				$pages = get_pages( $args );
				foreach ( $pages as $page ) {
					echo '<li><a href="' . get_page_link( $page->ID ) . '">' . $page->post_title . '</a></li>';
				}
			?>
			</ul> 
		</div>
		
	</div>
	<?php
	// 21 years of...
	$quotes = array(
		'noise',
		'half-baked philosophical drivel and nonsensical tirades',
		'acts of faith in the future',
		'discordancy'
	);
	?>
	<div class="footer-legal">&copy; 2001-<?php echo date("Y"); ?> Phonotonal.
	<a href="/years-of-noise/"><?php echo (intval(date('Y')) - 2001) ?> years of <?php echo $quotes[array_rand($quotes)] ?></a>.</div>
</footer>
<div class="social-icons">
	<ul>
		<li class="twitter"><a href="https://twitter.com/phonotonal" target="_blank">Phonotonal on Twitter</a></li>
		<li class="facebook"><a href="https://www.facebook.com/phonotonal" target="_blank">Phonotonal on Facebook</a></li>
		<li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank">Phonotonal RSS Feed</a></li>
	</ul>
</div>
<?php wp_footer(); ?>
</body>
</html>
