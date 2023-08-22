<x-base-layout>

    <x-slot:pageTitle>طلبات خدمات خاصة للفنيين</x-slot>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <table id="ecommerce-list" class="table dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th class="checkbox-column"></th>
                                <th>رقم الطلب</th>
                                <th>عدد الصور</th>
                                <th>صاحب الطلب</th>
                                <th>حالة الطلب</th>
                                <th>وقت الزيارة</th>
                                <th>ملاحظات</th>
                                <th class="no-content text-center">خيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($specialServiceOrders))
                                @foreach ($specialServiceOrders as $specialServiceOrder)
                                    <tr>
                                        <td>{{ $specialServiceOrder->id }}</td>
                                        <td>{{ $specialServiceOrder->client_id }}</td>
                                        <td>{{ $specialServiceOrder->specialServiceOrderImages ? count($specialServiceOrder->specialServiceOrderImages) : 'null' }}
                                        </td>
                                        <td>{{ $specialServiceOrder->client->name }}</td>
                                        <td>
                                            @if ($specialServiceOrder->is_scheduled === 1)
                                                مجدول
                                            @else
                                                غير مجدول
                                            @endif
                                        </td>
                                        <td>
                                            @if ($specialServiceOrder->visit_time)
                                                {{ $specialServiceOrder->visit_time }}
                                            @else
                                                فوري
                                            @endif
                                        </td>
                                        <td>{{ $specialServiceOrder->notes }}</td>
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
                                                        href="{{ route('special-service-orders.show', ['special_service_order' => $specialServiceOrder->id]) }}">عرض</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('special-service-orders.edit', ['special_service_order' => $specialServiceOrder->id]) }}">تعديل</a>
                                                    <form
                                                        action="{{ route('special-service-orders.destroy', ['special_service_order' => $specialServiceOrder->id]) }}"
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
                                    <h4>لا يوجد طلبات</h4>
                                </div>
                            @endif
                        </tbody>
                    </table>
                    {{ $specialServiceOrders->links() }}
                </div>
            </div>
        </div>

</x-base-layout>