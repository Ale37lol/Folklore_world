

<?php $__env->startSection('title', $culture->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex flex-col md:flex-row gap-8 mb-8">
            <div class="md:w-1/3">
                <div class="w-full bg-gray-200 rounded-lg overflow-hidden">
                    <?php
                        $filename = Str::slug($culture->name) . '/' . Str::slug($culture->name) . ' (1).png';
                        $relativePath = 'storage/Cultures/' . $filename;
                        $fullPath = public_path($relativePath);
                    ?>

                    <?php if(file_exists($fullPath)): ?>
                        <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($culture->name); ?>" class="w-full rounded-lg object-cover"
                            style="object-position: top;">
                    <?php else: ?>
                        <div class="flex items-center justify-center h-48 text-gray-500 text-sm">
                            Immagine non trovata per <?php echo e($filename); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Dettagli e descrizione -->
            <div class="md:w-2/3 flex flex-col">
                <h1 class="text-3xl font-bold mb-4"><?php echo e($culture->name); ?></h1>
                <p class="text-gray-700 mb-4"><?php echo nl2br(e($cultureText)); ?></p>
            </div>
        </div>

        <!-- Galleria immagini -->
        <?php
            $galleryDir = public_path('storage/Cultures/' . $slugName);
            $galleryRelativeDir = 'storage/Cultures/' . $slugName;
            $galleryImages = [];

            if (File::exists($galleryDir)) {
                $galleryImages = collect(File::files($galleryDir))
                    ->filter(function ($file) {
                        return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp']);
                    })
                    ->map(function ($file) use ($galleryRelativeDir) {
                        return asset($galleryRelativeDir . '/' . $file->getFilename());
                    });
            }
        ?>

        <?php if($galleryImages->count() > 1): ?>
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Gallery</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($img); ?>" data-lightbox="gallery" data-title="<?php echo e($culture->name); ?>">
                            <img src="<?php echo e($img); ?>" alt="<?php echo e($culture->name); ?>"
                                class="w-full h-45 object-cover rounded-lg shadow hover:shadow-lg transition-shadow">
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Gallery</h2>
                <p class="text-gray-500">No images available for this culture.</p>
            </div>
        <?php endif; ?>

        <div class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Deities of <?php echo e($culture->name); ?></h2>
            <?php if($culture->deities->count() > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                    <?php $__currentLoopData = $culture->deities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('deities.show', $deity)); ?>" class="block hover:shadow-lg transition-shadow">
                            <div class="bg-white rounded-lg overflow-hidden shadow-md h-full flex flex-col">
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                                    <?php
                                        $filename =
                                            Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpeg';
                                        $relativePath = 'storage/Deities/' . $filename;
                                        $fullPath = public_path($relativePath);
                                    ?>

                                    <?php if(file_exists($fullPath)): ?>
                                        <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($deity->name); ?>"
                                            class="object-cover w-full h-full"
                                            style="object-fit: cover; object-position: top;">
                                    <?php else: ?>
                                        <?php
                                            $filename =
                                                Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpg';
                                            $relativePath = 'storage/Deities/' . $filename;
                                            $fullPath = public_path($relativePath);
                                        ?>

                                        <?php if(file_exists($fullPath)): ?>
                                            <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($deity->name); ?>"
                                                class="object-cover w-full h-full"
                                                style="object-fit: cover; object-position: top;">
                                        <?php else: ?>
                                            <span class="text-gray-500 text-sm">Immagine non trovata per
                                                <?php echo e($filename); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="p-4 flex-grow flex flex-col">
                                    <h3 class="font-bold text-lg mb-1"><?php echo e($deity->name); ?></h3>
                                    <p class="text-gray-600 mb-2"><?php echo e($deity->domain ?? 'Divine domain'); ?></p>
                                    <p class="text-sm text-gray-500 line-clamp-2 mt-auto">
                                        <?php echo e(Str::limit($deity->description ?? 'No description available', 100)); ?>

                                    </p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-gray-500">No deities recorded for this culture yet.</p>
            <?php endif; ?>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Creatures of <?php echo e($culture->name); ?></h2>
            <?php if($culture->creatures->count() > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                    <?php $__currentLoopData = $culture->creatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $creature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('creatures.show', $creature)); ?>" class="block hover:shadow-lg transition-shadow">
                            <div class="bg-white rounded-lg overflow-hidden shadow-md h-full flex flex-col">
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                                    <?php
                            $filename = Str::slug($creature->name) . '/' . Str::slug($creature->name) . ' (1).jpeg';
                            $relativePath = 'storage/Creatures/' . $filename;
                            $fullPath = public_path($relativePath);
                        ?>

                        <?php if(file_exists($fullPath)): ?>
                            <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($creature->name); ?>"
                                class="object-cover w-full h-full" style="object-fit: cover; object-position: top;">
                        <?php else: ?>
                            <?php
                                $filename = Str::slug($creature->name) . '/' . Str::slug($creature->name) . ' (1).jpg';
                                $relativePath = 'storage/Creatures/' . $filename;
                                $fullPath = public_path($relativePath);
                            ?>

                            <?php if(file_exists($fullPath)): ?>
                                <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($creature->name); ?>"
                                    class="object-cover w-full h-full" style="object-fit: cover; object-position: top;">
                            <?php else: ?>
                                <span class="text-gray-500 text-sm">Immagine non trovata per <?php echo e($filename); ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                                </div>

                                <div class="p-4 flex-grow flex flex-col">
                                    <h3 class="font-bold text-lg mb-1"><?php echo e($creature->name); ?></h3>
                                    <p class="text-gray-600 mb-2"><?php echo e($creature->domain ?? 'Divine domain'); ?></p>
                                    <p class="text-sm text-gray-500 line-clamp-2 mt-auto">
                                        <?php echo e(Str::limit($creature->description ?? 'No description available', 100)); ?>

                                    </p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-gray-500">No creatures recorded for this culture yet.</p>
            <?php endif; ?>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Legends of <?php echo e($culture->name); ?></h2>
            <?php if($culture->legends->count() > 0): ?>
                <div class="space-y-6">
                    <?php $__currentLoopData = $culture->legends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $legend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('legends.show', $legend)); ?>"
                            class="block hover:bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h3 class="font-bold text-lg mb-1"><?php echo e($legend->title); ?></h3>
                            <p class="text-sm text-gray-500 line-clamp-2"><?php echo e(Str::limit($legend->content, 200)); ?></p>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-gray-500">No legends recorded for this culture yet.</p>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\folklore-world\resources\views/cultures/show.blade.php ENDPATH**/ ?>