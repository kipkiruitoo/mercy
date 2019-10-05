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
$shopper_add = new shopper_add();

// Run the page
$shopper_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shopper_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fshopperadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fshopperadd = currentForm = new ew.Form("fshopperadd", "add");

	// Validate form
	fshopperadd.validate = function() {
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
			<?php if ($shopper_add->shopperID->Required) { ?>
				elm = this.getElements("x" + infix + "_shopperID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shopper_add->shopperID->caption(), $shopper_add->shopperID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_shopperID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($shopper_add->shopperID->errorMessage()) ?>");
			<?php if ($shopper_add->shopperName->Required) { ?>
				elm = this.getElements("x" + infix + "_shopperName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shopper_add->shopperName->caption(), $shopper_add->shopperName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($shopper_add->shopperPhoneNo->Required) { ?>
				elm = this.getElements("x" + infix + "_shopperPhoneNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shopper_add->shopperPhoneNo->caption(), $shopper_add->shopperPhoneNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_shopperPhoneNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($shopper_add->shopperPhoneNo->errorMessage()) ?>");
			<?php if ($shopper_add->shopperEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_shopperEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shopper_add->shopperEmail->caption(), $shopper_add->shopperEmail->RequiredErrorMessage)) ?>");
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
	fshopperadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fshopperadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fshopperadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $shopper_add->showPageHeader(); ?>
<?php
$shopper_add->showMessage();
?>
<form name="fshopperadd" id="fshopperadd" class="<?php echo $shopper_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shopper">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$shopper_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($shopper_add->shopperID->Visible) { // shopperID ?>
	<div id="r_shopperID" class="form-group row">
		<label id="elh_shopper_shopperID" for="x_shopperID" class="<?php echo $shopper_add->LeftColumnClass ?>"><?php echo $shopper_add->shopperID->caption() ?><?php echo $shopper_add->shopperID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shopper_add->RightColumnClass ?>"><div <?php echo $shopper_add->shopperID->cellAttributes() ?>>
<span id="el_shopper_shopperID">
<input type="text" data-table="shopper" data-field="x_shopperID" name="x_shopperID" id="x_shopperID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($shopper_add->shopperID->getPlaceHolder()) ?>" value="<?php echo $shopper_add->shopperID->EditValue ?>"<?php echo $shopper_add->shopperID->editAttributes() ?>>
</span>
<?php echo $shopper_add->shopperID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($shopper_add->shopperName->Visible) { // shopperName ?>
	<div id="r_shopperName" class="form-group row">
		<label id="elh_shopper_shopperName" for="x_shopperName" class="<?php echo $shopper_add->LeftColumnClass ?>"><?php echo $shopper_add->shopperName->caption() ?><?php echo $shopper_add->shopperName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shopper_add->RightColumnClass ?>"><div <?php echo $shopper_add->shopperName->cellAttributes() ?>>
<span id="el_shopper_shopperName">
<input type="text" data-table="shopper" data-field="x_shopperName" name="x_shopperName" id="x_shopperName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($shopper_add->shopperName->getPlaceHolder()) ?>" value="<?php echo $shopper_add->shopperName->EditValue ?>"<?php echo $shopper_add->shopperName->editAttributes() ?>>
</span>
<?php echo $shopper_add->shopperName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($shopper_add->shopperPhoneNo->Visible) { // shopperPhoneNo ?>
	<div id="r_shopperPhoneNo" class="form-group row">
		<label id="elh_shopper_shopperPhoneNo" for="x_shopperPhoneNo" class="<?php echo $shopper_add->LeftColumnClass ?>"><?php echo $shopper_add->shopperPhoneNo->caption() ?><?php echo $shopper_add->shopperPhoneNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shopper_add->RightColumnClass ?>"><div <?php echo $shopper_add->shopperPhoneNo->cellAttributes() ?>>
<span id="el_shopper_shopperPhoneNo">
<input type="text" data-table="shopper" data-field="x_shopperPhoneNo" name="x_shopperPhoneNo" id="x_shopperPhoneNo" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($shopper_add->shopperPhoneNo->getPlaceHolder()) ?>" value="<?php echo $shopper_add->shopperPhoneNo->EditValue ?>"<?php echo $shopper_add->shopperPhoneNo->editAttributes() ?>>
</span>
<?php echo $shopper_add->shopperPhoneNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($shopper_add->shopperEmail->Visible) { // shopperEmail ?>
	<div id="r_shopperEmail" class="form-group row">
		<label id="elh_shopper_shopperEmail" for="x_shopperEmail" class="<?php echo $shopper_add->LeftColumnClass ?>"><?php echo $shopper_add->shopperEmail->caption() ?><?php echo $shopper_add->shopperEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shopper_add->RightColumnClass ?>"><div <?php echo $shopper_add->shopperEmail->cellAttributes() ?>>
<span id="el_shopper_shopperEmail">
<input type="text" data-table="shopper" data-field="x_shopperEmail" name="x_shopperEmail" id="x_shopperEmail" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($shopper_add->shopperEmail->getPlaceHolder()) ?>" value="<?php echo $shopper_add->shopperEmail->EditValue ?>"<?php echo $shopper_add->shopperEmail->editAttributes() ?>>
</span>
<?php echo $shopper_add->shopperEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$shopper_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $shopper_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $shopper_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$shopper_add->showPageFooter();
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
$shopper_add->terminate();
?>