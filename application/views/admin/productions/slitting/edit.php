<ul class="breadcrumb">
    <li>Produksi</li>
    <li><a class="link-to" data-to="<?=base_url("admin/productions/slitting/main/$year/$month/$date")?>">Slitting</a></li>
    <li class="active">Edit Data</li>
</ul>

<div class="content-frame">
    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-mail-reply link-to" data-to="<?=base_url("admin/productions/slitting/main/$year/$month/$date")?>"></span> Edit Roll Slitting</h2>
        </div>
    </div>

    <div class="content-frame-body content-frame-body-left">
        <div class="row">
            <div class="col-md-12">
                <form id="validate" role="form" class="form-horizontal action-submit-update"
                    data-action="<?=base_url("admin/productions/slitting/$slitting->id_slitt/update")?>" 
                    data-redirect="<?=base_url("admin/productions/slitting/main/$year/$month/$date")?>"
                    data-target=".content">

                    <div class="form-group">
                        <label class="col-md-3 control-label">PO/CO</label>
                        <div class="col-md-6">
                            <input style="color: black" readonly name="id_po_slitt" id="id_po_slitt" type="text" class="validate[required] form-control" 
                                value="<?= $slitting->id_po_slitt ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">SPK</label>
                        <div class="col-md-6">
                            <textarea style="color: black" readonly name="id_spk_slitt" id="id_spk_slitt" type="text" class="validate[required] form-control"><?= $slitting->id_spk_slitt ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">No SPK</label>
                        <div class="col-md-6">
                            <input style="color: black" readonly name="no_spk_slitt" id="no_spk_slitt" type="text" class="validate[required] form-control" 
                                value="<?= $slitting->no_spk_slitt ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal</label>
                        <div class="col-md-6">
                            <input style="color: black" readonly name="tgl" id="tgl" type="text" class="validate[required] form-control" 
                                value="<?= $slitting->tgl ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Mesin</label>
                        <div class="col-md-6">
                            <select class="form-control" name="nama_mesin" id="nama_mesin">
                                <?php $mesin = [
                                        "Sliting CPP 1", "Sliting CPP 2", "Sliting CPP 3", 
                                        "Sliting Met 1", "Sliting Met 2", "Sliting Met 3",
                                        "Secondary 1", "Secondary 2"
                                    ];
                                    foreach ($mesin as $ms) { $selected = $ms == $slitting->nama_mesin ? "selected" : null; ?>
                                        <option <?=$selected?> value="<?=$ms?>"><?=$ms?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Shift</label>
                        <div class="col-md-6">
                           <select class="form-control" name="shift" id="shift">
                                <?php $shift = ["1", "2", "3"];
                                    foreach ($shift as $sf) { $selected = $sf == $slitting->shift ? "selected" : null; ?>
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
                                    foreach ($groups as $gr) { $selected = $gr == $slitting->regu ? "selected" : null; ?>
                                        <option <?=$selected?> value="<?=$gr?>"><?=$gr?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Kode Roll</label>
                        <div class="col-md-6">
                            <input name="kode_roll_slitt" id="kode_roll_slitt" type="text" class="validate[required] form-control" 
                                value="<?= $slitting->kode_roll_slitt ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tipe</label>
                        <div class="col-md-6">
                            <input style="color: black" readonly name="type_slitt" id="type_slitt" type="text" class="validate[required] form-control" 
                                value="<?= $slitting->type_slitt ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tebal</label>
                        <div class="col-md-6">
                            <input name="mic_slitt" id="mic_slitt" type="number" class="validate[required] form-control" 
                                value="<?= $slitting->mic_slitt ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Lebar</label>
                        <div class="col-md-6">
                            <input name="lebar_slitt" id="lebar_slitt" type="number" class="validate[required] form-control" 
                                value="<?= $slitting->lebar_slitt ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Panjang</label>
                        <div class="col-md-6">
                            <input name="panjang_slitt" id="panjang_slitt" type="number" class="validate[required] form-control" 
                                value="<?= $slitting->panjang_slitt ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Keterangan</label>
                        <div class="col-md-6">
                            <textarea name="ket" id="ket" type="text" class="form-control"><?= $slitting->ket ?></textarea>
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