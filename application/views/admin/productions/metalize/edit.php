<ul class="breadcrumb">
    <li>Produksi</li>
    <li><a class="link-to" data-to="<?=base_url("admin/productions/metalize/main/$year/$month/$date")?>">Metalize</a></li>
    <li class="active">Edit Data</li>
</ul>

<div class="content-frame">
    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-mail-reply link-to" data-to="<?=base_url("admin/productions/metalize/main/$year/$month/$date")?>"></span> Edit Roll Metalize</h2>
        </div>
    </div>

    <div class="content-frame-body content-frame-body-left">
        <div class="row">
            <div style="margin-bottom: 10px" class="col-md-12">
                <span>Gunakan menu EDIT hanya jika salah pada CHAMBER CLOSE & OPEN, NO LOT INPUT, PANJANG OUTPUT, JOIN , KETERANGAN</span><br>
            </div>
            <div class="col-md-12">
                <form id="validate" role="form" class="form-horizontal action-submit-update"
                    data-action="<?=base_url("admin/productions/metalize/$metalize->id_met/update")?>" 
                    data-redirect="<?=base_url("admin/productions/metalize/main/$year/$month/$date")?>"
                    data-target=".content">

                    <div class="form-group">
                        <label class="col-md-3 control-label">No. SPK</label>
                        <div class="col-md-6">
                            <input style="color:black" readonly name="no_spk_met" id="no_spk_met" type="text" class="validate[required] form-control" 
                            value="<?= $metalize->no_spk_met ?>" />
                        </div>
                    </div>  

                    <div class="form-group">
                        <label class="col-md-3 control-label">No Lot Input</label>
                        <div class="col-md-6">
                            <input name="inputan_bf" id="inputan_bf" type="text" class="validate[required] form-control" 
                            value="<?= $metalize->inputan_bf ?>" />
                        </div>
                    </div>  

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tipe Input</label>
                        <div class="col-md-6">
                            <input style="color:black" readonly type="text" class="form-control" 
                            value="<?= $metalize->type_input_met." ".$metalize->tebal_inp_met." x ".$metalize->lebar_inp_met." x ".$metalize->panjang_inp_met ?>" />
                        </div>
                    </div>  

                    <div class="form-group">
                        <label class="col-md-3 control-label">Closed Chamber</label>
                        <div class="col-md-6">
                            <input name="closed" id="closed" type="text" class="validate[required] form-control" 
                            value="<?= $metalize->closed ?>" />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label">Opened Chamber</label>
                        <div class="col-md-6">
                            <input name="opened" id="opened" type="text" class="validate[required] form-control" 
                            value="<?= $metalize->opened ?>" />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label">Shift</label>
                        <div class="col-md-6">
                           <select class="form-control" name="shift" id="shift">
                                <?php $shift = ["1", "2", "3"];
                                    foreach ($shift as $sf) { $selected = $sf == $metalize->shift ? "selected" : null; ?>
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
                                    foreach ($groups as $gr) { $selected = $gr == $metalize->regu ? "selected" : null; ?>
                                        <option <?=$selected?> value="<?=$gr?>"><?=$gr?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Kode Roll Output</label>
                        <div class="col-md-6">
                            <input style="color:black" readonly type="text" class="form-control" 
                            value="<?= $metalize->output_kode_roll ?>" />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tipe Output</label>
                        <div class="col-md-6">
                            <input style="color:black" readonly type="text" class="form-control" 
                            value="<?= $metalize->output_type_met ?>" />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tebal Output</label>
                        <div class="col-md-6">
                            <input style="color:black" readonly type="text" class="form-control" 
                            value="<?= $metalize->mic_met ?>" />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label">Lebar Output</label>
                        <div class="col-md-6">
                            <input style="color:black" readonly type="text" class="form-control" 
                            value="<?= $metalize->lebar_met ?>" />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label">Panjang Output</label>
                        <div class="col-md-6">
                            <input name="panjang_met" id="panjang_met" type="text" class="validate[required] form-control" 
                            value="<?= $metalize->panjang_met ?>" />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label">Deskripsi</label>
                        <div class="col-md-6">
                            <input style="color:black" readonly type="text" class="form-control" 
                            value="<?= $metalize->desc_type ?>" />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label">Customer</label>
                        <div class="col-md-6">
                            <input name="customer_met" id="customer_met" type="text" class="form-control" 
                            value="<?= $metalize->customer_met ?>" />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label">Join</label>
                        <div class="col-md-6">
                            <input name="joint_met" id="joint_met" type="text" class="form-control" 
                            value="<?= $metalize->joint_met ?>" />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label">Keterangan</label>
                        <div class="col-md-6">
                            <textarea name="ket_met" id="ket_met" type="text" class="form-control"><?= $metalize->ket_met ?></textarea>
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