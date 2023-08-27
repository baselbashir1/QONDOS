<x-base-layout>

    <x-slot:pageTitle>إضافة عميل</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <form method="POST" action="{{ route('clients.store') }}">
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
                                <label for="email">البريد الالكتروني</label>
                                <input type="email" name="email" class="form-control text-right"
                                    placeholder="ادخل البريد الالكتروني">
                            </div>
                            @error('email')
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
                        {{-- <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="home">المنزل</label>
                                <input type="text" name="home" class="form-control" placeholder="ادخل اسم المنزل">
                            </div>
                            @error('home')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        {{-- <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="address">العنوان</label>
                                <input type="text" name="address" class="form-control" placeholder="ادخل العنوان">
                            </div>
                            @error('address')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        {{-- <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="latitude">latitude</label>
                                <input type="text" name="latitude" class="form-control" placeholder="latitude">
                            </div>
                            @error('latitude')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        {{-- <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="longitude">longitude</label>
                                <input type="text" name="longitude" class="form-control" placeholder="longitude">
                            </div>
                            @error('longitude')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success w-100"
                                    style="background:green"><span>إضافة
                                        عميل</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-base-layout>
