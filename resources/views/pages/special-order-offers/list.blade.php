<x-base-layout>

    <x-slot:pageTitle>جميع العروض</x-slot>

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <table id="ecommerce-list" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="checkbox-column"></th>
                            <th>رقم الطلب</th>
                            <th>اسم العميل</th>
                            <th>اسم الفني</th>
                            <th>تقييم الفني</th>
                            <th>حالة الطلب</th>
                            <th>حالة العرض</th>
                            <th class="no-content text-center">خيارات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($specialOrderOffers))
                            @foreach ($specialOrderOffers as $offer)
                                <tr>
                                    <td>{{ $offer->id }}</td>
                                    <td>{{ $offer->order->id }}</td>
                                    <td>{{ $offer->client->name }}</td>
                                    <td>{{ $offer->maintenanceTechnician->name }}</td>
                                    <td>{{ $offer->maintenanceTechnician->ratings->avg('rate') }}</td>
                                    <td>
                                        @if ($offer->order->status === 'Processing' || $offer->order->status === 'Finished')
                                            <div class="btn btn-success"
                                                style="border-radius: 20px; background-color: rgb(17, 163, 17); pointer-events: none">
                                                {{ $offer->order->status }}
                                            </div>
                                        @endif
                                        @if (
                                            $offer->order->status === 'Pending client approve' ||
                                                $offer->order->status === 'Pending maintenance confirm' ||
                                                $offer->order->status === 'Pending client to approve finish order')
                                            <div class="btn btn-warning"
                                                style="border-radius: 20px; background-color: orange; pointer-events: none">
                                                {{ $offer->order->status }}
                                            </div>
                                        @endif
                                        @if ($offer->order->status === 'Canceled')
                                            <div class="btn btn-danger"
                                                style="border-radius: 20px; background-color: red; pointer-events: none">
                                                {{ $offer->order->status }}
                                            </div>
                                        @endif
                                        @if ($offer->order->status === 'New order')
                                            <div class="btn btn-secondary"
                                                style="border-radius: 20px; background-color: gray; pointer-events: none">
                                                {{ $offer->order->status }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($offer->status === 'Accepted' || $offer->status === 'Confirmed')
                                            <div class="btn btn-success"
                                                style="border-radius: 20px; background-color: rgb(17, 163, 17); pointer-events: none">
                                                {{ $offer->status }}
                                            </div>
                                        @endif
                                        @if ($offer->status === 'Pending')
                                            <div class="btn btn-warning"
                                                style="border-radius: 20px; background-color: orange; pointer-events: none">
                                                {{ $offer->status }}
                                            </div>
                                        @endif
                                        @if ($offer->status === 'Rejected')
                                            <div class="btn btn-danger"
                                                style="border-radius: 20px; background-color: red; pointer-events: none">
                                                {{ $offer->status }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-more-horizontal">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="19" cy="12" r="1"></circle>
                                                    <circle cx="5" cy="12" r="1"></circle>
                                                </svg>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <a class="dropdown-item"
                                                    href="{{ route('offers.show', ['offer' => $offer->id]) }}">عرض
                                                    التفاصيل</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <div class="mb-4 text-center">
                                <h4>لا يوجد عروض</h4>
                            </div>
                        @endif
                    </tbody>
                </table>
                {{ $specialOrderOffers->links() }}
            </div>
        </div>
    </div>

</x-base-layout>
