<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Keuangan</title>
</head>
<body>
    <table border=1 style="border-collapse: collapse">
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl</th>
                <th>User</th>
                <th>Keterangan</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
                <th>-</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $total = 0;
                $periode['pemasukan'] = 0;
                $periode['pengeluaran'] = 0;
                $no = 1;

                for ($i=0; $i < COUNT($data); $i++) :
                    if($data[$i]['tipe'] == "Pemasukan") {
                        $periode['pemasukan'] += $data[$i]['nominal'];
                        $total += $data[$i]['nominal'];
                    } else {
                        $periode['pengeluaran'] += $data[$i]['nominal'];
                        $total -= $data[$i]['nominal'];
                    }
            ?>
                <?php if($i == COUNT($data)-1) :?>
                    <tr>
                        <td style="background: yellow" colspan="4">Sub Total</td>
                        <td style="background: yellow"><?= $periode['pemasukan']?></td>
                        <td style="background: yellow"><?= $periode['pengeluaran']?></td>
                        <td style="background: yellow"><?= $periode['pemasukan'] - $periode['pengeluaran']?></td>
                        <td><?= $total?></td>
                        <?php
                            $periode['pemasukan'] = 0;
                            $periode['pengeluaran'] = 0;
                        ?>
                    </tr>
                <?php elseif(date("M", strtotime($data[$i]['tgl'])) != date("M", strtotime($data[$i+1]['tgl']))) :
                    $no = 0;
                ?>
                    <tr>
                        <td style="background: yellow" colspan="4">Sub Total</td>
                        <td style="background: yellow"><?= $periode['pemasukan']?></td>
                        <td style="background: yellow"><?= $periode['pengeluaran']?></td>
                        <td style="background: yellow"><?= $periode['pemasukan'] - $periode['pengeluaran']?></td>
                        <td><?= $total?></td>
                        <?php
                            $periode['pemasukan'] = 0;
                            $periode['pengeluaran'] = 0;
                        ?>
                    </tr>
                    <tr>
                        <td colspan=8><center><b>Rekap <?= date("M Y", strtotime($data[$i+1]['tgl']))?></b></center></td>
                    </tr>
                <?php else :
                    if($i == 0) :?>
                        <tr>
                            <td colspan=8><center><b>Rekap <?= date("M Y", strtotime($data[$i]['tgl']))?></b></center></td>
                        </tr>
                    <?php endif;?>
                    <tr>
                        <td><?= $no?></td>
                        <td><?= $data[$i]['tgl']?></td>
                        <td><?= $data[$i]['pelaku']?></td>
                        <td><?= $data[$i]['keterangan']?></td>
                        <?php if($data[$i]['tipe'] == "Pemasukan") :?>
                            <td><?= $data[$i]['nominal']?></td>
                            <td>-</td>
                        <?php else :?>
                            <td>-</td>
                            <td><?= $data[$i]['nominal']?></td>
                        <?php endif;?>
                        <th>-</th>
                        <td><?= $total?></td>
                    </tr>
                <?php endif;?>
            <?php 
                $no++;
                endfor;?>
        </tbody>
    </table>
</body>
</html>