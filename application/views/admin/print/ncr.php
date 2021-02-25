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

    <div class="row" style="height: 100vh">
		<div class="col-md-12">
			<div style="display:flex; flex-direction:row; justify-content:flex-end; margin-bottom:10px;">
				<div class="input-group">
					<span class="input-group-addon">Group</span>
					<select id="group" class="form-control pointer" onchange="changeGroup($(this).val())">
                        <?php 
                            $groups = ["A", "B", "C", "D"];
                            foreach ($groups as $gr) { 
                                $selected = $gr == $group ? "selected" : "";
                        ?>
                            <option <?= $selected ?> value="<?=$gr?>"><?=$gr?></option>
                        <?php } ?>
					</select>
                </div>
                <div class="form-group">
					<div class="input-group">
						<input readonly id="date-filter" type="text" class="form-control pointer"
							style="color: #000;background:#fff;"
							value="<?= $date ?>"
							data-date="01-01-1999" data-date-format="dd-mm-yyyy" data-date-viewmode="months" />
						<span class="input-group-addon pointer" onclick="changeDate()">Ganti Tanggal</span>
					</div>
				</div>
			</div>
        </div>

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

<script>
    	const BASE_URL = "<?= base_url() ?>";
        $("#date-filter").datepicker();

        function changeGroup(group) {
            const date = "<?=$date?>";
            const url = `${BASE_URL}admin/productions/ncr/${date}/${group}`;
            setContentLoader(".content");
            loadContent(url, ".content");
        }

        function changeDate() {
            const date = $("#date-filter").val();
            const group = $("#group").val();
            const url = `${BASE_URL}admin/productions/ncr/${date}/${group}`;
            setContentLoader(".content");
            loadContent(url, ".content");
        }
</script>