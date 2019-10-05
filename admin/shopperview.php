<?php
namespace PHPMaker2020\project1;

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
$shopper_view = new shopper_view();

// Run the page
$shopper_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shopper_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$shopper_view->isExport()) { ?>
<script>
var fshopperview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fshopperview = currentForm = new ew.Form("fshopperview", "view");
	loadjs.done("fshopperview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$shopper_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $shopper_view->ExportOptions->render("body") ?>
<?php $shopper_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $shopper_view->showPageHeader(); ?>
<?php
$shopper_view->showMessage();
?>
<form name="fshopperview" id="fshopperview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shopper">
<input type="hidden" name="modal" value="<?php echo (int)$shopper_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($shopper_view->shopperID->Visible) { // shopperID ?>
	<tr id="r_shopperID">
		<td class="<?php echo $shopper_view->TableLeftColumnClass ?>"><span id="elh_shopper_shopperID"><?php echo $shopper_view->shopperID->caption() ?></span></td>
		<td data-name="shopperID" <?php echo $shopper_view->shopperID->cellAttributes() ?>>
<span id="el_shopper_shopperID">
<span<?php echo $shopper_view->shopperID->viewAttributes() ?>><?php echo $shopper_view->shopperID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($shopper_view->shopperName->Visible) { // shopperName ?>
	<tr id="r_shopperName">
		<td class="<?php echo $shopper_view->TableLeftColumnClass ?>"><span id="elh_shopper_shopperName"><?php echo $shopper_view->shopperName->caption() ?></span></td>
		<td data-name="shopperName" <?php echo $shopper_view->shopperName->cellAttributes() ?>>
<span id="el_shopper_shopperName">
<span<?php echo $shopper_view->shopperName->viewAttributes() ?>><?php echo $shopper_view->shopperName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($shopper_view->shopperPhoneNo->Visible) { // shopperPhoneNo ?>
	<tr id="r_shopperPhoneNo">
		<td class="<?php echo $shopper_view->TableLeftColumnClass ?>"><span id="elh_shopper_shopperPhoneNo"><?php echo $shopper_view->shopperPhoneNo->caption() ?></span></td>
		<td data-name="shopperPhoneNo" <?php echo $shopper_view->shopperPhoneNo->cellAttributes() ?>>
<span id="el_shopper_shopperPhoneNo">
<span<?php echo $shopper_view->shopperPhoneNo->viewAttributes() ?>><?php echo $shopper_view->shopperPhoneNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($shopper_view->shopperEmail->Visible) { // shopperEmail ?>
	<tr id="r_shopperEmail">
		<td class="<?php echo $shopper_view->TableLeftColumnClass ?>"><span id="elh_shopper_shopperEmail"><?php echo $shopper_view->shopperEmail->caption() ?></span></td>
		<td data-name="shopperEmail" <?php echo $shopper_view->shopperEmail->cellAttributes() ?>>
<span id="el_shopper_shopperEmail">
<span<?php echo $shopper_view->shopperEmail->viewAttributes() ?>><?php echo $shopper_view->shopperEmail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$shopper_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$shopper_view->isExport()) { ?>
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
$shopper_view->terminate();
?>