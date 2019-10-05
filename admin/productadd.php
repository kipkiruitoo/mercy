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
$product_add = new product_add();

// Run the page
$product_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproductadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproductadd = currentForm = new ew.Form("fproductadd", "add");

	// Validate form
	fproductadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($product_add->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_add->name->caption(), $product_add->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_add->code->Required) { ?>
				elm = this.getElements("x" + infix + "_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_add->code->caption(), $product_add->code->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_add->amountLeft->Required) { ?>
				elm = this.getElements("x" + infix + "_amountLeft");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_add->amountLeft->caption(), $product_add->amountLeft->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_amountLeft");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($product_add->amountLeft->errorMessage()) ?>");
			<?php if ($product_add->price->Required) { ?>
				elm = this.getElements("x" + infix + "_price");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_add->price->caption(), $product_add->price->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_price");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($product_add->price->errorMessage()) ?>");
			<?php if ($product_add->supermarket->Required) { ?>
				elm = this.getElements("x" + infix + "_supermarket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_add->supermarket->caption(), $product_add->supermarket->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_supermarket");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($product_add->supermarket->errorMessage()) ?>");
			<?php if ($product_add->picture->Required) { ?>
				felm = this.getElements("x" + infix + "_picture");
				elm = this.getElements("fn_x" + infix + "_picture");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $product_add->picture->caption(), $product_add->picture->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fproductadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproductadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproductadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $product_add->showPageHeader(); ?>
<?php
$product_add->showMessage();
?>
<form name="fproductadd" id="fproductadd" class="<?php echo $product_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$product_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($product_add->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_product_name" for="x_name" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->name->caption() ?><?php echo $product_add->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->name->cellAttributes() ?>>
<span id="el_product_name">
<input type="text" data-table="product" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($product_add->name->getPlaceHolder()) ?>" value="<?php echo $product_add->name->EditValue ?>"<?php echo $product_add->name->editAttributes() ?>>
</span>
<?php echo $product_add->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_add->code->Visible) { // code ?>
	<div id="r_code" class="form-group row">
		<label id="elh_product_code" for="x_code" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->code->caption() ?><?php echo $product_add->code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->code->cellAttributes() ?>>
<span id="el_product_code">
<input type="text" data-table="product" data-field="x_code" name="x_code" id="x_code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($product_add->code->getPlaceHolder()) ?>" value="<?php echo $product_add->code->EditValue ?>"<?php echo $product_add->code->editAttributes() ?>>
</span>
<?php echo $product_add->code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_add->amountLeft->Visible) { // amountLeft ?>
	<div id="r_amountLeft" class="form-group row">
		<label id="elh_product_amountLeft" for="x_amountLeft" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->amountLeft->caption() ?><?php echo $product_add->amountLeft->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->amountLeft->cellAttributes() ?>>
<span id="el_product_amountLeft">
<input type="text" data-table="product" data-field="x_amountLeft" name="x_amountLeft" id="x_amountLeft" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($product_add->amountLeft->getPlaceHolder()) ?>" value="<?php echo $product_add->amountLeft->EditValue ?>"<?php echo $product_add->amountLeft->editAttributes() ?>>
</span>
<?php echo $product_add->amountLeft->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_add->price->Visible) { // price ?>
	<div id="r_price" class="form-group row">
		<label id="elh_product_price" for="x_price" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->price->caption() ?><?php echo $product_add->price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->price->cellAttributes() ?>>
<span id="el_product_price">
<input type="text" data-table="product" data-field="x_price" name="x_price" id="x_price" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($product_add->price->getPlaceHolder()) ?>" value="<?php echo $product_add->price->EditValue ?>"<?php echo $product_add->price->editAttributes() ?>>
</span>
<?php echo $product_add->price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_add->supermarket->Visible) { // supermarket ?>
	<div id="r_supermarket" class="form-group row">
		<label id="elh_product_supermarket" for="x_supermarket" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->supermarket->caption() ?><?php echo $product_add->supermarket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->supermarket->cellAttributes() ?>>
<span id="el_product_supermarket">
<input type="text" data-table="product" data-field="x_supermarket" name="x_supermarket" id="x_supermarket" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($product_add->supermarket->getPlaceHolder()) ?>" value="<?php echo $product_add->supermarket->EditValue ?>"<?php echo $product_add->supermarket->editAttributes() ?>>
</span>
<?php echo $product_add->supermarket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_add->picture->Visible) { // picture ?>
	<div id="r_picture" class="form-group row">
		<label id="elh_product_picture" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->picture->caption() ?><?php echo $product_add->picture->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->picture->cellAttributes() ?>>
<span id="el_product_picture">
<div id="fd_x_picture">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $product_add->picture->title() ?>" data-table="product" data-field="x_picture" name="x_picture" id="x_picture" lang="<?php echo CurrentLanguageID() ?>"<?php echo $product_add->picture->editAttributes() ?><?php if ($product_add->picture->ReadOnly || $product_add->picture->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_picture"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_picture" id= "fn_x_picture" value="<?php echo $product_add->picture->Upload->FileName ?>">
<input type="hidden" name="fa_x_picture" id= "fa_x_picture" value="0">
<input type="hidden" name="fs_x_picture" id= "fs_x_picture" value="255">
<input type="hidden" name="fx_x_picture" id= "fx_x_picture" value="<?php echo $product_add->picture->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_picture" id= "fm_x_picture" value="<?php echo $product_add->picture->UploadMaxFileSize ?>">
</div>
<table id="ft_x_picture" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $product_add->picture->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$product_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $product_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $product_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$product_add->showPageFooter();
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
$product_add->terminate();
?>