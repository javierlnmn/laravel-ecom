<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'address',
        'address_additional',
        'postal_code',
        'city',
        'user_id',
    ];

    public function getCompleteAddress()
    {
        $completeAddress = $this->address;
        if ($this->address_additional) {
            $completeAddress .= ' '.$this->address_additional;
        }
        $completeAddress .= ', '.$this->city.', '.$this->postal_code;
        return $completeAddress;
    }
}
