<x-base-layout>
    <x-slot:pageTitle>معلومات العميل</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="widget-content widget-content-area ecommerce-create-section">
                    <div class="row">
                        <label class="ml-1 mr-1" style="width: 45%">الاسم</label>
                        <label class="ml-1 mr-1" style="width: 45%">رقم الهاتف</label>
                    </div>
                    <div class="row mb-4">
                        <div class="form-control m-1" style="width: 45%">{{ $client->name }}</div>
                        <div class="form-control m-1" style="width: 45%">{{ $client->phone }}</div>
                    </div>

                    <div class="row">
                        <label class="ml-1 mr-1" style="width: 45%">الايميل</label>
                        <label class="ml-1 mr-1" style="width: 45%">المدينة</label>
                    </div>
                    <div class="row mb-4">
                        <div class="form-control m-1" style="width: 45%">{{ $client->email }}</div>
                        <div class="form-control m-1" style="width: 45%">{{ $client->city }}</div>
                    </div>
                    <div class="row mb-4">
                        <label for="home">المنزل</label>
                        <div class="form-control m-1" style="width: 91%">{{ $currentAddress->home }}</div>
                    </div>
                    <div class="row mb-4">
                        <label for="home">العنوان الحالي</label>
                        <div class="form-control m-1" style="width: 91%">{{ $currentAddress->address }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label>الموقع الجغرافي</label>
                            <div id="map" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function initMap() {
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 5,
                });

                const clientId = {{ $client->id }};
                fetch(`/client/${clientId}/get-location`)
                    .then(response => response.json())
                    .then(data => {
                        const myLatLng = {
                            lat: parseFloat(data.latitude),
                            lng: parseFloat(data.longitude)
                        };

                        map.setCenter(myLatLng);

                        new google.maps.Marker({
                            position: myLatLng,
                            map,
                            title: data.name,
                        });
                    });
            }

            window.initMap = initMap;
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0HqqYZX6UfJhKREUB5hAnwcGWnP4Xl_Q&callback=initMap"
            defer></script>

</x-base-layout>
