<?php

namespace App\Http\Livewire;

use App\Imports\InvoiceItemsImport;
use App\Imports\InvoicesImport;
use Filament\Notifications\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
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
            'file' => 'required|file|max:20480', // 20MB Max
            'fileType' => 'required|string|in:tickets,items'
        ]);

        DB::table('invoices')->truncate();
        DB::table('invoice_items')->truncate();
        if ($this->fileType == "tickets") {
            Excel::queueImport(new InvoicesImport, $this->file)->onQueue('invoices');
        } else
            Excel::queueImport(new InvoiceItemsImport, $this->file)->onQueue('invoice-items');
        Notification::make()
            ->title('Uploaded successfully')
            ->success()
            ->send();
    }
}