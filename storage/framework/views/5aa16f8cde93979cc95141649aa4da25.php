

<?php $__env->startSection('title', 'World Cultures'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-8 pl-4">
        <h1 class="text-3xl font-bold mb-4">World Cultures</h1>
        <p class="text-gray-600">Explore the rich folklore traditions from cultures around the world.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-1 pl-6 pr-6">
        <?php $__currentLoopData = $cultures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $culture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('cultures.show', $culture)); ?>" class="block hover:shadow-lg transition-shadow" style="width: 95%">
                <div class="bg-white rounded-lg overflow-hidden shadow-md h-full">
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <?php
                            $filename = Str::slug($culture->name) .'/'. Str::slug($culture->name) .' (1).png';
                            $relativePath = 'storage/Cultures/' . $filename;
                            $fullPath = public_path($relativePath);
                        ?>

                        <?php if(file_exists($fullPath)): ?>
                            <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($culture->name); ?>"
                                class="object-cover w-full h-full">
                        <?php else: ?>
                            <span class="text-gray-500 text-sm">Immagine non trovata per <?php echo e($filename); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-1"><?php echo e($culture->name); ?></h3>
                        <p class="text-gray-600 mb-2"><?php echo e($culture->region); ?></p>
                        <p class="text-sm text-gray-500 line-clamp-2"><?php echo e(Str::limit($culture->description, 100)); ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-8">
        <?php echo e($cultures->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\folklore-world\resources\views/cultures/index.blade.php ENDPATH**/ ?>