<div class="row">
    <?php
        $total_berat_input = $output['polos']['total_berat_input']+$output['met']['total_berat_input']+$output['pm']['total_berat_input'];
        $total_berat_output = $output['polos']['total_berat_output']+$output['met']['total_berat_output']+$output['pm']['total_berat_output'];
    ?>
    <div class="col-md-12">
        <h6>Total Input: <?= toRp($total_berat_input) ?> Kg</h6>
        <h6>Total Output: <?= toRp($total_berat_output) ?> Kg</h6>
        <h6>Selisih: <?= toRp($total_berat_output - $total_berat_input) ?> Kg</h6>
    </div>
    <div class="col-md-12">
        <table class="table table-bordered">
            <tr>
                <th colspan="2" style="background: #9c2020; color: #fff"> POLOSAN </th>
                <th colspan="1" style="background: #9c2020; color: #fff"> SELISIH </th>
            </tr>
            <tr>
                <td>Total Input</td>
                <td class="bold"><?= toRp($output['polos']['total_berat_input']) ?> Kg</td>
                <td rowspan="2" class="bold"><?= toRp($output['polos']['total_berat_output'] - $output['polos']['total_berat_input']) ?> Kg</td>
            </tr>
            <tr>
                <td>Total Output</td>
                <td class="bold"><?= toRp($output['polos']['total_berat_output']) ?> Kg</td>
            </tr>
            <tr>
                <td colspan="2" class="bold" style="background: #9c2020; color: #fff">Detail Output</td>
                <td style="background: #9c2020; color: #fff" class="bold">Berat</td>
            </tr>
            <tr>
                <td>Roll OK</td>
                <td class="bold"><?= $output['polos']['OK']['total_roll'] ?> Roll</td>
                <td class="bold"><?= toRp($output['polos']['OK']['total_berat']) ?> Kg</td>
            </tr>
            <tr>
                <td>Roll HOLD</td>
                <td class="bold"><?= $output['polos']['HOLD']['total_roll'] ?> Roll</td>
                <td class="bold"><?= toRp($output['polos']['HOLD']['total_berat']) ?> Kg</td>
            </tr>
            <tr>
                <td>Roll NOT</td>
                <td class="bold"><?= $output['polos']['NOT']['total_roll'] ?> Roll</td>
                <td class="bold"><?= toRp($output['polos']['NOT']['total_berat']) ?> Kg</td>
            </tr>
        </table>

        <table class="table table-bordered">
            <tr>
                <th colspan="2" style="background: #9c2020; color: #fff"> METALIZED </th>
                <th colspan="1" style="background: #9c2020; color: #fff"> SELISIH </th>
            </tr>
            <tr>
                <td>Total Input</td>
                <td class="bold"><?= toRp($output['met']['total_berat_input']) ?> Kg</td>
                <td rowspan="2" class="bold"><?= toRp($output['met']['total_berat_output'] - $output['met']['total_berat_input']) ?> Kg</td>
            </tr>
            <tr>
                <td>Total Output</td>
                <td class="bold"><?= toRp($output['met']['total_berat_output']) ?> Kg</td>
            </tr>
            <tr>
                <td colspan="2" class="bold" style="background: #9c2020; color: #fff">Detail Output</td>
                <td style="background: #9c2020; color: #fff" class="bold">Berat</td>
            </tr>
            <tr>
                <td>Roll OK</td>
                <td class="bold"><?= $output['met']['OK']['total_roll'] ?> Roll</td>
                <td class="bold"><?= toRp($output['met']['OK']['total_berat']) ?> Kg</td>
            </tr>
            <tr>
                <td>Roll HOLD</td>
                <td class="bold"><?= $output['met']['HOLD']['total_roll'] ?> Roll</td>
                <td class="bold"><?= toRp($output['met']['HOLD']['total_berat']) ?> Kg</td>
            </tr>
            <tr>
                <td>Roll NOT</td>
                <td class="bold"><?= $output['met']['NOT']['total_roll'] ?> Roll</td>
                <td class="bold"><?= toRp($output['met']['NOT']['total_berat']) ?> Kg</td>
            </tr>
        </table>

        <table class="table table-bordered">
            <tr>
                <th colspan="2" style="background: #9c2020; color: #fff"> PM </th>
                <th colspan="1" style="background: #9c2020; color: #fff"> SELISIH </th>
            </tr>
            <tr>
                <td>Total Input</td>
                <td class="bold"><?= toRp($output['pm']['total_berat_input']) ?> Kg</td>
                <td rowspan="2" class="bold"><?= toRp($output['pm']['total_berat_output'] - $output['pm']['total_berat_input']) ?> Kg</td>
            </tr>
            <tr>
                <td>Total Output</td>
                <td class="bold"><?= toRp($output['pm']['total_berat_output']) ?> Kg</td>
            </tr>
            <tr>
                <td colspan="2" class="bold" style="background: #9c2020; color: #fff">Detail Output</td>
                <td style="background: #9c2020; color: #fff" class="bold">Berat</td>
            </tr>
            <tr>
                <td>Roll OK</td>
                <td class="bold"><?= $output['pm']['OK']['total_roll'] ?> Roll</td>
                <td class="bold"><?= toRp($output['pm']['OK']['total_berat']) ?> Kg</td>
            </tr>
            <tr>
                <td>Roll HOLD</td>
                <td class="bold"><?= $output['pm']['HOLD']['total_roll'] ?> Roll</td>
                <td class="bold"><?= toRp($output['pm']['HOLD']['total_berat']) ?> Kg</td>
            </tr>
            <tr>
                <td>Roll NOT</td>
                <td class="bold"><?= $output['pm']['NOT']['total_roll'] ?> Roll</td>
                <td class="bold"><?= toRp($output['pm']['NOT']['total_berat']) ?> Kg</td>
            </tr>
        </table>
    </div>
</div>