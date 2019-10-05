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
$product_edit = new product_edit();

// Run the page
$product_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproductedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproductedit = currentForm = new ew.Form("fproductedit", "edit");

	// Validate form
	fproductedit.validate = function() {
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
			<?php if ($product_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->ID->caption(), $product_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->name->caption(), $product_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_edit->code->Required) { ?>
				elm = this.getElements("x" + infix + "_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->code->caption(), $product_edit->code->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_edit->amountLeft->Required) { ?>
				elm = this.getElements("x" + infix + "_amountLeft");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->amountLeft->caption(), $product_edit->amountLeft->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_amountLeft");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($product_edit->amountLeft->errorMessage()) ?>");
			<?php if ($product_edit->price->Required) { ?>
				elm = this.getElements("x" + infix + "_price");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->price->caption(), $product_edit->price->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_price");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($product_edit->price->errorMessage()) ?>");
			<?php if ($product_edit->supermarket->Required) { ?>
				elm = this.getElements("x" + infix + "_supermarket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->supermarket->caption(), $product_edit->supermarket->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_supermarket");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($product_edit->supermarket->errorMessage()) ?>");
			<?php if ($product_edit->picture->Required) { ?>
				felm = this.getElements("x" + infix + "_picture");
				elm = this.getElements("fn_x" + infix + "_picture");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $product_edit->picture->caption(), $product_edit->picture->RequiredErrorMessage)) ?>");
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
	fproductedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproductedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproductedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $product_edit->showPageHeader(); ?>
<?php
$product_edit->showMessage();
?>
<form name="fproductedit" id="fproductedit" class="<?php echo $product_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$product_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($product_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_product_ID" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->ID->caption() ?><?php echo $product_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->ID->cellAttributes() ?>>
<span id="el_product_ID">
<span<?php echo $product_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($product_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="product" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($product_edit->ID->CurrentValue) ?>">
<?php echo $product_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_product_name" for="x_name" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->name->caption() ?><?php echo $product_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->name->cellAttributes() ?>>
<span id="el_product_name">
<input type="text" data-table="product" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($product_edit->name->getPlaceHolder()) ?>" value="<?php echo $product_edit->name->EditValue ?>"<?php echo $product_edit->name->editAttributes() ?>>
</span>
<?php echo $product_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->code->Visible) { // code ?>
	<div id="r_code" class="form-group row">
		<label id="elh_product_code" for="x_code" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->code->caption() ?><?php echo $product_edit->code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->code->cellAttributes() ?>>
<span id="el_product_code">
<input type="text" data-table="product" data-field="x_code" name="x_code" id="x_code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($product_edit->code->getPlaceHolder()) ?>" value="<?php echo $product_edit->code->EditValue ?>"<?php echo $product_edit->code->editAttributes() ?>>
</span>
<?php echo $product_edit->code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->amountLeft->Visible) { // amountLeft ?>
	<div id="r_amountLeft" class="form-group row">
		<label id="elh_product_amountLeft" for="x_amountLeft" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->amountLeft->caption() ?><?php echo $product_edit->amountLeft->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->amountLeft->cellAttributes() ?>>
<span id="el_product_amountLeft">
<input type="text" data-table="product" data-field="x_amountLeft" name="x_amountLeft" id="x_amountLeft" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($product_edit->amountLeft->getPlaceHolder()) ?>" value="<?php echo $product_edit->amountLeft->EditValue ?>"<?php echo $product_edit->amountLeft->editAttributes() ?>>
</span>
<?php echo $product_edit->amountLeft->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->price->Visible) { // price ?>
	<div id="r_price" class="form-group row">
		<label id="elh_product_price" for="x_price" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->price->caption() ?><?php echo $product_edit->price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->price->cellAttributes() ?>>
<span id="el_product_price">
<input type="text" data-table="product" data-field="x_price" name="x_price" id="x_price" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($product_edit->price->getPlaceHolder()) ?>" value="<?php echo $product_edit->price->EditValue ?>"<?php echo $product_edit->price->editAttributes() ?>>
</span>
<?php echo $product_edit->price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->supermarket->Visible) { // supermarket ?>
	<div id="r_supermarket" class="form-group row">
		<label id="elh_product_supermarket" for="x_supermarket" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->supermarket->caption() ?><?php echo $product_edit->supermarket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->supermarket->cellAttributes() ?>>
<span id="el_product_supermarket">
<input type="text" data-table="product" data-field="x_supermarket" name="x_supermarket" id="x_supermarket" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($product_edit->supermarket->getPlaceHolder()) ?>" value="<?php echo $product_edit->supermarket->EditValue ?>"<?php echo $product_edit->supermarket->editAttributes() ?>>
</span>
<?php echo $product_edit->supermarket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->picture->Visible) { // picture ?>
	<div id="r_picture" class="form-group row">
		<label id="elh_product_picture" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->picture->caption() ?><?php echo $product_edit->picture->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->picture->cellAttributes() ?>>
<span id="el_product_picture">
<div id="fd_x_picture">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $product_edit->picture->title() ?>" data-table="product" data-field="x_picture" name="x_picture" id="x_picture" lang="<?php echo CurrentLanguageID() ?>"<?php echo $product_edit->picture->editAttributes() ?><?php if ($product_edit->picture->ReadOnly || $product_edit->picture->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_picture"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_picture" id= "fn_x_picture" value="<?php echo $product_edit->picture->Upload->FileName ?>">
<input type="hidden" name="fa_x_picture" id= "fa_x_picture" value="<?php echo (Post("fa_x_picture") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_picture" id= "fs_x_picture" value="255">
<input type="hidden" name="fx_x_picture" id= "fx_x_picture" value="<?php echo $product_edit->picture->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_picture" id= "fm_x_picture" value="<?php echo $product_edit->picture->UploadMaxFileSize ?>">
</div>
<table id="ft_x_picture" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $product_edit->picture->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$product_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $product_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $product_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$product_edit->showPageFooter();
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
$product_edit->terminate();
?>