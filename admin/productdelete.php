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
$product_delete = new product_delete();

// Run the page
$product_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproductdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproductdelete = currentForm = new ew.Form("fproductdelete", "delete");
	loadjs.done("fproductdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $product_delete->showPageHeader(); ?>
<?php
$product_delete->showMessage();
?>
<form name="fproductdelete" id="fproductdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($product_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($product_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $product_delete->ID->headerCellClass() ?>"><span id="elh_product_ID" class="product_ID"><?php echo $product_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->name->Visible) { // name ?>
		<th class="<?php echo $product_delete->name->headerCellClass() ?>"><span id="elh_product_name" class="product_name"><?php echo $product_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->code->Visible) { // code ?>
		<th class="<?php echo $product_delete->code->headerCellClass() ?>"><span id="elh_product_code" class="product_code"><?php echo $product_delete->code->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->amountLeft->Visible) { // amountLeft ?>
		<th class="<?php echo $product_delete->amountLeft->headerCellClass() ?>"><span id="elh_product_amountLeft" class="product_amountLeft"><?php echo $product_delete->amountLeft->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->price->Visible) { // price ?>
		<th class="<?php echo $product_delete->price->headerCellClass() ?>"><span id="elh_product_price" class="product_price"><?php echo $product_delete->price->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->supermarket->Visible) { // supermarket ?>
		<th class="<?php echo $product_delete->supermarket->headerCellClass() ?>"><span id="elh_product_supermarket" class="product_supermarket"><?php echo $product_delete->supermarket->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->picture->Visible) { // picture ?>
		<th class="<?php echo $product_delete->picture->headerCellClass() ?>"><span id="elh_product_picture" class="product_picture"><?php echo $product_delete->picture->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$product_delete->RecordCount = 0;
$i = 0;
while (!$product_delete->Recordset->EOF) {
	$product_delete->RecordCount++;
	$product_delete->RowCount++;

	// Set row properties
	$product->resetAttributes();
	$product->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$product_delete->loadRowValues($product_delete->Recordset);

	// Render row
	$product_delete->renderRow();
?>
	<tr <?php echo $product->rowAttributes() ?>>
<?php if ($product_delete->ID->Visible) { // ID ?>
		<td <?php echo $product_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_ID" class="product_ID">
<span<?php echo $product_delete->ID->viewAttributes() ?>><?php echo $product_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->name->Visible) { // name ?>
		<td <?php echo $product_delete->name->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_name" class="product_name">
<span<?php echo $product_delete->name->viewAttributes() ?>><?php echo $product_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->code->Visible) { // code ?>
		<td <?php echo $product_delete->code->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_code" class="product_code">
<span<?php echo $product_delete->code->viewAttributes() ?>><?php echo $product_delete->code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->amountLeft->Visible) { // amountLeft ?>
		<td <?php echo $product_delete->amountLeft->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_amountLeft" class="product_amountLeft">
<span<?php echo $product_delete->amountLeft->viewAttributes() ?>><?php echo $product_delete->amountLeft->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->price->Visible) { // price ?>
		<td <?php echo $product_delete->price->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_price" class="product_price">
<span<?php echo $product_delete->price->viewAttributes() ?>><?php echo $product_delete->price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->supermarket->Visible) { // supermarket ?>
		<td <?php echo $product_delete->supermarket->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_supermarket" class="product_supermarket">
<span<?php echo $product_delete->supermarket->viewAttributes() ?>><?php echo $product_delete->supermarket->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->picture->Visible) { // picture ?>
		<td <?php echo $product_delete->picture->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_picture" class="product_picture">
<span><?php echo GetFileViewTag($product_delete->picture, $product_delete->picture->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$product_delete->Recordset->moveNext();
}
$product_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $product_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$product_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$product_delete->terminate();
?>