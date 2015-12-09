<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <h2 class="title fz14"><a class="slow gray4" href="<?php the_permalink() ?>" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<?php preg_match_all( '/\<img.+?src="(.+?)".*?\/>/',$post->post_content,$matches ,PREG_SET_ORDER); ?>
		<?php if ( has_post_thumbnail() ) : //特色图片?>
		<div class="text gray3 indextext">
			<a href="<?php the_permalink(); ?>" class="thumbnail">
				<?php if ( has_post_thumbnail() ) : //特色图片?>
					<?php the_post_thumbnail(); ?>
				<?php else: //无特色图片?>
					<?php if ( $matches[0][1] ) ://文章内有图片 ?>
						<img src="<?php echo $matches [0][1];?>" />
					<?php else : //文章内没有图片?>
						
					<?php endif;//文章内有图片结束 ?>
				<?php endif;//特色图片结束 ?>
			</a>			
			<p>
			<?php
				if (has_excerpt()) {
					the_excerpt();
				} else {
					if (!post_password_required()) {
						echo f_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 100, '...');
					} else {
						echo '密码保护文章，暂无摘要！';
					}
				}
			?>
			</p>
			<p class="fz12 gray6 fr">
				<span><time datetime="<?php the_time('Y/m/d') ?>"><?php the_time('Y/m/d') ?></time></span> |
				<span>围观：<?php echo guimeng_get_post_views(get_the_ID()); ?>人</span> |
				<span href="<?php the_permalink() ?>#comment">评论<?php comments_number('', '1人', '%人' 			);?></span>
				
			</p>
        </div>
		<?php elseif ( $matches[0][1] ) ://文章内有图片 ?>
		<div class="text gray3">
			<a href="<?php the_permalink(); ?>" class="thumbnail">
				<?php if ( has_post_thumbnail() ) : //特色图片?>
					<?php the_post_thumbnail(); ?>
				<?php else: //无特色图片?>
					<?php if ( $matches[0][1] ) ://文章内有图片 ?>
						<img src="<?php echo $matches [0][1];?>" />
					<?php else : //文章内没有图片?>
						
					<?php endif;//文章内有图片结束 ?>
				<?php endif;//特色图片结束 ?>
			</a>			
			<p>
			<?php
				if (has_excerpt()) {
					the_excerpt();
				} else {
					if (!post_password_required()) {
						echo f_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 100, '...');
					} else {
						echo '密码保护文章，暂无摘要！';
					}
				}
			?>
			</p>
			<p class="fz12 fr gray6">
				<span><time datetime="<?php the_time('Y/m/d') ?>"><?php the_time('Y/m/d') ?></time></span> |
				<span>围观：<?php echo guimeng_get_post_views(get_the_ID()); ?>人</span> |
				<span href="<?php the_permalink() ?>#comment">评论<?php comments_number('', '1人', '%人' 			);?></span>
			</p>
        </div>
		<?php else: //无特色图片?>
			<div class="text gray3">				
				<p>
				<?php
					if (has_excerpt()) {
						the_excerpt();
					} else {
						if (!post_password_required()) {
							echo f_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 100, '...');
						} else {
							echo '密码保护文章，暂无摘要！';
						}
					}
				?>
				</p>
				<p class="fz12 gray6 fr">
					<span><time datetime="<?php the_time('Y/m/d') ?>"><?php the_time('Y/m/d')?></time></span> |
					<span>围观：<?php echo guimeng_get_post_views(get_the_ID()); ?>人</span> |
					<span href="<?php the_permalink() ?>#comment">评论<?php comments_number('', '1人', '%人' );?></span>
				</p>
			</div>
		<?php endif;//特色图片结束 ?>
</article>