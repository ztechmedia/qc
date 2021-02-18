<div class="row">
	<div class="col-md-12">
		<div class="total-roll">
			<p class="date">Hari ini: <?= $now ?></p>
			<p class="roll-total">· <?= $totalRollFG ?> Total Roll FG (<?= toRp($totalWeight) ?> Kg) ·</p>
			<a class="btn btn-default link-to-unsave"
				data-to="<?= base_url("admin/productions/slitting/tab/$tabName/$year/$month/$day/false") ?>"
				data-target="<?= ".slitting-body" ?>"><i class="fa fa-refresh"></i></a>
		</div>
		<div class="status-roll-date">
			<span class="bold">Status Roll:
				<i class="fa fa-square ok"></i> OK |
				<i class="fa fa-square ncr"></i> NCR |
				<i class="fa fa-square hold"></i> HOLD |
				<i class="fa fa-square not"></i> NOT
			</span>
			<form class="form-horizontal">
				<div class="form-group">
					<div class="input-group">
						<input readonly id="date-filter" type="text" class="form-control pointer"
							style="color: #000;background:#fff;"
							value="<?= date("d-m-Y", strtotime($day . "-" . $month . "-" . $year)) ?>"
							data-date="01-01-1999" data-date-format="dd-mm-yyyy" data-date-viewmode="months" />
						<span class="input-group-addon pointer" onclick="changeDate()">Ganti Tanggal</span>
					</div>
				</div>
			</form>
		</div>
		<hr>
	</div>
	<div class="col-md-6 bold">
		<span><i class="fa fa-calendar"></i> <?= $thisMonth ?>, Total: <?= $totalRollFG ?> Roll FG</span>
		<div class="progress">
			<div onclick="loadData(['OK', 'NCR'])" class="progress-bar progress-bar-success pointer"
				style="width: <?= $ok["percen"] ?>%;background:#000;color:#fff">
				<?= $ok["data"] > 0 ? $ok['data'] : ""?>
			</div>
			<div onclick="loadData(['HOLD'])" class="progress-bar progress-bar-warning progress-bar-striped pointer"
				style="width: <?= $hold["percen"] ?>%;background:orange;color:#000">
				<?= $hold["data"] > 0 ? $hold['data'] : ""?>
			</div>
			<div onclick="loadData(['NOT'])" class="progress-bar progress-bar-danger pointer"
				style="width: <?= $not["percen"] ?>%;background:red;color:#fff">
				<?= $not['data'] > 0 ? $not['data'] : ""?>
			</div>
		</div>
	</div>
	<div class="col-md-6 bold">
		<span><i class="fa fa-calendar"></i> <?= $toDay ?>, Total: <?= $totalRollDay ?> Roll FG</span>
		<div class="progress">
			<div onclick="loadDataDay(['OK', 'NCR'])" class="progress-bar progress-bar-success pointer"
				style="width: <?= $okDay["percen"] ?>%;background:#000;color:#fff">
				<?= $okDay["data"] > 0 ? $okDay['data'] : "" ?>
			</div>
			<div onclick="loadDataDay(['HOLD'])" class="progress-bar progress-bar-warning progress-bar-striped pointer"
				style="width: <?= $holdDay["percen"] ?>%;background:orange;color:#000">
				<?= $holdDay["data"] > 0 ? $holdDay['data'] : "" ?>
			</div>
			<div onclick="loadDataDay(['NOT'])" class="progress-bar progress-bar-danger pointer"
				style="width: <?= $notDay["percen"] ?>%;background:red;color:#fff">
				<?= $notDay['data'] > 0 ? $notDay['data'] : "" ?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="actions"></div>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-md-12">
		<div class="filter">
			<div class="col-md-1">
				<div class="input-group">
					<input onchange="loadTable()" type="text" class="form-control" placeholder="Type" id="type">
				</div>
			</div>
			<div class="col-md-2">
				<div class="input-group">
					<input onchange="loadTable()" type="text" class="form-control" placeholder="Tebal" id="thick">
					<span class="input-group-addon">mic</span>
				</div>
			</div>
			<div class="col-md-2">
				<div class="input-group">
					<input onchange="loadTable()" type="text" class="form-control" placeholder="Lebar" id="width">
					<span class="input-group-addon">mm</span>
				</div>
			</div>
			<div class="col-md-2">
				<div class="input-group">
					<input onchange="loadTable()" type="text" class="form-control" placeholder="Panjang" id="length">
					<span class="input-group-addon">m</span>
				</div>
			</div>
			<div class="col-md-2">
				<div class="input-group">
					<input onchange="loadTable()" type="text" class="form-control" placeholder="No lot" id="no-lot">
					<span class="input-group-addon"><span class="fa fa-search"></span></span>
				</div>
			</div>
			<div class="col-md-2">
				<div class="input-group">
					<input placeholder="Tanggal" readonly id="date-filter-1" type="text" class="form-control pointer"
						style="color: #000;background:#fff;" data-date="01-01-1999" data-date-format="dd-mm-yyyy"
						data-date-viewmode="months" onchange="loadTable()" />
					<span class="input-group-addon"><span onclick="resetDate()"
							class="fa fa-refresh pointer"></span></span>
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
					<select onchange="loadTable()" class="form-control" id="limit">
						<option value="250">250</option>
						<option value="500">500</option>
						<option value="1000">1000</option>
					</select>
				</div>
			</div>
		</div>

		<div class="slitting-table"></div>
	</div>
</div>

<script>
	$("#date-filter").datepicker();
	$("#date-filter-1").datepicker();

	const BASE_URL = "<?= base_url() ?>";
	const TAB_URL = `${BASE_URL}admin/productions/slitting/tab`;
	const BODY_CLASS = ".slitting-body";
	const CHANGE_STATUS_URL = `${BASE_URL}admin/productions/slitting/change-status`;
	const CHANGE_STATUS_ACTION_URL = `${BASE_URL}admin/productions/slitting/change-status-action`;
	const CHANGE_DEFECT_URL = `${BASE_URL}admin/productions/slitting/change-defect`;
	const CHANGE_OD_URL = `${BASE_URL}admin/productions/slitting/change-od`;
	const CHANGE_COF_URL = `${BASE_URL}admin/productions/slitting/cof`;
	const CHANGE_DESC_URL = `${BASE_URL}admin/productions/slitting/desc`;
	const CHANGE_CORONA_URL = `${BASE_URL}admin/productions/slitting/corona`;
	let tabName = '<?= $tabName ?>';
	let machineName = '<?= $machineName ?>';

	$("[data-toggle=popover]").popover();
	$(".popover-dismiss").popover({
		trigger: 'focus'
	});

	function loadTable() {
		let dt = $("#date-filter-1").val() ?
			$("#date-filter-1").val().split("-") :
			$("#date-filter").val().split("-");
		let tgl = $("#date-filter-1").val() ? `${dt[2]}-${dt[1]}-${dt[0]}` : "";
		let limit = $("#limit").val();
		let noLot = $("#no-lot").val();
		let length = $("#length").val();
		let width = $("#width").val();
		let thick = $("#thick").val();
		let type = $("#type").val();
		let page = 1;
		const url = encodeURI(
			`${BASE_URL}admin/productions/slitting/slitting-table?year=${dt[2]}&month=${dt[1]}&tgl=${tgl}&limit=${limit}&page=${page}&nama_mesin=${machineName}&like:kode_roll_slitt=${noLot}&type_slitt=${type}&mic_slitt=${thick}&lebar_slitt=${width}&panjang_slitt=${length}`
		);
		setContentLoader(".slitting-table");
		loadContent(url, ".slitting-table");
	}

	loadTable();

	function loadData(status) {
		let dt = $("#date-filter").val().split("-");
		let limit = $("#limit").val();
		let page = 1;
		const url = encodeURI(
			`${BASE_URL}admin/productions/slitting/slitting-table?year=${dt[2]}&month=${dt[1]}&limit=${limit}&page=${page}&nama_mesin=${machineName}&where_in:status=${status}&not:stock=Base Film`
		);
		setContentLoader(".slitting-table");
		loadContent(url, ".slitting-table");
	}

	function loadDataDay(status) {
		let tgl = "<?=$currDate?>";
		let limit = $("#limit").val();
		let page = 1;
		const url = encodeURI(
			`${BASE_URL}admin/productions/slitting/slitting-table?tgl=${tgl}&limit=${limit}&page=${page}&nama_mesin=${machineName}&where_in:status=${status}&not:status=Base Film`
		);
		setContentLoader(".slitting-table");
		loadContent(url, ".slitting-table");
	}

	let isActive = false;

	function resetDate() {
		$("#date-filter-1").val("");
		setTimeout(() => {
			loadTable();
		}, 500);
	}

	function changeDate() {
		let dt = $("#date-filter").val().split("-");
		const url = `${TAB_URL}/${tabName}/${dt[2]}/${dt[1]}/${dt[0]}/true`;
		setContentLoader(BODY_CLASS);
		loadContent(url, BODY_CLASS);
	}

	function changeStatus(id) {
		if (!isActive) {
			isActive = true;
			$("tr").removeClass("selected");
			$(`#${id}`).addClass("selected");
			const url = `${CHANGE_STATUS_URL}/${id}`;
			setContentLoader(".actions");
			loadContent(url, ".actions");
		} else {
			alert("Editor sedang aktif!");
		}
	}

	function changeStatusAction(id, status) {
		const data = {
			id: id,
			status: status,
		};
		const url = CHANGE_STATUS_ACTION_URL;
		reqJson(url, "POST", data, (err, response) => {
			if (response) {
				$(`#${response.id}`).removeClass("ok hold not");
				$(`#${response.id}`).addClass(response.newClass);
				$(`#status-${response.id}`).html(response.status);
				$(".actions").html("");
			} else {
				console.log("Error: ", err);
			}
		});
		isActive = false;
	}

	function changeDefect(id) {
		if (!isActive) {
			isActive = true;
			$("tr").removeClass("selected");
			$(`#${id}`).addClass("selected");
			const url = `${CHANGE_DEFECT_URL}/${id}`;
			setContentLoader(".actions");
			loadContent(url, ".actions");
		} else {
			alert("Editor sedang aktif!");
		}
	}

	$(document.body).on("submit", ".change-defect-action", function (e) {
		e.preventDefault();
		const element = $(this);
		let url = element.data("url");
		let data = new FormData(e.target);

		reqFormData(url, "POST", data, (err, response) => {
			if (response) {
				console.log(response.message);
				$(`#defect-${response.id}`).html(response.defect);
				$(".actions").html("");
			} else {
				console.log("Error: ", err);
			}
		});

		isActive = false;
	});

	function changeOd(id) {
		if (!isActive) {
			isActive = true;
			$("tr").removeClass("selected");
			$(`#${id}`).addClass("selected");
			const url = `${CHANGE_OD_URL}/${id}`;
			setContentLoader(".actions");
			loadContent(url, ".actions");
		} else {
			alert("Editor sedang aktif!");
		}
	}

	$(document.body).on("submit", ".change-od-action", function (e) {
		e.preventDefault();
		const element = $(this);
		let url = element.data("url");
		let data = new FormData(e.target);

		reqFormData(url, "POST", data, (err, response) => {
			if (response) {
				console.log(response.message);
				$(`#od-${response.id}`).html(response.od);
				$(".actions").html("");
			} else {
				console.log("Error: ", err);
			}
		});

		isActive = false;
	});

	function setCof(element, value, id) {
		if (!isActive) {
			$(".cof-editor").removeClass();
			$(`#${element}`).replaceWith(
				`<input autofocus data-elid="${element}" data-id="${id}" class="cof-editor" type="number" value="${value}" />`
			);
		} else {
			alert("Editor sedang aktif!");
		}
	}

	$(document.body).on("change", ".cof-editor", function () {
		const element = $(this);
		let value = element.val();
		let id = element.data("id");
		let elementId = element.data("elid");
		let url = CHANGE_COF_URL;
		let data = {
			type: elementId,
			id: id,
			value: value,
		};

		$(".cof-editor").replaceWith(
			`<a id="${elementId}" onclick="setCof('${elementId}', '${value}', '${id}')">${value}</a>`
		);

		reqJson(url, "POST", data, (err, response) => {
			if (response) {
				console.log(response.message);
			} else {
				console.log("Error: ", err);
			}
		});
		isActive = false;
	});

	function setDesc(element, value, id) {
		if (!isActive) {
			$(".desc-editor").removeClass();
			$(`#${element}`).replaceWith(
				`<input autofocus data-elid="${element}" data-id="${id}" class="desc-editor" type="text" value="${value}" />`
			);
		}
	}

	$(document.body).on("change", ".desc-editor", function () {
		const element = $(this);
		let value = element.val().replace(/[\W_ ]+/g, " ");
		let id = element.data("id");
		let elementId = element.data("elid");
		let url = CHANGE_DESC_URL;
		let data = {
			id: id,
			value: value,
		};

		$(".desc-editor").replaceWith(
			`<a id="${elementId}" onclick="setDesc('${elementId}', '${value}', '${id}')">${value}</a>`
		);

		reqJson(url, "POST", data, (err, response) => {
			if (response) {
				console.log(response.message);
			} else {
				console.log("Error: ", err);
			}
		});

		isActive = false;
	});

	function setCorona(element, value, id) {
		if (!isActive) {
			$(".corona-editor").removeClass();
			$(`#${element}`).replaceWith(
				`<input autofocus data-elid="${element}" data-id="${id}" class="corona-editor" type="number" value="${value}" />`
			);
		} else {
			alert("Editor sedang aktif!");
		}
	}

	$(document.body).on("change", ".corona-editor", function () {
		const element = $(this);
		let value = element.val().replace(/[\W_ ]+/g, " ");
		let id = element.data("id");
		let elementId = element.data("elid");
		let url = CHANGE_CORONA_URL;
		let data = {
			id: id,
			value: value,
		};

		$(".corona-editor").replaceWith(
			`<a id="${elementId}" onclick="setCorona('${elementId}', '${value}', '${id}')">${value}</a>`
		);

		reqJson(url, "POST", data, (err, response) => {
			if (response) {
				console.log(response.message);
			} else {
				console.log("Error: ", err);
			}
		});

		isActive = false;
	});
</script>

<style>
	.filter {
		display: flex;
		flex-direction: row;
		justify-content: flex-end;
		align-items: center;
		margin-bottom: 10px;
	}

	.ok>td,
	.ok>td>a,
	span>.ok {
		color: black;
		font-weight: bold;
	}

	.ncr>td,
	.ncr>td>a,
	span>.ncr {
		color: blue;
		font-weight: bold;
	}

	.hold>td,
	.hold>td>a,
	span>.hold {
		color: orange;
		font-weight: bold;
	}

	.not>td,
	.not>td>a,
	span>.not {
		color: red;
		font-weight: bold;
	}

	.shift-separator {
		background: #ccc;
		color: #555;
		text-align: center;
		font-size: 12px;
		font-weight: bold;
	}

	.tbody {
		display: block;
		height: 380px;
		overflow: auto;
		font-size: 11px;
		color: #000;
	}

	.thead,
	.tbody tr {
		display: table;
		width: 100%;
		table-layout: fixed;
	}

	.bold {
		font-weight: bold !important;
		font-size: 14px;
	}

	.total-roll {
		display: flex;
		flex-direction: row;
		font-weight: bold;
		justify-content: space-between;
		align-items: center;
	}

	.date {
		font-size: 14px;
	}

	.roll-total {
		font-size: 28px;
	}

	.btn-default {
		border-radius: 5px;
	}

	hr {
		margin-top: 7px;
		margin-bottom: 7px;
	}

	.selected>td {
		background: #ddd;
	}

	a {
		text-decoration: none !important;
	}

	.cof-editor,
	.corona-editor {
		width: 125%;
		border: none;
		background: transparent
	}

	.desc-editor {
		width: 100%;
		border: none;
		background: transparent
	}

	.status-roll-date {
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
	}

	.actions {
		margin-bottom: 10px;
	}
</style>