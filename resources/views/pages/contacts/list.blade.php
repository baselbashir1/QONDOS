<x-base-layout>

    <x-slot:pageTitle>الرسائل</x-slot>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <table id="ecommerce-list" class="table dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th class="checkbox-column"></th>
                                <th>صاحب الرسالة</th>
                                <th>رقم صاحب الرسالة</th>
                                <th>عنوان الرسالة</th>
                                <th>محتوى الرسالة</th>
                                <th class="no-content text-center">خيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($contacts))
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->client->name }}</td>
                                        <td>{{ $contact->client->phone }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>{{ $contact->message }}</td>
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
                                                        href="{{ route('contacts.show', ['contact' => $contact->id]) }}">عرض</a>
                                                    <a class="dropdown-item"
                                                        href="/message-send-replay/{{ $contact->id }}">رد</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="mb-4 text-center">
                                    <h4>لا يوجد رسائل</h4>
                                </div>
                            @endif
                        </tbody>
                    </table>
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>

</x-base-layout>
