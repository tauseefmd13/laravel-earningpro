<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    protected $fillable = [
        'image',
        'heading',
        'content',
        'button1_text',
        'button1_url',
        'button2_text',
        'button2_url',
        'position',
        'status',
    ];

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        return !empty($this->image) ? asset("storage/sliders") ."/". $this->image : "";
    }
}
