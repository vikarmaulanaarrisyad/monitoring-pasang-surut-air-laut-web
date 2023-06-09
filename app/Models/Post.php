<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    public function category_post()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function statusColor()
    {
        $color =  '';
        switch ($this->status) {
            case 'publish':
                $color = 'success';
                break;
            case 'archived':
                $color = 'dark';
                break;

            default:
                # code...
                break;
        }

        return $color;
    }
}
