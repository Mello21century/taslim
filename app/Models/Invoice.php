<?php

namespace App\Models;


use App\Models\Admin;
use App\Models\Product;
use App\Models\Location;
use App\Models\Supplier;
use App\Models\Customers;
use App\Models\SerialNumber;
use App\Traits\TracksActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Invoice extends Model
{
    use HasFactory;
    protected $guarded=[];


    use TracksActivity;
   
    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    
    public function admin()
    {
        return $this->belongsTo(Admin::class,'employee_id');
    }

        public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function location()
    {
        return $this->belongsTo(Location::class,'location_id');
    }


    public function serialNumbers()
    {
        return $this->hasMany(SerialNumber::class); 
    }

    public function products()
{
    return $this->belongsToMany(Product::class, 'invoice_products')
                ->withPivot('quantity')
                ->withTimestamps();
}



protected static $logAttributes = [
    'code',
    'invoice_date',
    'invoice_status',
    'invoice_type',
    'location_id',
    'employee_id',
    'supplier_id',
    'customer_id',
    'created_by',
];

protected static $logName = 'invoice';
protected static $logOnlyDirty = true;



  
}
