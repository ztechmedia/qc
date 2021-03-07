<ul class="breadcrumb">
	<li class="active">Pengiriman</li>
</ul>

<div class="page-title">
	<h2><span class="fa fa-truck"></span> Pengiriman</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">
			<div style="display:flex; flex-direction:row; justify-content:flex-end; margin-bottom:10px;">
				<div class="input-group">
					<span class="input-group-addon">Tahun</span>
					<select id="year-date" class="form-control pointer" onchange="changeDate()">
						<?php for ($i=2018; $i <= 2099 ; $i++) {  $selected = $year == $i ? "selected" : null; ?>
							<option <?= $selected ?> value="<?=$i?>"><?=$i?></option>
						<?php } ?>
					</select>
				</div>

				<div class="input-group" style="margin-left: 20px;">
					<span class="input-group-addon">Bulan</span>
					<select id="month-date" class="form-control pointer" onchange="changeDate()">
						<?php for ($i=1; $i <= 12 ; $i++) {  $selected = $month == $i ? "selected" : null; ?>
							<option <?= $selected ?> value="<?=$i?>"><?= mToMonth($i) ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div id="month"></div>
		</div>
    </div>

    <div class="row" style="margin-top: 10px">
        <div class="col-md-4">
            <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-truck"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?=$total_month_polos?> Kg</div>
                    <div class="widget-title">POLOSAN <?=mToMonth($month)?></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-truck"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?=$total_month_metal?> Kg</div>
                    <div class="widget-title">METALIZED <?=mToMonth($month)?></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-truck"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?=$total_month?> Kg</div>
                    <div class="widget-title">Total Pengiriman <?=mToMonth($month)?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	const BASE_URL = "<?= base_url() ?>";

	function changeDate() {
		let year = $("#year-date").val();
		let month = $("#month-date").val();
		const url = `${BASE_URL}admin/delivery/${year}/${month}`;
		setContentLoader(".content");
		loadContent(url, ".content");
	}

	Highcharts.chart('month', {
		chart: {
			type: 'line'
		},
		title: {
			text: 'Pengiriman Tahun <?=$year?>'
		},
		subtitle: {
			text: 'PT. Wira Mustika Abadi'
		},
		xAxis: {
			categories: <?=json_encode($months)?>
		},
		yAxis: {
			title: {
				text: 'Total Berat (Kg)'
			}
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: false
			}
		},
		series: [{
			name: 'Total Berat Pengiriman',
			color: "orange",
			data:<?=json_encode($total_kirim)?>
		}]
	});

</script></div>