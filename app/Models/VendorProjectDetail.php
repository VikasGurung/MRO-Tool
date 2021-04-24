<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProjectDetail extends Model
{
    use HasFactory;
    
    protected $table = 'vendorprojectdetails';
    protected $primaryKey = 'pki_vendorprojectdetail_id';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}
