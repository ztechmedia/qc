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
        <input style="color:black" readonly type="text" class="validate[required] form-control" 
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
        <select name="customer_palet" id="customer_palet" class="form-control">
            <?php foreach ($customers as $customer) { $selected = $customer->customer_palet == $palet->customer_palet ? "selected" : null; ?>
               <option <?= $selected ?> value="<?= $customer->customer_palet ?>"><?= $customer->customer_palet ?></option>
            <?php } ?>
        </select>
        <span>Hati - hati nama Customer banyak yang beda, perhatikan titik, koma dan spasi (Programer wira amatir sih)</span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Type</label>
    <div class="col-md-6">
        <input name="type_roll_palet" id="type_roll_palet" type="text" class="validate[required] form-control" 
            value="<?= $palet->type_roll_palet ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Tebal</label>
    <div class="col-md-6">
        <input name="tebal_roll_palet" id="tebal_roll_palet" type="number" class="validate[required] form-control" 
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
        <input style="color:black" readonly type="text" class="validate[required] form-control" 
            value="<?= revDate($palet->tgl_kirim) ?>" />
    </div>
</div>