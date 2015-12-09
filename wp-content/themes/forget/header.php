<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<title>    
<?php if ( is_home() ) {bloginfo('name');}    
elseif ( is_category() ) {single_cat_title(); echo " 丨 "; bloginfo('name');}       
elseif (is_single() || is_page() ) {single_post_title(); echo " 丨 "; bloginfo('name');}      
elseif (is_search() ) {echo "搜索结果"; echo " 丨 "; bloginfo('name');}       
elseif (is_404() ) {echo '页面未找到!';}       
else {wp_title('',true);} ?> 
</title>
	<?php
	$options = get_option('f_options'); 
	global $post;
	if (is_home()){
		$keywords = $options['keywords'];
		$description = $options['description'];
	}elseif (is_single()){
		$keywords = get_post_meta($post->ID, "keywords", true);
		if($keywords == ""){
			$tags = wp_get_post_tags($post->ID);
			foreach ($tags as $tag){
				$keywords = $keywords.$tag->name.",";
			}
			$keywords = rtrim($keywords, ', ');
		}
		$description = get_post_meta($post->ID, "description", true);
		if($description == ""){
			if($post->post_excerpt){
				$description = $post->post_excerpt;
			}else{
				$description = mb_strimwidth(strip_tags($post->post_content),0,200,'');
			}
		}
	}elseif (is_page()){
		$keywords = get_post_meta($post->ID, "keywords", true);
		$description = get_post_meta($post->ID, "description", true);
	}elseif (is_category()){
		$keywords = single_cat_title('', false);
		$description = category_description();
	}elseif (is_tag()){
		$keywords = single_tag_title('', false);
		$description = tag_description();
	}
	$keywords = trim(strip_tags($keywords));
	$description = trim(strip_tags($description));
	?>
	
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<meta name="description" content="<?php echo $description; ?>" />
<script type='text/javascript' src='<?php bloginfo("template_url"); ?>/js/jquery.min.js'></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/style.css" />
<?php 
	if($options['tubiao']){
		echo '<link rel="shortcut icon" href="'.$options['tubiao'].'" type="image/x-icon" />'; 
	}else{
		echo '<link rel="shortcut icon" href="'.get_bloginfo("template_url").'/images/favicon.ico" type="image/x-icon" />';
	}	
?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />
<?php wp_head(); ?>
</head>
<body>
<header class="l-header" <?php if($options['datu']){ echo 'style="background-image:url('.$options['datu'].')"'; }else{ echo'style="background-image:url('.get_bloginfo("template_url").'/images/header.jpg);"';} ?>>
<div class="hdbg"></div>
<div class="hdbg2"></div>
<div class="m-about">
    <div id="logo">

		<?php if ($options["logo2"]): ?>
				<a href="<?php bloginfo('url'); ?>"><img src="<?php echo $options["logo2"]; ?>"></a> 
		<?php else :?>
				<a href="<?php bloginfo('url'); ?>" ><img src="<?php bloginfo("template_url"); ?>/images/logo.jpg"></a>
		<?php endif ;?>
		
	</div>
    	<h1 class="tit"><a href="<?php bloginfo('url'); ?>"><?php if($options['logo3']): ?><?php echo $options['logo3']; ?><?php else :?><?php bloginfo('name'); ?><?php endif; ?></a></h1>
        <div class="about"><?php if($options['logo4']): ?><?php echo $options['logo4']; ?><?php else :?><?php bloginfo('description'); ?><?php endif; ?></div>

</div>
</header>
	<div id="m-nav" class="m-nav">
		<div class="m-nav-all">
			<div class="m-logo-url">
				<img src="<?php if($options['logourl']){echo $options["logourl"];}else{echo''.get_bloginfo('template_directory').'/images/logo.jpg';} ?>">
				<h3><?php bloginfo('name');?></h3>
			</div>
			<ul class="nav">
				<?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'nav', 'echo' => false)) )); ?>
			</ul>
		</div>
	</div>
	<?php get_search_form(); ?>
	<div id="m-header" class="m-header">
		<div id="showLeftPush" class="left m-header-button"></div>
		<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name');?></a></h1>
		<div id="search-trigger" style="font-size: 18px;" class="right m-header-search"></div>
	</div>