<?php get_header(); ?>
<div id="m-container" class="mainContent">
<?php get_sidebar(); ?>
	<div class="blogitem">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="content">
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <h2 class="title"><a class="slow" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><span class="edit"><?php edit_post_link();?></span></h2>
        <ul class="text">

		<?php the_content(); ?>
		
		</ul>
</article>
</div>
<?php endwhile; else: ?>
<?php endif; ?>
	<?php comments_template('', true); ?>
	</div>
</div>
<?php get_footer(); ?>