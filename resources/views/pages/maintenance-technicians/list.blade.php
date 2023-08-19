<x-base-layout>

    <x-slot:pageTitle>فنيو الصيانة</x-slot>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-6" style="width: 200px">
                <a href="{{ route('maintenance-technicians.create') }}" class="btn btn-primary w-100 btn-lg mb-4">
                    <span class="btn-text-inner">إضافة فني صيانة</span>
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
                                <th>الاسم</th>
                                <th>رقم الهاتف</th>
                                <th>المدينة</th>
                                <th>البنك</th>
                                <th>رقم الحساب</th>
                                <th class="no-content text-center">خيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($maintenanceTechnicians))
                                @foreach ($maintenanceTechnicians as $maintenanceTechnician)
                                    <tr>
                                        <td>{{ $maintenanceTechnician->id }}</td>
                                        <td>{{ $maintenanceTechnician->name }}</td>
                                        <td>{{ $maintenanceTechnician->phone }}</td>
                                        <td>{{ $maintenanceTechnician->city }}</td>
                                        <td>{{ $maintenanceTechnician->bank }}</td>
                                        <td>{{ $maintenanceTechnician->account_number }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    id="dropdownMenuLink1" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="true">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-more-horizontal">
                                                        <circle cx="12" cy="12" r="1">
                                                        </circle>
                                                        <circle cx="19" cy="12" r="1">
                                                        </circle>
                                                        <circle cx="5" cy="12" r="1">
                                                        </circle>
                                                    </svg>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                    <a class="dropdown-item"
                                                        href="{{ route('maintenance-technicians.show', ['maintenance_technician' => $maintenanceTechnician->id]) }}">نفاصيل</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('maintenance-technicians.edit', ['maintenance_technician' => $maintenanceTechnician->id]) }}">تعديل</a>
                                                    <form
                                                        action="{{ route('maintenance-technicians.destroy', ['maintenance_technician' => $maintenanceTechnician->id]) }}"
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
                                    <h4>لا يوجد فنيو صيانة</h4>
                                </div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</x-base-layout>
