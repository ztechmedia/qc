<ul class="breadcrumb">
    <li>Master</li>
    <li class="active">Customer Alias</li>
</ul>

<div class="page-title">
    <h2></span> Customer Alias</h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <?php if ($this->auth->role_id == 1) { ?>
                        <div class="btnContainer">
                            <button class="btn btn-default link-to" data-to="<?= base_url("admin/master/customer-alias/create") ?>">
                                Tambah Alias
                            </button>
                        </div>
                    <?php } ?>

                    <table class="table table-bordered" id="admin">
                        <thead>
                            <th width="8%">No</th>
                            <th>Customer</th>
                            <th>Alias</th>
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
                [1, 'desc']
            ],
            "ajax": {
                "url": "<?= base_url("admin/master/customer-alias-table") ?>",
                "type": "POST"
            },
            columns: [{
                    data: "no",
                },
                {
                    data: "customer",
                },
                {
                    data: "alias",
                },
                {
                    data: 'actions'
                }
            ]
        });
    });
</script>