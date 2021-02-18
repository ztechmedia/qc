<ul class="breadcrumb">
    <li>Produksi</li>
    <li class="active">
       Palet
    </li>
</ul>

<div class="page-title">
    <h2></span> Palet</h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered" id="admin">
                        <thead>
                            <th width="8%">No</th>
                            <th>No. Palet</th>
                            <th>Tgl Input</th>
                            <th>Customer</th>
                            <th>No. Roll</th>
                            <th>Type</th>
                            <th>Tgl Kirim</th>
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
                "url": "<?= base_url("admin/productions/packing/palet-table") ?>",
                "type": "POST"
            },
            columns: [{
                    data: "no",
                },
                {
                    data: "no_palet",
                },
                {
                    data: "tgl_inputpalet",
                },
                {
                    data: "customer_palet",
                },
                {
                    data: "no_roll",
                },
                {
                    data: "slitt_roll_palet",
                },
                {
                    data: "tgl_kirim",
                },
                {
                    data: 'actions'
                }
            ]
        });
    });
</script>