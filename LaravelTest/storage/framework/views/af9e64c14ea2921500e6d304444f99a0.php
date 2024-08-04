<?php if(Route::is(['index-one','index-three'])): ?> 
<!-- Sidebar -->
<?php if(!Route::is(['index-three'])): ?>
<div class="sidebar new-header sidebar-one">
<?php endif; ?>
<?php if(Route::is(['index-three'])): ?>
<div class="sidebar side-three new-header">
<?php endif; ?>
<?php if(Route::is(['index-three'])): ?>
<div class="container">
<?php endif; ?>  
</div>
<!-- /Sidebar -->
<?php endif; ?>
<!-- Sidebar -->

<?php if(!Route::is(['index-one','index-two','index-three','index-four'])): ?>
<div class="sidebar" id="sidebar">
<?php endif; ?>
<?php if(Route::is(['index-two'])): ?>
<div class="sidebar sidebar-two" id="sidebar">
<?php endif; ?>    
    <div class="sidebar-inner slimscroll">
        <?php if(!Route::is(['index-four'])): ?>
        <div id="sidebar-menu" class="sidebar-menu">
            <?php endif; ?>
            <?php if(!Route::is(['index-four'])): ?>
            <ul>
                <li class="submenu-open">
                        <li class="<?php echo e(Request::is('index','index-two') ? 'active' : ''); ?>" >
                            <a href="<?php echo e(url('/')); ?>"><i data-feather="grid"></i><span>Home</span></a>
                        </li>
                </li>
            
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Database</h6>
                     <ul>
                        <li class="<?php echo e(Request::is('customerlist','addcustomer') ? 'active' : ''); ?>"><a href="<?php echo e(url('customerlist')); ?>"><i data-feather="user"></i><span>View Tables</span></a></li>
                        <li class="<?php echo e(Request::is('pos') ? 'active' : ''); ?>"><a href="<?php echo e(url('pos')); ?>"><i data-feather="hard-drive"></i><span>Add Data</span></a></li>
                        <li class="<?php echo e(Request::is('consultationformpage') ? 'active' : ''); ?>"><a href="<?php echo e(url('consultationformpage')); ?>"><i data-feather="list"></i><span>Consultation Form</span></a></li>
                    </ul> 
                </li>

            <?php endif; ?> 
            
        </div>
    </div>
</div>
<!-- /Sidebar --><?php /**PATH C:\xampp\htdocs\example-app\resources\views/layout/partials/sidebar.blade.php ENDPATH**/ ?>