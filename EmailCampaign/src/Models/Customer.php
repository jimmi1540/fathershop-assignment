<?php
namespace EmailCampaign\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email','phone_number', 'status', 'plan_expiry_date'];

    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class);
    }
}
