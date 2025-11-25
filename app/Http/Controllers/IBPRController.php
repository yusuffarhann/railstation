<?php

namespace App\Http\Controllers;

use App\Models\IBPR;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IBPRController extends Controller
{
    protected $station;

    public function __construct()
    {
        $this->station = $this->checkStation();
        view()->share('station', $this->station);
    }

    public function index()
    {
        return view('ibpr');
    }

    public function get(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);

        $ibprs = $this->station->ibprs()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        $ibprs->getCollection()->transform(function ($ibpr) {
            if ($ibpr->completion_date) {
                $ibpr->completion_date = Carbon::parse($ibpr->completion_date)->format('Y-m-d');
            }
            return $ibpr;
        });

        return response()->json($ibprs);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ibprs' => 'required|array',
            'ibprs.*.id' => 'nullable|integer',
            'ibprs.*.hazard_description' => 'nullable|string',
            'ibprs.*.control_explanation' => 'nullable|string',
            'ibprs.*.control_reference' => 'nullable|string',
            'ibprs.*.effectiveness' => 'nullable|string',
            'ibprs.*.responsible_position' => 'nullable|string',
            'ibprs.*.risk_explanation' => 'nullable|string',
            'ibprs.*.probability' => 'nullable|integer',
            'ibprs.*.impact' => 'nullable|integer',
            'ibprs.*.action_plan_explanation' => 'nullable|string',
            'ibprs.*.action_plan_reference' => 'nullable|string',
            'ibprs.*.action_plan_responsible' => 'nullable|string',
            'ibprs.*.completion_date' => 'nullable|date',
            'ibprs.*.after_probability' => 'nullable|integer',
            'ibprs.*.after_impact' => 'nullable|integer',
        ]);

        if (!$this->checkUserAccess()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $ibprs = [];
        foreach ($request->ibprs as $ibprData) {
            $ibprData['station_id'] = $this->station->id;

            $ibprs[] = IBPR::updateOrCreate(['id' => $ibprData['id']], $ibprData);
        }

        return response()->json($ibprs);
    }

    public function destroy(Request $request)
    {
        if (!$this->checkUserAccess()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $ibpr = IBPR::find($request->id);
        $ibpr->delete();

        return response()->json($ibpr);
    }
}
