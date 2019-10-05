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
$supermarket_list = new supermarket_list();

// Run the page
$supermarket_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$supermarket_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$supermarket_list->isExport()) { ?>
<script>
var fsupermarketlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsupermarketlist = currentForm = new ew.Form("fsupermarketlist", "list");
	fsupermarketlist.formKeyCountName = '<?php echo $supermarket_list->FormKeyCountName ?>';
	loadjs.done("fsupermarketlist");
});
var fsupermarketlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsupermarketlistsrch = currentSearchForm = new ew.Form("fsupermarketlistsrch");

	// Dynamic selection lists
	// Filters

	fsupermarketlistsrch.filterList = <?php echo $supermarket_list->getFilterList() ?>;
	loadjs.done("fsupermarketlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$supermarket_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($supermarket_list->TotalRecords > 0 && $supermarket_list->ExportOptions->visible()) { ?>
<?php $supermarket_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($supermarket_list->ImportOptions->visible()) { ?>
<?php $supermarket_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($supermarket_list->SearchOptions->visible()) { ?>
<?php $supermarket_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($supermarket_list->FilterOptions->visible()) { ?>
<?php $supermarket_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$supermarket_list->renderOtherOptions();
?>
<?php if (!$supermarket_list->isExport() && !$supermarket->CurrentAction) { ?>
<form name="fsupermarketlistsrch" id="fsupermarketlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsupermarketlistsrch-search-panel" class="<?php echo $supermarket_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="supermarket">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $supermarket_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($supermarket_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($supermarket_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $supermarket_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($supermarket_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($supermarket_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($supermarket_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($supermarket_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $supermarket_list->showPageHeader(); ?>
<?php
$supermarket_list->showMessage();
?>
<?php if ($supermarket_list->TotalRecords > 0 || $supermarket->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($supermarket_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> supermarket">
<form name="fsupermarketlist" id="fsupermarketlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="supermarket">
<div id="gmp_supermarket" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($supermarket_list->TotalRecords > 0 || $supermarket_list->isGridEdit()) { ?>
<table id="tbl_supermarketlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$supermarket->RowType = ROWTYPE_HEADER;

// Render list options
$supermarket_list->renderListOptions();

// Render list options (header, left)
$supermarket_list->ListOptions->render("header", "left");
?>
<?php if ($supermarket_list->supermarketID->Visible) { // supermarketID ?>
	<?php if ($supermarket_list->SortUrl($supermarket_list->supermarketID) == "") { ?>
		<th data-name="supermarketID" class="<?php echo $supermarket_list->supermarketID->headerCellClass() ?>"><div id="elh_supermarket_supermarketID" class="supermarket_supermarketID"><div class="ew-table-header-caption"><?php echo $supermarket_list->supermarketID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="supermarketID" class="<?php echo $supermarket_list->supermarketID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supermarket_list->SortUrl($supermarket_list->supermarketID) ?>', 1);"><div id="elh_supermarket_supermarketID" class="supermarket_supermarketID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supermarket_list->supermarketID->caption() ?></span><span class="ew-table-header-sort"><?php if ($supermarket_list->supermarketID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supermarket_list->supermarketID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supermarket_list->name->Visible) { // name ?>
	<?php if ($supermarket_list->SortUrl($supermarket_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $supermarket_list->name->headerCellClass() ?>"><div id="elh_supermarket_name" class="supermarket_name"><div class="ew-table-header-caption"><?php echo $supermarket_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $supermarket_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supermarket_list->SortUrl($supermarket_list->name) ?>', 1);"><div id="elh_supermarket_name" class="supermarket_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supermarket_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($supermarket_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supermarket_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supermarket_list->location->Visible) { // location ?>
	<?php if ($supermarket_list->SortUrl($supermarket_list->location) == "") { ?>
		<th data-name="location" class="<?php echo $supermarket_list->location->headerCellClass() ?>"><div id="elh_supermarket_location" class="supermarket_location"><div class="ew-table-header-caption"><?php echo $supermarket_list->location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="location" class="<?php echo $supermarket_list->location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supermarket_list->SortUrl($supermarket_list->location) ?>', 1);"><div id="elh_supermarket_location" class="supermarket_location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supermarket_list->location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($supermarket_list->location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supermarket_list->location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supermarket_list->logo->Visible) { // logo ?>
	<?php if ($supermarket_list->SortUrl($supermarket_list->logo) == "") { ?>
		<th data-name="logo" class="<?php echo $supermarket_list->logo->headerCellClass() ?>"><div id="elh_supermarket_logo" class="supermarket_logo"><div class="ew-table-header-caption"><?php echo $supermarket_list->logo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="logo" class="<?php echo $supermarket_list->logo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supermarket_list->SortUrl($supermarket_list->logo) ?>', 1);"><div id="elh_supermarket_logo" class="supermarket_logo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supermarket_list->logo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($supermarket_list->logo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supermarket_list->logo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$supermarket_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($supermarket_list->ExportAll && $supermarket_list->isExport()) {
	$supermarket_list->StopRecord = $supermarket_list->TotalRecords;
} else {

	// Set the last record to display
	if ($supermarket_list->TotalRecords > $supermarket_list->StartRecord + $supermarket_list->DisplayRecords - 1)
		$supermarket_list->StopRecord = $supermarket_list->StartRecord + $supermarket_list->DisplayRecords - 1;
	else
		$supermarket_list->StopRecord = $supermarket_list->TotalRecords;
}
$supermarket_list->RecordCount = $supermarket_list->StartRecord - 1;
if ($supermarket_list->Recordset && !$supermarket_list->Recordset->EOF) {
	$supermarket_list->Recordset->moveFirst();
	$selectLimit = $supermarket_list->UseSelectLimit;
	if (!$selectLimit && $supermarket_list->StartRecord > 1)
		$supermarket_list->Recordset->move($supermarket_list->StartRecord - 1);
} elseif (!$supermarket->AllowAddDeleteRow && $supermarket_list->StopRecord == 0) {
	$supermarket_list->StopRecord = $supermarket->GridAddRowCount;
}

// Initialize aggregate
$supermarket->RowType = ROWTYPE_AGGREGATEINIT;
$supermarket->resetAttributes();
$supermarket_list->renderRow();
while ($supermarket_list->RecordCount < $supermarket_list->StopRecord) {
	$supermarket_list->RecordCount++;
	if ($supermarket_list->RecordCount >= $supermarket_list->StartRecord) {
		$supermarket_list->RowCount++;

		// Set up key count
		$supermarket_list->KeyCount = $supermarket_list->RowIndex;

		// Init row class and style
		$supermarket->resetAttributes();
		$supermarket->CssClass = "";
		if ($supermarket_list->isGridAdd()) {
		} else {
			$supermarket_list->loadRowValues($supermarket_list->Recordset); // Load row values
		}
		$supermarket->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$supermarket->RowAttrs->merge(["data-rowindex" => $supermarket_list->RowCount, "id" => "r" . $supermarket_list->RowCount . "_supermarket", "data-rowtype" => $supermarket->RowType]);

		// Render row
		$supermarket_list->renderRow();

		// Render list options
		$supermarket_list->renderListOptions();
?>
	<tr <?php echo $supermarket->rowAttributes() ?>>
<?php

// Render list options (body, left)
$supermarket_list->ListOptions->render("body", "left", $supermarket_list->RowCount);
?>
	<?php if ($supermarket_list->supermarketID->Visible) { // supermarketID ?>
		<td data-name="supermarketID" <?php echo $supermarket_list->supermarketID->cellAttributes() ?>>
<span id="el<?php echo $supermarket_list->RowCount ?>_supermarket_supermarketID">
<span<?php echo $supermarket_list->supermarketID->viewAttributes() ?>><?php echo $supermarket_list->supermarketID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($supermarket_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $supermarket_list->name->cellAttributes() ?>>
<span id="el<?php echo $supermarket_list->RowCount ?>_supermarket_name">
<span<?php echo $supermarket_list->name->viewAttributes() ?>><?php echo $supermarket_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($supermarket_list->location->Visible) { // location ?>
		<td data-name="location" <?php echo $supermarket_list->location->cellAttributes() ?>>
<span id="el<?php echo $supermarket_list->RowCount ?>_supermarket_location">
<span<?php echo $supermarket_list->location->viewAttributes() ?>><?php echo $supermarket_list->location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($supermarket_list->logo->Visible) { // logo ?>
		<td data-name="logo" <?php echo $supermarket_list->logo->cellAttributes() ?>>
<span id="el<?php echo $supermarket_list->RowCount ?>_supermarket_logo">
<span<?php echo $supermarket_list->logo->viewAttributes() ?>><?php echo GetFileViewTag($supermarket_list->logo, $supermarket_list->logo->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$supermarket_list->ListOptions->render("body", "right", $supermarket_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$supermarket_list->isGridAdd())
		$supermarket_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$supermarket->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($supermarket_list->Recordset)
	$supermarket_list->Recordset->Close();
?>
<?php if (!$supermarket_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$supermarket_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $supermarket_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $supermarket_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($supermarket_list->TotalRecords == 0 && !$supermarket->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $supermarket_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$supermarket_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$supermarket_list->isExport()) { ?>
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
$supermarket_list->terminate();
?>