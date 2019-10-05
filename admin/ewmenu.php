<?php
namespace PHPMaker2020\project2;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(7, "mi_product", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "productlist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_supermarket", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "supermarketlist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>