<ul class="breadcrumb">
    <li>Produksi</li>
    <li><a class="link-to" data-to="<?=base_url("admin/productions/cpp/main/$year/$month/$date")?>">CPP</a></li>
    <li class="active">Edit Data</li>
</ul>

<div class="content-frame">
    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-mail-reply link-to" data-to="<?=base_url("admin/productions/cpp/main/$year/$month/$date")?>"></span> Edit Roll CPP</h2>
        </div>
    </div>

    <div class="content-frame-body content-frame-body-left">
        <div class="row">
            <div class="col-md-12">
                <form id="validate" role="form" class="form-horizontal action-submit-update"
                    data-action="<?=base_url("admin/productions/cpp/$cpp->id/update")?>" 
                    data-redirect="<?=base_url("admin/productions/cpp/main/$year/$month/$date")?>"
                    data-target=".content">

                    <div class="form-group">
                        <label class="col-md-3 control-label">No. SPK</label>
                        <div class="col-md-6">
                            <input name="no_spk" id="no_spk" type="text" class="validate[required] form-control" 
                            value="<?= $cpp->no_spk ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tgl Input</label>
                        <div class="col-md-6">
                            <input style="color: black" readonly type="text" class="validate[required] form-control" 
                            value="<?= revDate($cpp->tgl_input) ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Shift</label>
                        <div class="col-md-6">
                           <select class="form-control" name="shift" id="shift">
                                <?php $shift = ["1", "2", "3"];
                                    foreach ($shift as $sf) { $selected = $sf == $cpp->shift ? "selected" : null; ?>
                                        <option <?=$selected?> value="<?=$sf?>"><?=$sf?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Regu</label>
                        <div class="col-md-6">
                           <select class="form-control" name="regu" id="regu">
                                <?php $groups = ["A", "B", "C", "D"];
                                    foreach ($groups as $gr) { $selected = $gr == $cpp->regu ? "selected" : null; ?>
                                        <option <?=$selected?> value="<?=$gr?>"><?=$gr?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tipe</label>
                        <div class="col-md-6">
                            <input name="type" id="type" type="text" class="validate[required] form-control" 
                            value="<?= $cpp->type ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tebal</label>
                        <div class="col-md-6">
                            <input name="tebal" id="tebal" type="number" class="validate[required] form-control" 
                            value="<?= $cpp->tebal ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Lebar</label>
                        <div class="col-md-6">
                            <input name="lebar" id="lebar" type="number" class="validate[required] form-control" 
                            value="<?= $cpp->lebar ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Panjang</label>
                        <div class="col-md-6">
                            <input name="panjang" id="panjang" type="number" class="validate[required] form-control" 
                            value="<?= $cpp->panjang ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Kode Roll</label>
                        <div class="col-md-6">
                            <input name="kode_roll" id="kode_roll" type="text" class="validate[required] form-control" 
                            value="<?= $cpp->kode_roll ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Deskripsi</label>
                        <div class="col-md-6">
                            <input name="desc_type" id="desc_type" type="text" class="validate[required] form-control" 
                            value="<?= $cpp->desc_type ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Keterangan</label>
                        <div class="col-md-6">
                            <textarea name="keterangan_cpp" id="keterangan_cpp" class="form-control"><?= $cpp->keterangan_cpp ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button class="btn btn-default save" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    formSelect();
    formValidation(".action-submit-update");
</script>