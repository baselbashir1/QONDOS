<x-base-layout>

    <x-slot:pageTitle>إضافة فني صيانة</x-slot>

        {{-- <div class="mt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div> --}}

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
                                <input type="password" name="password" class="form-control"
                                    placeholder="ادخل كلمة المرور">
                            </div>
                            @error('password')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="city">المدينة</label>
                                <input type="text" name="city" class="form-control"
                                    placeholder="ادخل اسم المدينة">
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
                                <label for="main_category">اختر التصنيف الرئيسي لهذه الخدمة</label>
                                <select name="main_category" class="form-control">
                                    <option selected disabled>اختر التصنيف الرئيسي</option>
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
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="sub_category">اختر التصنيف الفرعي لهذه الخدمة</label>
                                <select name="sub_category" class="form-control">
                                    <option selected disabled>اختر التصنيف الفرعي</option>
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
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="service">اختر الخدمة</label>
                                <select name="service" class="form-control">
                                    <option selected disabled>اختر الخدمة</option>
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
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success w-100"
                                    style="background: green"><span>إضافة فني
                                        صيانة</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-base-layout>
