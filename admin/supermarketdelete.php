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
$supermarket_delete = new supermarket_delete();

// Run the page
$supermarket_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$supermarket_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsupermarketdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsupermarketdelete = currentForm = new ew.Form("fsupermarketdelete", "delete");
	loadjs.done("fsupermarketdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $supermarket_delete->showPageHeader(); ?>
<?php
$supermarket_delete->showMessage();
?>
<form name="fsupermarketdelete" id="fsupermarketdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="supermarket">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($supermarket_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($supermarket_delete->supermarketID->Visible) { // supermarketID ?>
		<th class="<?php echo $supermarket_delete->supermarketID->headerCellClass() ?>"><span id="elh_supermarket_supermarketID" class="supermarket_supermarketID"><?php echo $supermarket_delete->supermarketID->caption() ?></span></th>
<?php } ?>
<?php if ($supermarket_delete->name->Visible) { // name ?>
		<th class="<?php echo $supermarket_delete->name->headerCellClass() ?>"><span id="elh_supermarket_name" class="supermarket_name"><?php echo $supermarket_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($supermarket_delete->location->Visible) { // location ?>
		<th class="<?php echo $supermarket_delete->location->headerCellClass() ?>"><span id="elh_supermarket_location" class="supermarket_location"><?php echo $supermarket_delete->location->caption() ?></span></th>
<?php } ?>
<?php if ($supermarket_delete->logo->Visible) { // logo ?>
		<th class="<?php echo $supermarket_delete->logo->headerCellClass() ?>"><span id="elh_supermarket_logo" class="supermarket_logo"><?php echo $supermarket_delete->logo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$supermarket_delete->RecordCount = 0;
$i = 0;
while (!$supermarket_delete->Recordset->EOF) {
	$supermarket_delete->RecordCount++;
	$supermarket_delete->RowCount++;

	// Set row properties
	$supermarket->resetAttributes();
	$supermarket->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$supermarket_delete->loadRowValues($supermarket_delete->Recordset);

	// Render row
	$supermarket_delete->renderRow();
?>
	<tr <?php echo $supermarket->rowAttributes() ?>>
<?php if ($supermarket_delete->supermarketID->Visible) { // supermarketID ?>
		<td <?php echo $supermarket_delete->supermarketID->cellAttributes() ?>>
<span id="el<?php echo $supermarket_delete->RowCount ?>_supermarket_supermarketID" class="supermarket_supermarketID">
<span<?php echo $supermarket_delete->supermarketID->viewAttributes() ?>><?php echo $supermarket_delete->supermarketID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($supermarket_delete->name->Visible) { // name ?>
		<td <?php echo $supermarket_delete->name->cellAttributes() ?>>
<span id="el<?php echo $supermarket_delete->RowCount ?>_supermarket_name" class="supermarket_name">
<span<?php echo $supermarket_delete->name->viewAttributes() ?>><?php echo $supermarket_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($supermarket_delete->location->Visible) { // location ?>
		<td <?php echo $supermarket_delete->location->cellAttributes() ?>>
<span id="el<?php echo $supermarket_delete->RowCount ?>_supermarket_location" class="supermarket_location">
<span<?php echo $supermarket_delete->location->viewAttributes() ?>><?php echo $supermarket_delete->location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($supermarket_delete->logo->Visible) { // logo ?>
		<td <?php echo $supermarket_delete->logo->cellAttributes() ?>>
<span id="el<?php echo $supermarket_delete->RowCount ?>_supermarket_logo" class="supermarket_logo">
<span<?php echo $supermarket_delete->logo->viewAttributes() ?>><?php echo GetFileViewTag($supermarket_delete->logo, $supermarket_delete->logo->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$supermarket_delete->Recordset->moveNext();
}
$supermarket_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $supermarket_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$supermarket_delete->showPageFooter();
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
$supermarket_delete->terminate();
?>