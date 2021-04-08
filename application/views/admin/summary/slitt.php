<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <tr>
                <th colspan="2" style="background: skyblue; color: #fff"> POLOSAN </th>
                <th colspan="1" style="background: skyblue; color: #fff"> SELISIH </th>
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
                <td colspan="2" class="bold" style="background: skyblue; color: #fff">Detail Output</td>
                <td style="background: skyblue; color: #fff" class="bold">Berat</td>
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
                <th colspan="2" style="background: limegreen; color: #fff"> METALIZED </th>
                <th colspan="1" style="background: limegreen; color: #fff"> SELISIH </th>
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
                <td colspan="2" class="bold" style="background: limegreen; color: #fff">Detail Output</td>
                <td style="background: limegreen; color: #fff" class="bold">Berat</td>
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
                <th colspan="2" style="background: orange; color: #fff"> PM </th>
                <th colspan="1" style="background: orange; color: #fff"> SELISIH </th>
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
                <td colspan="2" class="bold" style="background: orange; color: #fff">Detail Output</td>
                <td style="background: orange; color: #fff" class="bold">Berat</td>
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