<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:make-admin {email : Kullanıcının e-posta adresi}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Belirtilen e-posta adresine sahip kullanıcıya admin rolü verir';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        // Kullanıcıyı bul
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("E-posta adresi '{$email}' ile kullanıcı bulunamadı!");
            return 1;
        }

        // Kullanıcı zaten admin mi kontrol et
        if ($user->role === 'admin') {
            $this->warn("Kullanıcı '{$email}' zaten admin rolüne sahip!");
            return 0;
        }

        // Admin rolü ver
        $user->role = 'admin';
        $user->save();

        $this->info("Kullanıcı '{$email}' başarıyla admin yapıldı!");
        return 0;
    }
}
