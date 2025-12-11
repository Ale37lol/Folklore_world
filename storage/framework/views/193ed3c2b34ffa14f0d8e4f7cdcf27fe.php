

<?php $__env->startSection('title', 'Explore World Folklore'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-12">
        <h1 class="text-4xl font-bold pl-4 mb-6">Explore World Folklore</h1>
        <p class="text-lg pl-4 mb-8">Discover myths, legends, deities, and creatures from cultures around the world.</p>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">Featured Cultures</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <?php $__currentLoopData = $cultures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $culture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('cultures.show', $culture)); ?>" class="block hover:shadow-lg transition-shadow">
                        <div class="bg-white rounded-lg overflow-hidden shadow-md">
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <?php
                                    $filename =
                                        Str::slug($culture->name) . '/' . Str::slug($culture->name) . ' (1).png';
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
                                <h3 class="font-bold text-lg"><?php echo e($culture->name); ?></h3>
                                <p class="text-gray-600"><?php echo e($culture->region); ?></p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Featured Deities</h2>
                <div class="space-y-4">
                    <?php $__currentLoopData = $featuredDeities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('deities.show', $deity)); ?>"
                            class="flex items-center space-x-4 hover:bg-gray-100 p-2 rounded">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                <?php
                                    $filename = Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpeg';
                                    $relativePath = 'storage/Deities/' . $filename;
                                    $fullPath = public_path($relativePath);
                                ?>

                                <?php if(file_exists($fullPath)): ?>
                                    <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($deity->name); ?>"
                                        class="object-cover w-full h-full" style="border-radius: 50%;">
                                <?php else: ?>
                                    <?php
                                        $filename =
                                            Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpg';
                                        $relativePath = 'storage/Deities/' . $filename;
                                        $fullPath = public_path($relativePath);
                                    ?>

                                    <?php if(file_exists($fullPath)): ?>
                                        <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($deity->name); ?>"
                                            class="object-cover w-full h-full" style="border-radius: 50%;">
                                    <?php else: ?>
                                        <span class="text-gray-500 text-sm">Immagine non trovata per
                                            <?php echo e($filename); ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div>
                                <h3 class="font-semibold"><?php echo e($deity->name); ?></h3>
                                <p class="text-sm text-gray-600"><?php echo e($deity->culture->name); ?></p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Featured Creatures</h2>
                <div class="space-y-4">
                    <?php $__currentLoopData = $featuredCreatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $creature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('creatures.show', $creature)); ?>"
                            class="flex items-center space-x-4 hover:bg-gray-100 p-2 rounded">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
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
                                    <?php
                                        $filename =
                                            Str::slug($creature->name) . '/' . Str::slug($creature->name) . ' (1).jpg';
                                        $relativePath = 'storage/Creatures/' . $filename;
                                        $fullPath = public_path($relativePath);
                                    ?>

                                    <?php if(file_exists($fullPath)): ?>
                                        <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($creature->name); ?>"
                                            class="object-cover w-full h-full" style="border-radius: 50%;">
                                    <?php else: ?>
                                        <span class="text-gray-500 text-sm">Immagine non trovata per
                                            <?php echo e($filename); ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div>
                                <h3 class="font-semibold"><?php echo e($creature->name); ?></h3>
                                <p class="text-sm text-gray-600"><?php echo e($creature->culture->name); ?></p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\folklore-world\resources\views/home.blade.php ENDPATH**/ ?>