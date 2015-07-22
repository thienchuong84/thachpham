<!--
<article id="<?php the_ID(); ?>" <?php post_class(); ?> >
	<div class="entry-thumbnail">
		<?php thachpham_thumbnail('thumbnail'); ?>
	</div>
	<div class="entry-header">
		<?php thachpham_entry_header(); ?>
		<?php thachpham_entry_meta(); //meta gồm tên tác giả, danh mục .. ?>
	</div>
	<div class="entry-content">
		<?php thachpham_entry_content(); ?>
		<?php //chỉ hiển thị tag trong trang single thôi, dùng hàm if rút gọn
		( is_single() ? thachpham_entry_tag() : '' );
		?>
	</div>
</article>
-->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
                <?php thachpham_entry_header(); ?>
        </header>
        <div class="entry-content">
                <?php the_content(); ?>
                <?php
                        if ( is_single() ) :
                                thachpham_entry_tag();
                        endif;
                ?>
        </div>
</article>