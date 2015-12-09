<?php $options=get_option('f_options'); ?>
   <aside class="sidebar">
     <div class="cbl-logo">
		<h3></h3>
		<a class="btn btn-primary-empty pull-left" href="<?php bloginfo('url'); ?>/leon/wp-admin"><i class=""></i> 帐号登陆</a>
		<a class="btn btn-danger-empty pull-right" href="<?php bloginfo('url'); ?>/leon/wp-login.php?action=register"><i class=""></i> 帐号注册</a>
	 </div>
	 <div class="m-sidebar">
<div class="userinfo"> 
        <p class="q-fans">
			公告：<?php echo $options['announcement']; ?>
		</p> 
      </div>
      <section class="topspaceinfo">
        <h1><?php echo $options['motto']; ?></h1>
        <p><?php echo $options['motto-tell']; ?></p>
      </section>
	  <?php 
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_sitesidebar')) : endif; 

		if (is_single()){
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_postsidebar')) : endif; 
		}
		else if (is_page()){
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_pagesidebar')) : endif; 
		}
		else if (is_home()){
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_sidebar')) : endif; 
		}
		else {
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_othersidebar')) : endif; 
		}
	  ?>
<section class="widget f_comment"><h2 class="widget_tit">近期评论</h2>
	  <?php
		function widget() {
        global $wpdb, $comments, $comment;
        $output = '';
        if (empty($instance['number']) || !$number = absint($instance['number']))
            $number = 8;
        //获取评论，过滤掉管理员自己
        $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE user_id !=1 and comment_approved = '1' and comment_type not in ('pingback','trackback') ORDER BY comment_date_gmt DESC LIMIT $number");
        $output .= $before_widget;
        if ($title)
            $output .= $before_title . $title . $after_title;
 
        $output .= '<div class="all-comments">';
        if ($comments) {
            // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
            $post_ids = array_unique(wp_list_pluck($comments, 'comment_post_ID'));
            _prime_post_caches($post_ids, strpos(get_option('permalink_structure'), '%category%'), false);
 
            foreach ((array) $comments as $comment) {
			  if ($comment->comment_author_email != $my_email) {
                //头像
                $avatar = get_avatar($comment, 50);
                //作者名称
                $author = get_comment_author();
                //评论内容
                $content = apply_filters('get_comment_text', $comment->comment_content);
                $content = mb_strimwidth(strip_tags($content), 0, '65', '...', 'UTF-8');
                $content = convert_smilies($content);
                //评论的文章
                $post = '<a href="' . esc_url(get_comment_link($comment->comment_ID)) . '">'  . $avatar . $author .'<span class="muted">'.timeago( $comment->comment_date_gmt ).':<br>' . $content . '</span></a>';
 
                //这里就是输出的html，可以根据需要自行修改
                $output .= $post;
			  }
            }
        }
        $output .= '</div>';
        $output .= $after_widget;
 
        echo $output;
    }
	widget();
	?>
	</section>
     </div>
    </aside>