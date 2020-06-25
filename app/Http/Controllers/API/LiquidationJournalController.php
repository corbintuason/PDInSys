<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
Use App\LiquidationJournal;
use Notification;
use App\Notifications\ItemNotification;

class LiquidationJournalController extends Controller
{
    use ControllersTrait;

    public function update(Request $request, $id)
    {
        // Update First the Cost Estimate Detail
        $liquidation_journal = LiquidationJournal::findOrFail($id);
        $liquidation_journal->update($request->all());        
        $this->updateItem($liquidation_journal, LiquidationJournal::class, "Liquidation Journal", $request, true);
        Notification::send($this->notifyApprovers($liquidation_journal), new ItemNotification($liquidation_journal, $liquidation_journal::$module, "budget_request_show", $liquidation_journal->budget_request->id));

        return [    
            'refresh' => true,
            'success_text' => $liquidation_journal->code . " has been successfully updated.",
        ];
        
    }

    public function saveState(Request $request , $id){
        $liquidation_journal = LiquidationJournal::findOrFail($id);
        $liquidation_journal->update($request->all());
        return [    
            'refresh' => true,
            'success_text' => $liquidation_journal->code . " has been successfully updated.",
        ];
    }
}
