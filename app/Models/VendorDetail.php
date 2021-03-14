<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDetail extends Model
{
    use HasFactory;

    protected $table = 'vendordetails';
    protected $primaryKey = 'pki_vendordetail_id';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public static function getVendorDetails($vendordetail_id){
        return VendorDetail::select(
            'vendordetails.pki_vendordetail_id as pki_vendordetail_id',
            'vendordetails.cpi as cpi',
            'vendordetails.required_completes as required_completes',
            'vendordetails.completes as completes',
            'vendordetails.survey_url as survey_url',
            'vendordetails.created as created',
            'vendordetails.updated as updated',
            'vendors.vendor as vendor',
            'vendors.complete_url as complete_url',
            'vendors.disqualify_url as disqualify_url',
            'vendors.quotafull_url as quotafull_url',
            'vendors.quality_term_url as qualityterm_url',
            'projects.name as project_name'
        )
                            ->join(
                                'vendors',
                                'vendors.pki_vendor_id',
                                '=',
                                'vendordetails.fki_vendor_id'
                            )
                            ->join(
                                'projects',
                                'projects.pki_project_id',
                                '=',
                                'vendordetails.fki_project_id'
                            )
                            ->where('vendordetails.pki_vendordetail_id', '=', $vendordetail_id)
                            ->first();
    }
}