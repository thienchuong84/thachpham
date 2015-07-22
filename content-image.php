<!-- content.php
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
                <?php thachpham_thumbnail( 'large' ); ?>
                <?php thachpham_entry_header(); ?>
                <?php
                        /*
                         * Đếm số lượng attachment có trong post
                         */
                        $attachments = get_children( array( 'post_parent'=>$post->ID ) );
                        $attachment_number = count($attachments);
                        printf( __('This image post contains %1$s photos', 'thachpham'), $attachment_number );
                ?>
        </header>
        <div class="entry-content">
                <?php thachpham_entry_content(); ?>
                <?php
                        if ( is_single() ) :
                                thachpham_entry_tag();
                        endif;
                ?>
        </div>
</article>