<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <?php echo $__env->make('layout.partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </head>
  <?php if(!Route::is(['error-404','error-500'])): ?>
<body>
 <?php endif; ?> 
<?php if(Route::is(['error-404','error-500'])): ?>
<body class="error-page">
<?php endif; ?> 
<?php if(Route::is(['forgetpassword','resetpassword','signin','signup'])): ?>
<body class="account-page">
<?php endif; ?> 
  <!-- Main Wrapper -->
<div class="main-wrapper">
  <?php if(!Route::is(['error-404','error-500','forgetpassword','resetpassword','login','signin','signup'])): ?>
    <?php echo $__env->make('layout.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?> 
  <?php if(!Route::is(['error-404','error-500','forgetpassword','pos','resetpassword','login','signin','signup'])): ?>
    <?php echo $__env->make('layout.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?> 
    <?php echo $__env->yieldContent('content'); ?>
</div>		
<!-- /Main Wrapper -->
    <?php echo $__env->yieldContent('script'); ?>
  </body>
</html><?php /**PATH C:\xampp\htdocs\example-app\resources\views/layout/mainlayout.blade.php ENDPATH**/ ?>