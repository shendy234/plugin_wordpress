<?php
$json=file_get_contents("http://192.168.209.1:5000/events");
$data =  json_decode($json, TRUE);


function html_table($data = array())
{
    $rows = array();
    $col = "<tr><th>Time stamp</th>
            <th>IP Source</th>
            <th>IP Destination</th>
            <th>Severity</th>
            <th>Description</th></tr>";
    $style = "<style>table, th, td {
        border: 1px solid;
      }</style>";
    foreach ($data as $row) {
        $cells = array();
        foreach ($row as $cell) {
            $cells[] = "<td>{$cell}</td>";
        }
        $rows[] = "<tr>" . implode('', $cells) . "</tr>";
    }
    return $style . "<table class='hci-table'>" . $col .  implode('', $rows) . "</table>";
}
echo "<div> <h3>Grafik Data SIEM</h3>";
echo "
<style type=\"text/css\">
BODY {
    width: 1500PX;
    heigh: 1024PX;
}

#chart-container {
    width: 100%;
    height: auto;
}
</style>
<script type=\"text/javascript\" src=\"js/jquery.min.js\"></script>
<script type=\"text/javascript\" src=\"js/Chart.min.js\"></script>

<body>
    <div id=\"chart-container\">
        <canvas id=\"graphCanvas\"></canvas>
    </div>

    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post(\"data.php\",
                function (data)
                {
                    console.log(data);
                    data = data.replace('[[','');
                    data = data.replace(']','');
                    data = data.replace(']]','');
                    data = data.replace(']','');
                    data = data.replace('\\n','');


                    data = data.split(',');
                    
                    console.log(data[0]);
                    console.log(data[2]);
                    
                    var sig_name = [data[0], data[2], data[4]];
                    var total_events = [data[1], data[3], data[5]];

            
                    console.log(sig_name);
                    console.log(total_events);

                    var chartdata = {
                        labels: sig_name,
                        datasets: [
                            {
                                label: 'Signature Names',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: total_events
                            }
                        ]
                    };

                    var graphTarget = $(\"#graphCanvas\");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                          scales: {
                            yAxes: [{
                               ticks: {
                                  min: 0
                               }
                            }]
                         }
                        },
                    });
                });
            }
        }
        </script>

</body>

";



echo "<div id='divToPrint' >";
echo "<div> <h3>Data Siem</h3> </div>";

echo html_table($data);

echo"
<script type=\"text/javascript\">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=300,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload=\"window.print()\">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
 </script>
 </div>
<div id=\"divToPrint\" style=\"display:none;\">
  <div style=\"width:200px;height:300px;background-color:teal;\">      
  </div>
</div>
<div>
  <input type=\"button\" value=\"Print to PDF\" onclick=\"PrintDiv();\" />
</div>
</html>";


// echo $data["1"];
// echo $data["2"];
// echo $data["3"];

// if (count($data->$stand)) {
//         // Open the table
//         echo "<table>";

//         // Cycle through the array
//         foreach ($data->stand as $idx => $stand) {

//             // Output a row
//             echo "<tr>";
//             echo "<td>$stand->afko</td>";
//             echo "<td>$stand->positie</td>";
//             echo "</tr>";
//         }

//         // Close the table
//         echo "</table>";
//     }
?>




<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>

  
    <link rel="stylesheet" href="../css/style.css"/>

    <script src="https://kit.fontawesome.com/a3764fe608.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="navbar navbar-white sticky-top bg-white flex-md-nowrap p-0 shadow"> 
    </header>

    <div class="container-fluid">
        <div class="row">

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h3>Report Serangan</h3>
                </div>
                <div id="content">
                    <div class="text-center align-items-center">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="1" scope="col">No</th>
                                        <th rowspan="4" scope="col">Laporan</th>
                                        <th colspan="1" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html> -->