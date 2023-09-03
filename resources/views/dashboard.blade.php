<x-base-layout>
    <x-slot:pageTitle>لوحة التحكم</x-slot>

    <div class="container mt-4 row">
        <div id="piechart" style="width: 500px; height: 400px;" class="text-right"></div>
        <div id="columnchart" style="width: 100px; height: 100px;" class="text-left"></div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Type', 'Count'],
                ['categories', <?php echo $categories; ?>],
                ['subCategories', <?php echo $subCategories; ?>],
                ['services', <?php echo $services; ?>],
            ]);

            var options = {
                title: 'Categories Types',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["User Type", "Count", {
                    role: "style"
                }],
                ["Admins", <?php echo $users; ?>, "gold"],
                ['Clients', <?php echo $clients; ?>, "#b87333"],
                ['Maintenances', <?php echo $maintenances; ?>, "silver"],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                title: "Users",
                width: 600,
                height: 400,
                bar: {
                    groupWidth: "95%"
                },
                legend: {
                    position: "none"
                },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart"));
            chart.draw(view, options);
        }
    </script>

</x-base-layout>
