<ul class="breadcrumb">
    <li>Produksi</li>
    <li class="active">
       Print NCR
    </li>
</ul>

<div class="page-title">
    <h2></span>Print NCR</h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered" id="admin">
                        <thead>
                            <th width="8%">No</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th width="12%">Print</th>
                        </thead>

                        <tbody>
                            <?php $no = 1; foreach ($rolls as $roll) {
                                $slitt_roll = str_replace(" ", "-", $roll->slitt_roll);
                            ?>
                                <tr>
                                    <td><?=$no++?></td>
                                    <td><?=$roll->customer?></td>
                                    <td><?=$roll->total?></td>
                                    <td>
                                        <a class="btn btn-warning" target="blank" href="<?= base_url("admin/productions/print-ncr/$date/$slitt_roll/$group")?>">
                                            Print
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>