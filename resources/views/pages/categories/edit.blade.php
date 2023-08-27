<x-base-layout>

    <x-slot:pageTitle>تعديل التصنيف</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <form method="POST" action="{{ route('categories.update', ['category' => $category->id]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="name_ar">اسم التصنيف باللغة العربية</label>
                                <input type="text" name="name_ar" class="form-control"
                                    placeholder="ادخل اسم التصنيف باللغة العربية"
                                    value="{{ $category->translate('ar')->name }}">
                            </div>
                            @error('name_ar')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="name_en">اسم التصنيف باللغة الانكليزية</label>
                                <input type="text" name="name_en" class="form-control"
                                    placeholder="ادخل اسم التصنيف باللغة الانكليزية"
                                    value="{{ $category->translate('en')->name }}">
                            </div>
                            @error('name_en')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="image">صورة التصنيف</label>
                                <div class="text-center">
                                    <img src="{{ $category->image ? Vite::asset('public/storage/' . $category->image) : Vite::asset('public/no-image.png') }}"
                                        class="card-img-top" alt="..." style="width: 250px; height: 250px;">
                                </div>
                                <input type="file" name="image" class="form-control"
                                    value="{{ $category->image }}">
                            </div>
                            @error('image')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success w-100"
                                    style="background:green"><span>تحديث</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-base-layout>
