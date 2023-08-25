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
                        <div class="form-control m-1" style="width: 45%">{{ $order->id }}</div>
                        <div class="form-control m-1" style="width: 45%">{{ $order->client->name }}</div>
                    </div>
                    <div class="row mb-4">
                        <label>الخدمات</label>
                        @if (count($order->orderServices))
                            @foreach ($order->orderServices as $orderService)
                                <div class="card form-control m-1" style="font-size: 20px; width: 20%; height: 20%">
                                    {{ $orderService->service->translate('ar')->name }}
                                </div>
                            @endforeach
                        @else
                            <div class="container text-center">
                                <p style="font-size: 35px">لا يوجد خدمات</p>
                            </div>
                        @endif
                    </div>
                    {{-- <div class="row mb-4">
                        <label>الصور</label>
                        @if (count($order->orderImages))
                            @foreach ($order->orderImages as $orderImage)
                                <div class="card form-control m-1" style="font-size: 20px; width: 20%; height: 20%">
                                    <img src="{{ $orderImage->image ? Vite::asset('public/storage/' . $orderImage->image) : Vite::asset('public/no-image.png') }}"
                                        alt="..." style="width: 100%; height: 100%">
                                </div>
                            @endforeach
                        @else
                            <div class="container text-center">
                                <p style="font-size: 35px">لا يوجد صور مرفقة</p>
                            </div>
                        @endif
                    </div> --}}
                    <div class="row mb-4 tex">
                        <div class="col-sm-12">
                            <label for="images">الصور</label>
                            @if (count($order->orderImages))
                                <div class="d-flex flex-wrap justify-content-center">
                                    @foreach ($order->orderImages as $orderImage)
                                        <div class="card container mb-2 text-center"
                                            style="width: 300px; height; 300px">
                                            <img src="{{ $orderImage->image ? Vite::asset('public/storage/' . $orderImage->image) : Vite::asset('public/no-image.png') }}"
                                                alt="..." style="width: 100%; height; 100%; margin: auto;">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="container text-center">
                                    <p style="font-size: 35px">لا يوجد صور مرفقة</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <label class="ml-1 mr-1" style="width: 45%">(مجدول\غير مجدول)</label>
                        <label class="ml-1 mr-1" style="width: 45%">وقت الزيارة</label>
                    </div>
                    <div class="row mb-4">
                        <div class="form-control m-1" style="width: 45%">
                            @if ($order->is_scheduled === 1)
                                مجدول
                            @else
                                غير مجدول
                            @endif
                        </div>
                        <div class="form-control m-1" style="width: 45%">
                            @if ($order->visit_time)
                                {{ $order->visit_time }}
                            @else
                                فوري
                            @endif
                        </div>
                    </div>
                    @if ($order->payment_type === 0)
                        <div class="row">
                            <label class="ml-1 mr-1" style="width: 45%">نوع الدفع</label>
                        </div>
                        <div class="row mb-4">
                            <div class="form-control m-1" style="width: 45%">
                                نقدي
                            </div>
                        </div>
                    @endif
                    @if ($order->payment_type === 1 && $order->payment_method)
                        <div class="row">
                            <label class="ml-1 mr-1" style="width: 45%">نوع الدفع</label>
                            <label class="ml-1 mr-1" style="width: 45%">طريقة الدفع</label>
                        </div>
                        <div class="row mb-4">
                            <div class="form-control m-1" style="width: 45%">
                                الكتروني
                            </div>
                            <div class="form-control m-1" style="width: 45%">
                                {{ $order->payment_method }}
                            </div>
                        </div>
                    @endif
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label class="ml-1 mr-1">ملاحظات</label>
                            <textarea class="form-control" style="pointer-events: none">{{ $order->notes }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-base-layout>
