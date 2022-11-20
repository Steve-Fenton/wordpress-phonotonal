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
				$args = array( 'numberposts' => '5', 'post_status' => 'publish' );
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
		<li class="mastodon"><a rel="me" href="https://mastodonmusic.social/@phonotonal" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M433 179.11c0-97.2-63.71-125.7-63.71-125.7-62.52-28.7-228.56-28.4-290.48 0 0 0-63.72 28.5-63.72 125.7 0 115.7-6.6 259.4 105.63 289.1 40.51 10.7 75.32 13 103.33 11.4 50.81-2.8 79.32-18.1 79.32-18.1l-1.7-36.9s-36.31 11.4-77.12 10.1c-40.41-1.4-83-4.4-89.63-54a102.54 102.54 0 0 1-.9-13.9c85.63 20.9 158.65 9.1 178.75 6.7 56.12-6.7 105-41.3 111.23-72.9 9.8-49.8 9-121.5 9-121.5zm-75.12 125.2h-46.63v-114.2c0-49.7-64-51.6-64 6.9v62.5h-46.33V197c0-58.5-64-56.6-64-6.9v114.2H90.19c0-122.1-5.2-147.9 18.41-175 25.9-28.9 79.82-30.8 103.83 6.1l11.6 19.5 11.6-19.5c24.11-37.1 78.12-34.8 103.83-6.1 23.71 27.3 18.4 53 18.4 175z"/></svg></a></li>
		<li class="facebook"><a href="https://www.facebook.com/phonotonal" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg></a></li>
		<li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM96 136c0-13.3 10.7-24 24-24c137 0 248 111 248 248c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-110.5-89.5-200-200-200c-13.3 0-24-10.7-24-24zm0 96c0-13.3 10.7-24 24-24c83.9 0 152 68.1 152 152c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-57.4-46.6-104-104-104c-13.3 0-24-10.7-24-24zm64 120c0 17.7-14.3 32-32 32s-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32z"/></svg></a></li>
	</ul>
</div>
<?php wp_footer(); ?>
</body>
</html>
