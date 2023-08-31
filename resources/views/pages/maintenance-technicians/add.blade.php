<x-base-layout>

    <x-slot:pageTitle>إضافة فني صيانة</x-slot>

    <div class="row mb-4 layout-spacing layout-top-spacing">
        <form method="POST" action="{{ route('maintenance-technicians.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="widget-content widget-content-area ecommerce-create-section">
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="name">الاسم</label>
                            <input type="text" name="name" class="form-control" placeholder="ادخل الاسم">
                        </div>
                        @error('name')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="phone">رقم الهاتف</label>
                            <input type="text" name="phone" class="form-control" placeholder="ادخل رقم الهاتف">
                        </div>
                        @error('phone')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="password">كلمة المرور</label>
                            <input type="password" name="password" class="form-control" placeholder="ادخل كلمة المرور">
                        </div>
                        @error('password')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="city">المدينة</label>
                            <input type="text" name="city" class="form-control" placeholder="ادخل اسم المدينة">
                        </div>
                        @error('city')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="bank">البنك</label>
                            <input type="text" name="bank" class="form-control" placeholder="ادخل اسم البنك">
                        </div>
                        @error('bank')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="account_number">رقم الحساب</label>
                            <input type="text" name="account_number" class="form-control"
                                placeholder="ادخل رقم الحساب">
                        </div>
                        @error('account_number')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="photo">الصورة الشخصية</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        @error('photo')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="residency_photo">صورة الإقامة</label>
                            <input type="file" name="residency_photo" class="form-control">
                        </div>
                        @error('residency_photo')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="longitude">خط الطول</label>
                            <input type="text" name="longitude" class="form-control" placeholder="ادخل خط الطول">
                        </div>
                        @error('longitude')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="latitude">خط العرض</label>
                            <input type="text" name="latitude" class="form-control" placeholder="ادخل خط العرض">
                        </div>
                        @error('latitude')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="service">اختر التصنيف الرئيسي</label>
                            <select name="category" class="form-control">
                                <option selected disabled>اختر التصنيف الرئيسي</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->translate('ar')->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('category')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="mb-3">اختر تصنيفات فرعية</label>
                            <ul>
                                @foreach ($subCategories as $subCategory)
                                    <li>
                                        <label style="font-size: 16px;">
                                            <input type="checkbox" name="sub_categories[]"
                                                value="{{ $subCategory->id }}" class="name">
                                            {{ $subCategory->translate('ar')->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success w-100" style="background: green"><span>إضافة
                                    فني
                                    صيانة</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script>
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
    </script> --}}

</x-base-layout>
