<?php
/**
 * お知らせまわりで共通の設定（アーカイブ・フロントで使用）
 * URL やラベルはここで一元管理
 */

// このサイトのカテゴリ（スラッグ => 表示名）
function get_news_this_site_category_slugs()
{
	return array(
		'news'    => 'お知らせ',
		'recruit' => '採用情報',
	);
}

// 別サイトの投稿を表示するタブ（api_base を変更するとアーカイブ・フロント両方に反映）
function get_news_external_site_config()
{
	return array(
		'kindergarten'       => array( 'label' => '幼稚園',       'api_base' => '' ),
		'elementary-school'  => array( 'label' => '小学校',       'api_base' => '' ),
		'middle-school'      => array( 'label' => '中学校・高等学校', 'api_base' => '' ),
		'junior-college'     => array( 'label' => '短期大学',     'api_base' => '' ),
		'university'         => array( 'label' => '大学',         'api_base' => '' ),
	);
}
