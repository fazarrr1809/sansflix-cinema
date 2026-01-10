

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-950 py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-black text-white uppercase italic mb-10 tracking-tighter">Pengaturan <span class="text-red-600">Akun</span></h2>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="bg-green-600/20 border border-green-600 text-green-500 px-6 py-4 rounded-2xl mb-6 font-bold text-sm">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-gray-900 border border-white/10 p-8 rounded-3xl text-center">
                        <div class="relative inline-block mb-4">
                            <img 
                                src="<?php echo e($user->avatar 
                                    ? (filter_var($user->avatar, FILTER_VALIDATE_URL) 
                                        ? $user->avatar 
                                        : asset('storage/' . (str_starts_with($user->avatar, 'uploads/avatars/') ? $user->avatar : 'uploads/avatars/' . $user->avatar))) 
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=E50914&color=fff'); ?>" 
                                alt="Avatar"
                                class="w-full h-full object-cover rounded-full"
                            >
                            <label class="absolute bottom-0 right-0 bg-red-600 p-2 rounded-full cursor-pointer hover:bg-red-700 transition shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                </svg>
                                <input type="file" name="avatar" class="hidden">
                            </label>
                        </div>
                        <h3 class="text-white font-bold text-lg"><?php echo e($user->name); ?></h3>
                        <p class="text-gray-500 text-sm mb-4"><?php echo e('@'.$user->username); ?></p>
                        
                        
                        <div class="bg-red-600/10 border border-red-600/20 rounded-xl py-2 px-4 inline-block">
                            <span class="text-red-500 text-xs font-black uppercase tracking-tighter">Status: <?php echo e($age); ?> Tahun (Verified)</span>
                        </div>
                    </div>
                </div>

                
                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-gray-900 border border-white/10 p-8 rounded-3xl shadow-xl">
                        <h4 class="text-white font-bold uppercase text-sm mb-6 flex items-center gap-2">
                            <span class="w-1 h-4 bg-red-600"></span> Informasi Dasar
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Nama Lengkap</label>
                                <input type="text" name="name" value="<?php echo e($user->name); ?>" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:border-red-600 transition outline-none mt-1">
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Username</label>
                                <input type="text" name="username" value="<?php echo e($user->username); ?>" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:border-red-600 transition outline-none mt-1">
                            </div>
                          <div>
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Tanggal Lahir</label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->dob): ?>
                                
                                <input type="text" value="<?php echo e(\Carbon\Carbon::parse($user->dob)->format('d F Y')); ?>" disabled 
                                    class="w-full bg-gray-800/50 border border-gray-700 rounded-xl px-4 py-3 text-gray-500 mt-1 cursor-not-allowed">
                            <?php else: ?>
                                
                                <input type="date" name="dob" required 
                                    max="<?php echo e(\Carbon\Carbon::now()->subYears(15)->format('Y-m-d')); ?>"
                                    class="w-full bg-gray-800 border <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-600 <?php else: ?> border-gray-700 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> rounded-xl px-4 py-3 text-white focus:border-red-600 transition outline-none mt-1">
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-[10px] text-red-500 mt-1"><?php echo e($message); ?></p>
                                <?php else: ?>
                                    <p class="text-[10px] text-gray-400 mt-1">*Minimal usia 15 tahun untuk verifikasi akun.</p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                            <div>
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Email</label>
                                <input type="email" value="<?php echo e($user->email); ?>" disabled class="w-full bg-gray-800/50 border border-gray-700 rounded-xl px-4 py-3 text-gray-500 mt-1 cursor-not-allowed">
                            </div>
                        </div>
                    </div>

                    
                    <div class="bg-gray-900 border border-white/10 p-8 rounded-3xl shadow-xl">
                        <h4 class="text-white font-bold uppercase text-sm mb-6 flex items-center gap-2">
                            <span class="w-1 h-4 bg-red-600"></span> Keamanan Akun
                        </h4>
                        <div class="space-y-4">
                            <div>
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Password Saat Ini</label>
                                <input type="password" name="current_password" placeholder="Masukkan password lama untuk ganti baru" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:border-red-600 transition outline-none mt-1">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[10px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Password Baru</label>
                                    <input type="password" name="new_password" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:border-red-600 transition outline-none mt-1">
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Konfirmasi Password</label>
                                    <input type="password" name="new_password_confirmation" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:border-red-600 transition outline-none mt-1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-4 rounded-2xl uppercase tracking-tighter shadow-lg transition transform hover:-translate-y-1">
                        Perbarui Profil & Keamanan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/profile/index.blade.php ENDPATH**/ ?>