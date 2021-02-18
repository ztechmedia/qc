<ul class="breadcrumb">
    <li>Akun</li>
    <li class="active">
        <?= $role->display_name ?>
    </li>
</ul>

<div class="page-title">
    <h2></span> <?= $role->display_name ?></h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <?php if ($this->auth->role_id == 1) { ?>
                        <div class="btnContainer">
                            <button class="btn btn-default link-to" data-to="<?= base_url("admin/users/create/$role->id") ?>">
                                Tambah <?= $role->display_name ?>
                            </button>
                        </div>
                    <?php } ?>

                    <table class="table table-bordered" id="admin">
                        <thead>
                            <th width="8%">No</th>
                            <th>Nama</th>
                            <th>Email</th>
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
                "url": "<?= base_url("admin/users-table/$role->id") ?>",
                "type": "POST"
            },
            columns: [{
                    data: "no",
                },
                {
                    data: "name",
                },
                {
                    data: "email",
                },
                {
                    data: 'actions'
                }
            ]
        });
    });
</script>