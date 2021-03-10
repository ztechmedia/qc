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
            <div class="widget widget-default widget-item-icon" style="border: 1px solid skyblue">
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
            <div class="widget widget-default widget-item-icon" style="border: 1px solid limegreen">
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
            <div class="widget widget-default widget-item-icon" style="border: 1px solid orange">
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

	<div class="row">
		<div class="col-md-6">
			<div class="panel-group accordion">
				<div class="panel panel-primary">
					<div class="panel-heading ui-draggable-handle">
						<h4 class="panel-title">
							<a href="#accOneColOne">
								Produk Pengiriman <?=mToMonth($month)?> (POLOS)
							</a>
						</h4>
					</div>                                
					<div class="panel-body panel-body-open list-group" id="accOneColOne" style="height:300px; overflow: auto; overflow-y: scroll">
						<?php foreach($list_polos as $polos) { ?>
							<a class="list-group-item"><span class="fa fa-circle"></span><?=$polos->slitt_roll_palet?>
								<span class="badge badge-default"><?=toRp($polos->total_kirim)?> Kg</span>
								<span style="background-color: #87ceeb" class="badge badge-default"><?=$polos->total_roll?> Roll</span>
							</a>
						<?php } ?>
					</div>                                
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel-group accordion">
				<div class="panel panel-primary">
					<div class="panel-heading ui-draggable-handle">
						<h4 class="panel-title">
							<a href="#accOneColOne">
								Produk Pengiriman <?=mToMonth($month)?> (METALIZED)
							</a>
						</h4>
					</div>                                
					<div class="panel-body panel-body-open list-group" id="accOneColOne" style="height:300px; overflow: auto; overflow-y: scroll">
						<?php foreach($list_metal as $metal) { ?>
							<a class="list-group-item"><span class="fa fa-circle"></span> <?=$metal->slitt_roll_palet?> 
								<span class="badge badge-default"><?=toRp($metal->total_kirim)?> Kg</span>
								<span style="background-color: #32cd32" class="badge badge-default"><?=$metal->total_roll?> Roll</span>
							</a>
						<?php } ?>
					</div>                                     
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div id="cust-year"></div>
		</div>
    </div>
	
	<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
		<div class="col-md-8">
			<div id="waste"></div>
		</div>
		
		<div class="col-md-4">
			<div class="panel-group accordion">
				<div class="panel panel-primary">
					<div class="panel-heading ui-draggable-handle">
						<h4 class="panel-title">
							<a href="#accOneColOne">
								Waste <?=mToMonth($month)." ".$year?>: <b><?=$total_waste?> Kg (<?=$waste_percen?> %)</b>
							</a>
						</h4>
					</div>                                
					<div class="panel-body panel-body-open list-group" id="accOneColOne" style="height:300px; overflow: auto; overflow-y: scroll">
						<div class="person-waste"></div>
					</div>                                     
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

	function loadWaste() {
		let year = $("#year-date").val();
		let month = $("#month-date").val();
		const url = `${BASE_URL}admin/waste/${year}/${month}`;
		setContentLoader(".person-waste");
		loadContent(url, ".person-waste");
	}

	loadWaste();

	Highcharts.chart('waste', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Waste <?= mToMonth($month).' '.$year ?>'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %',
					connectorColor: 'silver'
				}
			}
		},
		series: [{
			name: 'Total Waste',
			data: <?=json_encode($waste)?>
		}]
	});

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
			name: 'Total Berat Pengiriman TOTAL',
			color: "orange",
			data:<?=json_encode($total_kirim)?>
		}, {
			name: 'Total Berat Pengiriman POLOSAN',
			color: "skyblue",
			data:<?=json_encode($total_kirim_polos)?>
		}, {
			name: 'Total Berat Pengiriman METALIZED',
			color: "limegreen",
			data:<?=json_encode($total_kirim_metal)?>
		}]
	});

	Highcharts.chart('cust-year', {
		chart: {
			type: 'line'
		},
		title: {
			text: 'Pengiriman By Customer Tahun <?=$year?>'
		},
		subtitle: {
			text: 'PT. Wira Mustika Abadi'
		},
		xAxis: {
			categories: <?=json_encode($custYearName)?>
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
			name: 'Total Berat Pengiriman By Customer Tahun <?=$year?>',
			color: "orange",
			data:<?=json_encode($custYearKirim)?>
		},{
			name: 'Total Berat Pengiriman By Customer Bulan <?=mToMonth($month)?> Tahun <?=$year?>',
			color: "skyblue",
			data:<?=json_encode($custMonthKirim)?>
		}]
	});

</script></div>