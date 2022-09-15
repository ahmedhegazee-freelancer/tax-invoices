<?php

namespace App\Http\Livewire;

use App\Imports\InvoiceItemsImport;
use App\Imports\InvoicesImport;
use App\Models\UploadedFile;
use Filament\Notifications\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class UploadFile extends Component
{
    use WithFileUploads;
    public $file;
    public $fileType = "tickets";
    public function render()
    {

        return view('livewire.upload-file');
    }
    public function upload()
    {
        $this->validate([
            'file' => 'required|file|max:204800', // 200MB Max
            'fileType' => 'required|string|in:tickets,items'
        ]);


        if (UploadedFile::where('type', $this->fileType)->where('date', now()->toDateString())->exists()) {
            Notification::make()
                ->title('This file uploaded before')
                ->danger()
                ->send();
            return;
        }
        if ($this->fileType == "tickets") {
            Cache::forget('last-date');
            Excel::queueImport(new InvoicesImport, $this->file)->allOnQueue('invoices');
        } else {
            Cache::forget('item-last-date');
            Excel::queueImport(new InvoiceItemsImport, $this->file)->allOnQueue('invoice-items');
        }

        UploadedFile::create(['type' => $this->fileType, 'date' => now()->toDateString()]);
        Notification::make()
            ->title('Uploaded successfully')
            ->success()
            ->send();
    }
}