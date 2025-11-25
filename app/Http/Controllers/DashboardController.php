<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\DutyShift;
use App\Models\DutyRoster;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $station = $this->checkStation();
        $totalEmployees = $station->employees()->count();
        $totalTrains = $station->trains()->count();
        // $weather = $this->getWeatherData($station->latitude, $station->longitude);

        // Get employees per shift for today
        $today = date('j'); // Day of month without leading zeros
        $currentMonth = date('n');
        $currentYear = date('Y');

        $dutyRoster = DutyRoster::where('station_id', $station->id)->where('year', $currentYear)->where('month', $currentMonth)->first();

        $employeesPerShift = [];
        if ($dutyRoster) {
            $shifts = DutyShift::where('station_id', $station->id)->where('name', 'like', '%Dinas%')->get();

            foreach ($shifts as $shift) {
                $employees = $dutyRoster->dutyAssignments()
                    ->where('day', $today)
                    ->where('duty_shift_id', $shift->id)
                    ->with('employee')
                    ->get()
                    ->pluck('employee');

                // Sort employees by position order
                $employeesPerShift[$shift->name] = $employees->sortBy(function($employee) {
                    $positionOrder = [
                        'Kepala Stasiun' => 1,
                        'Wakil Kepala Stasiun' => 2,
                        'PPKA' => 3,
                        'PRS' => 4,
                        'PLR' => 5,
                        'PJL' => 6,
                        'Loket' => 7,
                        'Customer Service' => 8,
                        'Announcer' => 9,
                        'Security' => 10,
                        'Cleaning Service' => 11,
                    ];
                    return $positionOrder[$employee->position] ?? 999;
                })->values();
            }
        }

        return view('dashboard', compact('station', 'totalEmployees', 'totalTrains', 'employeesPerShift'));
    }
}
