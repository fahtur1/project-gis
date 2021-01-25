@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
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
