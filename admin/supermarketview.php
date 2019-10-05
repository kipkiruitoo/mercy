<?php
namespace PHPMaker2020\project2;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$supermarket_view = new supermarket_view();

// Run the page
$supermarket_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$supermarket_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$supermarket_view->isExport()) { ?>
<script>
var fsupermarketview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsupermarketview = currentForm = new ew.Form("fsupermarketview", "view");
	loadjs.done("fsupermarketview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$supermarket_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $supermarket_view->ExportOptions->render("body") ?>
<?php $supermarket_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $supermarket_view->showPageHeader(); ?>
<?php
$supermarket_view->showMessage();
?>
<form name="fsupermarketview" id="fsupermarketview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="supermarket">
<input type="hidden" name="modal" value="<?php echo (int)$supermarket_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($supermarket_view->supermarketID->Visible) { // supermarketID ?>
	<tr id="r_supermarketID">
		<td class="<?php echo $supermarket_view->TableLeftColumnClass ?>"><span id="elh_supermarket_supermarketID"><?php echo $supermarket_view->supermarketID->caption() ?></span></td>
		<td data-name="supermarketID" <?php echo $supermarket_view->supermarketID->cellAttributes() ?>>
<span id="el_supermarket_supermarketID">
<span<?php echo $supermarket_view->supermarketID->viewAttributes() ?>><?php echo $supermarket_view->supermarketID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($supermarket_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $supermarket_view->TableLeftColumnClass ?>"><span id="elh_supermarket_name"><?php echo $supermarket_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $supermarket_view->name->cellAttributes() ?>>
<span id="el_supermarket_name">
<span<?php echo $supermarket_view->name->viewAttributes() ?>><?php echo $supermarket_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($supermarket_view->location->Visible) { // location ?>
	<tr id="r_location">
		<td class="<?php echo $supermarket_view->TableLeftColumnClass ?>"><span id="elh_supermarket_location"><?php echo $supermarket_view->location->caption() ?></span></td>
		<td data-name="location" <?php echo $supermarket_view->location->cellAttributes() ?>>
<span id="el_supermarket_location">
<span<?php echo $supermarket_view->location->viewAttributes() ?>><?php echo $supermarket_view->location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($supermarket_view->logo->Visible) { // logo ?>
	<tr id="r_logo">
		<td class="<?php echo $supermarket_view->TableLeftColumnClass ?>"><span id="elh_supermarket_logo"><?php echo $supermarket_view->logo->caption() ?></span></td>
		<td data-name="logo" <?php echo $supermarket_view->logo->cellAttributes() ?>>
<span id="el_supermarket_logo">
<span<?php echo $supermarket_view->logo->viewAttributes() ?>><?php echo GetFileViewTag($supermarket_view->logo, $supermarket_view->logo->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$supermarket_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$supermarket_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$supermarket_view->terminate();
?>