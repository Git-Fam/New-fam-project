<?php

function enqueue_random_event_script() {
	wp_enqueue_script(
		'random-glitter',
		get_template_directory_uri() . '/js/road-random.js',
		['jquery'],
		null,
		true
	);

	// カスタム投稿タイプ "random" の投稿を取得し、URL化
	$random_posts = get_posts([
		'post_type' => 'random',
		'numberposts' => -1,
		'post_status' => 'publish',
	]);

	$event_links = array_map(function($post) {
		return add_query_arg([
			'type' => 'random',
			'id'   => $post->ID,
		], home_url('/randomevent'));
	}, $random_posts);

	// 各カテゴリーごとに、未達成の通常投稿のヒントURLを用意
	$categories = get_categories(['hide_empty' => false]);
	$hint_links = [];

	foreach ($categories as $cat) {
		$posts = get_posts([
			'post_type'      => 'post',
			'posts_per_page' => -1,
			'category'       => $cat->term_id,
			'post_status'    => 'publish',
		]);

		$uncompleted_links = [];

		foreach ($posts as $post) {
			$progress = get_user_meta(get_current_user_id(), $post->ID, true); // ユーザーごとの進捗（0〜100）
			$hint     = get_field('hint', $post->ID); // ACFフィールド "hint"

			if ((int)$progress < 100 && !empty($hint)) {
				$link = add_query_arg([
					'type' => 'post',
					'id'   => $post->ID,
				], home_url('/randomevent'));
				$uncompleted_links[] = $link;
			}
		}

		if (!empty($uncompleted_links)) {
			$hint_links[$cat->slug] = $uncompleted_links;
		}
	}

	wp_localize_script('random-glitter', 'RandomLinksData', [
		'hintLinks'  => $hint_links,  // カテゴリスラッグごとの hint リンク一覧
		'eventLinks' => $event_links, // random 投稿タイプの URL 一覧
	]);
}

add_action('wp_enqueue_scripts', 'enqueue_random_event_script');
