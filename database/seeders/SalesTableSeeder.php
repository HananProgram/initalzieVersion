<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;

class SalesTableSeeder extends Seeder
{
    public function run(): void
    {
        $agencyId = 1; // تأكد أن لديك وكالة بهذا الرقم
        $userId = 1;   // تأكد أن لديك مستخدم بهذا الرقم
        $serviceTypeId = 1;
        $providerId = 1;
        $accountId = 1;

        $sales = [
            [
                'agency_id' => $agencyId,
                'user_id' => $userId,
                'customer_id' => null,
                'service_type_id' => $serviceTypeId,
                'provider_id' => $providerId,
                'intermediary_id' => null,
                'account_id' => $accountId,
                'sale_date' => '2025-07-01',
                'beneficiary_name' => 'أحمد محمد',
                'route' => 'صنعاء - القاهرة',
                'pnr' => 'PNR123',
                'reference' => 'REF001',
                'action' => 'إصدار',
                'usd_buy' => 150.00,
                'usd_sell' => 200.00,
                'amount_received' => 220.00,
                'depositor_name' => 'خالد سعيد',
                'note' => 'تمت العملية بنجاح',
                'sale_profit' => 50.00,
            ],
            [
                'agency_id' => $agencyId,
                'user_id' => $userId,
                'customer_id' => null,
                'service_type_id' => $serviceTypeId,
                'provider_id' => $providerId,
                'intermediary_id' => null,
                'account_id' => $accountId,
                'sale_date' => '2025-07-02',
                'beneficiary_name' => 'منى عبد الله',
                'route' => 'عدن - دبي',
                'pnr' => 'PNR456',
                'reference' => 'REF002',
                'action' => 'إصدار',
                'usd_buy' => 120.00,
                'usd_sell' => 180.00,
                'amount_received' => 190.00,
                'depositor_name' => 'سامي علي',
                'note' => 'عميل دائم',
                'sale_profit' => 60.00,
            ],
            // أضف باقي السجلات بنفس النمط...
        ];

        foreach ($sales as $sale) {
            Sale::create($sale);
        }

        echo "✅ تم إضافة " . count($sales) . " سجلات مبيعات.\n";
    }
}
