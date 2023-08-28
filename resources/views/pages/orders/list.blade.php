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
                                <th>صاحب الطلب</th>
                                <th>(مجدول\غير مجدول)</th>
                                <th>وقت الزيارة</th>
                                <th>حالة الطلب</th>
                                <th>سعر الطلب</th>
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
                                        <td>
                                            @if ($order->status === 'Processing' || $order->status === 'Finished')
                                                <div class="btn btn-success"
                                                    style="border-radius: 20px; background-color: rgb(17, 163, 17); pointer-events: none">
                                                    {{ $order->status }}
                                                </div>
                                            @endif
                                            @if (
                                                $order->status === 'Pending client approve' ||
                                                    $order->status === 'Pending maintenance confirm' ||
                                                    $order->status === 'Pending client to approve finish order')
                                                <div class="btn btn-warning"
                                                    style="border-radius: 20px; background-color: orange; pointer-events: none">
                                                    {{ $order->status }}
                                                </div>
                                            @endif
                                            @if ($order->status === 'Canceled')
                                                <div class="btn btn-danger"
                                                    style="border-radius: 20px; background-color: red; pointer-events: none">
                                                    {{ $order->status }}
                                                </div>
                                            @endif
                                            @if ($order->status === 'New order')
                                                <div class="btn btn-secondary"
                                                    style="border-radius: 20px; background-color: gray; pointer-events: none">
                                                    {{ $order->status }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $totalPrice = 0.0;
                                                $count = 0;
                                            @endphp
                                            @foreach ($order->orderServices as $orderService)
                                                @php
                                                    $totalPrice += $orderService->service->price;
                                                    $count++;
                                                @endphp
                                            @endforeach
                                            ${{ $totalPrice }}
                                        </td>
                                        <td>{{ substr($order->notes, 0, 20) }}...</td>
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
                                    <h4>لا يوجد طلبات</h4>
                                </div>
                            @endif
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>

</x-base-layout>
