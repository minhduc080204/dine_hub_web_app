<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Discount;

class RemoveExpiredDiscounts extends Command
{
    protected $signature = 'discounts:remove-expired';
    protected $description = 'Remove expired discounts';

    public function handle()
    {
        Discount::where('expires_at', '<=', now())->delete();
        $this->info('Expired discounts removed successfully.');
    }
}