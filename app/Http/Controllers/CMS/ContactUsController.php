<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Mail\CMS\ContactUsMail;
use App\Models\AppSetting;
use App\Services\CMS\AppSettingService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index()
    {
        $contactText = app()->make(AppSettingService::class)->getValue('contact_text');

        if (!$contactText) throw new Exception('Please add the contact_text key in the app setting.');

        return view('pages.cms.contact-us.index', compact('contactText'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string', 'numeric'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'string'],
        ]);

        $contactEmail = app()->make(AppSettingService::class)->getValue('contact_email');

        if (!$contactEmail) throw new Exception('Please add the contact_email key in the app setting.');

        // Store the contact message in the database or send an email
        Mail::to($contactEmail)->send(new ContactUsMail($validated));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
