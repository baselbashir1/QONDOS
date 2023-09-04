<x-base-layout>

    <x-slot:pageTitle>لوحة التحكم</x-slot>

    <div class="container mt-4 row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card bg-secondary">
                <div class="card-body pt-3">
                    <h5 class="card-title mb-3">العملاء</h5>
                    <p class="card-text">any</p>
                </div>
                <div class="card-footer px-4 pt-0 border-0">
                    <a href="/clients" target="_blank">اضغط هنا لرؤية العملاء</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card bg-primary">
                <div class="card-body pt-3">
                    <h5 class="card-title mb-3">فنيو الصيانة</h5>
                    <p class="card-text">any</p>
                </div>
                <div class="card-footer px-4 pt-0 border-0">
                    <a href="/maintenance-technicians" target="_blank">اضغط هنا لرؤية الفنيين</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card bg-dark">
                <div class="card-body pt-3">
                    <h5 class="card-title mb-3">اجالي مبلغ الطلبات</h5>
                    <p class="card-text">${{ $totalPrice }}</p>
                </div>
                <div class="card-footer px-4 pt-0 border-0">
                    <a href="/orders" target="_blank">اضغط هنا لرؤية الطلبات</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card bg-danger">
                <div class="card-body pt-3">
                    <h5 class="card-title mb-3">اجالي مبلغ الطلبات الخاصة</h5>
                    <p class="card-text">${{ $totalPrice }}</p>
                </div>
                <div class="card-footer px-4 pt-0 border-0">
                    <a href="/orders" target="_blank">اضغط هنا لرؤية الطلبات الخاصة</a>
                </div>
            </div>
        </div>
    </div>

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
                ['Categories', <?php echo count($categories); ?>, '/categories'],
                ['SubCategories', <?php echo count($subCategories); ?>, '/sub-categories'],
                ['Services', <?php echo count($services); ?>, '/services'],
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
                ['Clients', <?php echo count($clients); ?>, '#b87333', '/clients'],
                ['Maintenances', <?php echo count($maintenances); ?>, 'silver', '/maintenance-technicians'],
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
                ['Finished', <?php echo count($finished); ?>, '/orders'],
                ['Processing', <?php echo count($processing); ?>, '/orders'],
                ['Canceled', <?php echo count($canceled); ?>, '/orders'],
                ['Other', <?php echo count($other); ?>, '/orders']
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
