<x-base-layout>
    <x-slot:pageTitle>تفاصيل الطلب</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="widget-content widget-content-area ecommerce-create-section">
                    <div class="row">
                        <label class="ml-1 mr-1" style="width: 45%">رقم الطلب</label>
                        <label class="ml-1 mr-1" style="width: 45%">صاحب الطلب</label>
                    </div>
                    <div class="row mb-4">
                        <div class="form-control m-1" style="width: 45%">{{ $specialServiceOrder->id }}</div>
                        <div class="form-control m-1" style="width: 45%">{{ $specialServiceOrder->client->name }}</div>
                    </div>
                    <div class="row mb-4 tex">
                        <div class="col-sm-12">
                            <label for="city">الصور</label>
                            @if (count($specialServiceOrder->orderImages))
                                @foreach ($specialServiceOrder->orderImages as $orderImage)
                                    <div class="card container mb-2">
                                        <img src="{{ $orderImage->image ? Vite::asset('public/storage/' . $orderImage->image) : Vite::asset('public/no-image.png') }}"
                                            alt="..." style="width: 30%; height: 30%">
                                    </div>
                                @endforeach
                            @else
                                <div class="container text-center">
                                    <p style="font-size: 35px">لا يوجد صور مرفقة</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <label class="ml-1 mr-1" style="width: 45%">حالة الطلب</label>
                        <label class="ml-1 mr-1" style="width: 45%">وقت الزيارة</label>
                    </div>
                    <div class="row mb-4">
                        <div class="form-control m-1" style="width: 45%">
                            @if ($specialServiceOrder->is_scheduled === 1)
                                مجدول
                            @else
                                غير مجدول
                            @endif
                        </div>
                        <div class="form-control m-1" style="width: 45%">
                            @if ($specialServiceOrder->visit_time)
                                {{ $specialServiceOrder->visit_time }}
                            @else
                                فوري
                            @endif
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="password">ملاحظات</label>
                            <textarea class="form-control" style="pointer-events: none">{{ $specialServiceOrder->notes }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-base-layout>