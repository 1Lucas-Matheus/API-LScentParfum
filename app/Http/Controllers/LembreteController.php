<?php

namespace App\Http\Controllers;

use App\Models\Lembrete;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LembreteController extends Controller
{
    public readonly Lembrete $reminders;

    public function __construct()
    {
        $this->reminders = new Lembrete();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reminders = $this->reminders->all();

        return response()->json([
            'reminders' => $reminders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reminder' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date_format:d/m/Y'],
        ]);

        // Converting date to Y-m-d format for consistency
        $dateConvert = Carbon::createFromFormat('d/m/Y', $request->date)->format('d/m/Y');
        $request->merge(['date' => $dateConvert]);

        $reminder = $this->reminders->create([
            'reminder' => $request->reminder,
            'date' => $request->date
        ]);

        return response()->json([
            'message' => 'Lembrete criado com êxito.',
            'reminder' => $reminder
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reminder = $this->reminders->find($id);

        if (!$reminder) {
            return response()->json(['message' => 'Lembrete não encontrado.'], 404);
        }

        return response()->json($reminder);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reminder = $this->reminders->find($id);

        if (!$reminder) {
            return response()->json(['message' => 'Lembrete não encontrado.'], 404);
        }

        $request->validate([
            'reminder' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date_format:d/m/Y'],
        ]);

        // Converting date to Y-m-d format for consistency
        $dateConvert = Carbon::createFromFormat('d/m/Y', trim($request->date))->format('Y-m-d');

        $request->merge(['date' => $dateConvert]);

        $reminder->update($request->only(['reminder', 'date']));

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
