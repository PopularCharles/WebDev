<?php $page="test"; ?>

<?php $__env->startSection('content'); ?>
<div class='page-wrapper'>
<table>
    <tr>
        <th>Day</th>
        <th>Number</th>
    </tr>
     <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <th><?php echo e($data->Day); ?></th>
        <th><?php echo e($data->Number); ?></th>
        <th><button id="editButton" onclick="showEditForm()">Edit</button></th>
        <th>
            <form action="<?php echo e(route('data.destroy', $data->Day)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type='hidden' name = 'day1' value = "<?php echo e($data->Day); ?>">
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </th>
    </tr>   
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <th><button id="addButton" onclick="showAddForm()">Add</button></th>
    </tr>
</table>

    <form id="addForm" style="display: none;" method="POST" action="<?php echo e(route('addtest.custom')); ?>">
    <?php echo csrf_field(); ?>	
    <label for="Day">Day:</label><br>
    <input type="text" id="day" name="day"><br>
    <label for="Number">Number</label><br>
    <input type="text" id="number" name="number"><br>
    <input type="submit" value="Submit">
    </form>

    <form id="editForm" style="display: none;" method="POST" action="<?php echo e(route('data.update', $data->Day)); ?>">
    <?php echo csrf_field(); ?>
    <label for="Day">Day:</label><br>
    <input type="text" id="day" name="day" value="<?php echo e($data->Day); ?>" readonly><br>
    <label for="Number">Number</label><br>
    <input type="text" id="number" name="number" value="<?php echo e($data->number); ?>"><br>
    <input type="submit" value="Submit">
    </form>
</div>


    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
function showAddForm() {
document.getElementById("addForm").style.display = "block";
document.getElementById("editForm").style.display = "none";
}
function showEditForm() {
 document.getElementById("editForm").style.display = "block";
 document.getElementById("addForm").style.display = "none";
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\example-app\resources\views/test.blade.php ENDPATH**/ ?>