<x-base-layout>

    <x-slot:pageTitle>إضافة تصنيف فرعي</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <form method="POST" action="{{ route('sub-categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="category">اختر التصنيف الرئيسي لهذا التصنيف</label>
                                <select name="category" class="form-control">
                                    <option selected disabled>اختر تصنيف</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->translate('ar')->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category')
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
                                <label for="name_ar">اسم التصنيف باللغة العربية</label>
                                <input type="text" name="name_ar" class="form-control"
                                    placeholder="ادخل اسم التصنيف باللغة العربية">
                            </div>
                            @error('name_ar')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="name_en">اسم التصنيف باللغة الانكليزية</label>
                                <input type="text" name="name_en" class="form-control"
                                    placeholder="ادخل اسم التصنيف باللغة الانكليزية">
                            </div>
                            @error('name_en')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label for="image">صورة التصنيف</label>
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
                                        تصنيف فرعي</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-base-layout>
