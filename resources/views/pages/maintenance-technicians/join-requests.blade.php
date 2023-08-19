<x-base-layout>

    <x-slot:pageTitle>طلبات انضمام فنيو الصيانة</x-slot>

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
                                        <td class="row">
                                            <form action="/approve/{{ $maintenanceTechnician->id }}" method="POST"
                                                class="col" style=" width: 10px">
                                                @csrf
                                                <button class="btn btn-success" type="submit"
                                                    style="background: rgb(14, 164, 14)">قبول</button>
                                            </form>
                                            <form action="/reject/{{ $maintenanceTechnician->id }}" method="POST"
                                                class="col" style=" width: 10px">
                                                @csrf
                                                <button class="btn btn-danger" type="submit"
                                                    style="background: rgb(255, 55, 55)">رفض</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="mb-4 text-center">
                                    <h4>لا يوجد طلبات انضمام فنيو صيانة</h4>
                                </div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</x-base-layout>
