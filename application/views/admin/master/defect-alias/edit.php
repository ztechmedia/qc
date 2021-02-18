<ul class="breadcrumb">
    <li>Master</li>
    <li><a class="link-to" data-to="<?=base_url("admin/master/defect-alias")?>">Defect Alias</a></li>
    <li class="active">Edit Data</li>
</ul>

<div class="content-frame">
    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-mail-reply link-to" data-to="<?=base_url("admin/master/defect-alias")?>"></span> Edit Alias</h2>
        </div>
    </div>

    <div class="content-frame-body content-frame-body-left">
        <div class="row">
            <div class="col-md-12">
                <form id="validate" role="form" class="form-horizontal action-submit-update"
                    data-action="<?=base_url("admin/master/defect-alias/$defect->id/update")?>" 
                    data-redirect="<?=base_url("admin/master/defect-alias")?>"
                    data-target=".content">
                    <?php $data['defect'] = $defect; $this->load->view('admin/master/defect-alias/form', $data)?>
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