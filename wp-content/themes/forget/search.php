<?php get_header(); ?>
<div id="m-container" class="mainContent">
<div class="jsc-sidebar" id="jsi-nav">
<?php get_sidebar(); ?>
</div>
	<div class="blogitem">
<?php 
	if( have_posts() ){ 
		while ( have_posts() ){
			the_post(); 
			get_template_part( 'modules/excerpt', get_post_format() );
		}
	}
?>
	<div class="pages"><?php pagenavi(); ?></div>
	</div>
</div>
<?php get_footer(); ?>