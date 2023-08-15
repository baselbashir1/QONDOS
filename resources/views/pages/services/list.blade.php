<x-base-layout>

    <x-slot:pageTitle>الخدمات</x-slot>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-6" style="width: 200px">
                <a href="{{ route('services.create') }}" class="btn btn-primary w-100 btn-lg mb-4">
                    <span class="btn-text-inner">إضافة خدمة</span>
                </a>
            </div>
        </div>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <table id="ecommerce-list" class="table dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th class="checkbox-column"></th>
                                <th>نوع التصنيف</th>
                                <th>التنصيف الفرعي لهذه الخدمة</th>
                                <th>اسم الخدمة باللغة العربية</th>
                                <th>اسم الخدمة باللغة الانكليزية</th>
                                <th>صورة الخدمة</th>
                                <th class="no-content text-center">خيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($services))
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $service->id }}</td>
                                        <td>{{ $service->type }}</td>
                                        <td>{{ $service->subCategory->translate('ar')->name }}</td>
                                        <td>{{ $service->translate('ar')->name }}</td>
                                        <td>{{ $service->translate('en')->name }}</td>
                                        <td>
                                            <div class="d-flex justify-content-left align-items-center">
                                                <div class="avatar  me-3">
                                                    <img src="{{ $service->image ? Vite::asset('public/storage/' . $service->image) : Vite::asset('public/no-image.png') }}"
                                                        alt="Avatar" width="64" height="64"
                                                        style="border-radius: 20px">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    id="dropdownMenuLink1" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="true">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-more-horizontal">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="19" cy="12" r="1"></circle>
                                                        <circle cx="5" cy="12" r="1"></circle>
                                                    </svg>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                    <a class="dropdown-item"
                                                        href="{{ route('services.edit', ['service' => $service->id]) }}">تعديل</a>
                                                    <form
                                                        action="{{ route('services.destroy', ['service' => $service->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" type="submit"
                                                            style="font-size: 13px">حذف</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="mb-4 text-center">
                                    <h4>لا يوجد خدمات</h4>
                                </div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</x-base-layout>
