<x-base-layout>

    <x-slot:pageTitle>تعديل العميل</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <form method="POST" action="{{ route('clients.update', ['client' => $client->id]) }}">
                @csrf
                @method('PUT')
                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="name">الاسم</label>
                                <input type="text" name="name" class="form-control" value="{{ $client->name }}"
                                    placeholder="ادخل الاسم">
                            </div>
                            @error('name')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="phone">رقم الهاتف</label>
                                <input type="text" name="phone" class="form-control" value="{{ $client->phone }}"
                                    placeholder="ادخل رقم الهاتف">
                            </div>
                            @error('phone')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="email">البريد الالكتروني</label>
                                <input type="email" name="email" class="form-control text-right"
                                    value="{{ $client->email }}" placeholder="ادخل البريد الالكتروني">
                            </div>
                            @error('email')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="city">المدينة</label>
                                <input type="text" name="city" class="form-control" value="{{ $client->city }}"
                                    placeholder="ادخل اسم المدينة">
                            </div>
                            @error('city')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="home">المنزل</label>
                                <input type="text" name="home" class="form-control"
                                    value="{{ $clientAddress?->home }}" placeholder="ادخل اسم المنزل">
                            </div>
                            @error('home')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="password">كلمة المرور</label>
                                <input type="password" name="password" class="form-control"
                                    value="{{ $client->password }}" placeholder="ادخل كلمة المرور">
                            </div>
                            @error('password')
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

</x-base-layout>
