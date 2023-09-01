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
                    <div class="form-control m-1" style="width: 30%">{{ $specialServiceOrder->id }}</div>
                    <div class="form-control m-1" style="width: 30%">{{ $specialServiceOrder->client->name }}</div>
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
                <div class="row mb-4 tex">
                    <div class="col-sm-12">
                        <label for="images">الصور</label>
                        @if (count($specialServiceOrder->specialServiceOrderImages))
                            <div class="d-flex flex-wrap justify-content-center">
                                @foreach ($specialServiceOrder->specialServiceOrderImages as $specialServiceOrderImage)
                                    <div class="card container mb-2 text-center" style="width: 300px; height; 300px">
                                        <img src="{{ $specialServiceOrderImage->image ? Vite::asset('public/storage/' . $specialServiceOrderImage->image) : Vite::asset('public/no-image.png') }}"
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
                        <label for="notes">حالة الطلب</label>
                        <div class="form-control">{{ $specialServiceOrder->status }}</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label for="notes">ملاحظات</label>
                        <textarea class="form-control" style="pointer-events: none">{{ $specialServiceOrder->notes }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-base-layout>
