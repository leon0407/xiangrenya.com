<?php

add_action('admin_menu','theme_setting');

function theme_setting(){
	add_theme_page(__('主题设置'),__('主题设置'),'edit_themes',basename(__FILE__),'setting');
	add_action('admin_init', 'register_theme_setting');
}

function register_theme_setting(){
	register_setting('settings_group','f_options');
}

function setting(){
	if ( isset($_REQUEST['settings-updated']) )
		echo '<div id="message" class="updated"><p><strong>主题设置已保存!</strong></p></div>';
	if ( 'reset' == isset($_REQUEST['reset']) ){
		delete_option('f_options');
		echo '<div id="message" class="updated"><p><strong>主题设置已重置!</strong></p></div>';
	}
$options=get_option('f_options');
?>
<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/admin/admin.css"/>
	<div class="bs-docs-header"><img src="<?php if($options["logo2"]){echo $options["logo2"];}else{echo get_bloginfo('template_directory').'/images/logo.jpg';} ?>"><h2>Forget主题设置</h2></div>
	<div class="wrap">
		<h2>forget主题设置</h2>
		<?php
			if(isset($_REQUEST['save'])){
				echo '<div id="message" class="updated fade"><p><strong> settings saved.</strong></p></div>';
			}
			if( 'reset' == isset($_REQUEST['reset']) ) {
				delete_option('f_options');
				echo '<div id="message" class="updated fade"><p><strong> settings reset.</strong></p></div>';
			}
		?>
		<form method="post" action="options.php">
			<?php settings_fields('settings_group'); ?>
			<?php $options=get_option('f_options'); ?>
			<div class="choice">
				<div><span class="span2">网站描述：</span><textarea type="textarea"  name="f_options[description]" placeholder="请用简洁干练的语言对你的网站进行描述"><?php echo $options['description']; ?></textarea></div>
			</div>	
			<div class="choice">
				<div><span class="span2">关键词语：</span><textarea type="textarea"  name="f_options[keywords]" placeholder="多个关键词请用英文逗号隔开"><?php echo $options['keywords']; ?></textarea></div>
			</div>
			<div class="choice">
				<div><span class="span2">网站图标：</span><input type="text" name="f_options[tubiao]" value="<?php echo $options['tubiao']; ?>" /></div>
			</div>
			<div class="choice">
				<div><span class="span2">头像链接：</span><input type="text" name="f_options[logo2]" value="<?php echo $options['logo2']; ?>" /></div>
			</div>
			<div class="choice">
				<div><span class="span2">头部大图：</span><input type="text" name="f_options[datu]" value="<?php echo $options['datu']; ?>" /></div>
				<div><span class="span2">头部名称：</span><input type="text" name="f_options[logo3]" value="<?php echo $options['logo3']; ?>" /></div>
				<div><span class="span2">头部描述：</span><input type="text" name="f_options[logo4]" value="<?php echo $options['logo4']; ?>" /></div>
			</div>
			<div class="choice">
				<div><span class="span2">座右铭称：</span><input type="text" name="f_options[motto]" value="<?php echo $options['motto']; ?>" /></div>
				<div><span class="span2">座右铭述：</span><input type="text" name="f_options[motto-tell]" value="<?php echo $options['motto-tell']; ?>" /></div>
			</div>
			<div class="choice">
				<div><span class="span2">网站公告：</span><textarea type="textarea" id="f_options[announcement]" name="f_options[announcement]"><?php echo $options['announcement']; ?></textarea></div>
			</div>
			<hr>
			<div class="choice">
				<div><span class="span2">页脚版权：</span><textarea type="textarea" id="f_options[footer]" name="f_options[footer]"><?php echo $options['footer']; ?></textarea></div>
			</div>
			<div class="submit">
				<input type="submit" name="Submit" value="保存设置"/>
			</div>
		</form>
		<form method="post">
			<div class="submit">
				<input type="submit" name="reset" value="重置"/>
				<input type="hidden" name="reset" value="reset" />
			</div>
		</form>
		<div style="padding:10px 0;color:rgba(0,0,0,0.4);">
			<p>感谢使用正版，发现问题可以到我<a href="http://azfashao.com">博客</a>留言或给我邮件azfashao@qq.com</p>
		</div>
		<div class="clear"></div>
	</div>
<?php } ?>