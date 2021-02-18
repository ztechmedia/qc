<ul class="breadcrumb">
    <li>Master</li>
    <li class="active">Defect Alias</li>
</ul>

<div class="page-title">
    <h2></span> CustDefectomer Alias</h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <?php if ($this->auth->role_id == 1) { ?>
                        <div class="btnContainer">
                            <button class="btn btn-default link-to" data-to="<?= base_url("admin/master/defect-alias/create") ?>">
                                Tambah Alias
                            </button>
                        </div>
                    <?php } ?>

                    <table class="table table-bordered" id="admin">
                        <thead>
                            <th width="8%">No</th>
                            <th>Defect</th>
                            <th>Alias</th>
                            <th>Standar Cross</th>
                            <th>Max Cross</th>
                            <th width="12%">Tindakan</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .btnContainer {
        margin-bottom: 10px;
    }
</style>

<script>
    $(document).ready(() => {
        $('#admin').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [
                [2, 'asc']
            ],
            "ajax": {
                "url": "<?= base_url("admin/master/defect-alias-table") ?>",
                "type": "POST"
            },
            columns: [{
                    data: "no",
                },
                {
                    data: "defect",
                },
                {
                    data: "alias",
                },
                {
                    data: "def_default",
                },
                {
                    data: "max_cross",
                },
                {
                    data: 'actions'
                }
            ]
        });
    });
</script>