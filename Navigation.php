<?php

namespace Softwayr;

class Navigation {
	private $name = "";
	private $class = "", $item_class = "";
	private $items = [];
	
	private static $navigations = [];
	
	private function __construct( $options = null ) {
		if( $options != null && is_array( $options ) && count( $options ) > 0 ) {
			foreach ( $options as $option_key => $option_value ) {
				if( $option_key == "name" )
					$this->name = $option_value;
				if( $option_key == "class" )
					$this->class = $option_value;
				if( $option_key == "item_class" )
					$this->item_class = $option_value;
			}
		}
	}
	
	public static function New( $options = [], callable $callable = null ): Navigation {
		if( $options != null && is_array( $options ) && count( $options ) > 0 ) {
			if( array_key_exists( "name", $options ) ) {
				$navigation = new Navigation( $options );
				Navigation::$navigations[ $options['name'] ] = $navigation;
				
				if( $callable != null )
					call_user_func( $callable );
				
				return $navigation;
			}
		}
	}
	
	/*public static function add( Route $route ) {
		end( Navigation::$navigations );
		Navigation::get( key( Navigation::$navigations ) ).addItem( $route );
	}*/
	
	public static function GetNavigation( String $name ): Navigation {
		if( array_key_exists( $name, Navigation::$navigations ) )
			return Navigation::$navigations[ $name ];
		return null;
	}
	
	public function items() {
		return $this->items;
	}
	
	public function AddItem( Route $route ) {
		$this->items[] = $route;
	}
	
	public function Render() {
		$output = "";
		if ( count( $this->items ) > 0 ) {
			$output .= "\n\n<nav id=\"nav";
			if ( $this->name != "" ) {
				$output .= "-" . strtolower( str_replace( " ", "-", $this->name ) );
			}
			$output .= "\"";
			
			if( $this->class != "" ) {
				$output .= " class=\"" . $this->class . "\"";
			}
			
			$output .= ">";
			foreach ( $this->items as $item ) {
				$output .= "\n\t<a href=\"" . Router::BasePath() . $item->path() . "\"";
				
				if( $this->item_class != "" || $item->page()->hasOption( "Navigation Class" ) )
					$output .= " class=\"";
				if( $this->item_class != "" )
					$output .= $this->item_class;
				if( $this->item_class != "" && $item->page()->hasOption( "Navigation Class" ) )
					$output .= " ";
				if( $item->page()->hasOption( "Navigation Class" ) )
					$output .= $item->page()->option( "Navigation Class" );
				if( $this->item_class != "" || $item->page()->hasOption( "Navigation Class" ) )
					$output .= "\"";
				
				$output .= ">" . $item->name() . "</a>";
			}
			$output .= "\n</nav>\n\n";
		}
		return $output;
	}
	
	public function name() {
		return $this->name;
	}
}

