@extends('layouts.app')

@section('title', 'تکمیل اطلاعات پروفایل')

@section('content')
@php
    use App\Models\ProfileFieldValue;

    $values = ProfileFieldValue::where('user_id', auth()->id())
        ->get()
        ->keyBy('profile_field_id');
@endphp

<div class="container">
    <h3 class="mb-4">تکمیل اطلاعات پروفایل</h3>

    <button type="button" id="enableEdit" class="btn btn-warning mb-3">
        ویرایش پروفایل
    </button>

    <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
        @csrf

        @foreach($fields as $field)
            @php
                $value = old($field->key, $values[$field->id]->value ?? '');
            @endphp

            <div class="mb-3">
                <label class="form-label">
                    {{ $field->label }}
                    @if($field->required)
                        <span class="text-danger">*</span>
                    @endif
                </label>

                @switch($field->type)

                    @case('text')
                        <input
                            type="text"
                            name="{{ $field->key }}"
                            class="form-control profile-input bg-light text-muted"
                            value="{{ $value }}"
                            {{ $field->required ? 'required' : '' }}
                            disabled
                        >
                        @break

                    @case('number')
                        <input
                            type="text"
                            name="{{ $field->key }}"
                            class="form-control profile-input bg-light text-muted"
                            value="{{ $value }}"
                            {{ $field->required ? 'required' : '' }}
                            disabled
                        >
                        @break

                    @case('textarea')
                        <textarea
                            name="{{ $field->key }}"
                            class="form-control profile-input bg-light text-muted"
                            rows="3"
                            {{ $field->required ? 'required' : '' }}
                            disabled
                        >{{ $value }}</textarea>
                        @break

                    @case('map')
                        <div id="map" style="height: 300px; border-radius: 8px; border:1px solid #ccc;"></div>

                        <input type="hidden" id="lat" name="lat" value="{{ old('lat', $profile->lat ?? '') }}">
                        <input type="hidden" id="lng" name="lng" value="{{ old('lng', $profile->lng ?? '') }}">
                        <input type="hidden" id="address" name="address" value="{{ old('address', $profile->address ?? '') }}">
                        @break

                    @default
                        <input
                            type="text"
                            name="{{ $field->key }}"
                            class="form-control profile-input bg-light text-muted"
                            value="{{ $value }}"
                            disabled
                        >
                @endswitch

                @error($field->key)
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary w-100">
            ذخیره اطلاعات
        </button>
    </form>
</div>

{{-- Leaflet --}}
<link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}">
<script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const enableBtn = document.getElementById('enableEdit');
    const inputs = document.querySelectorAll('.profile-input');

    enableBtn.addEventListener('click', function () {
        inputs.forEach(input => {
            input.removeAttribute('disabled');
            input.classList.remove('bg-light', 'text-muted');
        });

        enableBtn.innerText = 'در حال ویرایش...';
        enableBtn.disabled = true;
    });

    const mapEl = document.getElementById('map');
    if (!mapEl) return;

    const latInput = document.getElementById('lat');
    const lngInput = document.getElementById('lng');
    const addressInput = document.getElementById('address');

    const defaultLat = latInput.value || 35.6892;
    const defaultLng = lngInput.value || 51.3890;

    const map = L.map('map').setView([defaultLat, defaultLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    let marker = null;

    if (latInput.value && lngInput.value) {
        marker = L.marker([latInput.value, lngInput.value]).addTo(map);
    }

    map.on('click', function (e) {
        if (marker) map.removeLayer(marker);
        marker = L.marker(e.latlng).addTo(map);

        latInput.value = e.latlng.lat;
        lngInput.value = e.latlng.lng;

        if (addressInput) {
            addressInput.value = `Lat: ${e.latlng.lat.toFixed(5)}, Lng: ${e.latlng.lng.toFixed(5)}`;
        }
    });

});
</script>
@endsection
