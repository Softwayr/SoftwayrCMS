<?php

namespace Softwayr;

class Page {
	
	private $name = "", $title = "", $content = "";
	
	private static $pages =  [];
	
	public function __construct( String $name, String $title, String $content ) {
		$this->name = $name;
		$this->title = $title;
		$this->content = $content;
	}
	
	public static function create( String $name, String $title, String $content ): Page {
		$page = new Page( $name, $title, $content );
		Page::$pages[ $name ] = $page;
		return $page;
	}
	
	public static function get( String $name ): Page {
		if( array_key_exists( $name, Page::$pages ) )
			return Page::$pages[ $name ];
		return null;
	}
	
	public function name(): String { return $this->name; }
	public function title(): String { return $this->title; }
	public function content(): String { return $this->content; }
}

