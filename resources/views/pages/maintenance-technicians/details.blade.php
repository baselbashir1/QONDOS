<x-base-layout>
    <x-slot:pageTitle>معلومات فني الصيانة</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="widget-content widget-content-area ecommerce-create-section">
                    <div class="row">
                        <label class="ml-1 mr-1" style="width: 45%">الاسم</label>
                        <label class="ml-1 mr-1" style="width: 45%">رقم الهاتف</label>
                    </div>
                    <div class="row mb-4">
                        <div class="form-control m-1" style="width: 45%">{{ $maintenanceTechnician->name }}</div>
                        <div class="form-control m-1" style="width: 45%">{{ $maintenanceTechnician->phone }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label>الصورة الشخصية</label>
                            <div class="text-center">
                                <img src="{{ $maintenanceTechnician->photo ? Vite::asset('public/storage/' . $maintenanceTechnician->photo) : Vite::asset('public/no-image.png') }}"
                                    class="card-img-top" alt="..." style="width: 250px; height: 250px;">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label>صورة الإقامة</label>
                            <div class="text-center">
                                <img src="{{ $maintenanceTechnician->residency_photo ? Vite::asset('public/storage/' . $maintenanceTechnician->residency_photo) : Vite::asset('public/no-image.png') }}"
                                    class="card-img-top" alt="..." style="width: 250px; height: 250px;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="ml-1 mr-1" style="width: 45%">المدينة</label>
                        <label class="ml-1 mr-1" style="width: 45%">البنك</label>
                    </div>
                    <div class="row mb-4">
                        <div class="form-control m-1" style="width: 45%">{{ $maintenanceTechnician->city }}</div>
                        <div class="form-control m-1" style="width: 45%">{{ $maintenanceTechnician->bank }}</div>
                    </div>
                    <div class="row">
                        <label class="ml-1 mr-1" style="width: 45%">رقم الحساب</label>
                        <label class="ml-1 mr-1" style="width: 45%">التصنيف الرئيسي للخدمة</label>
                    </div>
                    <div class="row mb-4">
                        <div class="form-control m-1" style="width: 45%">{{ $maintenanceTechnician->account_number }}
                        </div>
                        <div class="form-control m-1" style="width: 45%">
                            {{ $maintenanceTechnician->mainCategory->translate('ar')->name }}
                        </div>
                    </div>
                    <div class="row">
                        <label class="ml-1 mr-1" style="width: 45%">التصنيف الفرعي للخدمة</label>
                        <label class="ml-1 mr-1" style="width: 45%">الخدمة</label>
                    </div>
                    <div class="row mb-4">
                        <div class="form-control m-1" style="width: 45%">
                            {{ $maintenanceTechnician->subCategory->translate('ar')->name }}
                        </div>
                        <div class="form-control m-1" style="width: 45%">
                            {{ $maintenanceTechnician->service->translate('ar')->name }}
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="phone">الموقع الجغرافي</label>
                            <h1>{{ $maintenanceTechnician->location }}</h1>
                            <div id="map" style="height: 400px;"></div>
                        </div>
                        @error('phone')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                </div>
            </div>
        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0HqqYZX6UfJhKREUB5hAnwcGWnP4Xl_Q&callback=initMap" async
            defer></script>
        <script>
            function initMap() {
                var location = {!! json_encode($maintenanceTechnician->location) !!};
                var lat = location.coordinates[1];
                var lng = location.coordinates[0];

                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: lat,
                        lng: lng
                    },
                    zoom: 12
                });

                var marker = new google.maps.Marker({
                    position: {
                        lat: lat,
                        lng: lng
                    },
                    map: map,
                    title: 'Location Name'
                });
            }
        </script>

</x-base-layout>

{{-- <x-base-layout>
    <x-slot name="pageTitle">معلومات فني الصيانة</x-slot>

    <div class="row mb-4 layout-spacing layout-top-spacing">
        <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="widget-content widget-content-area ecommerce-create-section">

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label for="phone">الموقع الجغرافي</label>
                        <h1>{{ $maintenanceTechnician->location }}</h1>
                        <div id="map" style="height: 400px;"></div>
                    </div>
                    @error('phone')
                        <p class="mt-2 text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0HqqYZX6UfJhKREUB5hAnwcGWnP4Xl_Q&callback=initMap" async
        defer></script>
    <script>
        function initMap() {
            var location = {!! json_encode($maintenanceTechnician->location) !!};
            var lat = location.coordinates[1];
            var lng = location.coordinates[0];

            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: lat,
                    lng: lng
                },
                zoom: 12
            });

            var marker = new google.maps.Marker({
                position: {
                    lat: lat,
                    lng: lng
                },
                map: map,
                title: 'Location Name'
            });
        }
    </script>
</x-base-layout> --}}
