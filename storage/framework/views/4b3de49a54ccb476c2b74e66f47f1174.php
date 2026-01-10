

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-950 py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <div class="bg-gray-900 border border-white/10 p-8 rounded-3xl shadow-2xl">
            <h2 class="text-2xl font-black text-white uppercase italic mb-8">Edit <span class="text-red-600">Profil</span></h2>
            
            <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                
                <div class="flex items-center gap-6 mb-8">
                    <img src="<?php echo e($user->avatar ? (str_starts_with($user->avatar, 'http') ? $user->avatar : asset('uploads/avatars/'.$user->avatar)) : 'https://ui-avatars.com/api/?name='.urlencode($user->name)); ?>" 
                         class="w-24 h-24 rounded-full border-2 border-red-600 object-cover">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Ganti Foto</label>
                        <input type="file" name="avatar" class="text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Nama Lengkap</label>
                        <input type="text" name="name" value="<?php echo e($user->name); ?>" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white mt-1">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Username</label>
                        <input type="text" name="username" value="<?php echo e($user->username); ?>" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white mt-1">
                    </div>
                </div>

                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl uppercase tracking-widest transition">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/profile/index.blade.php ENDPATH**/ ?>