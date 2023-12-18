<?php

namespace App\Http\Controllers;

use App\Models\Calls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data['report_calls'] = Calls::all();

        return view('reports.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'filecsv'          => 'required|file',
        ]);

        if ($request->file('filecsv')) {
            $file           = $request->file('filecsv');
            $fileContents = file($file->getPathname());

            foreach ($fileContents as $line) {
                $data = str_getcsv($line);

                Calls::create([
                    'customer_id'       => $data[0],
                    'call_date'         => $data[1],
                    'duration'          => $data[2],
                    'dialed_phone'      => $data[3],
                    'customer_ip'       => $data[4],
                ]);
            }
        }

        return 'success';
    }

    /**
     * Display the specified resource.
     */
    public function show(Calls $calls)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calls $calls)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calls $calls)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calls $calls)
    {
        //
    }

    public function getTable()
    {
        $data['calls_reports']      = DB::select("SELECT DISTINCT
                    customer_id,
                    customer_ip,
                    (SELECT COUNT(t2.customer_ip) FROM calls t2 WHERE t1.customer_ip = t2.customer_ip) AS 'numberofcallswithinsamecontinent',
                    (SELECT SUM(t2.duration) FROM calls t2 WHERE t1.customer_ip = t2.customer_ip) AS 'totaldurationwithinsamecontinent',
                    (SELECT COUNT(t2.customer_id) FROM calls t2 WHERE t1.customer_id = t2.customer_id) AS 'totalnumberofallcalls',
                    (SELECT SUM(t2.duration) FROM calls t2 WHERE t1.customer_id = t2.customer_id) AS 'totaldurationofallcalls'
                FROM
                    calls t1");


        return view('reports.table', $data);
    }
}
