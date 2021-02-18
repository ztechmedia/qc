<p style="font-weight:bold;">Aksi:</p>
<div style="margin-bottom: 10px;">
    <p>OD Form: <?=$product?></p>
	<form class="change-od-action" 
		data-url="<?=$url?>">
        <div class="od-form">
            <?php $no = 0; foreach ($od as $value) { ?>
                <div class="od-control">
                    <input name="od[]" class="form-control ods" type="text" maxLength="4" value="<?=$value?>">
                </div>
            <?php $no++; if($no % 10 == 0) echo "<br>"; } ?>
        </div>
        <div class="pull-right">
                <button class="btn btn-primary">Update OD</button>
        </div>
	</form>
</div>

<script>
    $("input.ods").mask("9.99");
    var $input = $('.ods');
    $input.bind('keydown', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            var nxtIdex = $input.index(this) + 1;
            $(".ods:eq(" + nxtIdex + ")").focus();
        }
    });
</script>

<style>
    .od-form {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .od-control {
        width: 10%;
        margin: auto 5px;
    }
</style>