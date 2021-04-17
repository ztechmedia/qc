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

    <?php if($slitting->stock == "Base Film") { ?>
        <div class="content-frame-body content-frame-body-left">
            <div class="row">
                <div class="col-md-12">
                    <span>Base Film tidak dapat direvisi, menu ini hanya untuk FG</span>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="content-frame-body content-frame-body-left">
            <div class="row">
                <div class="col-md-12">
                    <form id="validate" role="form" class="form-horizontal action-submit-update"
                        data-action="<?=base_url("admin/productions/slitting/$slitting->id_slitt/update")?>" 
                        data-redirect="<?=base_url("admin/productions/slitting/main/$year/$month/$date")?>"
                        data-target=".content">

                        <div class="form-group">
                            <label class="col-md-3 control-label">SPK Slitting</label>
                            <div class="col-md-8">
                                <select class="validate[required] form-control select" data-live-search="true" name="id_spk_slitt" id="id_spk_slitt">
                                    <?php foreach ($spks as $spk) { $selected = $spk->id_spk_slitting === $slitting->id_spk_slitt ? "selected" : null; ?>
                                            <option <?= $selected ?> value="<?= $spk->id_spk_slitting ?>"><?= $spk->id_spk_slitting ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">No SPK</label>
                            <div class="col-md-8">
                                <input style="color: black" readonly type="text" class="form-control" 
                                    value="<?= $slitting->no_spk_slitt ?>" />
                                <span>Akan update otomatis sesuai SPK Slitting</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">PO/CO</label>
                            <div class="col-md-8">
                                <input style="color: black" readonly type="text" class="form-control" 
                                    value="<?= $slitting->id_po_slitt ?>" />
                                <span>Akan update otomatis sesuai SPK Slitting</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Slitt Roll</label>
                            <div class="col-md-8">
                                <input style="color: black" readonly type="text" class="form-control" 
                                    value="<?= $slitting->slitt_roll ?>" />
                                <span>Akan update otomatis sesuai SPK Slitting</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Tanggal</label>
                            <div class="col-md-8">
                                <input data-date="<?= date('d-m-Y') ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="months"  style="color: black" readonly name="tgl" id="tgl" type="text" class="validate[required] form-control pointer" 
                                    value="<?= revDate($slitting->tgl) ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Mesin</label>
                            <div class="col-md-8">
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
                            <div class="col-md-8">
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
                            <div class="col-md-8">
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
                            <div class="col-md-8">
                                <input name="kode_roll_slitt" id="kode_roll_slitt" type="text" class="validate[required] form-control" 
                                    value="<?= $slitting->kode_roll_slitt ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Tipe</label>
                            <div class="col-md-8">
                                <input style="color: black" readonly type="text" class="form-control" 
                                    value="<?= $slitting->type_slitt ?>" />
                                <span>Akan update otomatis sesuai SPK Slitting</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Tebal</label>
                            <div class="col-md-8">
                                <input style="color: black" readonly type="number" class="form-control" 
                                    value="<?= $slitting->mic_slitt ?>" />
                                <span>Akan update otomatis sesuai SPK Slitting</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Lebar</label>
                            <div class="col-md-8">
                                <input style="color: black" readonly type="number" class="form-control" 
                                    value="<?= $slitting->lebar_slitt ?>" />
                                <span>Akan update otomatis sesuai SPK Slitting</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Panjang</label>
                            <div class="col-md-8">
                                <input style="color: black" readonly type="number" class="form-control" 
                                    value="<?= $slitting->panjang_slitt ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Join</label>
                            <div class="col-md-8">
                                <input name="join_slitt" id="join_slitt" type="text" class="form-control" 
                                    value="<?= $slitting->join_slitt?>" />
                                <span>Akan update otomatis sesuai SPK Slitting</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Keterangan</label>
                            <div class="col-md-8">
                                <textarea name="ket" id="ket" type="text" class="form-control"><?= $slitting->ket ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Operator</label>
                            <div class="col-md-8">
                                <input name="user" id="user" type="text" class="validate[required] form-control" 
                                    value="<?= $slitting->user ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <button class="btn btn-default save" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<script>
    $("#id_spk_slitt").val('<?= $slitting->id_spk_slitt ?>');
    $("#tgl").datepicker();
    formSelect();
    formValidation(".action-submit-update");
</script>