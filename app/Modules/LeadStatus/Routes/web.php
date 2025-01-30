<?php

use App\Modules\LeadStatus\Controllers\LeadStatusController;
use Illuminate\Support\Facades\Route;

Route::get('lead-status', [LeadStatusController::class, 'index'])->name('lead.status.index');
Route::get('lead-status/create', [LeadStatusController::class, 'create'])->name('lead.status.create');
Route::post('lead-status', [LeadStatusController::class, 'store'])->name('lead.status.store');
Route::get('lead-status/{leadStatus}/edit', [LeadStatusController::class, 'edit'])->name('lead.status.edit');
Route::put('lead-status/{leadStatus}', [LeadStatusController::class, 'update'])->name('lead.status.update');
Route::delete('lead-status/{leadStatus}', [LeadStatusController::class, 'destroy'])->name('lead.status.destroy');
