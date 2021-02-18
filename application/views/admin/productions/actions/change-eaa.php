<p style="font-weight:bold;">Aksi:</p>
<div style="margin-bottom: 10px;">
    <p>OD Form: <?=$product?></p>
	<form class="change-eaa-action" 
		data-url="<?=$url?>">
        <div class="eaa-form">
            <?php $index = 0; $position = ["Right:", "Center:", "Left:"]; foreach ($eaa as $value) { ?>
                <div class="eaa-control">
                    <?=$position[$index++]?><input name="eaa[]" class="form-control eaas" type="text" maxLength="4" value="<?=$value?>">
                </div>
            <?php } ?>
        </div>
        <div class="pull-right">
                <button class="btn btn-primary">Update EAA</button>
        </div>
	</form>
</div>

<script>
    $("input.eaas").mask("999");
    var $input = $('.eaas');
    $input.bind('keydown', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            var nxtIdex = $input.index(this) + 1;
            $(".eaas:eq(" + nxtIdex + ")").focus();
        }
    });
</script>

<style>
    .eaa-form {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        margin-bottom: 10px;
    }

    .eaa-control {
        width: 10%;
        margin: auto 5px;
    }
</style>