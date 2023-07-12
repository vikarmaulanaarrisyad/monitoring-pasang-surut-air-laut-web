<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sensor extends Model
{
    use HasFactory;
    protected $table = 'sensor';

    public function scopeHumidity($query)
    {
        $query->where('id','DESC');
    }

    public function statusColor()
    {
        $color = '';

        switch ($this->status) {
            case 'Aman':
                $color = 'success';
                break;
            case 'Siaga':
                $color = 'warning';
                break;
            case 'Bahaya':
                $color = 'danger';
                break;

            default:
                # code...
                break;
        }

        return $color;
    }
}
