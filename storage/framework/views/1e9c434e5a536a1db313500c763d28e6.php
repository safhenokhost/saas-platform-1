<?php $__env->startSection('title', 'ورود'); ?>

<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>ورود</title>

    <style>
        body {
            font-family: Vazirmatn, Tahoma, sans-serif;
            background: #f5f5f5;
        }
        .box {
            width: 360px;
            margin: 100px auto;
            background: #fff;
            padding: 24px;
            border-radius: 8px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 12px;
        }
    </style>
</head>
<body>
<?php $__env->startSection('content'); ?>
   <div class="box">
    <h3>ورود با شماره موبایل</h3>

    <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>

        <input
            type="text"
            name="mobile"
            placeholder="09123456789"
            required
        >

        <button type="submit">ورود</button>
    </form>
</div>
<?php $__env->stopSection(); ?>



</body>
</html>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\saas-platform\resources\views/auth/login.blade.php ENDPATH**/ ?>