<table class="table table-bordered tcustom">
    <thead class="thead">
        <tr>
            <th width="10%">Tipe Input</th>
            <th width="12%">No Lot Input</th>
            <th width="4%">Shift</th>
            <th width="8%">Tanggal</th>
            <th width="12%">Chamber</th>
            <th width="8%">No Lot Met</th>
            <th width="10%">Tipe Output</th>
            <th width="5%">Kg</th>
            <th width="4%">Dyne</th>
            <th width="11%">Properties</th>
            <th>Keterangan</th>
            <th width="6%">Status</th>
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
                if ($prod->status_met == 'HOLD') {
                    $color = "hold";
                }  else if ($prod->status_met == 'OK') {
                    $color =  "ok";
                }

                $defects = $prod->qc_defects ? unserialize($prod->qc_defects) : null;
                $defect = "2X: <br> 3X: ";
                if ($defects) {
                    $xx = "";
                    $xxx = "";
                    foreach ($defects as $alias => $value) {
                        if ($value == "XX" || $value >= 4) {
                            if ($xx == "") {
                                $xx = $alias;
                            } else {
                                $xx = $xx . "·" . $alias;
                            }
                        } else if ($value == "XXX" || $value >= 6) {
                            if ($xxx == "") {
                                $xxx = $alias;
                            } else {
                                $xxx = $xxx . "·" . $alias;
                            }
                        }
                    }
                    $xx = $xx != "" ? "[ $xx ]" : $xx;
                    $xxx = $xxx != "" ? "[ $xxx ]" : $xxx;
                    $defect = "2X: " . $xx . "<br> 3X: " . $xxx;
                }

                $ods = $prod->qc_od ? unserialize($prod->qc_od) : null;
                $od = "OD: ";
                if($ods) {
                    $min = min($ods);
                    $max = max($ods);
                    $ods = array_filter($ods);
                    $odSum = array_sum($ods);
                    $avg = $odSum > 0 ? substr($odSum/count($ods), 0, 4) : 0;
                    $maxV = $max ? $max : 0;
                    $minV = $min ? $min : 0;
                    $od = "OD: $minV"."·".$maxV."·".$avg;
                }
                $eaas = $prod->qc_eaa ? unserialize($prod->qc_eaa) : null;
                $eaa = "EAA: ";
                if($eaas) {
                    $eaa = "EAA: $eaas[0]"."·".$eaas[1]."·".$eaas[2];
                }
                $shift = !$prod->regu ? $prod->shift : "$prod->shift - $prod->regu";
                $corona = "corona-$prod->id_met";
                $desc = "desc-$prod->id_met";
        ?>

            <?php if ($shiftSeparator == true) { ?>
                <tr>
                    <td colspan="8" class="shift-separator">
                        <?= "Shift " . $shift. " · Tanggal: " . revDate($prod->tgl_input) ?></td>
                </tr>
            <?php } ?>

            <tr id="<?= $prod->id_met ?>" class="<?= $color ?>">
                <td width="10%"><?= "$prod->type_input_met-$prod->tebal_inp_met x $prod->lebar_inp_met x $prod->panjang_inp_met" ?></td>
                <td width="12%"><?= $prod->inputan_bf ?></td>
		        <td width="4%"><?= $shift ?></td>
		        <td width="8%"><?= revDate($prod->tgl_input) ?></td>
                <td width="6%"><?= $prod->closed ?></td>
                <td width="6%"><?= $prod->opened ?></td>
                <td width="8%"><?= $prod->output_kode_roll ?></td>
                <td width="10%"><?= "$prod->output_type_met-$prod->mic_met x $prod->lebar_met x $prod->panjang_met" ?></td>
                <td width="5%"><?= $prod->kg_hasil_met ?></td>
                <td width="4%">
                    <a id="<?= $corona ?>" onclick="setCorona('<?= $corona ?>', '<?= $prod->qc_corona ?>', '<?= $prod->id_met ?>')">
                        <?= $prod->qc_corona ? $prod->qc_corona : 52 ?>
                    </a>
                </td>

                <td width="11%">
                    <div class="pointer" id="defect-<?= $prod->id_met ?>" onclick="changeDefect('<?= $prod->id_met ?>')">
                        <?= $defect ?>
                    </div>
                    <div class="pointer" id="od-<?= $prod->id_met ?>" onclick="changeOd('<?= $prod->id_met ?>')"><?=$od?></div>
                    <div class="pointer" id="eaa-<?= $prod->id_met ?>" onclick="changeEaa('<?= $prod->id_met ?>')"><?=$eaa?></div>
                </td>

                <td>
                    <a id="<?= $desc ?>" onclick="setDesc('<?= $desc ?>', '<?= $prod->ket_met ?>', '<?= $prod->id_met ?>')">
                        <?= $prod->ket_met ? $prod->ket_met : "-" ?>
                    </a>
                </td>

                <td width="5%">
                    <a id="status-<?= $prod->id_met ?>" onclick="changeStatus('<?= $prod->id_met ?>')"><?= $prod->status_met ?></a>
                </td>
            </tr>
        <?php
            if ($shiftSeparator == true) {
                $shiftSeparator = false;
            }
        } ?>
    </tbody>
</table>