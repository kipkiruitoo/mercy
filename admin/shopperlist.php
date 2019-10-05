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
$shopper_list = new shopper_list();

// Run the page
$shopper_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shopper_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$shopper_list->isExport()) { ?>
<script>
var fshopperlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fshopperlist = currentForm = new ew.Form("fshopperlist", "list");
	fshopperlist.formKeyCountName = '<?php echo $shopper_list->FormKeyCountName ?>';
	loadjs.done("fshopperlist");
});
var fshopperlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fshopperlistsrch = currentSearchForm = new ew.Form("fshopperlistsrch");

	// Dynamic selection lists
	// Filters

	fshopperlistsrch.filterList = <?php echo $shopper_list->getFilterList() ?>;
	loadjs.done("fshopperlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$shopper_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($shopper_list->TotalRecords > 0 && $shopper_list->ExportOptions->visible()) { ?>
<?php $shopper_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($shopper_list->ImportOptions->visible()) { ?>
<?php $shopper_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($shopper_list->SearchOptions->visible()) { ?>
<?php $shopper_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($shopper_list->FilterOptions->visible()) { ?>
<?php $shopper_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$shopper_list->renderOtherOptions();
?>
<?php if (!$shopper_list->isExport() && !$shopper->CurrentAction) { ?>
<form name="fshopperlistsrch" id="fshopperlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fshopperlistsrch-search-panel" class="<?php echo $shopper_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="shopper">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $shopper_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($shopper_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($shopper_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $shopper_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($shopper_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($shopper_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($shopper_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($shopper_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $shopper_list->showPageHeader(); ?>
<?php
$shopper_list->showMessage();
?>
<?php if ($shopper_list->TotalRecords > 0 || $shopper->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($shopper_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> shopper">
<form name="fshopperlist" id="fshopperlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shopper">
<div id="gmp_shopper" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($shopper_list->TotalRecords > 0 || $shopper_list->isGridEdit()) { ?>
<table id="tbl_shopperlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$shopper->RowType = ROWTYPE_HEADER;

// Render list options
$shopper_list->renderListOptions();

// Render list options (header, left)
$shopper_list->ListOptions->render("header", "left");
?>
<?php if ($shopper_list->shopperID->Visible) { // shopperID ?>
	<?php if ($shopper_list->SortUrl($shopper_list->shopperID) == "") { ?>
		<th data-name="shopperID" class="<?php echo $shopper_list->shopperID->headerCellClass() ?>"><div id="elh_shopper_shopperID" class="shopper_shopperID"><div class="ew-table-header-caption"><?php echo $shopper_list->shopperID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="shopperID" class="<?php echo $shopper_list->shopperID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $shopper_list->SortUrl($shopper_list->shopperID) ?>', 1);"><div id="elh_shopper_shopperID" class="shopper_shopperID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $shopper_list->shopperID->caption() ?></span><span class="ew-table-header-sort"><?php if ($shopper_list->shopperID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($shopper_list->shopperID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($shopper_list->shopperName->Visible) { // shopperName ?>
	<?php if ($shopper_list->SortUrl($shopper_list->shopperName) == "") { ?>
		<th data-name="shopperName" class="<?php echo $shopper_list->shopperName->headerCellClass() ?>"><div id="elh_shopper_shopperName" class="shopper_shopperName"><div class="ew-table-header-caption"><?php echo $shopper_list->shopperName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="shopperName" class="<?php echo $shopper_list->shopperName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $shopper_list->SortUrl($shopper_list->shopperName) ?>', 1);"><div id="elh_shopper_shopperName" class="shopper_shopperName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $shopper_list->shopperName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($shopper_list->shopperName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($shopper_list->shopperName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($shopper_list->shopperPhoneNo->Visible) { // shopperPhoneNo ?>
	<?php if ($shopper_list->SortUrl($shopper_list->shopperPhoneNo) == "") { ?>
		<th data-name="shopperPhoneNo" class="<?php echo $shopper_list->shopperPhoneNo->headerCellClass() ?>"><div id="elh_shopper_shopperPhoneNo" class="shopper_shopperPhoneNo"><div class="ew-table-header-caption"><?php echo $shopper_list->shopperPhoneNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="shopperPhoneNo" class="<?php echo $shopper_list->shopperPhoneNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $shopper_list->SortUrl($shopper_list->shopperPhoneNo) ?>', 1);"><div id="elh_shopper_shopperPhoneNo" class="shopper_shopperPhoneNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $shopper_list->shopperPhoneNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($shopper_list->shopperPhoneNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($shopper_list->shopperPhoneNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($shopper_list->shopperEmail->Visible) { // shopperEmail ?>
	<?php if ($shopper_list->SortUrl($shopper_list->shopperEmail) == "") { ?>
		<th data-name="shopperEmail" class="<?php echo $shopper_list->shopperEmail->headerCellClass() ?>"><div id="elh_shopper_shopperEmail" class="shopper_shopperEmail"><div class="ew-table-header-caption"><?php echo $shopper_list->shopperEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="shopperEmail" class="<?php echo $shopper_list->shopperEmail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $shopper_list->SortUrl($shopper_list->shopperEmail) ?>', 1);"><div id="elh_shopper_shopperEmail" class="shopper_shopperEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $shopper_list->shopperEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($shopper_list->shopperEmail->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($shopper_list->shopperEmail->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$shopper_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($shopper_list->ExportAll && $shopper_list->isExport()) {
	$shopper_list->StopRecord = $shopper_list->TotalRecords;
} else {

	// Set the last record to display
	if ($shopper_list->TotalRecords > $shopper_list->StartRecord + $shopper_list->DisplayRecords - 1)
		$shopper_list->StopRecord = $shopper_list->StartRecord + $shopper_list->DisplayRecords - 1;
	else
		$shopper_list->StopRecord = $shopper_list->TotalRecords;
}
$shopper_list->RecordCount = $shopper_list->StartRecord - 1;
if ($shopper_list->Recordset && !$shopper_list->Recordset->EOF) {
	$shopper_list->Recordset->moveFirst();
	$selectLimit = $shopper_list->UseSelectLimit;
	if (!$selectLimit && $shopper_list->StartRecord > 1)
		$shopper_list->Recordset->move($shopper_list->StartRecord - 1);
} elseif (!$shopper->AllowAddDeleteRow && $shopper_list->StopRecord == 0) {
	$shopper_list->StopRecord = $shopper->GridAddRowCount;
}

// Initialize aggregate
$shopper->RowType = ROWTYPE_AGGREGATEINIT;
$shopper->resetAttributes();
$shopper_list->renderRow();
while ($shopper_list->RecordCount < $shopper_list->StopRecord) {
	$shopper_list->RecordCount++;
	if ($shopper_list->RecordCount >= $shopper_list->StartRecord) {
		$shopper_list->RowCount++;

		// Set up key count
		$shopper_list->KeyCount = $shopper_list->RowIndex;

		// Init row class and style
		$shopper->resetAttributes();
		$shopper->CssClass = "";
		if ($shopper_list->isGridAdd()) {
		} else {
			$shopper_list->loadRowValues($shopper_list->Recordset); // Load row values
		}
		$shopper->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$shopper->RowAttrs->merge(["data-rowindex" => $shopper_list->RowCount, "id" => "r" . $shopper_list->RowCount . "_shopper", "data-rowtype" => $shopper->RowType]);

		// Render row
		$shopper_list->renderRow();

		// Render list options
		$shopper_list->renderListOptions();
?>
	<tr <?php echo $shopper->rowAttributes() ?>>
<?php

// Render list options (body, left)
$shopper_list->ListOptions->render("body", "left", $shopper_list->RowCount);
?>
	<?php if ($shopper_list->shopperID->Visible) { // shopperID ?>
		<td data-name="shopperID" <?php echo $shopper_list->shopperID->cellAttributes() ?>>
<span id="el<?php echo $shopper_list->RowCount ?>_shopper_shopperID">
<span<?php echo $shopper_list->shopperID->viewAttributes() ?>><?php echo $shopper_list->shopperID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($shopper_list->shopperName->Visible) { // shopperName ?>
		<td data-name="shopperName" <?php echo $shopper_list->shopperName->cellAttributes() ?>>
<span id="el<?php echo $shopper_list->RowCount ?>_shopper_shopperName">
<span<?php echo $shopper_list->shopperName->viewAttributes() ?>><?php echo $shopper_list->shopperName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($shopper_list->shopperPhoneNo->Visible) { // shopperPhoneNo ?>
		<td data-name="shopperPhoneNo" <?php echo $shopper_list->shopperPhoneNo->cellAttributes() ?>>
<span id="el<?php echo $shopper_list->RowCount ?>_shopper_shopperPhoneNo">
<span<?php echo $shopper_list->shopperPhoneNo->viewAttributes() ?>><?php echo $shopper_list->shopperPhoneNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($shopper_list->shopperEmail->Visible) { // shopperEmail ?>
		<td data-name="shopperEmail" <?php echo $shopper_list->shopperEmail->cellAttributes() ?>>
<span id="el<?php echo $shopper_list->RowCount ?>_shopper_shopperEmail">
<span<?php echo $shopper_list->shopperEmail->viewAttributes() ?>><?php echo $shopper_list->shopperEmail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$shopper_list->ListOptions->render("body", "right", $shopper_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$shopper_list->isGridAdd())
		$shopper_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$shopper->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($shopper_list->Recordset)
	$shopper_list->Recordset->Close();
?>
<?php if (!$shopper_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$shopper_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $shopper_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $shopper_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($shopper_list->TotalRecords == 0 && !$shopper->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $shopper_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$shopper_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$shopper_list->isExport()) { ?>
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
$shopper_list->terminate();
?>