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
$product_list = new product_list();

// Run the page
$product_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$product_list->isExport()) { ?>
<script>
var fproductlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproductlist = currentForm = new ew.Form("fproductlist", "list");
	fproductlist.formKeyCountName = '<?php echo $product_list->FormKeyCountName ?>';
	loadjs.done("fproductlist");
});
var fproductlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproductlistsrch = currentSearchForm = new ew.Form("fproductlistsrch");

	// Dynamic selection lists
	// Filters

	fproductlistsrch.filterList = <?php echo $product_list->getFilterList() ?>;
	loadjs.done("fproductlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$product_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($product_list->TotalRecords > 0 && $product_list->ExportOptions->visible()) { ?>
<?php $product_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($product_list->ImportOptions->visible()) { ?>
<?php $product_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($product_list->SearchOptions->visible()) { ?>
<?php $product_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($product_list->FilterOptions->visible()) { ?>
<?php $product_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$product_list->renderOtherOptions();
?>
<?php if (!$product_list->isExport() && !$product->CurrentAction) { ?>
<form name="fproductlistsrch" id="fproductlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproductlistsrch-search-panel" class="<?php echo $product_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="product">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $product_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($product_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($product_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $product_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($product_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($product_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($product_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($product_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $product_list->showPageHeader(); ?>
<?php
$product_list->showMessage();
?>
<?php if ($product_list->TotalRecords > 0 || $product->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($product_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> product">
<form name="fproductlist" id="fproductlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product">
<div id="gmp_product" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($product_list->TotalRecords > 0 || $product_list->isGridEdit()) { ?>
<table id="tbl_productlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$product->RowType = ROWTYPE_HEADER;

// Render list options
$product_list->renderListOptions();

// Render list options (header, left)
$product_list->ListOptions->render("header", "left");
?>
<?php if ($product_list->ID->Visible) { // ID ?>
	<?php if ($product_list->SortUrl($product_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $product_list->ID->headerCellClass() ?>"><div id="elh_product_ID" class="product_ID"><div class="ew-table-header-caption"><?php echo $product_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $product_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $product_list->SortUrl($product_list->ID) ?>', 1);"><div id="elh_product_ID" class="product_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($product_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($product_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($product_list->name->Visible) { // name ?>
	<?php if ($product_list->SortUrl($product_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $product_list->name->headerCellClass() ?>"><div id="elh_product_name" class="product_name"><div class="ew-table-header-caption"><?php echo $product_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $product_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $product_list->SortUrl($product_list->name) ?>', 1);"><div id="elh_product_name" class="product_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($product_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($product_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($product_list->code->Visible) { // code ?>
	<?php if ($product_list->SortUrl($product_list->code) == "") { ?>
		<th data-name="code" class="<?php echo $product_list->code->headerCellClass() ?>"><div id="elh_product_code" class="product_code"><div class="ew-table-header-caption"><?php echo $product_list->code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="code" class="<?php echo $product_list->code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $product_list->SortUrl($product_list->code) ?>', 1);"><div id="elh_product_code" class="product_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product_list->code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($product_list->code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($product_list->code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($product_list->amountLeft->Visible) { // amountLeft ?>
	<?php if ($product_list->SortUrl($product_list->amountLeft) == "") { ?>
		<th data-name="amountLeft" class="<?php echo $product_list->amountLeft->headerCellClass() ?>"><div id="elh_product_amountLeft" class="product_amountLeft"><div class="ew-table-header-caption"><?php echo $product_list->amountLeft->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="amountLeft" class="<?php echo $product_list->amountLeft->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $product_list->SortUrl($product_list->amountLeft) ?>', 1);"><div id="elh_product_amountLeft" class="product_amountLeft">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product_list->amountLeft->caption() ?></span><span class="ew-table-header-sort"><?php if ($product_list->amountLeft->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($product_list->amountLeft->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($product_list->price->Visible) { // price ?>
	<?php if ($product_list->SortUrl($product_list->price) == "") { ?>
		<th data-name="price" class="<?php echo $product_list->price->headerCellClass() ?>"><div id="elh_product_price" class="product_price"><div class="ew-table-header-caption"><?php echo $product_list->price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="price" class="<?php echo $product_list->price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $product_list->SortUrl($product_list->price) ?>', 1);"><div id="elh_product_price" class="product_price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product_list->price->caption() ?></span><span class="ew-table-header-sort"><?php if ($product_list->price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($product_list->price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($product_list->supermarket->Visible) { // supermarket ?>
	<?php if ($product_list->SortUrl($product_list->supermarket) == "") { ?>
		<th data-name="supermarket" class="<?php echo $product_list->supermarket->headerCellClass() ?>"><div id="elh_product_supermarket" class="product_supermarket"><div class="ew-table-header-caption"><?php echo $product_list->supermarket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="supermarket" class="<?php echo $product_list->supermarket->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $product_list->SortUrl($product_list->supermarket) ?>', 1);"><div id="elh_product_supermarket" class="product_supermarket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product_list->supermarket->caption() ?></span><span class="ew-table-header-sort"><?php if ($product_list->supermarket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($product_list->supermarket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($product_list->picture->Visible) { // picture ?>
	<?php if ($product_list->SortUrl($product_list->picture) == "") { ?>
		<th data-name="picture" class="<?php echo $product_list->picture->headerCellClass() ?>"><div id="elh_product_picture" class="product_picture"><div class="ew-table-header-caption"><?php echo $product_list->picture->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="picture" class="<?php echo $product_list->picture->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $product_list->SortUrl($product_list->picture) ?>', 1);"><div id="elh_product_picture" class="product_picture">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product_list->picture->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($product_list->picture->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($product_list->picture->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$product_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($product_list->ExportAll && $product_list->isExport()) {
	$product_list->StopRecord = $product_list->TotalRecords;
} else {

	// Set the last record to display
	if ($product_list->TotalRecords > $product_list->StartRecord + $product_list->DisplayRecords - 1)
		$product_list->StopRecord = $product_list->StartRecord + $product_list->DisplayRecords - 1;
	else
		$product_list->StopRecord = $product_list->TotalRecords;
}
$product_list->RecordCount = $product_list->StartRecord - 1;
if ($product_list->Recordset && !$product_list->Recordset->EOF) {
	$product_list->Recordset->moveFirst();
	$selectLimit = $product_list->UseSelectLimit;
	if (!$selectLimit && $product_list->StartRecord > 1)
		$product_list->Recordset->move($product_list->StartRecord - 1);
} elseif (!$product->AllowAddDeleteRow && $product_list->StopRecord == 0) {
	$product_list->StopRecord = $product->GridAddRowCount;
}

// Initialize aggregate
$product->RowType = ROWTYPE_AGGREGATEINIT;
$product->resetAttributes();
$product_list->renderRow();
while ($product_list->RecordCount < $product_list->StopRecord) {
	$product_list->RecordCount++;
	if ($product_list->RecordCount >= $product_list->StartRecord) {
		$product_list->RowCount++;

		// Set up key count
		$product_list->KeyCount = $product_list->RowIndex;

		// Init row class and style
		$product->resetAttributes();
		$product->CssClass = "";
		if ($product_list->isGridAdd()) {
		} else {
			$product_list->loadRowValues($product_list->Recordset); // Load row values
		}
		$product->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$product->RowAttrs->merge(["data-rowindex" => $product_list->RowCount, "id" => "r" . $product_list->RowCount . "_product", "data-rowtype" => $product->RowType]);

		// Render row
		$product_list->renderRow();

		// Render list options
		$product_list->renderListOptions();
?>
	<tr <?php echo $product->rowAttributes() ?>>
<?php

// Render list options (body, left)
$product_list->ListOptions->render("body", "left", $product_list->RowCount);
?>
	<?php if ($product_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $product_list->ID->cellAttributes() ?>>
<span id="el<?php echo $product_list->RowCount ?>_product_ID">
<span<?php echo $product_list->ID->viewAttributes() ?>><?php echo $product_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($product_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $product_list->name->cellAttributes() ?>>
<span id="el<?php echo $product_list->RowCount ?>_product_name">
<span<?php echo $product_list->name->viewAttributes() ?>><?php echo $product_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($product_list->code->Visible) { // code ?>
		<td data-name="code" <?php echo $product_list->code->cellAttributes() ?>>
<span id="el<?php echo $product_list->RowCount ?>_product_code">
<span<?php echo $product_list->code->viewAttributes() ?>><?php echo $product_list->code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($product_list->amountLeft->Visible) { // amountLeft ?>
		<td data-name="amountLeft" <?php echo $product_list->amountLeft->cellAttributes() ?>>
<span id="el<?php echo $product_list->RowCount ?>_product_amountLeft">
<span<?php echo $product_list->amountLeft->viewAttributes() ?>><?php echo $product_list->amountLeft->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($product_list->price->Visible) { // price ?>
		<td data-name="price" <?php echo $product_list->price->cellAttributes() ?>>
<span id="el<?php echo $product_list->RowCount ?>_product_price">
<span<?php echo $product_list->price->viewAttributes() ?>><?php echo $product_list->price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($product_list->supermarket->Visible) { // supermarket ?>
		<td data-name="supermarket" <?php echo $product_list->supermarket->cellAttributes() ?>>
<span id="el<?php echo $product_list->RowCount ?>_product_supermarket">
<span<?php echo $product_list->supermarket->viewAttributes() ?>><?php echo $product_list->supermarket->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($product_list->picture->Visible) { // picture ?>
		<td data-name="picture" <?php echo $product_list->picture->cellAttributes() ?>>
<span id="el<?php echo $product_list->RowCount ?>_product_picture">
<span><?php echo GetFileViewTag($product_list->picture, $product_list->picture->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$product_list->ListOptions->render("body", "right", $product_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$product_list->isGridAdd())
		$product_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$product->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($product_list->Recordset)
	$product_list->Recordset->Close();
?>
<?php if (!$product_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$product_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $product_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $product_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($product_list->TotalRecords == 0 && !$product->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $product_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$product_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$product_list->isExport()) { ?>
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
$product_list->terminate();
?>