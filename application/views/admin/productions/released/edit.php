<ul class="breadcrumb">
    <li>Akun</li>
    <li><a class="link-to" data-to="<?=base_url("admin/productions/released/$year/$month")?>">Released Rolll</a></li>
    <li class="active">Edit Data</li>
</ul>

<div class="content-frame">
    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-mail-reply link-to" data-to="<?=base_url("admin/productions/released/$year/$month")?>"></span> Edit Released Roll</h2>
        </div>
    </div>

    <div class="content-frame-body content-frame-body-left">
        <div class="row">
            <div class="col-md-12">
                <form id="validate" role="form" class="form-horizontal action-submit-update"
                    data-action="<?=base_url("admin/productions/released/$roll->id_released_jr/update")?>" 
                    data-redirect="<?=base_url("admin/productions/released/$year/$month")?>"
                    data-target=".content">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Released</label>
                        <div class="col-md-6">
                            <input style="color: black" readonly name="tgl_released_jr" id="tgl_released_jr" type="text" class="validate[required] form-control" 
                            value="<?=$roll->tgl_released_jr?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Nomor Released</label>
                        <div class="col-md-6">
                            <input style="color: black" readonly name="no_released_jr" id="no_released_jr" type="text" class="validate[required] form-control" 
                            value="<?=$roll->no_released_jr?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">No Roll</label>
                        <div class="col-md-6">
                            <input style="color: black" readonly name="no_roll_released_jr" id="no_roll_released_jr" type="text" class="validate[required] form-control" 
                            value="<?=$roll->no_roll_released_jr?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tipe</label>
                        <div class="col-md-6">
                            <input style="color: black" readonly name="ukuran" id="ukuran" type="text" class="validate[required] form-control" 
                            value="<?=$roll->ukuran?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Keterangan Hold</label>
                        <div class="col-md-6">
                            <input style="color: black" readonly name="ket_hold" id="ket_hold" type="text" class="validate[required] form-control" 
                            value="<?=$roll->ket_hold?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Di Released Oleh</label>
                        <div class="col-md-6">
                            <input style="color: black" readonly name="id_user_released_jr" id="id_user_released_jr" type="text" class="validate[required] form-control" 
                            value="<?=$roll->id_user_released_jr?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Alasan</label>
                        <div class="col-md-6">
                            <input style="color: black" name="reason_jr" id="reason_jr" type="text" class="validate[required] form-control" 
                            value="<?=$roll->reason_jr?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Status Akhir</label>
                        <div class="col-md-6">
                            <select class="form-control" id="status_akhir" name="status_akhir">
                            <?php $status = ["HOLD", "REWORK", "REJECT"];
                                foreach ($status as $value) { $select = $value == $roll->status_akhir ? "selected" : null; ?>
                                <option <?=$select?> value="<?=$value?>"><?=$value?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <input style="display: none" name="status_form" id="status_form" type="text" value="<?=$roll->status_form?>" />

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