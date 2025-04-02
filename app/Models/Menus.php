<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menus extends Model
{
    use HasFactory;
    
    protected $table = 'menu_items';
    
    protected $primaryKey = 'menu_item_id';

    protected $fillable = [
        'name', 
        'description',
        'price', 
        'category', 
        'menu_image', 
    ];
}
