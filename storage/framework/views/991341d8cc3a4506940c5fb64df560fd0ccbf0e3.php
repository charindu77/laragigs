<?php if(session()->has('success')): ?>
<div x-data="{show:true}" x-init="setTimeout( () => show = false, 3000)" x-show="show"
 class="fixed top-0 left-1/2 transform bg-green-600 text-white px-5 py-3 -translate-x-1/2">
    <p>
        <?php echo e(session('success')); ?>

    </p>
</div>
<?php endif; ?><?php /**PATH D:\Laravel-projects\laragigs\resources\views/components/flash-message.blade.php ENDPATH**/ ?>