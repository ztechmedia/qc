<div class="row">
    <div class="col-md-3">
        <div class="panel-group accordion">
            <div class="panel panel-primary">
                <div class="panel-heading ui-draggable-handle">
                    <h4 class="panel-title">
                        <a href="#accOneColOne">
                            HASIL ROLL OK <?=mToMonth($month). " ".$year?>
                        </a>
                    </h4>
                </div>                                
                <div class="panel-body panel-body-open list-group" id="accOneColOne" style="height:365px; overflow: auto; overflow-y: scroll">
                    <?php foreach($polos as $pl) { ?>
                        <a class="list-group-item"><span class="fa fa-circle"></span> <?=$pl->slitt_roll?> 
                            <span class="badge badge-info"><?=$pl->total_roll?> Roll</span>
                        </a>
                    <?php } ?>
                    <?php foreach($met as $mt) { ?>
                        <a class="list-group-item"><span class="fa fa-circle"></span> <?=$mt->slitt_roll?> 
                            <span class="badge badge-info" style="background-color: orange"><?=$mt->total_roll?> Roll</span>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <table class="table table-bordered tcustom">
            <thead class="thead">
                <tr>
                    <th width="9%">Tipe</th>
                    <th width="10%">Cst</th>
                    <th width="10%">Tgl</th>
                    <th width="5%">Lbr</th>
                    <th width="6.5%">Pjg</th>
                    <th width="6%">Kg</th>
                    <th width="5%">Shift</th>
                    <th width="17%">No Lot</th>
                    <!-- <th width="10%">COF</th>
                    <th width="5%">Dyne</th>
                    <th width="12%">Defect · OD</th> -->
                    <th>Keterangan</th>
                    <th width="7%">Status</th>
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
                            $currDate = $prod->tgl;
                        } else if ($currDate != $prod->tgl) {
                            $shiftSeparator = true;
                            $currDate = $prod->tgl;
                        }

                        $color = null;
                        if ($prod->status == 'HOLD') {
                            $color = "hold";
                        } else if ($prod->status == 'NOT') {
                            $color = "not";
                        } else if ($prod->status == 'NCR') {
                            $color =  "ncr";
                        } else if ($prod->status == 'OK') {
                            $color =  "ok";
                        }
                        $desc = "desc-$prod->id_slitt";
                        // $cofStatik = "cof-statik-$prod->id_slitt";
                        // $cofKinetik = "cof-kinetik-$prod->id_slitt";
                        // $corona = "corona-$prod->id_slitt";

                        // $defects = $prod->qc_defects ? unserialize($prod->qc_defects) : null;
                        // $defect = "2X: <br> 3X: ";
                        // if ($defects) {
                        //     $xx = "";
                        //     $xxx = "";
                        //     foreach ($defects as $alias => $value) {
                        //         if ($value == "XX" || $value >= 4) {
                        //             if ($xx == "") {
                        //                 $xx = $alias;
                        //             } else {
                        //                 $xx = $xx . "·" . $alias;
                        //             }
                        //         } else if ($value == "XXX" || $value >= 6) {
                        //             if ($xxx == "") {
                        //                 $xxx = $alias;
                        //             } else {
                        //                 $xxx = $xxx . "·" . $alias;
                        //             }
                        //         }
                        //     }
                        //     $xx = $xx != "" ? "[ $xx ]" : $xx;
                        //     $xxx = $xxx != "" ? "[ $xxx ]" : $xxx;
                        //     $defect = "2X: " . $xx . "<br> 3X: " . $xxx;
                        // }

                        // $ods = $prod->qc_od ? unserialize($prod->qc_od) : null;
                        // $od = "OD: ";
                        // if($ods) {
                        //     $min = min($ods);
                        //     $max = max($ods);
                        //     $ods = array_filter($ods);
                        //     $odSum = array_sum($ods);
                        //     $avg = $odSum > 0 ? substr($odSum/count($ods), 0, 4) : 0;
                        //     $maxV = $max ? $max : 0;
                        //     $minV = $min ? $min : 0;
                        //     $od = "OD: $minV"."·".$maxV."·".$avg;
                        // }
                        $shift = !$prod->regu ? $prod->shift : "$prod->shift-$prod->regu";
                ?>

                <?php if ($shiftSeparator == true) { ?>
                    <tr>
                        <td colspan="8" class="shift-separator">
                            <?= "Shift ".$shift." · Tanggal: " . revDate($prod->tgl) ?></td>
                    </tr>
                <?php } ?>

                <tr id="<?= $prod->id_slitt ?>" class="<?= $color ?>">
                    <td width="9%"><?= $prod->type_slitt . "-" . $prod->mic_slitt?></td>
                    <td width="10%"><?= $prod->customer_lap_slitt == "" ? "Base Film" : checkAlias($customerAlias, $prod->customer_lap_slitt) ?></td>
                    <td width="10%"><?= revDate($prod->tgl) ?></td>
                    <td width="5%"><?= $prod->lebar_slitt ?></td>
                    <td width="6.5%"><?= $prod->panjang_slitt ?></td>
                    <td width="6%"><?= $prod->kg_hasil_slitt ?></td>
                    <td width="5%"><?= $prod->shift ?></td>
                    <td width="17%"><?= $prod->kode_roll_slitt ?><p style="font-size: 12px; color: #9c2020;"><?= $prod->nama_mesin ?> - <?= strtoupper($prod->user) ?></p></td>

                    <!-- <td width="5%">
                        <a id="<?= $cofStatik ?>"
                            onclick="setCof('<?= $cofStatik ?>', '<?= $prod->qc_cof_statik ?>', '<?= $prod->id_slitt ?>')">
                            <?= $prod->qc_cof_statik ?>
                        </a>
                    </td>

                    <td width="5%">
                        <a id="<?= $cofKinetik ?>"
                            onclick="setCof('<?= $cofKinetik ?>', '<?= $prod->qc_cof_kinetik ?>', '<?= $prod->id_slitt ?>')">
                            <?= $prod->qc_cof_kinetik ?>
                        </a>
                    </td>

                    <td width="5%">
                        <a id="<?= $corona ?>"
                            onclick="setCorona('<?= $corona ?>', '<?= $prod->qc_corona ?>', '<?= $prod->id_slitt ?>')">
                            <?php
                                if ($prod->qc_corona) {
                                    echo $prod->qc_corona;
                                } else {
                                    if ($prod->jenis_roll_slitt == "METALIZZED" && $prod->stock != "Base Film") {
                                        echo "52";
                                    } else {
                                        echo "42";
                                    }
                                }
                                ?>
                        </a>
                    </td>

                    <td width="12%">
                        <div class="pointer" id="defect-<?= $prod->id_slitt ?>"
                            onclick="changeDefect('<?= $prod->id_slitt ?>')">
                            <?= $defect ?>
                        </div>
                        <div class="pointer" id="od-<?= $prod->id_slitt ?>" onclick="changeOd('<?= $prod->id_slitt ?>')">
                            <?=$od?></div>
                    </td> -->

                    <td>
                        <a id="<?= $desc ?>" onclick="setDesc('<?= $desc ?>', '<?= $prod->ket ?>', '<?= $prod->id_slitt ?>')">
                            <?= $prod->ket ? $prod->ket : "-" ?>
                        </a>
                    </td>

                    <td width="7%">
                        <a id="status-<?= $prod->id_slitt ?>"
                            onclick="changeStatus('<?= $prod->id_slitt ?>')"><?= $prod->status ?></a>
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