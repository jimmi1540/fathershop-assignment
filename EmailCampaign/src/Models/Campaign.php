<?php 
namespace  EmailCampaign\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['title', 'subject', 'body'];
    
    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class);
    }
}
