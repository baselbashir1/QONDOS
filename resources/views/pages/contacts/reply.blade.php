<x-base-layout>

    <x-slot:pageTitle>ارسال رد</x-slot>

        <div class="row mb-4 layout-spacing layout-top-spacing">
            <form method="POST" action="/message-replay/{{ $contact->id }}">
                @csrf
                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row mb-4">
                            <label>محتوى الرسالة</label>
                            <textarea name="reply" class="form-control" style="border-width: 3px; border-color:lightseagreen">
                        {{ $contact->message }}
                        </textarea>
                        </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success w-100"
                                    style="background: green"><span>ارسال الرد</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-base-layout>
