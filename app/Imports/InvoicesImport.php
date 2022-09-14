<?php

namespace App\Imports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoicesImport implements ToModel, WithBatchInserts, WithChunkReading, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //skip first row
        if ($row[0] == 'ID') {
            return null;
        }
        // //skip not paid
        // if (!$row[12]) {
        //     return null;
        // }
        // //skip voided
        // if ($row[13]) {
        //     return null;
        // }
        // //skip deleted
        // if ($row[68]) {
        //     return null;
        // }
        return new Invoice([
            'closing_date' => $row[8],
            'ticket_id' => $row[0],
            'sub_total' => $row[19],
            'total' => $row[22],
            'discount' => $row[20],
            'tax' => $row[21],
            'fees' => $row[43],
            'terminal_id' => $row[61],
            'paid' => \boolval($row[12]),
            'voided' => \boolval($row[13]),
            'deleted' => \boolval($row[68]),
        ]);
    }
    public function chunkSize(): int
    {
        return 100;
    }
    public function batchSize(): int
    {
        return 100;
    }
}