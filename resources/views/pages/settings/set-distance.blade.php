<x-base-layout>

    <x-slot:pageTitle>تفاصيل العرض</x-slot>

    <div class="row mb-4 layout-spacing layout-top-spacing">
        <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="widget-content widget-content-area ecommerce-create-section">
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label class="ml-1 mr-1">اسم العميل</label>
                        <div class="form-control" style="pointer-events: none">{{ $offer->client->name }}</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label class="ml-1 mr-1">اسم الفني</label>
                        <div class="form-control" style="pointer-events: none">{{ $offer->maintenanceTechnician->name }}
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label class="ml-1 mr-1">تقييم الفني</label>
                        <div class="form-control" style="pointer-events: none">
                            {{ $offer->maintenanceTechnician->ratings->avg('rate') }}</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label class="ml-1 mr-1">المسافة بين الفني والعميل</label>
                        <div class="form-control" style="pointer-events: none">
                            {{ intval($distance) }}m</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label class="ml-1 mr-1">محتوى العرض</label>
                        <textarea class="form-control" style="pointer-events: none">{{ $offer->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-base-layout>
