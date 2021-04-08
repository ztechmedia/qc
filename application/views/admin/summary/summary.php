<ul class="breadcrumb">
    <li class="active">Laporan Produksi</li>
</ul>

<div class="page-title">
    <h2><span class="fa fa-bar-chart-o"></span> Slitting</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-4">
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel-heading ui-draggable-handle">
						<h4 class="panel-title">
							<a>
								Week List
							</a>
						</h4>
					</div>                                
					<div class="panel-body panel-body-open list-group" style="height:400px; overflow: auto; overflow-y: scroll">
						<?php foreach($weeks as $week) { ?>
							<a onclick="selectedWeek('#week-<?=$week['week']?>', 'Week #<?= $week['week']?>', '<?= $week['first_day'] ?>', '<?= $week['last_day'] ?>')" id="week-<?=$week['week']?>" class="list-group-item"><span class="fa fa-circle"> Week #<?= $week['week'] ?></span>
								<span class="badge badge-default"><?= revDate($week['last_day']) ?></span>
								<span class="badge badge-default" style="background: #9c2020">s/d</span>
								<span class="badge badge-default"><?= revDate($week['first_day']) ?></span>
							</a>
						<?php } ?>
					</div>                                
				</div>
			</div>
        </div>

        <div class="col-md-8">
         <p>Silakan klik pada week yang diinginkan!</p>
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel-heading ui-draggable-handle">
						<h4 class="panel-title">
							<a class="selected-week-text">
								Performance Slitting
							</a>
						</h4>
					</div>                                
					<div class="panel-body">
						<div id="week-chart"></div>
					</div>                                
				</div>
			</div>
        </div>
    </div>
</div>

<script>
    const BASE_URL = "<?= base_url() ?>";
    
    function selectedWeek(id, week, first, last) {
        $(".selected-week").removeClass("selected-week");
        $(id).addClass("selected-week");
        $(".selected-week-text").html(`Performance Slitting ${week}`);

        setContentLoader("#week-chart");
        loadContent(`${BASE_URL}admin/summary/chart/${first}/${last}`, "#week-chart");
    }
</script>

<style>
    .selected-week {
        background: #ddd;
    }
    .status-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: left;
    }

    .status {
        width: 100%;
        text-align: left;
        margin-left: 10px;
        margin-right: 10px;
    }

    .ok {
        color: black;
    }

    .hold {
        color: orange;
    }

    .not {
        color: red;
    }

    .kecil {
        font-size: 10px;
    }

    .bold {
        font-weight: bold;
    }
</style>