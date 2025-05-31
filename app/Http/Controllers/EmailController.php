<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\sendBulkEmailRequest;
use App\Services\BulkEmailService;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function __construct(protected BulkEmailService $service) {}

    public function sendBulkEmail(sendBulkEmailRequest $request)
    {
        $this->service->sendBulkEmail($request);

        return 'Bulk emails are being sent!';
    }
}
