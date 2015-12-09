<?php get_header(); ?>
<div id="m-container" class="mainContent">
<?php get_sidebar(); ?>
	<div class="blogitem">
<?php 
	if( have_posts() ){ 
		while ( have_posts() ){
			the_post(); 
			get_template_part( 'modules/template', get_post_format() );
		}
	}
?>
	<?php comments_template('', true); ?>
	</div>
</div>
<?php get_footer(); ?>