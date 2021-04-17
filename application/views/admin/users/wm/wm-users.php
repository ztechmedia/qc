<ul class="breadcrumb">
    <li>Akun</li>
    <li class="active">WM</li>
</ul>

<div class="page-title">
    <h2></span> Akun Aplikasi WM</h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <?php if ($this->auth->role_id == 1) { ?>
                        <div class="btnContainer">
                            <button class="btn btn-default link-to" data-to="<?= base_url("admin/wm-users/create") ?>">
                                Tambah Akun WM
                            </button>
                        </div>
                    <?php } ?>

                    <table class="table table-bordered" id="wm-users">
                        <thead>
                            <th width="8%">No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Level</th>
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
        $('#wm-users').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [
                [1, 'desc']
            ],
            "ajax": {
                "url": "<?= base_url("admin/wm-users-table") ?>",
                "type": "POST"
            },
            columns: [{
                    data: "no",
                },
                {
                    data: "nama",
                },
                {
                    data: "username",
                },
                {
                    data: "level",
                },
                {
                    data: 'actions'
                }
            ]
        });
    });
</script>