<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    // Methode om de 'Over Ons' pagina te tonen
    public function about()
    {
        return view('about');
    }

    // Methode om de 'Contact' pagina te tonen
    public function contact()
    {
        return view('contact');
    }

    // Methode om het contactformulier te verwerken
    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

        // In een echte applicatie zou je hier een e-mail versturen.
        // Voor nu sturen we de gebruiker terug met een succesbericht.
        // Mail::to('admin@fts.com')->send(new ContactFormMail($validatedData));

        return redirect()->route('contact')->with('success', 'Bedankt voor je bericht! We nemen zo snel mogelijk contact met je op.');
    }
}
