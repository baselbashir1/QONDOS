<x-base-layout>

    <x-slot:pageTitle>الطلبات</x-slot>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <table id="ecommerce-list" class="table dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th class="checkbox-column"></th>
                                <th>رقم الطلب</th>
                                <th>عدد الخدمات</th>
                                <th>عدد الصور</th>
                                <th>صاحب الطلب</th>
                                <th>حالة الطلب</th>
                                <th>وقت الزيارة</th>
                                <th>ملاحظات</th>
                                <th class="no-content text-center">خيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($orders))
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->client_id }}</td>
                                        <td>{{ count($order->orderServices) }}</td>
                                        <td>{{ count($order->orderImages) }}</td>
                                        <td>{{ $order->client->name }}</td>
                                        <td>
                                            @if ($order->is_scheduled === 1)
                                                مجدول
                                            @else
                                                غير مجدول
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->visit_time)
                                                {{ $order->visit_time }}
                                            @else
                                                فوري
                                            @endif
                                        </td>
                                        <td>{{ $order->notes }}</td>
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
                                                        href="{{ route('orders.show', ['order' => $order->id]) }}">عرض</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('orders.edit', ['order' => $order->id]) }}">تعديل</a>
                                                    <form
                                                        action="{{ route('orders.destroy', ['order' => $order->id]) }}"
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
                                    <h4>لا يوجد عملاء</h4>
                                </div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</x-base-layout>
