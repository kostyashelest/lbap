<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    /**
     * @param $file
     * @param $model
     * @param $description
     * @return bool
     */
    public function handle($file, $model, $description): bool
    {
        if (!$path = $this->put($file)) {
            return false;
        }

        if ($this->save($path, $model, $description)) {
            return true;
        }

        return false;
    }

    /**
     * @param $file
     * @return string
     */
    private function put($file): string
    {
        $path = Storage::putFile(config('app.path.storage'), $file);
        $url = explode('/', $path);
        return $url[1];
    }

    /**
     * @param $url
     * @param $model
     * @param $description
     * @return bool
     */
    private function save($url, $model, $description): bool
    {
        $file = File::create([
            'file_name' => $url,
            'fileable_id' => $model->id,
            'fileable_type' => get_class($model),
            'description' => $description,
        ]);

        return (bool)$file->exists;
    }
}
