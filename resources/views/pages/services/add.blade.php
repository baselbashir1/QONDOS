<x-base-layout>

    <x-slot:pageTitle>إضافة خدمة</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="sub_category">اختر التصنيف الفرعي لهذه الخدمة</label>
                                <select name="sub_category" class="form-control">
                                    <option selected disabled>اختر تصنيف</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}">{{ $subCategory->translate('ar')->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('sub_category')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="type">نوع التصنيف</label>
                                <select name="type" class="form-control">
                                    <option selected disabled>اختر نوع التصنيف</option>
                                    @foreach ($categoryTypes as $categoryType)
                                        <option value="{{ $categoryType }}">{{ $categoryType }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('type')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="name_ar">اسم الخدمة باللغة العربية</label>
                                <input type="text" name="name_ar" class="form-control"
                                    placeholder="ادخل اسم الخدمة باللغة العربية">
                            </div>
                            @error('name_ar')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="name_en">اسم الخدمة باللغة الانكليزية</label>
                                <input type="text" name="name_en" class="form-control"
                                    placeholder="ادخل اسم الخدمة باللغة الانكليزية">
                            </div>
                            @error('name_en')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="price">سعر الخدمة</label>
                                <input type="text" name="price" class="form-control text-right">
                            </div>
                            @error('price')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="image">صورة الخدمة</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            @error('image')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success w-100"
                                    style="background:green"><span>إضافة
                                        خدمة</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-base-layout>
