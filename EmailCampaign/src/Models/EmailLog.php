<?php
namespace EmailCampaign\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $fillable = ['customer_id', 'campaign_id','status', 'error_message'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
