<x-base-layout>

    <x-slot:pageTitle>نعديل فني الصيانة</x-slot>

        <div class="mt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <form method="POST"
                action="{{ route('maintenance-technicians.update', ['maintenance_technician' => $maintenanceTechnician->id]) }}">
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
                                <p class="mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="phone">رقم الهاتف</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ $maintenanceTechnician->phone }}">
                            </div>
                            @error('phone')
                                <p class="mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="city">المدينة</label>
                                <input type="text" name="city" class="form-control"
                                    value="{{ $maintenanceTechnician->city }}">
                            </div>
                            @error('phone')
                                <p class="mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="email">البريد الالكتروني</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ $maintenanceTechnician->email }}">
                            </div>
                            @error('email')
                                <p class="mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="password">كلمة المرور</label>
                                <input type="text" name="password" class="form-control"
                                    value="{{ $maintenanceTechnician->password }}">
                            </div>
                            @error('password')
                                <p class="mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success w-100"><span
                                        style="color: black">تحديث</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-base-layout>
