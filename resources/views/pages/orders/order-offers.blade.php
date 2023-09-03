<x-base-layout>

    <x-slot:pageTitle>عروض الطلب</x-slot>

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <table id="ecommerce-list" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="checkbox-column"></th>
                            <th>اسم الفني</th>
                            <th>تقييم الفني</th>
                            <th>حالة العرض</th>
                            <th>محتوى العرض</th>
                            <th class="no-content text-center">خيارات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($offers))
                            @foreach ($offers as $offer)
                                <tr>
                                    <td>{{ $offer->id }}</td>
                                    <td>{{ $offer->maintenanceTechnician->name }}</td>
                                    <td>{{ $offer->maintenanceTechnician->ratings->avg('rate') }}</td>
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
                                    <td>{{ $offer->description }}</td>
                                    <td class="row text-center">
                                        @if ($offer->status === 'Pending')
                                            <form action="/accept-offer/{{ $offer->id }}" method="POST"
                                                class="col m-2" style=" width: 10px">
                                                @csrf
                                                <button class="btn btn-success" type="submit"
                                                    style="background: rgb(14, 164, 14)">قبول</button>
                                            </form>
                                            <form action="/reject-offer/{{ $offer->id }}" method="POST"
                                                class="col m-2" style=" width: 10px">
                                                @csrf
                                                <button class="btn btn-danger" type="submit"
                                                    style="background: rgb(255, 55, 55)">رفض</button>
                                            </form>
                                        @endif
                                        <div class="col m-2" style=" width: 10px">
                                            <a href="{{ route('offers.show', ['offer' => $offer->id]) }}"
                                                class="btn btn-primary" style="background: rgb(16, 100, 210)">تفاصيل</a>
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
                {{ $offers->links() }}
            </div>
        </div>
    </div>

</x-base-layout>
