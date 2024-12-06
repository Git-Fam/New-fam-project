<div class="C_categorySide">
    <div class="C_categorySide--inner">
        <h2 class="TL">Category</h2>
        <ul>
            <li class="hover-opa">
                <p class="TX <?php if (!is_tax('column-cat')) echo 'change'; ?>"><a href="<?php echo get_post_type_archive_link('column'); ?>">ALL</a></p>
            </li>
            <?php
            $current_term = get_queried_object();
            $terms = get_terms(array(
                'taxonomy' => 'column-cat',
                'hide_empty' => false,
            ));
            foreach ($terms as $term) {
                $class = (isset($current_term->term_id) && $current_term->term_id == $term->term_id) ? 'change' : '';
                echo '<li><p class="TX hover-opa ' . $class . '"><a href="' . get_term_link($term, 'column-cat') . '">' . $term->name . '</a></p></li>';
            }
            ?>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>