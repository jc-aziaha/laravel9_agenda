<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        
        return view("index", ['contacts' => $contacts]);
    }

    public function create()
    {
        return view("create");
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validator = Validator::make($request->all(), 
        [
            "full_name" => ["required", "string", "max:255"],
            "email"     => ["required", "string", "max:255", "email", "unique:contacts,email"],
            "age"       => ["nullable", "integer", "min:6", "max:120"]
        ], 
        [
            "full_name.required"    => "Le nom est obligatoire.",
            "full_name.string"      => "Veuillez entrer une chaine de carctères.",
            "full_name.max"         => "Le nom doit contenir au maximum 255 caractères.",

            "email.required"        => "L'email est obligatoire.",
            "email.string"          => "Veuillez entrer une chaine de carctères.",
            "email.max"             => "L'email doit contenir au maximum 255 caractères.",
            "email.email"           => "Veuillez entrer un email valide.",
            "email.unique"          => "Cet email appartient déjà à l'un de vos contacts!.",

            "age.integer"           => "L'age doit être un nombre entier.",
            "age.min"               => "Veuillez entrer au minimum 6 ans.",
            "age.max"               => "Veuillez entrer au maximum 120 ans.",
        ]);

        if ( $validator->fails() ) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Insérer en base
        Contact::create([
            "full_name" => $request->full_name,
            "email"     => $request->email,
            "age"       => $request->age,
        ]);

        // Effectuer une redirection vers la page d'accueil
        return redirect()->route('index')->with([
            "success" => "Votre contact a été ajouté avec succès."
        ]);
    }

    public function edit($id)
    {
        $contact = Contact::find($id);

        if ( ! $contact ) 
        {
            return redirect()->route('index')->with([
                "danger" => "Ce contact n'existe pas!!!"
            ]);
        }

        return view("edit", compact('contact'));
    }

    public function update($id, Request $request)
    {
        $contact = Contact::find($id);

        if ( ! $contact ) 
        {
            return redirect()->route('index')->with([
                "danger" => "Ce contact n'existe pas!!!"
            ]);
        }

        // Valider les données du formulaire
        $validator = Validator::make($request->all(), 
        [
            "full_name" => ["required", "string", "max:255"],
            "email"     => ["required", "string", "max:255", "email", Rule::unique('contacts')->ignore($contact->id)],
            "age"       => ["nullable", "integer", "min:6", "max:120"]
        ], 
        [
            "full_name.required"    => "Le nom est obligatoire.",
            "full_name.string"      => "Veuillez entrer une chaine de carctères.",
            "full_name.max"         => "Le nom doit contenir au maximum 255 caractères.",

            "email.required"        => "L'email est obligatoire.",
            "email.string"          => "Veuillez entrer une chaine de carctères.",
            "email.max"             => "L'email doit contenir au maximum 255 caractères.",
            "email.email"           => "Veuillez entrer un email valide.",
            "email.unique"          => "Cet email appartient déjà à l'un de vos contacts!.",

            "age.integer"           => "L'age doit être un nombre entier.",
            "age.min"               => "Veuillez entrer au minimum 6 ans.",
            "age.max"               => "Veuillez entrer au maximum 120 ans.",
        ]);

        if ( $validator->fails() ) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $contact->update([
            "full_name" => $request->full_name,
            "email" => $request->email,
            "age" => $request->age,
        ]);

        return redirect()->route('index')->with([
            "success" => "Le contact a été modifié avec succès."
        ]);

    }

    public function delete($id)
    {
        $contact = Contact::find($id);

        if ( ! $contact ) 
        {
            return redirect()->route('index')->with([
                "danger" => "Ce contact n'existe pas!!!"
            ]);
        }

        $contact->delete();

        return redirect()->route('index')->with([
            "success" => "$contact->full_name a été retiré de la liste."
        ]);
    }
}
