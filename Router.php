<?php

namespace Softwayr;

require_once 'Route.php';

class Router {
	
	private static $base_path = "/";
	private static $routes = [ ];
	
	public static function add(Route $route) {
		Router::$routes [ $route->name() ] = $route;
	}
	
	public static function create( String $name, String $path, Page $page ): Route {
		$route = new Route( $name, $path, $page );
		Router::add( $route );
		return $route;
	}
	
	public static function get( String $name ): Route {
		if (array_key_exists ( $name, Router::$routes ))
			return Router::$routes [ $name ];
		return null;
	}
	
	public static function find(array $params): array {
		$routes_found = [ ];
		
		foreach ( Router::$routes as $route ) {
			$params_found = 0;
			
			foreach ( $params as $param_key => $param_value ) {
				if (method_exists ( $route, $param_key ) ) {
					$method_value = call_user_func ( [
							$route,
							$param_key
					] );
					
					if( $method_value == $param_value) {
						$params_found ++;
					}
				}
			}
			
			if ($params_found == count ( $params )) {
				$routes_found [] = $route;
			}
		}
		
		return $routes_found;
	}
	
	public static function base_path( String $base_path = null ) {
		return $base_path != null ? Router::$base_path = $base_path : Router::$base_path;
	}
	
	public static function route( String $page_path ) {
		$routes_found = Router::find([ 'path' => $page_path ]);
		
		if( count( $routes_found ) == 1 ) {
			echo "<h2>" . $routes_found[0]->page()->title() . "</h2>";
			echo "<p>" . $routes_found[0]->page()->content() . "</p>";
		} else {
			header("HTTP/1.0 404 Not Found");
			echo "<h2>Not Found (404)</h2>";
			echo "<p>Sorry, nothing to be found here.</p>";
		}
	}
}

