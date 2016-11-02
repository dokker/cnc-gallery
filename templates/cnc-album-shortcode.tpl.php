<section class="cnc-gallery-album">
	<article class="">
		<figure>
			<a href="<?php echo get_permalink($album['id']); ?>" data-images="<?php echo $album['images']; ?>" class="swipebox-album">
				<?php echo get_the_post_thumbnail($album['id'], 'large', array( 'class' => 'album-cover-image swipebox' )); ?>
			</a>
			<figcaption>
				<h3 class="the-title"><?php echo get_the_title($album['id']); ?></h3>
			</figcaption>
		</figure>
	</article>
</section>
