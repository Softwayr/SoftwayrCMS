<?php

use Softwayr\Navigation;
use Softwayr\Router;
use Softwayr\Page;

require_once 'Navigation.php';
require_once 'Router.php';
require_once 'Page.php';

$page_path = isset( $_GET['page_path'] ) ? $_GET['page_path'] : "";

Page::create( "Home", "Home", "Welcome to the home page.");
Page::create( "Contact", "Contact", "Get in touch using the details on this page.");

Page::create( "Account Dashboard", "Account Dashboard", "This is your account.");
Page::create( "Account Settings", "Account Settings", "Manage your account settings here.");

Navigation::create( [
	"name" => "Main Nav Menu",
	"class" => "w3-nav",
	"item_class" => "w3-nav-item"
]);

Navigation::create( [
	"name" => "Account Nav Menu",
	"class" => "w3-nav",
	"item_class" => "w3-nav-item"
]);

Router::base_path("index.php?page_path=");
Router::create( "Home", "", Page::get("Home") );
Router::create( "Contact", "contact", Page::get("Contact") );

Navigation::get("Main Nav Menu")->addItem( Router::get("Home") );
Navigation::get("Main Nav Menu")->addItem( Router::get("Contact") );
echo Navigation::get("Main Nav Menu")->render();

Router::create( "Account Dashboard", "account", Page::get("Account Dashboard") );
Router::create( "Account Settings", "account/settings", Page::get("Account Settings") );

Navigation::get("Account Nav Menu")->addItem( Router::get("Account Dashboard") );
Navigation::get("Account Nav Menu")->addItem( Router::get("Account Settings") );
echo Navigation::get("Account Nav Menu")->render();

Router::route( $page_path );

