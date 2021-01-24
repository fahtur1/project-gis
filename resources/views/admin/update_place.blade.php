@extends('layout/app')

@section('content')
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Update Place</h4>
                    <p class="card-category">Fill the form to update a place</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_data.post') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md">
                                <h5>Choose Coordinate</h5>
                                <div id="map" style="height: 200px; width: 100%" class="w-100"></div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Longitude</label>
                                    <input type="text" name="id_feature" value="{{ $list['id_feature'] }}" hidden>
                                    <input type="text" name="longitude" id="longitude" class="form-control"
                                           value="{{ $list['geometry']['coordinates'][0] }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Latitude</label>
                                    <input type="text" name="latitude" id="latitude" class="form-control"
                                           value="{{ $list['geometry']['coordinates'][1] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Nama Toko</label>
                                    <input type="text" name="nama_toko" class="form-control"
                                           value="{{ $list['property']['nama_toko'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group bmd-form-group">
                                    <label>Status Resmi</label>
                                    <select class="form-control" name="status_resmi" id="exampleFormControlSelect1">
                                        @if ($list['property']['status_resmi'] == 'Resmi')
                                            <option value="Resmi" selected>Resmi</option>
                                            <option value="Tidak resmi">Tidak Resmi</option>
                                        @else
                                            <option value="Resmi">Resmi</option>
                                            <option value="Tidak resmi" selected>Tidak Resmi</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Alamat</label>
                                        <textarea class="form-control" name="alamat"
                                                  rows="3">{{ $list['property']['alamat'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4 text-center">
                                <img src="{{ asset('img/places/' . $list['property']['gambar']) }}"
                                     class="img-thumbnail" width="200"
                                     alt="..." id="thumbnail">
                            </div>
                            <div class="col-md-8">
                                <div class="form-group bmd-form-group">
                                    <label>Gambar</label>
                                    <input type="file" name="gambar" id="gambar" class="form-control"
                                           style="position: initial; opacity: 1">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let mapCenter = [0.510440, 101.438309]; // Coordinat Riau
        let map = L.map('map').setView(mapCenter, 12);
        let accessToken = 'pk.eyJ1IjoiZmFodHVyMSIsImEiOiJja2owbm1wNXYxcXdwMnFwMjl6OW43Zno4In0.F2jdwFNykOh79BFbI01vtg';

        let marker = L.marker([0, 0]).addTo(map);

        let longitude = document.getElementById('longitude');
        let latitude = document.getElementById('latitude');


        const updateMarker = (lat, lng) => {
            marker
                .setLatLng([lat, lng])
                .bindPopUp("Your Location : " + marker.getLatLng().toString())
                .openPopup();

            return false;
        }

        const init = async () => {
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                maxZoom: 18,
                tileSize: 512,
                zoomOffset: -1,
                accessToken: accessToken
            }).addTo(map);

            document.getElementById('gambar').addEventListener('change', (e) => {
                let url = URL.createObjectURL(e.target.files[0]);

                document.getElementById('thumbnail').src = url;
            }, false);

            map.on('click', (e) => {
                let lat = e.latlng.lat;
                let lng = e.latlng.lng;

                latitude.value = lat;
                longitude.value = lng;

                updateMarker(lat, lng);
            });
        }

        init();

    </script>
@endpush
