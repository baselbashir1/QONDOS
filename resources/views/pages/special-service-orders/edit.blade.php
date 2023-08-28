<x-base-layout>

    <x-slot:pageTitle>تعديل الطلب</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <form method="POST"
                action="{{ route('special-service-orders.update', ['special_service_order' => $specialServiceOrder->id]) }}">
                @csrf
                @method('PUT')
                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row">
                            <label class="ml-1 mr-1" style="width: 45%">رقم الطلب</label>
                            <label class="ml-1 mr-1" style="width: 45%">صاحب الطلب</label>
                        </div>
                        <div class="row mb-4">
                            <div class="form-control m-1" style="width: 45%">{{ $specialServiceOrder->id }}</div>
                            <div class="form-control m-1" style="width: 45%">{{ $specialServiceOrder->client->name }}
                            </div>
                        </div>
                        <div class="row mb-4 tex">
                            <div class="col-sm-12">
                                <label for="images">الصور</label>
                                @if (count($specialServiceOrder->specialServiceOrderImages))
                                    <div class="d-flex flex-wrap justify-content-center">
                                        @foreach ($specialServiceOrder->specialServiceOrderImages as $specialServiceOrderImage)
                                            <div class="card container mb-2 text-center"
                                                style="width: 300px; height; 300px">
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
                            <label class="ml-1 mr-1" style="width: 45%" id="visit_title">وقت الزيارة</label>
                        </div>
                        <div class="row mb-4">
                            @if ($specialServiceOrder->is_scheduled === 1)
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
                                value="{{ $specialServiceOrder->visit_time }}">
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="password">ملاحظات</label>
                                <textarea class="form-control" name="notes" style="border-width: 3px; border-color:lightseagreen">{{ $specialServiceOrder->notes }}</textarea>
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const scheduled = document.getElementById('scheduled');
                const unscheduled = document.getElementById('unscheduled');
                const visitTime = document.getElementById('visit_time');
                const visitTitle = document.getElementById('visit_title');

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
                const scheduled = {{ $specialServiceOrder->is_scheduled }};

                if (scheduled === 1) {
                    visitTime.style.visibility = 'visible';
                    visitTitle.style.visibility = 'visible';
                } else {
                    visitTime.style.visibility = 'hidden';
                    visitTitle.style.visibility = 'hidden';
                }
            };
        </script>

</x-base-layout>
