<?php
/*
Plugin Name: Search Highlighter
Description: Highlight searched words when you search
Version: 1.0
*/

class SearchHighlighter {
	// プラグインは一般的にクラスを用いて作成されるケースが多い。クラスを用いていれば関数名の重複を回避できる上、処理の流れを管理しやすいなどメリットが多い。
	public function __construct() {
		add_filter( 'the_title', array( $this, 'highlight_keywords' ) ); // クラスを用いてフックするときには、フックの第二引数は [ クラス名, メソッド名 ] のように配列形式で指定する必要がある
		add_filter( 'get_the_excerpt', array( $this, 'highlight_keywords' ) );
	}

	public function highlight_keywords( $text ) {
		if ( is_search() ) {
			$keys = explode( ' ', get_search_query() );
			foreach ( $keys as $key ) {
				$text = str_replace( $key, '<span style="background:#ffff00">' . $key . '</span>', $text );
			}
		}
		return $text;
	}
}

$SearchHighlighter = new SearchHighlighter();