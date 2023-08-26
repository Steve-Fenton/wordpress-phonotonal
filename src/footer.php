<!-- *f* -->
</div>

<footer>
	<h2 class="hidden">More Content</h2>
	<div class="footer-search">
		<h3 class="hidden">Search</h3>
		<form role="search" method="get" class="search-form" action="/">
			<label><span class="screen-reader-text">Search for:</span>
			<input type="search" class="search-field" placeholder="Search …" value="" name="s" id="search">
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

	<div class="social-icons">
		<ul>
			<li class="threads"><a rel="me" href="https://threads.net/@phonotonal" target="_blank"><svg aria-label="Threads" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg"><title>Threads</title><path class="x19hqcy" d="M141.537 88.9883C140.71 88.5919 139.87 88.2104 139.019 87.8451C137.537 60.5382 122.616 44.905 97.5619 44.745C97.4484 44.7443 97.3355 44.7443 97.222 44.7443C82.2364 44.7443 69.7731 51.1409 62.102 62.7807L75.881 72.2328C81.6116 63.5383 90.6052 61.6848 97.2286 61.6848C97.3051 61.6848 97.3819 61.6848 97.4576 61.6855C105.707 61.7381 111.932 64.1366 115.961 68.814C118.893 72.2193 120.854 76.925 121.825 82.8638C114.511 81.6207 106.601 81.2385 98.145 81.7233C74.3247 83.0954 59.0111 96.9879 60.0396 116.292C60.5615 126.084 65.4397 134.508 73.775 140.011C80.8224 144.663 89.899 146.938 99.3323 146.423C111.79 145.74 121.563 140.987 128.381 132.296C133.559 125.696 136.834 117.143 138.28 106.366C144.217 109.949 148.617 114.664 151.047 120.332C155.179 129.967 155.42 145.8 142.501 158.708C131.182 170.016 117.576 174.908 97.0135 175.059C74.2042 174.89 56.9538 167.575 45.7381 153.317C35.2355 139.966 29.8077 120.682 29.6052 96C29.8077 71.3178 35.2355 52.0336 45.7381 38.6827C56.9538 24.4249 74.2039 17.11 97.0132 16.9405C119.988 17.1113 137.539 24.4614 149.184 38.788C154.894 45.8136 159.199 54.6488 162.037 64.9503L178.184 60.6422C174.744 47.9622 169.331 37.0357 161.965 27.974C147.036 9.60668 125.202 0.195148 97.0695 0H96.9569C68.8816 0.19447 47.2921 9.6418 32.7883 28.0793C19.8819 44.4864 13.2244 67.3157 13.0007 95.9325L13 96L13.0007 96.0675C13.2244 124.684 19.8819 147.514 32.7883 163.921C47.2921 182.358 68.8816 191.806 96.9569 192H97.0695C122.03 191.827 139.624 185.292 154.118 170.811C173.081 151.866 172.51 128.119 166.26 113.541C161.776 103.087 153.227 94.5962 141.537 88.9883ZM98.4405 129.507C88.0005 130.095 77.1544 125.409 76.6196 115.372C76.2232 107.93 81.9158 99.626 99.0812 98.6368C101.047 98.5234 102.976 98.468 104.871 98.468C111.106 98.468 116.939 99.0737 122.242 100.233C120.264 124.935 108.662 128.946 98.4405 129.507Z"></path></svg></a></li>
			<li class="mastodon"><a rel="me" href="https://mastodonmusic.social/@phonotonal" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><title>Mastodon</title><path d="M433 179.11c0-97.2-63.71-125.7-63.71-125.7-62.52-28.7-228.56-28.4-290.48 0 0 0-63.72 28.5-63.72 125.7 0 115.7-6.6 259.4 105.63 289.1 40.51 10.7 75.32 13 103.33 11.4 50.81-2.8 79.32-18.1 79.32-18.1l-1.7-36.9s-36.31 11.4-77.12 10.1c-40.41-1.4-83-4.4-89.63-54a102.54 102.54 0 0 1-.9-13.9c85.63 20.9 158.65 9.1 178.75 6.7 56.12-6.7 105-41.3 111.23-72.9 9.8-49.8 9-121.5 9-121.5zm-75.12 125.2h-46.63v-114.2c0-49.7-64-51.6-64 6.9v62.5h-46.33V197c0-58.5-64-56.6-64-6.9v114.2H90.19c0-122.1-5.2-147.9 18.41-175 25.9-28.9 79.82-30.8 103.83 6.1l11.6 19.5 11.6-19.5c24.11-37.1 78.12-34.8 103.83-6.1 23.71 27.3 18.4 53 18.4 175z"/></svg></a></li>
			<li class="facebook"><a href="https://www.facebook.com/phonotonal" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><title>Facebook</title><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg></a></li>
			<li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><title>RSS</title><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM96 136c0-13.3 10.7-24 24-24c137 0 248 111 248 248c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-110.5-89.5-200-200-200c-13.3 0-24-10.7-24-24zm0 96c0-13.3 10.7-24 24-24c83.9 0 152 68.1 152 152c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-57.4-46.6-104-104-104c-13.3 0-24-10.7-24-24zm64 120c0 17.7-14.3 32-32 32s-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32z"/></svg></a></li>
		</ul>
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
<?php wp_footer(); ?>
</body>
</html>
