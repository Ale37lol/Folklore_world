

<?php $__env->startSection('title', $deity->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex flex-col md:flex-row gap-8 mb-8">
            <!-- Immagine principale -->
            <div class="md:w-1/3">
                <div class="w-full bg-gray-200 rounded-lg overflow-hidden">
                    <?php
                        $filename = Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpeg';
                        $relativePath = 'storage/Deities/' . $filename;
                        $fullPath = public_path($relativePath);
                    ?>

                    <?php if(file_exists($fullPath)): ?>
                        <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($deity->name); ?>" class="w-full rounded-lg object-cover"
                            style="object-position: top;">
                    <?php else: ?>
                        <?php
                            $filename = Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpg';
                            $relativePath = 'storage/Deities/' . $filename;
                            $fullPath = public_path($relativePath);
                        ?>

                        <?php if(file_exists($fullPath)): ?>
                            <img src="<?php echo e(asset($relativePath)); ?>" alt="<?php echo e($deity->name); ?>" class="object-cover w-full h-full"
                                style="object-fit: cover; object-position: top;">
                        <?php else: ?>
                            <span class="text-gray-500 text-sm">Immagine non trovata per <?php echo e($filename); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Dettagli e descrizione -->
            <div class="md:w-2/3 flex flex-col">
                <h1 class="text-3xl font-bold mb-4"><?php echo e($deity->name); ?></h1>
                <p class="text-gray-700 mb-4"><?php echo nl2br(e($deityText)); ?></p>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold mb-2">Details</h3>
                    <p><span class="font-medium">Culture:</span> <?php echo e($deity->culture->name ?? 'Unknown'); ?></p>
                    <p><span class="font-medium">Role:</span> <?php echo e($deity->role ?? 'Unknown'); ?></p>
                </div>

                <?php if($familyRelations->count() > 0): ?>
                    <div class="mt-6">
                        <h3 class="font-semibold mb-2">Family Relations</h3>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $familyRelations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="text-sm">
                                    <?php if($relation->parent_id == $deity->id): ?>
                                        <span class="font-medium"><?php echo e($deity->name); ?></span>
                                        <span class="text-gray-500"><?php echo e($relation->relationship_type ?? 'unknown'); ?></span>
                                        <span class="font-medium"><?php echo e($relation->child->name ?? 'Unknown'); ?></span>
                                    <?php else: ?>
                                        <span class="font-medium"><?php echo e($relation->parent->name ?? 'Unknown'); ?></span>
                                        <span class="text-gray-500"><?php echo e($relation->relationship_type ?? 'unknown'); ?></span>
                                        <span class="font-medium"><?php echo e($deity->name); ?></span>
                                    <?php endif; ?>
                                    <?php if($relation->notes): ?>
                                        <p class="mt-1 text-xs text-gray-600"><?php echo e($relation->notes); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Galleria immagini -->
        <?php
            $directory = public_path('storage/Deities/' . Str::slug($deity->name));
            $relativeDir = 'storage/Deities/' . Str::slug($deity->name);
            $galleryImages = [];

            if (File::exists($directory)) {
                $galleryImages = collect(File::files($directory))
                    ->filter(function ($file) {
                        return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp']);
                    })
                    ->map(function ($file) use ($relativeDir) {
                        return asset($relativeDir . '/' . $file->getFilename());
                    });
            }
        ?>

        <?php if($galleryImages->count() > 1): ?>
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Gallery</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($img); ?>" data-lightbox="gallery" data-title="<?php echo e($deity->name); ?>">
                            <img src="<?php echo e($img); ?>" alt="<?php echo e($deity->name); ?>"
                                class="w-full h-45 object-cover rounded-lg shadow hover:shadow-lg transition-shadow">
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Leggende correlate -->
        <?php if($deity->legends->count() > 0): ?>
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Related Legends</h2>
                <div class="space-y-4">
                    <?php $__currentLoopData = $deity->legends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $legend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('legends.show', $legend)); ?>"
                            class="block border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                            <h3 class="font-bold text-lg"><?php echo e($legend->title); ?></h3>
                            <p class="text-sm text-gray-600 mt-1"><?php echo e(Str::limit($legend->content, 150)); ?></p>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "Image %1 of %2"
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\folklore-world\resources\views/deities/show.blade.php ENDPATH**/ ?>