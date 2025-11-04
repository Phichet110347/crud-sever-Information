<?php
try {
    require_once __DIR__ . '/../config/db.php';
} catch (Exception $e) {
    die("Could not load configuration: " . $e->getMessage());
}
try {
    $query = "SELECT
        server.server_id,
        server.service_id,
        server.service_name,  
        server.service_date,
        server.service_space,
        server.service_space_uses,
        server.service_space_remain,
        server.service_space_percen,
        server.service_type_id,
        service_type.service_type_name,
        server.service_cpu,
        server.service_ram,
        server.service_disk
    FROM server
    INNER JOIN service_type ON server.service_type_id = service_type.service_type_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Query Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Table V05</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="util.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--===============================================================================================-->
    <meta name="robots" content="noindex, follow">
</head>

<body>
    <div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100 ver1">

                    <div class="wrap-table100-nextcols js-pscroll">
                        <div class="table100-nextcols">
                            <table>
                                <thead>
                                    <tr class="row100 head">
                                        <th class="cell100 column2">ลำดับ</th>
                                        <th class="cell100 column2">บริการ</th>
                                        <th class="cell100 column3">ชื่อ</th>
                                        <th class="cell100 column4">วันหมดอายุ</th>
                                        <th class="cell100 column5">พื้นที่ทั้งหมด</th>
                                        <th class="cell100 column6">ใช้ไป</th>
                                        <th class="cell100 column7">คงเหลือ</th>
                                        <th class="cell100 column8">ใช้ไปกี่เปอร์เซ็น</th>
                                        <th class="cell100 column9">ประเภท</th>
                                        <th class="cell100 column10">Ram</th>
                                        <th class="cell100 column11">CPU</th>
                                        <th class="cell100 column12">Disk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result as $row): ?>
                                        <tr class="row100 body">
                                            <td class="cell100 column2"><?= htmlspecialchars($row['server_id']) ?></td>
                                            <td class="cell100 column3"><?= htmlspecialchars($row['']) ?></td>
                                            <td class="cell100 column4"><?= htmlspecialchars($row['service_name']) ?></td>
                                            <td class="cell100 column5"><?= htmlspecialchars($row['service_date']) ?></td>
                                            <td class="cell100 column6"><?= htmlspecialchars($row['service_space']) ?></td>
                                            <td class="cell100 column7"><?= htmlspecialchars($row['service_space_uses']) ?></td>
                                            <td class="cell100 column8"><?= htmlspecialchars($row['service_space_remain']) ?></td>
                                            <td class="cell100 column9"><?= htmlspecialchars($row['service_space_percen']) ?>%</td>
                                            <td class="cell100 column10"><?= htmlspecialchars($row['service_type_name']) ?></td>
                                            <td class="cell100 column11"><?= htmlspecialchars($row['service_ram']) ?> GB</td>
                                            <td class="cell100 column12"><?= htmlspecialchars($row['service_cpu']) ?> Core</td>
                                            <td class="cell100 column12"><?= htmlspecialchars($row['service_disk']) ?> GB</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="endCont"><button class="btn btn-success" id="exportBtn">
                        <i class="fa fa-download"></i> Export
                    </button></div>

            </div>

        </div>
    </div>


    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $('.js-pscroll').each(function() {
            var ps = new PerfectScrollbar(this);

            $(window).on('resize', function() {
                ps.update();
            })

            $(this).on('ps-x-reach-start', function() {
                $(this).parent().find('.table100-firstcol').removeClass('shadow-table100-firstcol');
            });

            $(this).on('ps-scroll-x', function() {
                $(this).parent().find('.table100-firstcol').addClass('shadow-table100-firstcol');
            });
            // $(this).on('ps-y-reach-start', function(){
            // 	$(this).parent().find('.table100-firstrow').removeClass('shadow-table100-firstrow');
            // });

            // $(this).on('ps-scroll-y', function(){
            // 	$(this).parent().find('.table100-firstrow').addClass('shadow-table100-firstrow');
            // });

        });
    </script>


</body>

</html>