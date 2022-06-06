// Generate Invoice
Route::post('invoice/generate', [PDFController::class, 'invoice'])->middleware('auth');
 

en dessous de purchase order