<?php

namespace App\Http\Controllers;

use App\Enums\PageFeatureEnum;
use App\Models\Contact;
use App\Models\WorkingHour;
use Illuminate\Http\Request;
use Exception;

class ContactController extends Controller
{
    //return contact form and contact info on user page
    public function index()
    {
        return view('contact', ['contacts' => Contact::first()]); 
    }


    public function handle(Request $request)
    {
        try
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'message' => 'required',
                'agree' => 'required',
            ]);
    
            $to = "l.lababidi90@gmail.com";
            //$to = "ibrahim.a.a.h.2017@gmail.com";
            //$to = "ib.malek.2021@gmail.com";
            $subject = "From lababidi-bau.de";
            ///////////////////////////////////////////////////////
            $phone_number = $request->phone ?? ' <Not Set>';
            $message = "You have a new website form submission : <br>";
            $message.= "Name : $request->name <br>";
            $message.="Phone Number : $phone_number <br>";
            $message.="Email : $request->email <br>";
            $message.="Message :$request->message <br>";
            ////////////////////////////////////////////////////////
            //$headers = "From: lababidi-bau.de \r\n";
            //$headers .='Reply-To: '. $request->email . "\r\n" ;

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
            $headers .= "From: info@lababidi-bau.de" . "\r\n" .
            "Reply-To: $request->email " . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

            mail($to,$subject,$message,$headers);

            return back()->with('success_mail','Ihre Nachricht wurde erfolgreich gesendet. Vielen Dank!');
        }
        catch(Exception $ex)
        {
            //return back()->with('error_mail',$ex->getMessage());
            return back()->with('error_mail','Nachricht konnte nicht gesendet werden, erneut versuchen.');
        }

       
        
    }

    //return user info and a form to update user info on admin page
    public function index_admin()
    {
        $workingHours = WorkingHour::first();

        return view('contact-admin', [
            'contacts' => Contact::first(),
            'workingHoursData' => $workingHours?->hours ?? [], // ✅ already array
            'isOpenNow' => $workingHours?->openingHours()->isOpenAt(now()) ?? false,
        ]);
    }
    
    public function update(Request $request)
    {
        $contact = Contact::find(1);
        //if there were not contacts data then add a new row
        if(!$contact)
        {
            $contact = new Contact(); 
        }
        
        $contact->email = $request->email;
        $contact->call = $request->call;
        $contact->location = $request->location;
        
        if($contact->save())
        {
            return back()->with('success','Contacts Info Updated Successfully :)');
        }
        else
        {
            return back()->with('faild','Cann\'t update Contacts Info :(');
        }
    }

    public function toggleContact(Request $request)
    {
        $enabled = $request->boolean('contact_status');
    
        PageFeatureEnum::HOME_CONTACT->set($enabled);
    
        return back()->with(
            'contact_toggle_status',
            $enabled ? 'enabled' : 'disabled'
        );
    }
}
