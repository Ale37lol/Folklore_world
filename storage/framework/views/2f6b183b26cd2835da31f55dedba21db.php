

<?php $__env->startSection('title', $legend->title); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-md p-6">
    
    <div class="mb-6">
        <h1 class="text-3xl font-bold mb-2"><?php echo e($legend->title); ?></h1>
        <div class="flex items-center text-gray-600">
            <span>From <?php echo e($legend->culture->name ?? 'Unknown Culture'); ?></span>
            <?php if($legend->is_verified): ?>
                <span class="ml-2 px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Verified</span>
            <?php endif; ?>
        </div>
    </div>

    
    <?php if($legendText): ?>
        <div class="prose max-w-none">
            <?php echo nl2br(e($legendText)); ?>

        </div>
    <?php else: ?>
        <div class="text-red-500 font-semibold">
            Testo della leggenda "<?php echo e($legend->title); ?>" non disponibile.
            <?php if(auth()->check() && auth()->user()->isAdmin()): ?>
                <div class="mt-2 text-sm text-gray-600">
                    Controlla che il titolo nel database ("<?php echo e($legend->title); ?>") corrisponda esattamente a quello nel file leggende.txt
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    
    <?php if($legend->deities->count() > 0): ?>
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Related Deities</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php $__currentLoopData = $legend->deities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('deities.show', $deity)); ?>"
                       class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
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
                        <div>
                            <h3 class="font-medium"><?php echo e($deity->name); ?></h3>
                            <p class="text-sm text-gray-600">
                                <?php echo e($deity->pivot->role_in_legend ?? 'Associated deity'); ?>

                                <?php if($deity->role): ?>
                                    <span class="block text-xs text-gray-400"><?php echo e($deity->role); ?></span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

    
    <?php if($legend->creatures->count() > 0): ?>
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Related Creatures</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php $__currentLoopData = $legend->creatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $creature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('creatures.show', $creature)); ?>"
                       class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                            <?php
                                    $filename =
                                        Str::slug($creature->name) . '/' . Str::slug($creature->name) . ' (1).jpeg';
                                    $relativePath = 'storage/Creatures/' . $filename;
                                    $fullPath = public_path($relativePath);
                                ?>

                                <?php if(file_exists($fullPath)): ?>
                                    <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($creature->name); ?>"
                                        class="object-cover w-full h-full" style="border-radius: 50%;">
                                <?php else: ?>
                                    <span class="text-gray-500 text-sm">Immagine non trovata per <?php echo e($filename); ?></span>
                                <?php endif; ?>
                        </div>
                        <div>
                            <h3 class="font-medium"><?php echo e($creature->name); ?></h3>
                            <p class="text-sm text-gray-600">
                                <?php echo e($creature->pivot->role_in_legend ?? 'Associated creature'); ?>

                                <span class="block text-xs text-gray-400 capitalize"><?php echo e($creature->type); ?></span>
                            </p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\folklore-world\resources\views/legends/show.blade.php ENDPATH**/ ?>