

<?php $__env->startSection('title', 'Search Results'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Search Results for "<?php echo e($query); ?>"</h1>
        
        <?php if($deities->count() > 0): ?>
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Deities</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $deities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('partials.deity-card', ['deity' => $deity], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php if($deities->count() == 5): ?>
                    <div class="mt-4 text-right">
                        <a href="<?php echo e(route('deities.search')); ?>?q=<?php echo e($query); ?>" class="text-blue-600 hover:underline">View all deity results</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <?php if($creatures->count() > 0): ?>
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Creatures</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $creatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $creature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('partials.creature-card', ['creature' => $creature], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php if($creatures->count() == 5): ?>
                    <div class="mt-4 text-right">
                        <a href="<?php echo e(route('creatures.search')); ?>?q=<?php echo e($query); ?>" class="text-blue-600 hover:underline">View all creature results</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <?php if($legends->count() > 0): ?>
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Legends</h2>
                <div class="space-y-4">
                    <?php $__currentLoopData = $legends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $legend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('partials.legend-card', ['legend' => $legend], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php if($legends->count() == 5): ?>
                    <div class="mt-4 text-right">
                        <a href="<?php echo e(route('legends.search')); ?>?q=<?php echo e($query); ?>" class="text-blue-600 hover:underline">View all legend results</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <?php if($deities->count() == 0 && $creatures->count() == 0 && $legends->count() == 0): ?>
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No results found</h3>
                <p class="mt-1 text-gray-500">Try different search terms.</p>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\folklore-world\resources\views/search.blade.php ENDPATH**/ ?>