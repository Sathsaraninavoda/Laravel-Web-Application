<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = [
            [
                'name' => 'Spice Gardens Ltd',
                'email' => 'contact@spicegardens.lk',
                'phone' => '+94771234567',
                'address' => '123 Spice Street, Peradeniya',
                'city' => 'Kandy',
                'country' => 'Sri Lanka',
                'status' => 'active',
                'contact_person' => 'Rajesh Kumar',
                'business_type' => 'Spice Exporter',
                'tax_number' => 'TAX001',
            ],
            [
                'name' => 'Ayurveda Exports',
                'email' => 'info@ayurvedaexports.lk',
                'phone' => '+94777654321',
                'address' => '456 Herbal Lane, Colombo 03',
                'city' => 'Colombo',
                'country' => 'Sri Lanka',
                'status' => 'active',
                'contact_person' => 'Priya Silva',
                'business_type' => 'Ayurvedic Products',
                'tax_number' => 'TAX002',
            ],
            [
                'name' => 'Ceylon Tea Co',
                'email' => 'orders@ceylontea.lk',
                'phone' => '+94773333444',
                'address' => '789 Tea Estate Road, Hatton',
                'city' => 'Nuwara Eliya',
                'country' => 'Sri Lanka',
                'status' => 'active',
                'contact_person' => 'Michael Fernando',
                'business_type' => 'Tea Exporter',
                'tax_number' => 'TAX003',
            ],
            [
                'name' => 'Craft Masters',
                'email' => 'sales@craftmasters.lk',
                'phone' => '+94771111222',
                'address' => '321 Artisan Street, Galle Fort',
                'city' => 'Galle',
                'country' => 'Sri Lanka',
                'status' => 'pending',
                'contact_person' => 'Saman Perera',
                'business_type' => 'Handicrafts',
                'tax_number' => 'TAX004',
            ],
            [
                'name' => 'Gem Palace',
                'email' => 'gems@gempalace.lk',
                'phone' => '+94775555666',
                'address' => '567 Gem Street, Ratnapura',
                'city' => 'Ratnapura',
                'country' => 'Sri Lanka',
                'status' => 'active',
                'contact_person' => 'Kumari Jayasinghe',
                'business_type' => 'Gemstone Dealer',
                'tax_number' => 'TAX005',
            ],
        ];

        foreach ($vendors as $vendor) {
            Vendor::updateOrCreate(['email' => $vendor['email']], $vendor);
        }
    }
}
