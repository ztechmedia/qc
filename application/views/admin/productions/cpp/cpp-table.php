<div class="row">
    <div class="col-md-12">
        <ul class="pagination pagination-sm pull-left">
            <?php if(array_key_exists("prev", $pagination)) {?>
                <li onclick="changePage('<?=$pagination['prev']['page']?>')"
                    data-secondary="yes"><a>«</a></li>
            <?php } else{ ?>
                <li class="disabled"><a>«</a></li>
            <?php } ?>
            
            <li><a><?= "Halaman $page - $totalPage | Data $start - $end"?></a></li>      

            <?php if(array_key_exists("next", $pagination)) {  ?>
                <li onclick="changePage('<?=$pagination['next']['page']?>')"
                    data-secondary="yes"><a>»</a></li>
            <?php } else{ ?>
                <li class="disabled"><a>»</a></li>
            <?php } ?>
        </ul>  
    </div>

    <div class="col-md-12" style="margin-top: 10px">
        <table class="table table-bordered tcustom">
            <thead class="thead">
                <tr>
                    <th width="12%">Tipe</th>
                    <th width="8%">SPK</th>
                    <th width="8%">Tanggal</th>
                    <th width="4%">Shift</th>
                    <th width="10%">No Lot</th>
                    <th width="6%">Kg</th>
                    <!-- <th width="4%">Haze</th>
                    <th width="5%">Dyne</th> -->
                    <th>Keterangan</th>
                    <th width="10%">Operator/GL</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>

            <tbody class="tbody">

                <?php
                    $no = 1;
                    $currShit = null;
                    $currDate = null;
                    $shiftSeparator = false;
                    foreach ($products as $prod) {
                        if ($currShit == null) {
                            $currShit = $prod->shift;
                        } else if ($currShit != $prod->shift) {
                            $shiftSeparator = true;
                            $currShit = $prod->shift;
                        }

                        if ($currDate == null) {
                            $currDate = $prod->tgl_input;
                        } else if ($currDate != $prod->tgl_input) {
                            $shiftSeparator = true;
                            $currDate = $prod->tgl_input;
                        }

                        $color = null;
                        if ($prod->status == 'HOLD') {
                            $color = "hold";
                        }  else if ($prod->status == 'OK') {
                            $color =  "ok";
                        }

                        $shift = !$prod->regu ? $prod->shift : "$prod->shift-$prod->regu";
                        $desc = "desc-$prod->id";
                        $haze = "haze-$prod->id";
                        $corona = "corona-$prod->id";
                ?>

                    <?php if ($shiftSeparator == true) { ?>
                        <tr>
                            <td colspan="8" class="shift-separator">
                                <?= "Shift " . $shift. " · Tanggal: " . revDate($prod->tgl_input) ?></td>
                        </tr>
                    <?php } ?>

                    <tr id="<?= $prod->id ?>" class="<?= $color ?>">
                        <td width="12%"><?= "$prod->type-$prod->tebal x $prod->lebar x $prod->panjang" ?></td>
                        <td width="8%"><?= $prod->no_spk ?></td>
                        <td width="8%"><?= revDate($prod->tgl_input) ?></td>
                        <td width="4%"><?= $shift ?></td>
                        <td width="10%"><?= $prod->kode_roll ?></td>
                        <td width="6%"><?= $prod->kg_hasil_cpp ?></td>

                        <!-- <td width="4%">
                            <a id="<?= $haze ?>" onclick="setHaze('<?= $haze ?>', '<?= $prod->qc_haze ?>', '<?= $prod->id ?>')">
                                <?= $prod->qc_haze ? $prod->qc_haze : "-" ?>
                            </a>
                        </td>

                        <td width="5%">
                            <a id="<?= $corona ?>"
                                onclick="setCorona('<?= $corona ?>', '<?= $prod->qc_corona ?>', '<?= $prod->id ?>')">
                                <?= $prod->qc_corona ? $prod->qc_corona : "-" ?>
                            </a>
                        </td> -->

                        <td>
                            <a id="<?= $desc ?>" onclick="setDesc('<?= $desc ?>', '<?= $prod->keterangan_cpp ?>', '<?= $prod->id ?>')">
                                <?= $prod->keterangan_cpp ? strtoupper($prod->keterangan_cpp) : "-" ?>
                            </a>
                        </td>

                        <td width="10%"><?= strtoupper($prod->user) ?></td>

                        <td width="10%">
                                <a id="status-<?= $prod->id ?>" onclick="changeStatus('<?= $prod->id ?>')"><?= $prod->status ?></a> | 
                                <a class="link-to" data-to="<?=base_url("admin/productions/cpp/$prod->tgl_input/$prod->id/edit")?>">Revisi</a>
                        </td>
                    </tr>
                <?php
                    if ($shiftSeparator == true) {
                        $shiftSeparator = false;
                    }
                } ?>
            </tbody>
        </table>
    </div>
</div>