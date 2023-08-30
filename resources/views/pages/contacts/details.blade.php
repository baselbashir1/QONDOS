<x-base-layout>

    <x-slot:pageTitle>تفاصيل الرسالة</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="widget-content widget-content-area ecommerce-create-section">
                    <div class="row mb-4">
                        <label>صاحب الرسالة</label>
                        <div class="form-control">{{ $contact->client->name }}</div>
                    </div>
                    <div class="row mb-4">
                        <label>رقم صاحب الرسالة</label>
                        <div class="form-control">{{ $contact->client->phone }}</div>
                    </div>
                    <div class="row mb-4">
                        <label>عنوان الرسالة</label>
                        <div class="form-control">
                            {{ $contact->subject }}
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label>محتوى الرسالة</label>
                        <textarea class="form-control" style="pointer-events: none">
                            {{ $contact->message }}
                        </textarea>
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                        <div class="col-sm-12">
                            <a href="/message-replay" class="btn btn-success w-100"
                                style="background: green"><span>ارسال رد</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-base-layout>
