

<?php $__env->startSection('title', 'Search Results for Legends'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-4">Risultati ricerca: "<?php echo e($query); ?>"</h1>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <p class="text-gray-600">Explore legends and myths from different cultures and traditions.</p>
            <form action="<?php echo e(route('legends.search')); ?>" method="GET" class="w-full md:w-auto">
                <input type="text" name="q" value="<?php echo e($query); ?>" placeholder="Search legends..."
                    class="px-4 py-2 border rounded-lg shadow-sm w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </form>
        </div>
    </div>
    <?php if($legends->count() > 0): ?>
        <div class="space-y-6">
            <?php $__currentLoopData = $legends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $legend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('legends.show', $legend)); ?>"
                    class="block bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="w-full">
                                <h2 class="text-xl font-bold mb-2"><?php echo e($legend->title); ?></h2>
                                <p class="text-gray-600 mb-3"><?php echo e($legend->culture->name); ?></p>
                                <p class="text-gray-700">
                                    <?php echo e(\Illuminate\Support\Str::limit(strip_tags($legend->content), 200)); ?></p>
                                <?php if($legend->is_verified): ?>
                                    <span
                                        class="inline-block mt-3 px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Verified</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-8">
            <?php echo e($legends->links()); ?>

        </div>
    <?php else: ?>
        <p class="text-gray-600">No legends found matching your search.</p>
    <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\folklore-world\resources\views/legends/search-results.blade.php ENDPATH**/ ?>