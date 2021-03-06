<?php
 
/**
  @ Thiết lập các hằng dữ liệu quan trọng
  @ THEME_URL = get_stylesheet_directory() - đường dẫn tới thư mục theme
  @ CORE = thư mục /core của theme, chứa các file nguồn quan trọng.
  **/
  define( 'THEME_URL', get_stylesheet_directory() );
  define( 'CORE', THEME_URL . '/core' );
 
/**
  @ Load file /core/init.php
  @ Đây là file cấu hình ban đầu của theme mà sẽ không nên được thay đổi sau này.
  **/
 
  require_once( CORE . '/init.php' );
 
 /**
  @ Thiết lập $content_width để khai báo kích thước chiều rộng của nội dung
  **/
  if ( ! isset( $content_width ) ) {
        /*
         * Nếu biến $content_width chưa có dữ liệu thì gán giá trị cho nó
         */
        $content_width = 620;
   }
 
/**
  @ Thiết lập các chức năng sẽ được theme hỗ trợ
  **/
  if ( ! function_exists( 'thachpham_theme_setup' ) ) {
        /*
         * Nếu chưa có hàm thachpham_theme_setup() thì sẽ tạo mới hàm đó
         */
        function thachpham_theme_setup() {
                /*
                 * Thiết lập theme có thể dịch được
                 */
                $language_folder = THEME_URL . '/languages';
                load_theme_textdomain( 'thachpham', $language_folder );
 
                /*
                 * Tự chèn RSS Feed links trong <head>
                 */
                add_theme_support( 'automatic-feed-links' );
 
                /*
                 * Thêm chức năng post thumbnail
                 */
                add_theme_support( 'post-thumbnails' );
 
                /*
                 * Thêm chức năng title-tag để tự thêm <title>
                 */
                add_theme_support( 'title-tag' );
 
                /*
                 * Thêm chức năng post format
                 */
                add_theme_support( 'post-formats',
                        array(
                                'video',
                                'image',
                                'audio',
                                'gallery'
                        )
                 );
 
                /*
                 * Thêm chức năng custom background
                 */
                $default_background = array(
                        'default-color' => '#e8e8e8',
                );
                add_theme_support( 'custom-background', $default_background );
 
                /*
                 * Tạo menu cho theme
                 */
                 register_nav_menu ( 'primary-menu', __('Primary Menu', 'thachpham') );
 
                /*
                 * Tạo sidebar cho theme
                 */
                 $sidebar = array(
                    'name' => __('Main Sidebar', 'thachpham'),
                    'id' => 'main-sidebar',
                    'description' => 'Main sidebar for Thachpham theme',
                    'class' => 'main-sidebar',
                    'before_title' => '<h3 class="widgettitle">',
                    'after_sidebar' => '</h3>'
                 );
                 register_sidebar( $sidebar );
        }
        add_action ( 'init', 'thachpham_theme_setup' );
 
  }


  /**
@ Thiết lập hàm hiển thị logo
@ thachpham_logo()
**/
if( ! function_exists('thachpham_logo') ) {
	function thachpham_logo() { ?>
		<div class="logo">
			<div class="site-name">
				<?php if( is_home() ) {
					printf(
						'<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
						get_bloginfo( 'url' ),
						get_bloginfo( 'description' ),
						get_bloginfo( 'sitename' )
						);
				} else {
					printf (
						'<a href="%1$s" title="%2$s">%3$s</a>',
						get_bloginfo('url'),
						get_bloginfo('description'),
						get_bloginfo('sitename')
						);
				} //endif ?>
			</div>
			<div class="site-description"><?php bloginfo('description'); ?></div>
		</div> <?php
	}
}

/**
@ Thiết lập hàm hiển thị menu
@ thachpham_menu( $slug )
**/
if ( ! function_exists('thachpham_menu') ) {
	function thachpham_menu($slug) {
		$menu = array (
			'theme_location' => $slug,
			'container' => $slug,
			'container_class' => $slug,
		);
		wp_nav_menu($menu);
	};
}

/**
Hàm tạo phân trang đơn giản
**/
if ( !function_exists('thachpham_pagination')) {
	function thachpham_pagination() {
		if ( $GLOBALS['wp_query']->max_num_pages <2 ) {
			return '';
		} ?>
		<nav class="pagination" role="navigation">
			<?php if( get_next_posts_link() ) : ?>
				<div class="prev"><?php next_posts_link( __('Older Posts', 'thachpham') ); ?></div>
			<?php endif; ?>
			<?php if( get_previous_posts_link() ) : ?>
				<div class="next"><?php previous_posts_link( __('Newest Posts', 'thachpham')); ?></div>
			<?php endif; ?>
		</nav>
	<?php }
}

/**
Hiển thị thumbnail, hàm sử dụng trong file content.php
**/
if ( !function_exists('thachpham_thumbnail')) {
  function thachpham_thumbnail($size) {
    //Kiểm tra xem trang này: ko phải là trang đơn (tức ta muốn hiển thị ngoài trang chủ hoặc trang bìa) && có thumbnail && ko yêu cầu pass || có format là image
    if (!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')) : ?>
    <figure class="post-thumbnail"><?php the_post_thumbnail($size); ?></figure>
    <?php endif; ?>
  <?php }
}

/**
thachpham_entry_header = hiển thị tiêu đề post
**/
if ( !function_exists('thachpham_entry_header') ) {
  function thachpham_entry_header() {?>
    <!--nếu trong trang single (trang hiển thị nội dung) -->
    <?php if ( is_single() ) : ?> 
      <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
    <?php else : ?>
       <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>  
     <?php endif; ?>
  <?php }
}

/**
thachpham_entry_meta - hien thi ten tac gia, tag ..
**/
if ( !function_exists('thachpham_entry_meta') ){
  function thachpham_entry_meta(){ ?>
    <?php if( !is_page() ) : ?>
      <div class="entry-meta">
      <?php
        //muốn cùng 1 hàng thì dùng span tag
        printf( __('<span class="author">Posts by %1$s', 'thachpham'),
          get_the_author() );
        printf( __('<span class="date-published"> at %1$s', 'thachpham'),
          get_the_date() );
        printf( __('<span class="category"> in %1$s ', 'thachpham'),
          get_the_category_list(',') );
        //hiển thị bình luận, tuy nhiên có 2 trường hợp là bình luận đã đóng hay còn mở
        if ( comments_open() ) :
          echo '<span class="meta-reply">';
          comments_popup_link(
            __('Leave a comment', 'thachpham'),
            __('One comment', 'thachpham'),
            __('% comments', 'thachpham'),
            __('Read all comments', 'thachpham')
            );
          echo '</span>';
        endif;
      ?>
      </div>
    <?php endif; ?>
  <?php }
}

/**
thachpham_entry_content - will be used in content.php
**/
if ( !function_exists('thachpham_entry_content')) {
  function thachpham_entry_content() {
    // ta co 2 vấn đề: ơ trang chủ ta chỉ hiển thị phần rút gọn, còn vào trang thì hiển thị full
    if(!is_single()){
      //hàm the_excerpt hiển thị 1 đoạn nội dung
      the_excerpt();
    } else {
      //hàm the_content hiển thị full content
      the_content();
      
      // phân trang trong single
      $link_pages = array(
        'before' => __('<p>Page: ', 'thachpham'),
        'after' => '</p>',
        'nextpagelink' => __('Next Page', 'thachpham'),
        'previouspagelink' => __('Previous Page'. 'thachpham')
        );
      // gọi hàm wp_link_pages để dùng biến vừa khai báo ở trên vào
      wp_link_pages( $link_pages );
    }
  }
}

/**
thachpham_readmore
**/
function thachpham_readmore() {
  return '<a class="read-more" href="'. get_permalink(get_the_ID()).'">'.__(' Read More', 'thachpham').'</a>';
}
add_filter('excerpt_more', 'thachpham_readmore');

/**
thachpham_entry_tag
**/
if( !function_exists('thachpham_entry_tag')) {
  function thachpham_entry_tag(){
    if(has_tag()) :
      echo '<div class="entry-tag">';
      printf(__('Tagged in %1$s', 'thachpham'),get_the_tag_list('',',')
        );
      echo '</div>';
    endif;
  }
}
