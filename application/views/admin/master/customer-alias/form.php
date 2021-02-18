<div class="form-group">
    <label class="col-md-3 control-label">Customer</label>
    <div class="col-md-6">
        <input name="customer" id="customer" type="text" class="validate[required,maxSize[50]] form-control" value="<?= $customer ? $customer->customer : "" ?>" />
        <span class="help-block form-error" id="customer-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Alias</label>
    <div class="col-md-6">
        <input name="alias" id="alias" type="text" class="validate[required,maxSize[15]] form-control" value="<?= $customer ? $customer->alias : "" ?>" />
        <span class="help-block form-error" id="alias-error"></span>
    </div>
</div>