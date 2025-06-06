<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public readonly Reminder $reminders;

    public function __construct()
    {
        $this->reminders = new Reminder();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reminders = $this->reminders->all();

        return response()->json([
            'data' => $reminders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reminder' => ['required', 'string', 'max:255'],
            'dateTime' => ['required', 'date_format:d/m/Y'],
        ]);

        $dateTimeConvert = Carbon::createFromFormat('d/m/Y', $request->dateTime)->format('d/m/Y');
        $request->merge(['dateTime' => $dateTimeConvert]);

        $reminder = $this->reminders->create([
            'reminder' => $request->reminder,
            'dateTime' => $request->dateTime
        ]);

        return response()->json([
            'message' => 'Lembrete criado com êxito.',
            'reminder' => $reminder
        ], 201);
    }

    public function show(Reminder $reminders)
    {
        $reminders = $this->reminders->all();

        return response()->json([
            'data' => $reminders
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reminder $reminder)
    {
        $request->validate([
            'reminder' => ['required', 'string', 'max:255'],
            'dateTime' => ['required', 'date_format:d/m/Y'],
        ]);

        $dateTimeConvert = Carbon::createFromFormat('d/m/Y', trim($request->dateTime))->format('Y-m-d');

        $reminder->update([
            'reminder' => $request->reminder,
            'dateTime' => $dateTimeConvert,
        ]);

        return response()->json([
            'message' => 'Lembrete atualizado com êxito.',
            'reminder' => $reminder
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reminder = $this->reminders->find($id);

        if (!$reminder) {
            return response()->json(['message' => 'Lembrete não encontrado.'], 404);
        }

        $reminder->delete();

        return response()->json(['message' => 'Lembrete excluído com êxito.']);
    }
}
