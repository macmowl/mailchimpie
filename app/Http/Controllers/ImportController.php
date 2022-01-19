<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use Illuminate\Http\Client\RequestException;
use Toastr;

class ImportController extends Controller
{
    public function importCSV(Request $request) {
        Subscriber::truncate();
        Excel::import(new UsersImport, $request->file('file'));

        $mailchimp = new \MailchimpMarketing\ApiClient();
        $mailchimp->setConfig([
            'apiKey' => env('MAILCHIMP_APIKEY'),
            'server' => env('MAILCHIMP_SERVER')
        ]);

        $list_id = env('MAILCHIMP_LIST_ID');
        $subscribers = Subscriber::all();

        foreach ($subscribers as $subscriber) {
            try {
                $user_hash = md5(strtolower($subscriber->email));

                $mailchimp->lists->setListMember($list_id, $user_hash, [
                    "email_address" => $subscriber->email_address,
                    "status_if_new" => "subscribed",
                    "status" => "subscribed",
                    "merge_fields" => [
                        "FNAME" => $subscriber->FNAME,
                        "LNAME" => $subscriber->LNAME,
                    ]
                ]);
            } catch (RequestException $exception) {
                Toastr::error($exception, 'Failed to sync with Mailchimp', ["positionClass" => "toast-bottom-right"]);
                return redirect()->back();
            }
            
        }
        Subscriber::truncate();
        Toastr::success('Syncing successfully with Mailchimp', 'Success', ["positionClass" => "toast-bottom-right"]);
        return redirect()->back();
    }
}
