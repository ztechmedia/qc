<ul class="breadcrumb">
    <li>Master</li>
    <li><a class="link-to" data-to="<?= base_url("admin/master/customer-alias") ?>">Customer Alias</a></li>
    <li class="active">Tambah Data</li>
</ul>

<div class="content-frame">
    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-mail-reply link-to" data-to="<?= base_url("admin/master/customer-alias") ?>"></span> Tambah Alias</h2>
        </div>
    </div>

    <div class="content-frame-body content-frame-body-left">
        <div class="row">
            <div class="col-md-12">
                <form id="validate" role="form" class="form-horizontal action-submit-create" data-action="<?= base_url("admin/master/customer-alias/add") ?>">
                    <?php $data['customer'] = null;
                    $this->load->view('admin/master/customer-alias/form', $data) ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button class="btn btn-default save" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    formSelect();
    formValidation(".action-submit-create");
</script>