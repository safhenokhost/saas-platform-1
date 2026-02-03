<button type="submit" class="btn btn-primary w-100" id="saveBtn" disabled>
    ذخیره اطلاعات
</button>

@case('map')
    <div id="map" class="profile-map" style="height: 300px; border-radius: 8px; border:1px solid #ccc; pointer-events:none; opacity:.6;"></div>

    <input type="hidden" id="lat" name="lat" value="{{ old('lat', $profile->lat ?? '') }}">
    <input type="hidden" id="lng" name="lng" value="{{ old('lng', $profile->lng ?? '') }}">
    <input type="hidden" id="address" name="address" value="{{ old('address', $profile->address ?? '') }}">
@break

<script>
document.addEventListener("DOMContentLoaded", function () {

    const enableBtn = document.getElementById('enableEdit');
    const inputs = document.querySelectorAll('.profile-input');
    const saveBtn = document.getElementById('saveBtn');
    const mapEl = document.getElementById('map');

    enableBtn.addEventListener('click', function () {

        inputs.forEach(input => input.removeAttribute('disabled'));

        if (mapEl) {
            mapEl.style.pointerEvents = 'auto';
            mapEl.style.opacity = '1';
        }

        saveBtn.removeAttribute('disabled');
        enableBtn.innerText = 'در حال ویرایش...';
        enableBtn.disabled = true;
    });

});
</script>
