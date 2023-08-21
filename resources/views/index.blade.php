<x-base-layout>

    <x-slot:pageTitle>لوحة التحكم</x-slot>

        <div class="container text-center" style="margin-top: 50px; margin-bottom: 50px">
            <h3 style="font-size: 30px">لوحة التحكم</h3>
        </div>

        <div class="row">
            <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                <a class="card style-6" href="{{ route('clients.index') }}">
                    <img src="{{ Vite::asset('resources/src/assets/img/cleint.png') }}" class="card-img-top" alt="..."
                        style="width: 100%; height: 100%;">
                    <div class="card-footer">
                        <div class="row">
                            <div class="container text-center">
                                <i style="font-size: 20px" class="fas fa-shopping-bag"></i>
                                <b>العملاء</b>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                <a class="card style-6" href="{{ route('maintenance-technicians.index') }}">
                    <img src="{{ Vite::asset('resources/src/assets/img/maintenance.png') }}" class="card-img-top"
                        alt="..." style="width: 100%; height: 100%;">
                    <div class="card-footer">
                        <div class="row">
                            <div class="container text-center">
                                <i style="font-size: 20px" class="fas fa-clipboard-list"></i>
                                <b>فنيو الصيانة</b>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                <a class="card style-6" href="{{ route('orders.index') }}">
                    <img src="{{ Vite::asset('resources/src/assets/img/order.png') }}" class="card-img-top"
                        alt="..." style="width: 100%; height: 100%;">
                    <div class="card-footer">
                        <div class="row">
                            <div class="container text-center">
                                <i style="font-size: 20px" class="fas fa-clipboard-list"></i>
                                <b>الطلبات</b>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

</x-base-layout>
