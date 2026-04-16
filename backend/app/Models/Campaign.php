<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'message_template',
        'status'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
