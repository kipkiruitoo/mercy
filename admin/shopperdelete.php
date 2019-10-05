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
$shopper_delete = new shopper_delete();

// Run the page
$shopper_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shopper_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fshopperdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fshopperdelete = currentForm = new ew.Form("fshopperdelete", "delete");
	loadjs.done("fshopperdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $shopper_delete->showPageHeader(); ?>
<?php
$shopper_delete->showMessage();
?>
<form name="fshopperdelete" id="fshopperdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shopper">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($shopper_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($shopper_delete->shopperID->Visible) { // shopperID ?>
		<th class="<?php echo $shopper_delete->shopperID->headerCellClass() ?>"><span id="elh_shopper_shopperID" class="shopper_shopperID"><?php echo $shopper_delete->shopperID->caption() ?></span></th>
<?php } ?>
<?php if ($shopper_delete->shopperName->Visible) { // shopperName ?>
		<th class="<?php echo $shopper_delete->shopperName->headerCellClass() ?>"><span id="elh_shopper_shopperName" class="shopper_shopperName"><?php echo $shopper_delete->shopperName->caption() ?></span></th>
<?php } ?>
<?php if ($shopper_delete->shopperPhoneNo->Visible) { // shopperPhoneNo ?>
		<th class="<?php echo $shopper_delete->shopperPhoneNo->headerCellClass() ?>"><span id="elh_shopper_shopperPhoneNo" class="shopper_shopperPhoneNo"><?php echo $shopper_delete->shopperPhoneNo->caption() ?></span></th>
<?php } ?>
<?php if ($shopper_delete->shopperEmail->Visible) { // shopperEmail ?>
		<th class="<?php echo $shopper_delete->shopperEmail->headerCellClass() ?>"><span id="elh_shopper_shopperEmail" class="shopper_shopperEmail"><?php echo $shopper_delete->shopperEmail->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$shopper_delete->RecordCount = 0;
$i = 0;
while (!$shopper_delete->Recordset->EOF) {
	$shopper_delete->RecordCount++;
	$shopper_delete->RowCount++;

	// Set row properties
	$shopper->resetAttributes();
	$shopper->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$shopper_delete->loadRowValues($shopper_delete->Recordset);

	// Render row
	$shopper_delete->renderRow();
?>
	<tr <?php echo $shopper->rowAttributes() ?>>
<?php if ($shopper_delete->shopperID->Visible) { // shopperID ?>
		<td <?php echo $shopper_delete->shopperID->cellAttributes() ?>>
<span id="el<?php echo $shopper_delete->RowCount ?>_shopper_shopperID" class="shopper_shopperID">
<span<?php echo $shopper_delete->shopperID->viewAttributes() ?>><?php echo $shopper_delete->shopperID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($shopper_delete->shopperName->Visible) { // shopperName ?>
		<td <?php echo $shopper_delete->shopperName->cellAttributes() ?>>
<span id="el<?php echo $shopper_delete->RowCount ?>_shopper_shopperName" class="shopper_shopperName">
<span<?php echo $shopper_delete->shopperName->viewAttributes() ?>><?php echo $shopper_delete->shopperName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($shopper_delete->shopperPhoneNo->Visible) { // shopperPhoneNo ?>
		<td <?php echo $shopper_delete->shopperPhoneNo->cellAttributes() ?>>
<span id="el<?php echo $shopper_delete->RowCount ?>_shopper_shopperPhoneNo" class="shopper_shopperPhoneNo">
<span<?php echo $shopper_delete->shopperPhoneNo->viewAttributes() ?>><?php echo $shopper_delete->shopperPhoneNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($shopper_delete->shopperEmail->Visible) { // shopperEmail ?>
		<td <?php echo $shopper_delete->shopperEmail->cellAttributes() ?>>
<span id="el<?php echo $shopper_delete->RowCount ?>_shopper_shopperEmail" class="shopper_shopperEmail">
<span<?php echo $shopper_delete->shopperEmail->viewAttributes() ?>><?php echo $shopper_delete->shopperEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$shopper_delete->Recordset->moveNext();
}
$shopper_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $shopper_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$shopper_delete->showPageFooter();
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
$shopper_delete->terminate();
?>