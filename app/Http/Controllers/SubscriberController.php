<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use App\Field;
use App\Mail\Subscriber as MailSubcriber;
use App\Mail\UnSubscriber;
use Validator;
Use Exception;
use Mail;

class SubscriberController extends Controller
{

    //Unsubscribe User
    public function unsubscribed(Request $request)
    {
      //Update the current user
      try {
        $userEmail = Subscriber::where('id', $request->id)->get(['email']);
        Subscriber::where('id', $request->id)->update(['state' => 'unsubscribed']);

        Mail::to($userEmail)->send(new UnSubscriber);

        if (Mail::failures())
        {
          return redirect('/')->with('success', 'Sorry! Please try again latter.');
        }
        else
        {
          return redirect('/')->with('success', 'You are now successfully unsubscribed.');
        }
      } catch (Exception $e) {
        return redirect('/')->with('error', 'There was and error. Sorry! Please try again latter.');
      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          "fullName" => "required",
          "title" => "required",
          "email" => "required|domain|email"
        ]);


        if ($validator->passes())
        {
          try {

            Subscriber::create([
              "name" => $request->fullName,
              "email" => $request->email,
              "state" => "active",
            ]);

            $lastSubscriberId = Subscriber::latest()->first('id');

            Field::create([
              "subscriber_id" => $lastSubscriberId->id,
              "title" => $request->title
            ]);

            $emailData = [
              "id" => $lastSubscriberId->id,
              "name" => $request->fullName,
              "title" => $request->title,
              "email" => $request->email
            ];

            Mail::to($request->email)->send(new MailSubcriber($emailData));

            if (Mail::failures())
            {
              //return response()->Fail('Sorry! Please try again latter');
              return response()->json(['error' => ["0" => 'Sorry, ther was an error! Please try again latter.']]);
            }
            else
            {
              //return response()->success('Great! Successfully send in your mail');
              return response()->json(['success' => 'You are now successfully subscribed on our newsletter.']);
            }

          } catch (Exception $e) {
            return response()->json(['error' => ["0" => 'Email must be unique.']]);
          }
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
