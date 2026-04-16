<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Message;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Campaign::all();
    }

    public function send($id)
    {
        $campaign = Campaign::findOrFail($id);

        $contacts = Contact::all();

        foreach ($contacts as $contact) {
            Message::create([
                'campaign_id' => $campaign->id,
                'contact_id' => $contact->id,
                'content' => str_replace('{name}', $contact->name, $campaign->message_template),
                'status' => 'pending'
            ]);
        }

        $campaign->update(['status' => 'sending']);

        return response()->json(['message' => 'Campaign started']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Campaign::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $campaign = Campaign::findOrFail($id);
        return response()->json($campaign);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->update($request->all());

        return $campaign;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Campaign::destroy($id);

        return response()->json(null, 204);
    }
}
