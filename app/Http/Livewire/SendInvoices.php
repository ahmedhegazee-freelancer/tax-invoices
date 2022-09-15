<?php

namespace App\Http\Livewire;

use App\Services\InvoiceService;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SendInvoices extends Component
{
    public $date;
    public function render()
    {
        $this->date = now()->toDateString();
        return view('livewire.send-invoices');
    }
    public function send()
    {
        if (DB::table('uploaded_files')->whereDate('date', '=', now()->toDateString())->count() != 2) {
            Notification::make()
                ->title('Upload All Files please')
                ->danger()
                ->send();
            return;
        }
        if (DB::table('jobs')->count('id')) {
            Notification::make()
                ->title('The importing process is not finished')
                ->danger()
                ->send();
            return;
        }
        InvoiceService::make()->generateInvoiceJobs($this->date);
        Notification::make()
            ->title('The Invoices is being formatted and sent')
            ->success()
            ->send();
    }
}