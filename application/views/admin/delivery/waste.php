<?php foreach($personWasteInputs as $key => $wst) { ?>
    <a class="list-group-item"><span class="fa fa-circle"></span> <?=$wst["user"]?> 
        <span style="background-color: orange" class="badge badge-default"><?=$wst["total_waste"]?> Kg</span>
        <span class="badge badge-info"><?=$wst["total_input"]?> Input</span>
        <span class="badge badge-warning"><?=$wst["masuk_kerja"]?> Hari Kerja</span>
    </a>
<?php } ?>