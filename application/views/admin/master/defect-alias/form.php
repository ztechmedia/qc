<div class="form-group">
    <label class="col-md-3 control-label">Defect</label>
    <div class="col-md-6">
        <input name="defect" id="defect" type="text" class="validate[required,maxSize[20]] form-control" value="<?= $defect ? $defect->defect : "" ?>" />
        <span class="help-block form-error" id="defect-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Alias</label>
    <div class="col-md-6">
        <input name="alias" id="alias" type="text" class="validate[required,maxSize[2]] form-control" value="<?= $defect ? $defect->alias : "" ?>" />
        <span class="help-block form-error" id="alias-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Standar Cross</label>
    <div class="col-md-6">
        <input name="def_default" id="def_default" type="text" class="validate[maxSize[3]] form-control" value="<?= $defect ? $defect->def_default : "" ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Max Cross</label>
    <div class="col-md-6">
        <input name="max_cross" id="max_cross" type="text" class="validate[maxSize[3]] form-control" value="<?= $defect ? $defect->max_cross : "" ?>" />
    </div>
</div>