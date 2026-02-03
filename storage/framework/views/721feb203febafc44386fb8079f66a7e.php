<?php $__env->startSection('title', 'داشبورد'); ?>

<?php $__env->startSection('content'); ?>
    <h2>داشبورد</h2>

    <p>شما با موفقیت وارد شده‌اید ✅</p>
<?php $__env->stopSection(); ?>


<a href="<?php echo e(route('force.logout')); ?>" style="color:red">
    خروج سراسری (برای تست)
</a>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\saas-platform\resources\views/dashboard.blade.php ENDPATH**/ ?>