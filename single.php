<?php get_header(); ?>

<div id="content">
	<div id="main-content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part('content', get_post_format()); /*nghĩa là lấy nội dung trang content.php*/?>

		<?php endwhile ?>
		<?php thachpham_pagination(); ?>
		<?php else: ?>
			<?php get_template_part('content', 'none'); /*nếu ko có post thì lấy trang content-none.php */?>
		<?php endif; ?>
	</div>
	<div id="sidebar">
		<?php get_sidebar(); /*lấy trang sidebar.php */ ?>
	</div>
</div>

<?php get_footer(); ?>