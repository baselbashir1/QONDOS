<x-base-layout>

    <x-slot:pageTitle>تفاصيل الطلب</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="widget-content widget-content-area ecommerce-create-section">
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="name">رقم الطلب</label>
                            <div class="form-control">{{ $order->id }}</div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="phone">الخدمات</label>
                            @foreach ($order->orderServices as $orderService)
                                <div class="card container mb-2">
                                    <div>{{ $orderService->service->translate('ar')->name }}</div>
                                    <div class="form-control">
                                        <img src="{{ $orderService->service->image ? Vite::asset('public/storage/' . $orderService->service->image) : Vite::asset('public/no-image.png') }}"
                                            alt="..." style="width: 30%; height: 30%">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mb-4 tex">
                        <div class="col-sm-12">
                            <label for="city">الصور</label>
                            @foreach ($order->orderImages as $orderImage)
                                <div class="card container mb-2">
                                    <img src="{{ $orderImage->image ? Vite::asset('public/storage/' . $orderImage->image) : Vite::asset('public/no-image.png') }}"
                                        alt="..." style="width: 30%; height: 30%">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="email">صاحب الطلب</label>
                            <div class="form-control">{{ $order->client->name }}</div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="password">ملاحظات</label>
                            <div class="form-control">{{ $order->notes }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-base-layout>
