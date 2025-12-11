

<?php $__env->startSection('title', 'Deities of the World'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-8 pl-4 pr-4">
        <h1 class="text-3xl font-bold mb-4">Deities of the World</h1>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <p class="text-gray-600">Explore gods and goddesses from different cultures and mythologies.</p>
            <form action="<?php echo e(route('deities.search')); ?>" method="GET" class="w-full md:w-auto">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                       placeholder="Search deities..."
                       class="px-4 py-2 border rounded-lg shadow-sm w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </form>
        </div>

        <?php if(session('error')): ?>
            <p class="mt-4 text-red-600 font-semibold"><?php echo e(session('error')); ?></p>
        <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 pl-6 pr-6">
        <?php $__currentLoopData = $deities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('deities.show', $deity)); ?>" class="block hover:shadow-lg transition-shadow" style="width: 95%">
                <div class="bg-white rounded-lg overflow-hidden shadow-md h-full">
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <?php
                            $filename = Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpeg';
                            $relativePath = 'storage/Deities/' . $filename;
                            $fullPath = public_path($relativePath);
                        ?>

                        <?php if(file_exists($fullPath)): ?>
                            <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($deity->name); ?>" class="object-cover w-full h-full" style="object-fit: cover; object-position: top;">
                        <?php else: ?>
                            <?php
                                $filename = Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpg';
                                $relativePath = 'storage/Deities/' . $filename;
                                $fullPath = public_path($relativePath);
                            ?>

                            <?php if(file_exists($fullPath)): ?>
                                <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($deity->name); ?>" class="object-cover w-full h-full" style="object-fit: cover; object-position: top;">
                            <?php else: ?>
                                <span class="text-gray-500 text-sm">Immagine non trovata per <?php echo e($filename); ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-1"><?php echo e($deity->name); ?></h3>
                        <p class="text-gray-600 mb-2"><?php echo e($deity->culture->name); ?></p>
                        <p class="text-sm text-gray-500 line-clamp-2"><?php echo e(Str::limit($deity->description, 100)); ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-8">
        <?php echo e($deities->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\folklore-world\resources\views/deities/index.blade.php ENDPATH**/ ?>