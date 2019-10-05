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
$product_view = new product_view();

// Run the page
$product_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$product_view->isExport()) { ?>
<script>
var fproductview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproductview = currentForm = new ew.Form("fproductview", "view");
	loadjs.done("fproductview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$product_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $product_view->ExportOptions->render("body") ?>
<?php $product_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $product_view->showPageHeader(); ?>
<?php
$product_view->showMessage();
?>
<form name="fproductview" id="fproductview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product">
<input type="hidden" name="modal" value="<?php echo (int)$product_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($product_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_ID"><?php echo $product_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $product_view->ID->cellAttributes() ?>>
<span id="el_product_ID">
<span<?php echo $product_view->ID->viewAttributes() ?>><?php echo $product_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_name"><?php echo $product_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $product_view->name->cellAttributes() ?>>
<span id="el_product_name">
<span<?php echo $product_view->name->viewAttributes() ?>><?php echo $product_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->code->Visible) { // code ?>
	<tr id="r_code">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_code"><?php echo $product_view->code->caption() ?></span></td>
		<td data-name="code" <?php echo $product_view->code->cellAttributes() ?>>
<span id="el_product_code">
<span<?php echo $product_view->code->viewAttributes() ?>><?php echo $product_view->code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->amountLeft->Visible) { // amountLeft ?>
	<tr id="r_amountLeft">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_amountLeft"><?php echo $product_view->amountLeft->caption() ?></span></td>
		<td data-name="amountLeft" <?php echo $product_view->amountLeft->cellAttributes() ?>>
<span id="el_product_amountLeft">
<span<?php echo $product_view->amountLeft->viewAttributes() ?>><?php echo $product_view->amountLeft->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->price->Visible) { // price ?>
	<tr id="r_price">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_price"><?php echo $product_view->price->caption() ?></span></td>
		<td data-name="price" <?php echo $product_view->price->cellAttributes() ?>>
<span id="el_product_price">
<span<?php echo $product_view->price->viewAttributes() ?>><?php echo $product_view->price->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->supermarket->Visible) { // supermarket ?>
	<tr id="r_supermarket">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_supermarket"><?php echo $product_view->supermarket->caption() ?></span></td>
		<td data-name="supermarket" <?php echo $product_view->supermarket->cellAttributes() ?>>
<span id="el_product_supermarket">
<span<?php echo $product_view->supermarket->viewAttributes() ?>><?php echo $product_view->supermarket->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->picture->Visible) { // picture ?>
	<tr id="r_picture">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_picture"><?php echo $product_view->picture->caption() ?></span></td>
		<td data-name="picture" <?php echo $product_view->picture->cellAttributes() ?>>
<span id="el_product_picture">
<span><?php echo GetFileViewTag($product_view->picture, $product_view->picture->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$product_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$product_view->isExport()) { ?>
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
$product_view->terminate();
?>