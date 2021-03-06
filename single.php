<?php
// Exit if accessed directly

if (!defined('ABSPATH')) exit;
?>

<?php get_header(); ?>
<div class="id_blog blog-color">
    <?php if (have_posts()) : ?>

   <div class="container<?php if($smof_data['blog_text_align']==1) echo " text-center"; else echo "";?>">
        <h1><?php $category = get_the_category();
            echo $firstCategory = $category[0]->cat_name; ?></h1>
        <div class="lines sub_title"><?php echo $smof_data['blog_subtitle']; ?></div>

        <div class="row-fluid">
            <div class="span9">

                <?php while (have_posts()) : the_post(); ?>
                <!-- ========== POST SECTION ========== -->
                    <div <?php post_class();?>>
                        <div class="in-post">

                            <?php
                            // Post Format type detect Start
                            $format = get_post_format();
                            if ($format === "video") {
                                $post_class = 'full-box';
                                echo '<div class="full-box video-post">';
                                $video_type = get_field('video_type');
                                if ($video_type === "youtube") {
                                    echo '<div class="center" style="max-width:' . get_field('video_width') . 'px;max-height:' . get_field('video_height') . 'px;"><div class="video-shortcode"><iframe title="YouTube video player" width="' . get_field('video_width') . '" height="' . get_field('video_height') . '" src="http://www.youtube.com/embed/' . get_field('video_id') . '"></iframe></div></div>';
                                } elseif ($video_type === "vimeo") {
                                    echo '<div class="center" style="max-width:' . get_field('video_width') . 'px;max-height:' . get_field('video_height') . 'px;"><div class="video-shortcode"><iframe src="http://player.vimeo.com/video/' . get_field('video_id') . '" width="' . get_field('video_width') . '" height="' . get_field('video_height') . '"></iframe></div></div>';
                                } else {
                                    echo '<div class="center" style="max-width:' . get_field('video_width') . 'px;max-height:' . get_field('video_height') . 'px;"><div class="video-shortcode">' . get_field('iframe_code') . '</div></div>';
                                }
                                echo '</div>';
                            } elseif ($format === "gallery") {
                                $post_class = 'left-box whitebg post-stream';
                                echo '<div class="right-box gallery-strip">';
                                $gallery = get_field('gallery');
                                foreach ($gallery as $img) {
                                    echo '<img src="' . $img['sizes']['blog-thumb'] . '" alt=""/>';
                                }
                                echo '</div>';
                            } elseif ($format === "image") {
                                $post_class = 'full-box';
                                echo '<div class="full-box slider-post">';
                                $slider = get_field('slider_images');
                                echo '<div class="cycle-slideshow" data-cycle-timeout="5000" data-cycle-swipe="true" data-cycle-auto-height="425:320">';
                                echo '<div class="cycle-prev"><i class="icon-chevron-left"></i></div>';
                                echo '<div class="cycle-next"><i class="icon-chevron-right"></i></div>';
                                foreach ($slider as $slide) {
                                    echo '<img src="' . $slide['sizes']['blog-thumb'] . '" alt=""/>';
                                }
                                echo '</div>';
                                echo '</div>';
                            } else {
                                $post_class = 'full-box';
                                if (has_post_thumbnail()) {
                                    $post_class = 'right-box';
                                    ?>
                                    <div class="left-box stand-post">
                                        <div class="post_thumb">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('blog-thumb'); ?>
                                            </a>
                                        </div>

                                    </div>
                                <?php }
                            }
                            // Post Format type detect __End
                            ?>

                            <div class="<?php echo $post_class; ?>">
                                <div class="padding">
                                    <ul class="post_info unstyled inline">
                                        <?php if ($smof_data['blog_cat'] == 1) { ?>
                                            <li><?php the_category(', '); ?><span class="slash">/</span></li>
                                        <?php
                                        }
                                        if ($smof_data['blog_date'] == 1) {
                                            ?>
                                            <li class="blog_date">
                                                <?php the_time('d M Y'); ?><span class="slash">/</span>
                                            </li>
                                        <?php
                                        }
                                        if ($smof_data['blog_comment'] == 1) {
                                            ?>
                                            <li class="comments">
                                                <?php if ('open' == $post->comment_status) : ?>
                                                    <!-- If comments are open, but there are no comments. -->
                                                    <?php comments_popup_link(__('0 Comments','GoGetThemes'), __('1 Comments','GoGetThemes'), __('% Comments','GoGetThemes')); ?>
                                                <?php else : // comments are closed ?>

                                                    <!-- If comments are closed. -->
                                                    <?php _e('Comments Off.','GoGetThemes'); ?>
                                                <?php endif; ?>
                                                <span class="slash">/</span>
                                            </li>
                                        <?php
                                        }
                                        if ($smof_data['blog_author'] == 1) {
                                            ?>
                                            <li class="author">
                                                <?php _e('By','GoGetThemes'); ?> <?php the_author(); ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <h2 class="extrab"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="entry">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>

                            <?php the_tags(__('Tagged with:', 'GoGetThemes') . ' ', ', ', '<br />'); ?>


                        </div>
                    <?php if ($smof_data['blog_share'] == 1) { ?>
                        <div id="share" class="row-fluid">
                            <div class="span2"><?php _e('Shared','GoGetThemes'); ?></div>
                            <div class="span10">
                                <!-- AddThis Button BEGIN -->
                                <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                                    <a class="addthis_button_preferred_1"></a>
                                    <a class="addthis_button_preferred_2"></a>
                                    <a class="addthis_button_preferred_3"></a>
                                    <a class="addthis_button_preferred_4"></a>
                                    <a class="addthis_button_compact"></a>
                                    <a class="addthis_counter addthis_bubble_style"></a>
                                </div>
                                <script type="text/javascript"
                                        src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-516e76fe5514a72e"></script>
                                <!-- AddThis Button END -->
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($smof_data['blog_comment'] == 1) { comments_template('', true);} ?>

                    </div>
                <?php endwhile; ?>
            </div>
            <?php get_sidebar('blog'); ?>
        </div>

        <?php else : ?>
            <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'GoGetThemes'); ?></h1>
            <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'GoGetThemes'); ?></p>
            <h6><?php _e('You can return', 'GoGetThemes'); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e('Home', 'GoGetThemes'); ?>"><?php _e('&larr; Home', 'GoGetThemes'); ?></a> <?php _e('or search for the page you were looking for', 'GoGetThemes'); ?></h6>
            <?php get_search_form(); ?>
        <?php endif; ?>
        </div>
        <div class="bot-border"><div class="bot-border-left"></div><div class="bot-border-right"></div></div>

</div>





<?php get_footer(); ?>

