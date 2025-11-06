<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peinado extends Model {

    protected $table = 'peinado';
    
    protected $fillable = ['author', 'name', 'hair', 'description', 'price', 'image'];

    function getPath() {
        $path = url('assets/img/afeitado.jpg');
        if($this->image != null) {
            $path = url('storage/' . $this->image);
        }
        return $path;
    }

    function getPdf() {
        return url('storage/pdf') . '/' . $this->id . '.pdf';
    }

    function isPdf() {
        return file_exists(storage_path('app/public/pdf') . '/' . $this->id . '.pdf');
    }
    
}