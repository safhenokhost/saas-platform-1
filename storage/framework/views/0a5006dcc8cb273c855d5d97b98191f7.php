<?php $__env->startSection('title', 'تکمیل اطلاعات پروفایل'); ?>

<?php $__env->startSection('content'); ?>
<?php
    use App\Models\ProfileFieldValue;

    $values = ProfileFieldValue::where('user_id', auth()->id())
        ->get()
        ->keyBy('profile_field_id');
?>

<div class="container">
    <h3 class="mb-4">تکمیل اطلاعات پروفایل</h3>

    <button type="button" id="enableEdit" class="btn btn-warning mb-3">
        ویرایش پروفایل
    </button>

    <form method="POST" action="<?php echo e(route('profile.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $value = old($field->key, $values[$field->id]->value ?? '');
            ?>

            <div class="mb-3">
                <label class="form-label">
                    <?php echo e($field->label); ?>

                    <?php if($field->required): ?>
                        <span class="text-danger">*</span>
                    <?php endif; ?>
                </label>

                <?php switch($field->type):

                    case ('text'): ?>
                        <input
                            type="text"
                            name="<?php echo e($field->key); ?>"
                            class="form-control profile-input bg-light text-muted"
                            value="<?php echo e($value); ?>"
                            <?php echo e($field->required ? 'required' : ''); ?>

                            disabled
                        >
                        <?php break; ?>

                    <?php case ('number'): ?>
                        <input
                            type="text"
                            name="<?php echo e($field->key); ?>"
                            class="form-control profile-input bg-light text-muted"
                            value="<?php echo e($value); ?>"
                            <?php echo e($field->required ? 'required' : ''); ?>

                            disabled
                        >
                        <?php break; ?>

                    <?php case ('textarea'): ?>
                        <textarea
                            name="<?php echo e($field->key); ?>"
                            class="form-control profile-input bg-light text-muted"
                            rows="3"
                            <?php echo e($field->required ? 'required' : ''); ?>

                            disabled
                        ><?php echo e($value); ?></textarea>
                        <?php break; ?>

                    <?php case ('map'): ?>
                        <div id="map" style="height: 300px; border-radius: 8px; border:1px solid #ccc;"></div>

                        <input type="hidden" id="lat" name="lat" value="<?php echo e(old('lat', $profile->lat ?? '')); ?>">
                        <input type="hidden" id="lng" name="lng" value="<?php echo e(old('lng', $profile->lng ?? '')); ?>">
                        <input type="hidden" id="address" name="address" value="<?php echo e(old('address', $profile->address ?? '')); ?>">
                        <?php break; ?>

                    <?php default: ?>
                        <input
                            type="text"
                            name="<?php echo e($field->key); ?>"
                            class="form-control profile-input bg-light text-muted"
                            value="<?php echo e($value); ?>"
                            disabled
                        >
                <?php endswitch; ?>

                <?php $__errorArgs = [$field->key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="text-danger"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <button type="submit" class="btn btn-primary w-100">
            ذخیره اطلاعات
        </button>
    </form>
</div>


<link rel="stylesheet" href="<?php echo e(asset('vendor/leaflet/leaflet.css')); ?>">
<script src="<?php echo e(asset('vendor/leaflet/leaflet.js')); ?>"></script>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\saas-platform\resources\views/complete-profile.blade.php ENDPATH**/ ?>