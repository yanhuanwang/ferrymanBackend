<?php
namespace PHPMaker2019\ferryman;

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
$topMenu->addMenuItem(2, "mi_admin", $Language->MenuPhrase("2", "MenuText"), "adminlist.php", -1, "", IsLoggedIn() || AllowListMenu('{D49A959E-F136-47C9-B9D7-6B34755F62D4}admin'), FALSE, FALSE, "", "", TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(9, "mi_log", $Language->MenuPhrase("9", "MenuText"), "loglist.php", -1, "", IsLoggedIn() || AllowListMenu('{D49A959E-F136-47C9-B9D7-6B34755F62D4}log'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_mobile_confirm_code", $Language->MenuPhrase("10", "MenuText"), "mobile_confirm_codelist.php", -1, "", IsLoggedIn() || AllowListMenu('{D49A959E-F136-47C9-B9D7-6B34755F62D4}mobile_confirm_code'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_order", $Language->MenuPhrase("11", "MenuText"), "orderlist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{D49A959E-F136-47C9-B9D7-6B34755F62D4}order'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(1, "mi_user", $Language->MenuPhrase("1", "MenuText"), "userlist.php", -1, "", IsLoggedIn() || AllowListMenu('{D49A959E-F136-47C9-B9D7-6B34755F62D4}user'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_admin", $Language->MenuPhrase("2", "MenuText"), "adminlist.php", -1, "", IsLoggedIn() || AllowListMenu('{D49A959E-F136-47C9-B9D7-6B34755F62D4}admin'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(3, "mi_category", $Language->MenuPhrase("3", "MenuText"), "categorylist.php", -1, "", IsLoggedIn() || AllowListMenu('{D49A959E-F136-47C9-B9D7-6B34755F62D4}category'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_image", $Language->MenuPhrase("4", "MenuText"), "imagelist.php", -1, "", IsLoggedIn() || AllowListMenu('{D49A959E-F136-47C9-B9D7-6B34755F62D4}image'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_parcel_info", $Language->MenuPhrase("6", "MenuText"), "parcel_infolist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{D49A959E-F136-47C9-B9D7-6B34755F62D4}parcel_info'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(7, "mi_trip_info", $Language->MenuPhrase("7", "MenuText"), "trip_infolist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{D49A959E-F136-47C9-B9D7-6B34755F62D4}trip_info'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_request_trip", $Language->MenuPhrase("8", "MenuText"), "request_triplist.php", -1, "", IsLoggedIn() || AllowListMenu('{D49A959E-F136-47C9-B9D7-6B34755F62D4}request_trip'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>
