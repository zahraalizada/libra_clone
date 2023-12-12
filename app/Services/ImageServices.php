<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;


class ImageServices
{
    private UploadedFile  $file;
    private int $width;
    private int $height;

    private String $folderName;

    private Image  $imageResize;

    public function setFile(UploadedFile $file): self
    {
        $this->file = $file;
        return $this;
    }
    public function setWidth(int $width): self
    {
        $this->width = $width;
        return $this;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function setFolderName(string $folderName): self
    {
        $this->folderName = $folderName;
        return $this;
    }


    public function resize(){

        $this->imageResize=\Intervention\Image\Facades\Image::make($this->file);
        $this->imageResize->resize($this->width,$this->height,function ($constraint){
            $constraint->aspectRatio();
        })->encode($this->file->extension());

        return $this;
    }

    public function upload(){
        Storage::disk("author")->put($this->folderName."/".$this->file->hashName(),$this->imageResize);
    }
}
