<x-base-layout>

    <x-slot:pageTitle>تفاصيل الطلب</x-slot>

    <div class="row mb-4 layout-spacing layout-top-spacing">
        <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="widget-content widget-content-area ecommerce-create-section">
                <div class="row">
                    <label class="ml-1 mr-1" style="width: 30%">رقم الطلب</label>
                    <label class="ml-1 mr-1" style="width: 30%">صاحب الطلب</label>
                    <label class="ml-1 mr-1" style="width: 30%">الفني</label>
                </div>
                <div class="row mb-4">
                    <div class="form-control m-1" style="width: 30%">{{ $order->id }}</div>
                    <div class="form-control m-1" style="width: 30%">{{ $order->client->name }}</div>
                    @if ($offer?->maintenanceTechnician->name)
                        <div class="form-control m-1" style="width: 30%">
                            {{ $offer?->maintenanceTechnician->name }}
                        </div>
                    @else
                        <div class="form-control m-1" style="width: 30%">
                            لم يتم تحديد الفني حتى الآن
                        </div>
                    @endif
                </div>
                <div class="row mb-4">
                    <label>الخدمات</label>
                    @if (count($order->orderServices))
                        @php
                            $totalPrice = 0.0;
                        @endphp
                        @foreach ($order->orderServices as $orderService)
                            <div class="card m-2 text-center w-25">
                                <div class="mb-2" style="font-size: 20px">
                                    <b>{{ $orderService->service->translate('ar')->name }}</b>
                                </div>
                                <div class="mb-2">
                                    x{{ $orderService->quantity }}
                                </div>
                                <div class="mb-2">
                                    @php
                                        $totalPrice += $orderService->service->price * $orderService->quantity;
                                    @endphp
                                    ${{ $orderService->service->price * $orderService->quantity }}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="container text-center">
                            <p style="font-size: 35px">لا يوجد خدمات</p>
                        </div>
                    @endif
                </div>
                <div class="row mb-4 tex">
                    <div class="col-sm-12">
                        <label for="images">الصور</label>
                        @if (count($order->orderImages))
                            <div class="d-flex flex-wrap justify-content-center">
                                @foreach ($order->orderImages as $orderImage)
                                    <div class="card container mb-2 text-center" style="width: 300px; height; 300px">
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
                <div class="row">
                    <label class="ml-1 mr-1" style="width: 45%">حالة الطلب</label>
                    <label class="ml-1 mr-1" style="width: 45%">السعر الكلي</label>
                </div>
                <div class="row mb-4">
                    <div class="form-control m-1" style="width: 45%">
                        {{ $order->status }}
                    </div>
                    <div class="form-control m-1" style="width: 45%">
                        ${{ $totalPrice }}
                    </div>
                </div>
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
