<?php
namespace EmailCampaign\Services;
use EmailCampaign\Models\Customer;
use EmailCampaign\Models\Campaign;
use EmailCampaign\Models\EmailLog;

class SendEmailCampaignService
{
    /**
     * Filter customers based on status and plan expiry date.
     */
    public function filterCustomers($status, $daysUntilExpiry)
    {
        
        return Customer::where('status', $status)
        ->where('plan_expiry_date', '=', now()->addDay()->toDateString())
        ->get();
    }

    /**
     * Get campaign by ID.
     */
    public function getCampaign($campaignId)
    {
        return Campaign::findOrFail($campaignId);
    }
}
