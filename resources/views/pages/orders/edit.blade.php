<x-base-layout>

    <x-slot:pageTitle>تعديل الطلب</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <form method="POST" action="{{ route('orders.update', ['order' => $order->id]) }}">
                @csrf
                @method('PUT')
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
                                        <img src="{{ $orderService->service->image ? Vite::asset('public/storage/' . $orderService->service->image) : Vite::asset('public/no-image.png') }}"
                                            alt="..." style="width: 100%; height: 100%">
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
                                <label for="city">الصور</label>
                                @if (count($order->orderImages))
                                    @foreach ($order->orderImages as $orderImage)
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
                            @if ($order->is_scheduled === 1)
                                <div class="col mt-3">
                                    <input type="radio" name="is_scheduled" value="1" checked> مجدول
                                    <input type="radio" name="is_scheduled" value="0"> غير مجدول
                                </div>
                            @else
                                <div class="col mt-3">
                                    <input type="radio" name="is_scheduled" value="1"> مجدول
                                    <input type="radio" name="is_scheduled" value="0" checked> غير مجدول
                                </div>
                            @endif
                            <input type="date" name="visit_time" class="form-control m-1"
                                style="width: 55%; border-width: 3px; border-color:lightseagreen"
                                value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="password">ملاحظات</label>
                                <textarea class="form-control" name="notes" style="border-width: 3px; border-color:lightseagreen">{{ $order->notes }}</textarea>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success w-100"
                                    style="background:green"><span>تحديث الطلب</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-base-layout>
