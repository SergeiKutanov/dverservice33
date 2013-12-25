<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
            <?php
                if(is_page()){
                    if(!$post->post_parent){
                        $my_wp_query = new WP_Query();
                        $all_wp_pages = $my_wp_query->query(array(
                            'post_type' => 'page',
                            'orderby'   => 'title',
                            'order'     => 'ASC',
                            'posts_per_page'    => -1
                        ));
                        $children = get_page_children($post->ID, $all_wp_pages);?>
                        <ul class="main_subs">
                        <?php foreach($children as $child){?>
                            <li><a href="
                                <?php
                                echo get_page_link($child);
                                ?>
                            "><?php echo $child->post_title; ?></a></li>
                        <?php } ?>
                        </ul>
                        <?php
                    }
                }
            ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>