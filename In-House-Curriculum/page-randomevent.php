<?php get_header(); ?>

<?php
$type = $_GET['type'] ?? '';
$id   = intval($_GET['id'] ?? 0);

$wrap_classes = ['random-wrap'];

if ($type && $id) {
    $post = get_post($id);

    if ($post && $post->post_type === $type) {
        setup_postdata($post);

        if ($type === 'post') {
            $wrap_classes[] = 'post';
        }

        if ($type === 'random') {
            $terms = get_the_terms($id, 'random-cat');
            if (!is_wp_error($terms) && !empty($terms)) {
                foreach ($terms as $term) {
                    $wrap_classes[] = 'cat-' . esc_attr($term->slug);
                }
            }
        }
        ?>
        <div class="<?php echo implode(' ', $wrap_classes); ?>">
            <div class="inner">
                <div class="TL_wrap">
                <h1><?php the_title(); ?><span>のヒント</span></h1>
                <div class="event_character"></div>
                </div>
                <div class="event-content"><?php the_content(); ?></div>

                <?php if ($type === 'post') :
                    $hint = get_field('hint', $id);
                    if (!empty($hint)) : ?>
                        <div class="hint"><?php echo esc_html($hint); ?></div>
                    <?php endif;
                endif; ?>

                <?php if ($type === 'random') : ?>
                    <div class="random-coin-get" data-post-id="<?php echo esc_attr($id); ?>">
                        <div class="get-content">
                            <div class="get-coin"></div>
                            <p class="get-TX"><span>5</span>コインGet!!</p>
                        </div>
                    
                    </div>
            <?php endif; ?>
            </div>
        </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const coinBtn = document.querySelector(".random-coin-get");
        if (!coinBtn) return;

        coinBtn.addEventListener("click", () => {
            const postId = coinBtn.dataset.postId;

            fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams({
                    action: "add_random_coin",
                    post_id: postId,
                }),
            })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    coinBtn.textContent = "コイン受け取り完了!";
                    coinBtn.classList.add("received");
                    coinBtn.style.pointerEvents = "none";
                } else {
                    alert(data.data);
                }
            })
            .catch(() => {
                alert("通信エラーが発生しました");
            });
        });
    });
    </script>

    <?php
            wp_reset_postdata();
        } else {
            echo '<div class="random-wrap">該当データが見つかりませんでした</div>';
        }
    } else {
        echo '<div class="random-wrap">パラメータが不足しています</div>';
    }
    ?>

    <?php get_footer(); ?>
