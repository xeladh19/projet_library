<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Bike_order;
use App\Models\Company;
use App\Models\Accessory;
use App\Models\Accessory_order;
use App\Models\Boxe;
use App\Models\Boxe_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Grouped_order;

class PDFController extends Controller
{
    public function generate(Request $request)
    {
        // Initialize the DOMPDF class
        $pdf = App::make('dompdf.wrapper');
        // Retrieve the HTML generated in the view using Blade
        $pdf->loadView('pdf.invoice.model-1-bike-details', $request->all());
        // Set file name
        $fileName = 'invoice_' . time() . '.pdf';

        // Upload to server
        $pdf->save(public_path("storage/invoices/" . $fileName));

        // Download PDF file in browser
        // return $pdf->stream($fileName . ".pdf");
    }

    public function purchaseOrder(Request $request)
    {
        // Retrieve data from database
        $items = [];
        foreach ($request->all() as $item) {
            if (isset($item['bike_id'])) {
                $other_keys = Bike::select('frame_number', 'locker_reference', 'key_reference')->where('id', $item['bike_id'])->first();
                if ($other_keys) {
                    $item = array_merge($item, $other_keys->toArray());
                }
            }
            $items[] = $item;
        }
        // Initialize the DOMPDF class
        $pdf = App::make('dompdf.wrapper');
        // Retrieve the HTML generated in the view using Blade
        $pdf->loadView('pdf.purchaseOrder.model-1', compact('items'));
        // Set file name
        $fileName = 'purchaseOrder.pdf';
        // Upload to server
        $pdf->save(public_path("storage/purchaseOrder/" . $fileName));
        // Return pdf file name
        return response()->json([
            'success'   => true,
            'fileName'  => "https://" . $_SERVER['HTTP_HOST'] . "/storage/purchaseOrder/" . $fileName
        ]);
    }

    public function invoice(Request $request, $order)
    {
        $bikes          = [];
        $accessories    = [];
        $boxes          = [];
        $company        = Company::with('address', 'contact')->find(Grouped_order::select('companies_id')->where('id', intval($order))->first()->companies_id);
        foreach ($request->all() as $item) {
            if ($item['name'] === 'bike') {
                $other_keys = Bike::select('frame_number', 'locker_reference', 'key_reference', 'size', 'contract_type')->where('id', $item['bike_id'])->first();
                if($other_keys['contract_type'] === 'selling') {
                    $other_keys['selling_price']    = Bike::select('selling_price')->where('id', $item['bike_id'])->first()['selling_price'];
                    $item = array_merge($item, $other_keys->toArray());
                }
                else{
                    $other_keys['leasing_price']    = Bike::select('leasing_price')->where('id', $item['bike_id'])->first()['leasing_price'];
                    $other_keys['contract_start']   = Bike::select('contract_start')->where('id', $item['bike_id'])->first()['contract_start'];
                    $other_keys['contract_end']     = Bike::select('contract_end')->where('id', $item['bike_id'])->first()['contract_end'];
                    $item = array_merge($item, $other_keys->toArray());
                }
            }
            else if($item['name'] === 'accessory') {
                $other_keys = Accessory::select('size', 'contract_type')->where('id', $item['accessory_id'])->first();
                if($other_keys['contract_type'] === 'selling') {
                    $other_keys['selling_price']    = accessory::select('selling_price')->where('id', $item['accessory_id'])->first()['selling_price'];
                    $item = array_merge($item, $other_keys->toArray());
                }
                else{
                    $other_keys['leasing_price']    = accessory::select('leasing_price')->where('id', $item['accessory_id'])->first()['leasing_price'];
                    $other_keys['contract_start']   = accessory::select('contract_start')->where('id', $item['accessory_id'])->first()['contract_start'];
                    $other_keys['contract_end']     = accessory::select('contract_end')->where('id', $item['accessory_id'])->first()['contract_end'];
                    $item = array_merge($item, $other_keys->toArray());
                }
            }
            else if($item['name'] === 'boxe') {
                $other_keys = Boxe::select('contract_start','contract_end','reference')->where('id', $item['boxe_id'])->first();
                $item = array_merge($item, $other_keys->toArray());
            }

            $items[] = $item;
        }
      
        // Initialize the DOMPDF class
        $pdf = App::make('dompdf.wrapper');
        // Retrieve the HTML generated in the view using Blade
        $pdf->loadView('pdf.invoice.model-1', compact('items','company'));
        // Set file name
        $fileName = 'invoice.pdf';
        // Upload to server
        $pdf->save(public_path("storage/invoices/" . $fileName));
        // Return pdf file name
        return response()->json([
            'success'   => true,
            'fileName'  => "https://" . $_SERVER['HTTP_HOST'] . "/storage/invoices/" . $fileName
        ]);
        // dd(count($bikes));
        dd('test');

        if(count($bikes) > 0) {
            $pdf->loadView('pdf.invoice.model-1-bike-details', compact('bikes'));
            // Set file name
            $fileName = 'invoice_bike_details.pdf';
            // Upload to server
            $pdf->save(public_path("storage/invoices/" . $fileName));
            // Return pdf file name
            return response()->json([
                'success'   => true,
                'fileName'  => "https://" . $_SERVER['HTTP_HOST'] . "/storage/invoices/" . $fileName
            ]);
        }
    }
}

