@extends('layout.user_app')

@section('content')
    <div class="section_service_main">
        <div class="section_service_2">
            <h1 class="service_text">Toko Komputer di Pekanbaru</h1>
            <div class="row mt-5 justify-content-center">
                <div class="col-md-10" style="height: 500px">
                    <div id="map" class="w-100 h-100"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let mapCenter = [0.510440, 101.438309]; // Coordinat Riau
        let map = L.map('map').setView(mapCenter, 12);
        let accessToken = 'pk.eyJ1IjoiZmFodHVyMSIsImEiOiJja2owbm1wNXYxcXdwMnFwMjl6OW43Zno4In0.F2jdwFNykOh79BFbI01vtg'

        const init = async () => {
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                maxZoom: 18,
                tileSize: 512,
                zoomOffset: -1,
                accessToken: accessToken
            }).addTo(map);

            const layerResmi = L.geoJson(@json($geojson), {
                filter: function (feature, layer) {
                    return feature.property['status_resmi'] === "Resmi"
                },
                onEachFeature: function (feature, layer) {
                    const data = feature.property;

                    layer.bindPopup(`<b>${data['nama_toko']}</b><br>(${data['status_resmi']})<br>${data['gambar']}`);

                    const icon = L.icon({
                        iconUrl: '{{ asset('img') }}/marker.png',
                        iconSize: [40, 40],
                        popupAnchor: [0, -10]
                    });

                    layer.setIcon(icon);
                }
            }).addTo(map);

            const layerTidakResmi = L.geoJson(@json($geojson), {
                filter: function (feature, layer) {
                    return feature.property['status_resmi'] === "Tidak resmi"
                },
                onEachFeature: function (feature, layer) {
                    const data = feature.property;

                    layer.bindPopup(`<b>${data['nama_toko']}</b><br>(${data['status_resmi']})<br>${data['gambar']}`);
                }
            }).addTo(map);

            const overlay = {
                "Resmi": layerResmi,
                "Tidak resmi": layerTidakResmi
            }

            L.control.layers(null, overlay).addTo(map)
        }

        init();
    </script>
@endpush
