<?php $__env->startSection('title', 'مدیریت فیلدهای پروفایل'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h4 class="mb-4">مدیریت فیلدهای پروفایل</h4>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <div class="card mb-4">
        <div class="card-header">➕ افزودن فیلد جدید</div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('admin.profile-fields.store')); ?>" class="row g-3">
                <?php echo csrf_field(); ?>

                <div class="col-md-3">
                    <label class="form-label">عنوان</label>
                    <input type="text" name="label" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">کلید (key)</label>
                    <input type="text" name="key" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">نوع فیلد</label>
                    <select name="type" class="form-select">
                        <option value="text">متن</option>
                        <option value="number">عدد</option>
                        <option value="textarea">متن بلند</option>
                        <option value="map">نقشه</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="required" id="required_new">
                        <label class="form-check-label" for="required_new">
                            اجباری
                        </label>
                    </div>
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <button class="btn btn-success w-100">ثبت</button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="card">
        <div class="card-header">📋 لیست فیلدها</div>
        <div class="card-body">

            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="border rounded p-3 mb-3">

                    
                    <form method="POST" action="<?php echo e(route('admin.profile-fields.update', $field->id)); ?>" class="row g-2 align-items-end">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="col-md-3">
                            <input type="text" name="label" value="<?php echo e($field->label); ?>" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="key" value="<?php echo e($field->key); ?>" class="form-control" required>
                        </div>

                        <div class="col-md-2">
                            <select name="type" class="form-select">
                                <option value="text" <?php echo e($field->type === 'text' ? 'selected' : ''); ?>>متن</option>
                                <option value="number" <?php echo e($field->type === 'number' ? 'selected' : ''); ?>>عدد</option>
                                <option value="textarea" <?php echo e($field->type === 'textarea' ? 'selected' : ''); ?>>متن بلند</option>
                                <option value="map" <?php echo e($field->type === 'map' ? 'selected' : ''); ?>>نقشه</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="required" value="1" <?php echo e($field->required ? 'checked' : ''); ?>>
                                <label class="form-check-label">اجباری</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="enabled" value="1" <?php echo e($field->enabled ? 'checked' : ''); ?>>
                                <label class="form-check-label">فعال</label>
                            </div>
                        </div>

                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-sm btn-success">ذخیره</button>
                        </div>
                    </form>

                    
                    <form method="POST" action="<?php echo e(route('admin.profile-fields.destroy', $field->id)); ?>" class="mt-2"
                          onsubmit="return confirm('حذف شود؟')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\saas-platform\resources\views/admin/profile-fields/index.blade.php ENDPATH**/ ?>