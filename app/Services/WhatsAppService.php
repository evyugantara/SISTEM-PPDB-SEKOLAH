<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    public static function send($phone, $message)
    {
        $isActive = Setting::get('wa_notif_aktif', '0');
        if ($isActive !== '1') return false;

        $apiUrl = Setting::get('wa_api_url');
        $apiToken = Setting::get('wa_api_token');

        if (!$apiUrl || !$apiToken) {
            Log::warning("WhatsApp API URL or Token is not configured.");
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiToken
            ])->post($apiUrl, [
                'target' => $phone,
                'message' => $message,
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error("Failed to send WA message: " . $e->getMessage());
            return false;
        }
    }
    
    public static function buildMessage($template, $data)
    {
        $message = $template;
        foreach ($data as $key => $value) {
            $message = str_replace('{' . $key . '}', $value, $message);
        }
        return $message;
    }
}


