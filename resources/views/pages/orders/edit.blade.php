<x-base-layout>

    <x-slot:pageTitle>تعديل الطلب</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <form method="POST" action="{{ route('orders.update', ['order' => $order->id]) }}">
                @csrf
                @method('PUT')
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
                                            <input type="number" name="quantities[{{ $orderService->id }}]"
                                                style="border-width: 3px; border-color:lightseagreen"
                                                value="{{ $orderService->quantity }}"
                                                class="form-control m-1 text-center" min="1">
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
                            <label class="ml-1 mr-1" style="width: 45%" id="visit_title">وقت الزيارة</label>
                        </div>
                        <div class="row mb-4">
                            @if ($order->is_scheduled === 1)
                                <div class="col mt-3">
                                    <input type="radio" name="is_scheduled" id="scheduled" value="1" checked>
                                    مجدول
                                    <input type="radio" name="is_scheduled" id="unscheduled" value="0"> غير مجدول
                                </div>
                            @else
                                <div class="col mt-3">
                                    <input type="radio" name="is_scheduled" id="scheduled" value="1"> مجدول
                                    <input type="radio" name="is_scheduled" id="unscheduled" value="0" checked>
                                    غير مجدول
                                </div>
                            @endif
                            <input type="datetime-local" name="visit_time" id="visit_time" class="form-control m-1"
                                style="width: 55%; border-width: 3px; border-color:lightseagreen"
                                value="{{ $order->visit_time }}">
                        </div>
                        <div class="row">
                            <label class="ml-1 mr-1" style="width: 45%">نوع الدفع</label>
                            <label class="ml-1 mr-1" style="width: 45%" id="payment_type_label">طريقة الدفع</label>
                        </div>
                        <div class="row mb-4">
                            <select name="payment_type" class="form-control m-1" id="payment_type"
                                style="width: 45%; border-width: 3px; border-color:lightseagreen">
                                <option value="{{ $order->payment_type }}" hidden>
                                    @if ($order->payment_type === 1)
                                        الكتروني
                                    @else
                                        نقدي
                                    @endif
                                </option>
                                <option value="0">نقدي</option>
                                <option value="1">الكتروني</option>
                            </select>
                            <input type="text" name="payment_method" class="form-control m-1" id="payment_method"
                                style="width: 45%; border-width: 3px; border-color:lightseagreen"
                                value="{{ $order->payment_method }}">
                        </div>
                        <div class="row">
                            <label class="ml-1 mr-1" style="width: 45%">حالة الطلب</label>
                        </div>
                        <div class="row mb-4">
                            <select name="status" class="form-control m-1"
                                style="width: 91%; border-width: 3px; border-color:lightseagreen">
                                <option value="{{ $order->status }}" hidden>{{ $order->status }}</option>
                                @foreach ($orderStatuses as $orderStatus)
                                    <option value="{{ $orderStatus }}">{{ $orderStatus }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="notes">ملاحظات</label>
                                <textarea class="form-control" name="notes" style="border-width: 3px; border-color:lightseagreen">{{ $order->notes }}</textarea>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success w-100"
                                    style="background:green"><span>تحديث
                                        الطلب</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const scheduled = document.getElementById('scheduled');
                const unscheduled = document.getElementById('unscheduled');
                const visitTime = document.getElementById('visit_time');
                const visitTitle = document.getElementById('visit_title');

                if (scheduled === 1) {
                    visitTime.style.visibility = 'visible';
                    visitTitle.style.visibility = 'visible';
                } else {
                    visitTime.style.visibility = 'hidden';
                    visitTitle.style.visibility = 'hidden';
                }

                function clickScheduled() {
                    visitTime.style.visibility = 'visible';
                    visitTitle.style.visibility = 'visible';
                    visitTime.value = '';
                    visitTime.setAttribute('type', 'datetime-local');
                    visitTime.setAttribute('class', 'form-control');
                }

                function clickUnscheduled() {
                    visitTime.style.visibility = 'hidden';
                    visitTitle.style.visibility = 'hidden';
                    visitTime.setAttribute('type', 'text');
                    visitTime.value = '';
                    visitTime.setAttribute('class', 'form-control pe-none');
                }

                scheduled.addEventListener('click', clickScheduled);
                unscheduled.addEventListener('click', clickUnscheduled);
            });
        </script>

        <script>
            window.onload = function() {
                const visitTime = document.getElementById('visit_time');
                const visitTitle = document.getElementById('visit_title');
                const scheduled = {{ $order->is_scheduled }};

                if (scheduled === 1) {
                    visitTime.style.visibility = 'visible';
                    visitTitle.style.visibility = 'visible';
                } else {
                    visitTime.style.visibility = 'hidden';
                    visitTitle.style.visibility = 'hidden';
                }
            };
        </script>

        <script>
            window.onload = function() {
                const paymentMethod = document.getElementById('payment_method');
                const paymentTypeLabel = document.getElementById('payment_type_label');
                const paymentTypeSelect = document.getElementById('payment_type');

                paymentTypeSelect.addEventListener('change', function() {
                    if (this.value === '1') {
                        paymentMethod.style.display = 'block';
                        paymentTypeLabel.style.display = 'block';
                    } else {
                        paymentMethod.style.display = 'none';
                        paymentTypeLabel.style.display = 'none';
                    }
                });

                if (paymentTypeSelect.value === '1') {
                    paymentMethod.style.display = 'block';
                    paymentTypeLabel.style.display = 'block';
                } else {
                    paymentMethod.style.display = 'none';
                    paymentTypeLabel.style.display = 'none';
                }
            };
        </script>

</x-base-layout>
