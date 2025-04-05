<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {
    protected $fillable = [
        'name',
        'file',
        'status'
    ];

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getDocumentPathAttribute() {
        return $this->file ? public_path('assets/files/documents/' . $this->file) : null;
    }

    public function getDocumentUrlAttribute() {
        return $this->file ? asset('assets/files/documents/' . $this->file) : null;
    }

}
