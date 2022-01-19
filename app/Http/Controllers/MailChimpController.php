<?php

namespace App\Http\Controllers;

use Newsletter;
use Toastr;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class MailChimpController extends Controller
{
    // --------------- MEMBER LIST -----------------

    public function manage(Request $request) {
        // dd(env('DB_DATABASE'));
        // dd(database_path('database.sqlite'));
        $total =  Newsletter::getMembers()['total_items'];
        $resultsByPage = 50;
        $numberOfPages = ($total-($total % $resultsByPage)) / $resultsByPage;
        $currentPage = (int)$request->page;
        if ($currentPage < 0) $currentPage = 0;
        if ($currentPage > $numberOfPages) $currentPage = $numberOfPages;


        if ($total % $resultsByPage > 0) $numberOfPages + 1;

        $parameters = [
            'count' => $resultsByPage,
            'offset' => $currentPage * $resultsByPage,
        ];
        $members = Newsletter::getMembers($string = '', $parameters)['members'];
        // dd($members);
        return view('home', compact('members', 'numberOfPages', 'currentPage'));
    }

    // --------------- DELETE -----------------

    public function deleteSubscriber($email) {
        Newsletter::deletePermanently($email);

        Toastr::success('Subscriber successfully deleted', 'Success', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('manage');
    }

    // --------------- ADD ROUTE -----------------

    public function addSubscriber() {
        return view('subscriber.add');
    }

    // --------------- CREATE ROUTE -----------------

    public function createSubscriber(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'lname' => 'required',
            'fname' => 'required'
        ]);

        $isSubscribed = Newsletter::isSubscribed($request->email);
        if ($isSubscribed) {
            Toastr::info('This email is already subscribed to the list', 'Info', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('manage');
        }

        try {
            Newsletter::subscribe($request->email, ['FNAME'=>$request->fname, 'LNAME'=>$request->lname]);
            Toastr::success('Subscriber successfully added', 'Success', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('manage');
        } catch(Exception $err) {
            Toastr::error($err, 'An error occured', ["positionClass" => "toast-bottom-right"]);
        }
    }

    // --------------- EDIT ROUTE -----------------

    public function editSubscriber($email) {
        $member = Newsletter::getMember($email);
        return view('subscriber.edit', compact('member'));
    }

    // --------------- UPDATE ROUTE -----------------

    public function updateSubscriber($email, Request $request) {
        $request->validate([
            'email' => 'required|email',
            'lname' => 'required',
            'fname' => 'required'
        ]);

        try {
            Newsletter::subscribeOrUpdate($request->email, ['FNAME'=>$request->fname, 'LNAME'=>$request->lname]);
            Toastr::success('Subscriber successfully updated', 'Success', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('manage');
        } catch(Exception $err) {
            Toastr::error($err, 'An error occured', ["positionClass" => "toast-bottom-right"]);
        }
    }

    // --------------- PAGINATE FUNCTION -----------------

    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
