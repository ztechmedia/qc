<p style="font-weight:bold;">Aksi:</p>
<div style="margin-bottom: 10px;">
	<form class="change-defect-action" 
		data-url="<?=$url?>">
		<?php $no = 0; foreach ($defects as $alias => $value) { ?>
		<div class="col-md-3">
			<span>
				<i onclick="defDecrease('<?=$alias?>')" class="fa fa-minus-square pointer"></i>
				<a id="defect-value-<?=$alias?>" style="color:#9c2020"><?=$value['value']?></a>
				<i onclick="defIncrease('<?=$alias?>')" class="fa fa-plus-square pointer"></i>
				: <a style="font-size:10px;color: #656d78;"><?=$value['defect']?> (<?=$alias?>)</a>
				<input style="display:none" name="defects[]" id="defect-input-<?=$alias?>" type="text" value="<?=$alias.":".$value['value']?>">
			</span>
		</div>
		<?php $no++; if($no % 6 == 0) echo "<br>"; } ?>
		<div class="col-md-12">
			<div class="pull-right">
				<button class="btn btn-primary update-deffect">Update Defect</button>
			</div>
		</div>
	</form>
</div>

<script>
	function defDecrease(alias) {
		console.log(alias);
		let input = $(`#defect-input-${alias}`);
		let value = input.val().split(":");
		let newValue = "";

		if (alias != "J") {
			if (value[1] == "XXX") {
				newValue = "XX";
			} else if (value[1] == "XX") {
				newValue = "X";
			}
		} else {
			newValue = parseInt(value[1]);
			if (newValue >= 1) {
				newValue = parseInt(value[1]) - 1;
			}
		}

		$(`#defect-value-${alias}`).html(newValue);
		input.val(`${alias}:${newValue}`);
	}

	function defIncrease(alias) {
		console.log(alias);
		let input = $(`#defect-input-${alias}`);
		let value = input.val().split(":");
		let newValue = "X";

		if (alias != "J") {
			if (value[1] == "X") {
				newValue = "XX";
			} else if (value[1] == "XX") {
				newValue = "XXX";
			} 
		} else {
			newValue = parseInt(value[1]) + 1;
		}

		$(`#defect-value-${alias}`).html(newValue);
		input.val(`${alias}:${newValue}`);
	}
</script>

