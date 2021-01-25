@extends('layout.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-profile">
                <div class="card-body">
                    <div id="map" style="height: 350px;" class="w-100"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="javascript:;">
                        @if(str_contains($feature['property']['gambar'], 'http') > 0)
                            <script>
                                let img = @json($feature['property']['gambar']);
                                if (img.includes('<img')) {
                                    document.write(img);
                                } else {
                                    let html = `<img class="img" src="${img}">`;
                                    document.write(html);
                                }
                            </script>
                        @else
                            <img src="{{ asset('img/places/' . $feature['property']['gambar']) }}"
                                 class="img" width="200">
                        @endif
                    </a>
                </div>
                <div class="card-body">
                    <h3 class="card-category text-black-50">{{ $feature['property']['nama_toko'] }}</h3>
                    <h4 class="card-title text-gray">({{ $feature['property']['status_resmi'] }})</h4>

                    <h4 class="mt-4">Koordinat</h4>
                    <h5 class="card-description">
                        [ {{ $feature['geometry']['coordinates'][0] }}, {{ $feature['geometry']['coordinates'][1] }} ]
                    </h5>

                    <h4 class="mt-4">Alamat</h4>
                    <h5 class="card-description">
                        {{ $feature['property']['alamat'] }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let x =  {{ $feature['geometry']['coordinates'][0] }};
        let y = {{ $feature['geometry']['coordinates'][1] }};

        let mapCenter = [y, x]; // Coordinat Riau
        let map = L.map('map').setView(mapCenter, 17);
        let accessToken = 'pk.eyJ1IjoiZmFodHVyMSIsImEiOiJja2owbm1wNXYxcXdwMnFwMjl6OW43Zno4In0.F2jdwFNykOh79BFbI01vtg';

        let marker = L.marker([y, x]).addTo(map);

        const init = async () => {
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                maxZoom: 18,
                tileSize: 512,
                zoomOffset: -1,
                accessToken: accessToken
            }).addTo(map);
        }

        init();

    </script>
@endpush
