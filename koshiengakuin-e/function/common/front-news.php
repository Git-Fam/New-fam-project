<?php
/**
 * Helper to render news items for a given category slug.
 * Usage: koshien_render_news_items( $cat_slug );
 * Pass empty string for all posts.
 */
if ( ! function_exists( 'koshien_render_news_items' ) ) {
    function koshien_render_news_items( $cat_slug = '' ) {
        $args = array(
            'posts_per_page' => 6,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        // If category identifier provided, try to resolve it to a term ID or slug.
        if ( ! empty( $cat_slug ) ) {
            $resolved = false;

            // Try slug first
            if ( function_exists( 'get_category_by_slug' ) ) {
                $term = get_category_by_slug( $cat_slug );
                if ( $term && ! is_wp_error( $term ) ) {
                    $args['cat'] = $term->term_id;
                    $resolved = true;
                }
            }

            // Try term by name
            if ( ! $resolved ) {
                $term = get_term_by( 'name', $cat_slug, 'category' );
                if ( $term && ! is_wp_error( $term ) ) {
                    $args['cat'] = $term->term_id;
                    $resolved = true;
                }
            }

            // Try numeric id
            if ( ! $resolved && is_numeric( $cat_slug ) ) {
                $args['cat'] = intval( $cat_slug );
                $resolved = true;
            }

            // If still not resolved, try using it as category_name (slug-like)
            if ( ! $resolved ) {
                $args['category_name'] = $cat_slug;
            }
        }

        $q = new WP_Query( $args );

        if ( $q->have_posts() ) {
            while ( $q->have_posts() ) {
                $q->the_post();

                $thumb = get_the_post_thumbnail_url( get_the_ID(), '' );
                if ( ! $thumb ) {
                    $thumb = get_template_directory_uri() . '/img/no-image.jpg';
                }

                $date = get_the_date( 'Y.m.d' );
                $cats = get_the_category();
                $cat_label = ! empty( $cats ) ? esc_html( $cats[0]->name ) : '';

                ?>
                <a class="p-archive__item" href="<?php echo esc_url( get_permalink() ); ?>">
                    <div class="p-archive__image pc-mgb-10"><img src="<?php echo esc_url( $thumb ); ?>" alt="" loading="lazy"></div>
                    <div class="p-archive__content">
                        <div class="p-archive__head pc-mgb-5">
                            <span class="p-archive__date font-avenir"><?php echo esc_html( $date ); ?></span>
                            <div>
                                <span class="c-label"><?php echo $cat_label; ?></span>
                            </div>
                        </div>
                        <span class="p-archive__title"><?php echo esc_html( get_the_title() ); ?></span>
                    </div>
                </a>
                <?php
            }
            wp_reset_postdata();
        } else {
            if ( defined( 'WP_DEBUG' ) && WP_DEBUG && current_user_can( 'manage_options' ) ) {
                echo '<p class="p-archive__none">記事はありません。 (デバッグ: query_args=' . esc_html( wp_json_encode( $args ) ) . ' )</p>';
            } else {
                echo '<p class="p-archive__none">記事はありません。</p>';
            }
        }
    }
}
