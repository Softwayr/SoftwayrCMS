<?php

namespace Softwayr;

class Page {
	
	private $name, $title, $content, $options;
	
	private static $pages =  [];
	
	public function __construct( String $name, String $title, String $content, array $options = [] ) {
		$this->name = $name;
		$this->title = $title;
		$this->content = $content;
		$this->options = $options;
	}
	
	public static function New( String $name, String $title, String $content, array $options = [] ): Page {
		$page = new Page( $name, $title, $content, $options );
		Page::$pages[ $name ] = $page;
		return $page;
	}
	
	public static function GetPage( String $name ): Page {
		if( array_key_exists( $name, Page::$pages ) )
			return Page::$pages[ $name ];
		return null;
	}
	
	public function hasOption( String $option ): bool {
		return array_key_exists( $option, $this->options ) && $this->options[ $option ] != "";
	}
	
	public function option( String $option, String $value = "" ): String {
		if( $option && $value ) {
			$this->options[ $option ] = $value;
			return $this->options[ $option ];
		} else if( $option && $this->hasOption( $option ) ) {
			return $this->options[ $option ];
		}
		return null;
	}
	
	public function name(): String { return $this->name; }
	public function title(): String { return $this->title; }
	public function content(): String { return $this->content; }
	public function options(): array { return $this->options; }
}

