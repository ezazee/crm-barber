<?php

namespace Database\Seeders;

use App\Libraries\FileLibrary;
use App\Models\UserFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RecoverLostAssetWithPlaceholderImage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $placeholderName = 'icon-placeholder-1.jpg';
        if (!Storage::disk('public')->exists($placeholderName)) {
            $file = File::get(public_path('images/' . $placeholderName));
        } else {
            $file = Storage::disk('public')->get($placeholderName);
        }


        $userFiles = UserFile::all();
        $i = 0;
        foreach ($userFiles as $key => $userFile) {
            $checkFile = Storage::disk('public')->exists($userFile->file_url);
            if (!$checkFile) {
                echo $userFile->file_url . PHP_EOL;
                Storage::disk('public')->put($userFile->file_url, $file);
                $i++;
            }
        }

        var_dump($i);
        // dd($file);
    }
}
