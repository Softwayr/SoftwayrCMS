<?php

use Softwayr\Navigation;
use Softwayr\Router;
use Softwayr\Page;

require_once 'Navigation.php';
require_once 'Router.php';
require_once 'Page.php';

$page_path = isset( $_GET['page_path'] ) ? $_GET['page_path'] : "";

Page::New( "Home", "Home", "Welcome to the home page." );
Page::New( "Contact", "Contact", "Get in touch using the details on this page." );

Page::New( "Account Dashboard", "Account Dashboard", "This is your account." );
Page::New( "Account Settings", "Account Settings", "Manage your account settings here." );

Page::GetPage( "Account Settings" )->option( "Navigation Class", "w3-right" );

Navigation::New([
	"name" => "Main Nav Menu",
	"class" => "w3-bar w3-dark-grey",
	"item_class" => "w3-bar-item w3-button"
]);

Navigation::New([
	"name" => "Account Nav Menu",
	"class" => "w3-bar w3-light-grey",
	"item_class" => "w3-bar-item w3-button"
]);

Router::BasePath( "index.php?page_path=" );

Router::CreateRoute( "Home", "", Page::GetPage("Home") );
Router::CreateRoute( "Contact", "contact", Page::GetPage("Contact") );

Navigation::GetNavigation( "Main Nav Menu" )->AddItem( Router::GetRoute("Home") );
Navigation::GetNavigation( "Main Nav Menu" )->AddItem( Router::GetRoute("Contact") );

Router::CreateRoute( "Account Dashboard", "account", Page::GetPage("Account Dashboard") );
Router::CreateRoute( "Account Settings", "account/settings", Page::GetPage("Account Settings") );

Navigation::GetNavigation( "Account Nav Menu" )->AddItem( Router::GetRoute("Account Dashboard") );
Navigation::GetNavigation( "Account Nav Menu" )->AddItem( Router::GetRoute("Account Settings") );

?><!DOCTYPT html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>SoftwayrCMS Demo</title>
		
		<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
	</head>
	
	<body>
	
		<?php echo Navigation::GetNavigation( "Main Nav Menu" )->Render(); ?>
		<?php echo Navigation::GetNavigation( "Account Nav Menu" )->Render(); ?>
		
		<div class="w3-container w3-padding">
			<?php Router::Route( $page_path ); ?>
		</div>
	</body>
</html>

