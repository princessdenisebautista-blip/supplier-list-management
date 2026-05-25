<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
protected $fillable = [
    'name',
    'contact_person',
    'primary_contact',
    'category',
    'product_service',
    'rating',
    'phone',
    'email',
    'address',
    'payment_terms',
    'payment_method',
    'status',
    'contract_start',
    'contract_end'
];

    
}
