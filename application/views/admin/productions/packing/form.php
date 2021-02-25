<div class="form-group">
    <label class="col-md-3 control-label">No. palet</label>
    <div class="col-md-6">
        <input name="no_palet" id="no_palet" type="text" class="validate[required] form-control" 
            value="<?= $palet->no_palet ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Tgl Input</label>
    <div class="col-md-6">
        <input readonly name="tgl_inputpalet" id="tgl_inputpalet" type="text" class="validate[required] form-control" 
            value="<?= revDate($palet->tgl_inputpalet) ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">PO Palet</label>
    <div class="col-md-6">
        <input <?= $this->auth->role_id == 1 ? "" : "readonly" ?> name="id_po_palet" id="id_po_palet" type="text" class="form-control" 
            value="<?= $palet->id_po_palet ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">No. Roll</label>
    <div class="col-md-6">
        <input name="no_roll" id="no_roll" type="text" class="validate[required] form-control" 
            value="<?= $palet->no_roll ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Customer</label>
    <div class="col-md-6">
        <input name="customer_palet" id="customer_palet" type="text" class="validate[required] form-control" 
            value="<?= $palet->customer_palet ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Type Roll</label>
    <div class="col-md-6">
        <input name="slitt_roll_palet" id="slitt_roll_palet" type="text" class="validate[required] form-control" 
            value="<?= $palet->slitt_roll_palet ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Type</label>
    <div class="col-md-6">
        <input <?= $this->auth->role_id == 1 ? "" : "readonly" ?> name="type_roll_palet" id="type_roll_palet" type="text" class="validate[required] form-control" 
            value="<?= $palet->type_roll_palet ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Tebal</label>
    <div class="col-md-6">
        <input <?= $this->auth->role_id == 1 ? "" : "readonly" ?> name="tebal_roll_palet" id="tebal_roll_palet" type="number" class="validate[required] form-control" 
            value="<?= $palet->tebal_roll_palet ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Lebar</label>
    <div class="col-md-6">
        <input name="lebar_roll_palet" id="lebar_roll_palet" type="number" class="validate[required] form-control" 
            value="<?= $palet->lebar_roll_palet ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Panjang</label>
    <div class="col-md-6">
        <input name="panjang_roll_palet" id="panjang_roll_palet" type="number" class="validate[required] form-control" 
            value="<?= $palet->panjang_roll_palet ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Tgl Kirim</label>
    <div class="col-md-6">
        <input readonly name="tgl_kirim" id="tgl_kirim" type="text" class="validate[required] form-control" 
            value="<?= revDate($palet->tgl_kirim) ?>" />
    </div>
</div>