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
$supermarket_edit = new supermarket_edit();

// Run the page
$supermarket_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$supermarket_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsupermarketedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsupermarketedit = currentForm = new ew.Form("fsupermarketedit", "edit");

	// Validate form
	fsupermarketedit.validate = function() {
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
			<?php if ($supermarket_edit->supermarketID->Required) { ?>
				elm = this.getElements("x" + infix + "_supermarketID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $supermarket_edit->supermarketID->caption(), $supermarket_edit->supermarketID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($supermarket_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $supermarket_edit->name->caption(), $supermarket_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($supermarket_edit->location->Required) { ?>
				elm = this.getElements("x" + infix + "_location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $supermarket_edit->location->caption(), $supermarket_edit->location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($supermarket_edit->logo->Required) { ?>
				felm = this.getElements("x" + infix + "_logo");
				elm = this.getElements("fn_x" + infix + "_logo");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $supermarket_edit->logo->caption(), $supermarket_edit->logo->RequiredErrorMessage)) ?>");
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
	fsupermarketedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsupermarketedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsupermarketedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $supermarket_edit->showPageHeader(); ?>
<?php
$supermarket_edit->showMessage();
?>
<form name="fsupermarketedit" id="fsupermarketedit" class="<?php echo $supermarket_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="supermarket">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$supermarket_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($supermarket_edit->supermarketID->Visible) { // supermarketID ?>
	<div id="r_supermarketID" class="form-group row">
		<label id="elh_supermarket_supermarketID" class="<?php echo $supermarket_edit->LeftColumnClass ?>"><?php echo $supermarket_edit->supermarketID->caption() ?><?php echo $supermarket_edit->supermarketID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $supermarket_edit->RightColumnClass ?>"><div <?php echo $supermarket_edit->supermarketID->cellAttributes() ?>>
<span id="el_supermarket_supermarketID">
<span<?php echo $supermarket_edit->supermarketID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($supermarket_edit->supermarketID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="supermarket" data-field="x_supermarketID" name="x_supermarketID" id="x_supermarketID" value="<?php echo HtmlEncode($supermarket_edit->supermarketID->CurrentValue) ?>">
<?php echo $supermarket_edit->supermarketID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($supermarket_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_supermarket_name" for="x_name" class="<?php echo $supermarket_edit->LeftColumnClass ?>"><?php echo $supermarket_edit->name->caption() ?><?php echo $supermarket_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $supermarket_edit->RightColumnClass ?>"><div <?php echo $supermarket_edit->name->cellAttributes() ?>>
<span id="el_supermarket_name">
<input type="text" data-table="supermarket" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($supermarket_edit->name->getPlaceHolder()) ?>" value="<?php echo $supermarket_edit->name->EditValue ?>"<?php echo $supermarket_edit->name->editAttributes() ?>>
</span>
<?php echo $supermarket_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($supermarket_edit->location->Visible) { // location ?>
	<div id="r_location" class="form-group row">
		<label id="elh_supermarket_location" for="x_location" class="<?php echo $supermarket_edit->LeftColumnClass ?>"><?php echo $supermarket_edit->location->caption() ?><?php echo $supermarket_edit->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $supermarket_edit->RightColumnClass ?>"><div <?php echo $supermarket_edit->location->cellAttributes() ?>>
<span id="el_supermarket_location">
<input type="text" data-table="supermarket" data-field="x_location" name="x_location" id="x_location" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($supermarket_edit->location->getPlaceHolder()) ?>" value="<?php echo $supermarket_edit->location->EditValue ?>"<?php echo $supermarket_edit->location->editAttributes() ?>>
</span>
<?php echo $supermarket_edit->location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($supermarket_edit->logo->Visible) { // logo ?>
	<div id="r_logo" class="form-group row">
		<label id="elh_supermarket_logo" class="<?php echo $supermarket_edit->LeftColumnClass ?>"><?php echo $supermarket_edit->logo->caption() ?><?php echo $supermarket_edit->logo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $supermarket_edit->RightColumnClass ?>"><div <?php echo $supermarket_edit->logo->cellAttributes() ?>>
<span id="el_supermarket_logo">
<div id="fd_x_logo">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $supermarket_edit->logo->title() ?>" data-table="supermarket" data-field="x_logo" name="x_logo" id="x_logo" lang="<?php echo CurrentLanguageID() ?>"<?php echo $supermarket_edit->logo->editAttributes() ?><?php if ($supermarket_edit->logo->ReadOnly || $supermarket_edit->logo->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_logo"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_logo" id= "fn_x_logo" value="<?php echo $supermarket_edit->logo->Upload->FileName ?>">
<input type="hidden" name="fa_x_logo" id= "fa_x_logo" value="<?php echo (Post("fa_x_logo") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_logo" id= "fs_x_logo" value="255">
<input type="hidden" name="fx_x_logo" id= "fx_x_logo" value="<?php echo $supermarket_edit->logo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_logo" id= "fm_x_logo" value="<?php echo $supermarket_edit->logo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_logo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $supermarket_edit->logo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$supermarket_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $supermarket_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $supermarket_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$supermarket_edit->showPageFooter();
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
$supermarket_edit->terminate();
?>