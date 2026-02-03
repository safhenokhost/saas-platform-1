<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'داشبورد'); ?></title>

    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>
<?php echo $__env->yieldContent('scripts'); ?>
<body>

<header style="padding: 16px; background:#222; color:#fff">
    خوش آمدی 👋 <?php echo e(auth()->user()->mobile ?? ''); ?>

</header>

<main style="padding: 24px">
    <?php echo $__env->yieldContent('content'); ?>
</main>

</body>
</html>
<?php /**PATH C:\laragon\www\saas-platform\resources\views/layouts/app.blade.php ENDPATH**/ ?>