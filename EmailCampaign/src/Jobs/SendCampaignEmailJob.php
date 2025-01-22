<?php
namespace EmailCampaign\Jobs;
use EmailCampaign\Models\Campaign;
use EmailCampaign\Models\Customer;
use EmailCampaign\Models\EmailLog;
use Illuminate\Bus\Queueable;
use Services\SendEmailCampaignService;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;

class SendCampaignEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customer;
    protected $campaign;

    public function __construct(Customer $customer, Campaign $campaign)
    {
        $this->customer = $customer;
        $this->campaign = $campaign;
    }

    public function handle()
    {
        try {
            $emailBody = View::make('emailcampaign::emails.campaign', [
                'customer' => $this->customer,
                'campaign' => $this->campaign
            ])->render();
        
            Mail::send([], [], function ($message) use ($emailBody) {
                $message->to($this->customer->email)
                        ->subject($this->campaign->title)
                        ->html($emailBody);
            });
            EmailLog::create([
                'customer_id' => $this->customer->id,
                'campaign_id' => $this->campaign->id,
                'status' => 'sent',
            ]);

        } catch (\Exception $e) {
            EmailLog::create([
                'customer_id' => $this->customer->id,
                'campaign_id' => $this->campaign->id,
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
        }
    }
}
