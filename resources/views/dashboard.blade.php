<x-base-layout>
    <x-slot:pageTitle>لوحة التحكم</x-slot>

    <div class="container mt-4 row">
        <div id="piechart" style="width: 500px; height: 400px;" class="text-right"></div>
        <div id="columnchart" style="width: 100px; height: 100px;" class="text-left"></div>
    </div>

    <div class="container mt-4 row">
        <div id="chart_div" style="width: 500px; height: 400px;" class="text-right"></div>
        {{-- <div id="columnchart" style="width: 100px; height: 100px;" class="text-left"></div> --}}
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Type', 'Count', {
                    role: 'link'
                }],
                ['Categories', <?php echo $categories; ?>, '/categories'],
                ['SubCategories', <?php echo $subCategories; ?>, '/sub-categories'],
                ['Services', <?php echo $services; ?>, '/services'],
            ]);

            var options = {
                title: 'Categories Types',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            google.visualization.events.addListener(chart, 'select', function() {
                var selection = chart.getSelection();
                if (selection.length > 0) {
                    var row = selection[0].row;
                    var url = data.getValue(row, 2);
                    window.location.href = url;
                }
            });

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
                ['User Type', 'Count', {
                    role: 'style',
                }, {
                    role: 'link'
                }],
                ['Admins', <?php echo $users; ?>, 'gold', ''],
                ['Clients', <?php echo $clients; ?>, '#b87333', '/clients'],
                ['Maintenances', <?php echo $maintenances; ?>, 'silver', '/maintenance-technicians'],
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

            google.visualization.events.addListener(chart, 'select', function() {
                var selection = chart.getSelection();
                if (selection.length > 0) {
                    var row = selection[0].row;
                    var url = data.getValue(row, 3);
                    window.location.href = url;
                }
            });

            chart.draw(view, options);
        }
    </script>

    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Pizza');
            data.addColumn('number', 'Populartiy');
            data.addColumn(['string', 'Link']);
            data.addRows([
                ['Finished', <?php echo $finished; ?>, '/orders'],
                ['Processing', <?php echo $processing; ?>, '/orders'],
                ['Canceled', <?php echo $canceled; ?>, '/orders'],
                ['Other', <?php echo $other; ?>, '/orders']
            ]);

            var options = {
                title: 'Orders',
                sliceVisibilityThreshold: .2,
                colors: ['green', 'orange', 'red', 'lightgray']
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

            google.visualization.events.addListener(chart, 'select', function() {
                var selectedItem = chart.getSelection()[0];
                if (selectedItem) {
                    var link = data.getValue(selectedItem.row, 2);
                    window.open(link);
                }
            });

            chart.draw(data, options);
        }
    </script>

</x-base-layout>
