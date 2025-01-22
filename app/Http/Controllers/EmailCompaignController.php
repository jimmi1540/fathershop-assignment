<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use EmailCampaign\Jobs\SendCampaignEmailJob;
use Exception;
use EmailCampaign\Models\Campaign;
use EmailCampaign\Models\Customer;
use EmailCampaign\Services\SendEmailCampaignService;
class EmailCompaignController extends Controller
{
    protected $emailCampaignService;

    public function __construct(SendEmailCampaignService $emailCampaignService)
    {
        $this->emailCampaignService = $emailCampaignService;
    }
     public function store(Request $request)
    {
        try {
            $apiResponse = new ApiResponse();
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'subject' => 'required|string',
                'body' => 'required|string',
            ]);
        
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $validatedData = $validator->validated();
            $campaign = Campaign::create($validatedData);
            return $apiResponse->successResponse('Campaign created successfully', $campaign, 201);
        } catch (Exception $e) {
            return $apiResponse->errorResponse('An error occurred while creating the campaign', $e->getMessage());
        }
        
    }
    public function sendCampaign(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'plan_expiry_date' => 'required',
        ]);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        } 
        $filteredCustomers = $this->emailCampaignService->filterCustomers(
            $request->status, 
            $request->plan_expiry_date
        );
        $campaign = $this->emailCampaignService->getCampaign($request->compaign_id);
        foreach ($filteredCustomers as $customer) {
            dispatch(new SendCampaignEmailJob($customer, $campaign));
        }

        return response()->json(['message' => 'Email campaign queued successfully!']);
    }
}
