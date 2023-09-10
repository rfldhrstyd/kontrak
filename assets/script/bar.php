<?php
$tampil_kontrak = $db->tampil_data_chart(); ?>

<script>
    var ctx = document.getElementById("grafik")
    var myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Kontrak 1", "Kontrak 2", "Kontrak 3", "Kontrak 4", "Kontrak 5"],
            datasets: [{
                label: "Aging Days Terbaru",
                data: [<?php
                        $no = 1;
                        if (is_array($tampil_kontrak) || is_object($tampil_kontrak)) {
                            foreach ($tampil_kontrak as $row) {
                                $tgl1 = new DateTime($row['tgl_dari']);
                                $tgl2 = new DateTime($row['tgl_sampai']);
                                $jarak = $tgl2->diff($tgl1);
                        ?>
                            <?php echo $jarak->days ?>,
                    <?php }
                        } ?>
                ],
                borderWidth: 1,

            }, ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>