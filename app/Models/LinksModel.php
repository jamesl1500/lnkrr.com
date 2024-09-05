<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinksModel extends Model
{
    use HasFactory;

    protected $table = 'links';
    protected $fillable = [
        'user_id',
        'name',
        'url',
        'description',
        'image',
        'category',
        'clicks',
        'is_active',
        'is_protected',
        'password',
        'photo',
        'type',
        'font_family',
        'font_size',
        'font_color',
        'background_color',
        'border_color',
        'border_radius',
        'border_width',
        'padding',
        'margin',
        'shadow',
    ];
}
