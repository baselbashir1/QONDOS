<x-base-layout>

    <x-slot:pageTitle>تعديل فني الصيانة</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <form method="POST"
                action="{{ route('maintenance-technicians.update', ['maintenance_technician' => $maintenanceTechnician->id]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="name">الاسم</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $maintenanceTechnician->name }}">
                            </div>
                            @error('name')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="phone">رقم الهاتف</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ $maintenanceTechnician->phone }}">
                            </div>
                            @error('phone')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="password">كلمة المرور</label>
                                <input type="password" name="password" class="form-control"
                                    value="{{ $maintenanceTechnician->password }}">
                            </div>
                            @error('password')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="city">المدينة</label>
                                <input type="text" name="city" class="form-control"
                                    value="{{ $maintenanceTechnician->city }}">
                            </div>
                            @error('city')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="bank">البنك</label>
                                <input type="text" name="bank" class="form-control"
                                    value="{{ $maintenanceTechnician->bank }}">
                            </div>
                            @error('bank')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="account_number">رقم الحساب</label>
                                <input type="text" name="account_number" class="form-control"
                                    value="{{ $maintenanceTechnician->account_number }}">
                            </div>
                            @error('account_number')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="photo">الصورة الشخصية</label>
                                <div class="text-center">
                                    <img src="{{ $maintenanceTechnician->photo ? Vite::asset('public/storage/' . $maintenanceTechnician->photo) : Vite::asset('public/no-image.png') }}"
                                        class="card-img-top" alt="..." style="width: 250px; height: 250px;">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <input type="file" name="photo" class="form-control">
                            </div>
                            @error('photo')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="residency_photo">صورة الإقامة</label>
                                <div class="text-center">
                                    <img src="{{ $maintenanceTechnician->residency_photo ? Vite::asset('public/storage/' . $maintenanceTechnician->residency_photo) : Vite::asset('public/no-image.png') }}"
                                        class="card-img-top" alt="..." style="width: 250px; height: 250px;">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <input type="file" name="residency_photo" class="form-control">
                            </div>
                            @error('residency_photo')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="service">اختر الخدمة</label>
                                <select name="service" class="form-control" id="service">
                                    <option value="{{ $maintenanceTechnician->service_id }}" selected hidden>
                                        {{ $maintenanceTechnician->service->translate('ar')->name }}</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">
                                            {{ $service->translate('ar')->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('service')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4" hidden>
                            <div class="col-sm-12">
                                <label for="sub_category">اختر التصنيف الفرعي لهذه الخدمة</label>
                                <select name="sub_category" class="form-control">
                                    <option value="{{ $maintenanceTechnician->sub_category_id }}" selected hidden>
                                        {{ $maintenanceTechnician->subCategory->translate('ar')->name }}</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}">
                                            {{ $subCategory->translate('ar')->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('sub_category')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4" hidden>
                            <div class="col-sm-12">
                                <label for="main_category">اختر التصنيف الرئيسي لهذه الخدمة</label>
                                <select name="main_category" class="form-control">
                                    <option value="{{ $maintenanceTechnician->main_category_id }}" selected hidden>
                                        {{ $maintenanceTechnician->mainCategory->translate('ar')->name }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->translate('ar')->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('main_category')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success w-100"
                                    style="background: green"><span>تحديث</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                const service = $('#service');

                function updateServiceSelected() {
                    const selectedServiceId = service.val();

                    fetch(`/get-sub-category/${selectedServiceId}`)
                        .then(response => response.text())
                        .then(subcategory => {
                            $('select[name="sub_category"]').empty();
                            $('select[name="sub_category"]').append('<option value="' +
                                subcategory + '">' + subcategory + '</option>');
                        })
                        .catch(error => console.error(error));

                    fetch(`/get-main-category/${selectedServiceId}`)
                        .then(response => response.text())
                        .then(maincategory => {
                            $('select[name="main_category"]').empty();
                            $('select[name="main_category"]').append('<option value="' +
                                maincategory + '">' + maincategory + '</option>');
                        })
                        .catch(error => console.error(error));
                }

                service.on('change', updateServiceSelected);
            });
        </script>

</x-base-layout>
