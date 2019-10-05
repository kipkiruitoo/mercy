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
$shopper_edit = new shopper_edit();

// Run the page
$shopper_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shopper_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fshopperedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fshopperedit = currentForm = new ew.Form("fshopperedit", "edit");

	// Validate form
	fshopperedit.validate = function() {
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
			<?php if ($shopper_edit->shopperID->Required) { ?>
				elm = this.getElements("x" + infix + "_shopperID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shopper_edit->shopperID->caption(), $shopper_edit->shopperID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_shopperID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($shopper_edit->shopperID->errorMessage()) ?>");
			<?php if ($shopper_edit->shopperName->Required) { ?>
				elm = this.getElements("x" + infix + "_shopperName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shopper_edit->shopperName->caption(), $shopper_edit->shopperName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($shopper_edit->shopperPhoneNo->Required) { ?>
				elm = this.getElements("x" + infix + "_shopperPhoneNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shopper_edit->shopperPhoneNo->caption(), $shopper_edit->shopperPhoneNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_shopperPhoneNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($shopper_edit->shopperPhoneNo->errorMessage()) ?>");
			<?php if ($shopper_edit->shopperEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_shopperEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shopper_edit->shopperEmail->caption(), $shopper_edit->shopperEmail->RequiredErrorMessage)) ?>");
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
	fshopperedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fshopperedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fshopperedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $shopper_edit->showPageHeader(); ?>
<?php
$shopper_edit->showMessage();
?>
<form name="fshopperedit" id="fshopperedit" class="<?php echo $shopper_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shopper">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$shopper_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($shopper_edit->shopperID->Visible) { // shopperID ?>
	<div id="r_shopperID" class="form-group row">
		<label id="elh_shopper_shopperID" for="x_shopperID" class="<?php echo $shopper_edit->LeftColumnClass ?>"><?php echo $shopper_edit->shopperID->caption() ?><?php echo $shopper_edit->shopperID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shopper_edit->RightColumnClass ?>"><div <?php echo $shopper_edit->shopperID->cellAttributes() ?>>
<input type="text" data-table="shopper" data-field="x_shopperID" name="x_shopperID" id="x_shopperID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($shopper_edit->shopperID->getPlaceHolder()) ?>" value="<?php echo $shopper_edit->shopperID->EditValue ?>"<?php echo $shopper_edit->shopperID->editAttributes() ?>>
<input type="hidden" data-table="shopper" data-field="x_shopperID" name="o_shopperID" id="o_shopperID" value="<?php echo HtmlEncode($shopper_edit->shopperID->OldValue != null ? $shopper_edit->shopperID->OldValue : $shopper_edit->shopperID->CurrentValue) ?>">
<?php echo $shopper_edit->shopperID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($shopper_edit->shopperName->Visible) { // shopperName ?>
	<div id="r_shopperName" class="form-group row">
		<label id="elh_shopper_shopperName" for="x_shopperName" class="<?php echo $shopper_edit->LeftColumnClass ?>"><?php echo $shopper_edit->shopperName->caption() ?><?php echo $shopper_edit->shopperName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shopper_edit->RightColumnClass ?>"><div <?php echo $shopper_edit->shopperName->cellAttributes() ?>>
<span id="el_shopper_shopperName">
<input type="text" data-table="shopper" data-field="x_shopperName" name="x_shopperName" id="x_shopperName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($shopper_edit->shopperName->getPlaceHolder()) ?>" value="<?php echo $shopper_edit->shopperName->EditValue ?>"<?php echo $shopper_edit->shopperName->editAttributes() ?>>
</span>
<?php echo $shopper_edit->shopperName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($shopper_edit->shopperPhoneNo->Visible) { // shopperPhoneNo ?>
	<div id="r_shopperPhoneNo" class="form-group row">
		<label id="elh_shopper_shopperPhoneNo" for="x_shopperPhoneNo" class="<?php echo $shopper_edit->LeftColumnClass ?>"><?php echo $shopper_edit->shopperPhoneNo->caption() ?><?php echo $shopper_edit->shopperPhoneNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shopper_edit->RightColumnClass ?>"><div <?php echo $shopper_edit->shopperPhoneNo->cellAttributes() ?>>
<span id="el_shopper_shopperPhoneNo">
<input type="text" data-table="shopper" data-field="x_shopperPhoneNo" name="x_shopperPhoneNo" id="x_shopperPhoneNo" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($shopper_edit->shopperPhoneNo->getPlaceHolder()) ?>" value="<?php echo $shopper_edit->shopperPhoneNo->EditValue ?>"<?php echo $shopper_edit->shopperPhoneNo->editAttributes() ?>>
</span>
<?php echo $shopper_edit->shopperPhoneNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($shopper_edit->shopperEmail->Visible) { // shopperEmail ?>
	<div id="r_shopperEmail" class="form-group row">
		<label id="elh_shopper_shopperEmail" for="x_shopperEmail" class="<?php echo $shopper_edit->LeftColumnClass ?>"><?php echo $shopper_edit->shopperEmail->caption() ?><?php echo $shopper_edit->shopperEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shopper_edit->RightColumnClass ?>"><div <?php echo $shopper_edit->shopperEmail->cellAttributes() ?>>
<span id="el_shopper_shopperEmail">
<input type="text" data-table="shopper" data-field="x_shopperEmail" name="x_shopperEmail" id="x_shopperEmail" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($shopper_edit->shopperEmail->getPlaceHolder()) ?>" value="<?php echo $shopper_edit->shopperEmail->EditValue ?>"<?php echo $shopper_edit->shopperEmail->editAttributes() ?>>
</span>
<?php echo $shopper_edit->shopperEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$shopper_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $shopper_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $shopper_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$shopper_edit->showPageFooter();
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
$shopper_edit->terminate();
?>