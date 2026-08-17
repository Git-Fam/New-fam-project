<?php

/**
 * お知らせまわりで共通の設定（アーカイブ・フロントで使用）
 * 別サイトの api_base は管理画面「お知らせ連携」から変更可能
 */

// このサイトのカテゴリ（スラッグ => 表示名）
function get_news_this_site_category_slugs()
{
	return array(
		'news'    => 'お知らせ',
		'recruit' => '採用情報',
	);
}

// 別サイトのタブ定義（キー => 表示名）。api_base は管理画面で設定
function get_news_external_site_labels()
{
	return array(
		'kindergarten'      => '幼稚園',
		'elementary-school' => '小学校',
		'middle-school'     => '中学校・高等学校',
		'junior-college'    => '短期大学',
		'university'        => '大学',
	);
}

/**
 * 別サイトの投稿を表示するタブ設定
 * api_base はオプション koshien_news_external_apis から取得
 */
function get_news_external_site_config()
{
	$labels = get_news_external_site_labels();
	$saved  = get_option('koshien_news_external_apis', array());
	if (!is_array($saved)) {
		$saved = array();
	}

	$config = array();
	foreach ($labels as $key => $label) {
		$api_base = isset($saved[$key]) ? untrailingslashit(esc_url_raw($saved[$key])) : '';
		$config[$key] = array(
			'label'    => $label,
			'api_base' => $api_base,
		);
	}
	return $config;
}

// --- 管理画面「お知らせ連携」 ---

function koshien_news_external_admin_menu()
{
	add_menu_page(
		'お知らせ連携',
		'お知らせ連携',
		'manage_options',
		'koshien-news-external',
		'koshien_news_external_settings_page',
		'dashicons-rss',
		81
	);
}
add_action('admin_menu', 'koshien_news_external_admin_menu');

function koshien_news_external_register_settings()
{
	register_setting(
		'koshien_news_external_group',
		'koshien_news_external_apis',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'koshien_news_external_sanitize_apis',
			'default'           => array(),
		)
	);
}
add_action('admin_init', 'koshien_news_external_register_settings');

function koshien_news_external_sanitize_apis($input)
{
	$labels = get_news_external_site_labels();
	$clean  = array();

	if (!is_array($input)) {
		$input = array();
	}

	foreach ($labels as $key => $label) {
		$url = isset($input[$key]) ? trim((string) $input[$key]) : '';
		if ($url === '') {
			$clean[$key] = '';
			continue;
		}
		$clean[$key] = untrailingslashit(esc_url_raw($url));
	}

	return $clean;
}

function koshien_news_external_settings_page()
{
	if (!current_user_can('manage_options')) {
		return;
	}

	$labels = get_news_external_site_labels();
	$saved  = get_option('koshien_news_external_apis', array());
	if (!is_array($saved)) {
		$saved = array();
	}
	?>
	<div class="wrap">
		<h1>お知らせ連携（別サイト URL）</h1>
		<p>各サイトの WordPress ルート URL を入力してください（末尾スラッシュなし）。空欄のタブは投稿を取得しません。</p>
		<p>例: <code>https://example.com</code> → <code>https://example.com/wp-json/wp/v2/posts</code> を取得します。</p>
		<form method="post" action="options.php">
			<?php settings_fields('koshien_news_external_group'); ?>
			<table class="form-table" role="presentation">
				<tbody>
					<?php foreach ($labels as $key => $label) :
						$value = isset($saved[$key]) ? $saved[$key] : '';
						?>
						<tr>
							<th scope="row">
								<label for="koshien_news_api_<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></label>
							</th>
							<td>
								<input
									type="url"
									class="regular-text"
									id="koshien_news_api_<?php echo esc_attr($key); ?>"
									name="koshien_news_external_apis[<?php echo esc_attr($key); ?>]"
									value="<?php echo esc_attr($value); ?>"
									placeholder="https://example.com"
								>
								<p class="description">キー: <code><?php echo esc_html($key); ?></code></p>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php submit_button('変更を保存'); ?>
		</form>
	</div>
	<?php
}
