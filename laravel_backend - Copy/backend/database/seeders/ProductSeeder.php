<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Ceylon Cinnamon Sticks',
                'description' => 'Premium quality Ceylon cinnamon sticks, known for their sweet and delicate flavor. Perfect for cooking, baking, and traditional medicine.',
                'category' => 'Spices',
                'price' => 25.99,
                'cost_price' => 12.50,
                'stock_quantity' => 45,
                'min_stock_level' => 10,
                'image_path' => 'CeylonCinnamonSticks.jpg',
                'sku' => 'CIN-001',
                'status' => 'active',
                'weight' => 0.250,
                'dimensions' => '15cm x 10cm x 5cm',
                'tags' => 'cinnamon, spice, organic, ceylon, premium',
                'featured' => true
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Ceylon Black Tea',
                'description' => 'Authentic Ceylon black tea with rich flavor and aroma. Sourced directly from the hill country tea gardens of Sri Lanka.',
                'category' => 'Tea',
                'price' => 18.50,
                'cost_price' => 8.75,
                'stock_quantity' => 32,
                'min_stock_level' => 8,
                'image_path' => 'Ceylon Tea.jpg',
                'sku' => 'TEA-001',
                'status' => 'active',
                'weight' => 0.200,
                'dimensions' => '12cm x 8cm x 3cm',
                'tags' => 'tea, black tea, ceylon, premium, organic',
                'featured' => true
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Authentic Curry Spice Mix',
                'description' => 'Traditional Sri Lankan curry spice blend with authentic flavors. Contains coriander, cumin, fennel, and other aromatic spices.',
                'category' => 'Spices',
                'price' => 15.99,
                'cost_price' => 7.25,
                'stock_quantity' => 28,
                'min_stock_level' => 5,
                'image_path' => 'AuthenticCurrySpiceMix.jpg',
                'sku' => 'CUR-001',
                'status' => 'active',
                'weight' => 0.150,
                'dimensions' => '10cm x 8cm x 4cm',
                'tags' => 'curry, spice mix, authentic, sri lankan',
                'featured' => false
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Ayurvedic Herbal Oil',
                'description' => 'Traditional Ayurvedic herbal oil blend for therapeutic massage and wellness. Made with natural herbs and coconut oil.',
                'category' => 'Ayurvedic',
                'price' => 32.75,
                'cost_price' => 15.50,
                'stock_quantity' => 18,
                'min_stock_level' => 5,
                'image_path' => 'Ayurvedic Oils.jpg',
                'sku' => 'AYU-001',
                'status' => 'active',
                'weight' => 0.300,
                'dimensions' => '8cm x 8cm x 12cm',
                'tags' => 'ayurvedic, herbal oil, massage, wellness',
                'featured' => true
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Traditional Batik Wear',
                'description' => 'Handcrafted traditional batik clothing with authentic Sri Lankan patterns. Made from high-quality cotton fabric.',
                'category' => 'Clothing',
                'price' => 89.99,
                'cost_price' => 45.00,
                'stock_quantity' => 12,
                'min_stock_level' => 3,
                'image_path' => 'Batik Wear.jpg',
                'sku' => 'BAT-001',
                'status' => 'active',
                'weight' => 0.400,
                'dimensions' => 'Medium Size',
                'tags' => 'batik, clothing, traditional, handcrafted',
                'featured' => true
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Carved Wooden Elephant',
                'description' => 'Beautifully carved wooden elephant sculpture, a symbol of good luck and wisdom in Sri Lankan culture.',
                'category' => 'Handicrafts',
                'price' => 45.50,
                'cost_price' => 22.75,
                'stock_quantity' => 15,
                'min_stock_level' => 4,
                'image_path' => 'CarvedWoodenElephant.jpg',
                'sku' => 'WOD-001',
                'status' => 'active',
                'weight' => 0.800,
                'dimensions' => '20cm x 15cm x 12cm',
                'tags' => 'wooden, elephant, carved, handicraft, sculpture',
                'featured' => false
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Ceylon Spices Collection',
                'description' => 'Premium collection of authentic Ceylon spices including cardamom, cloves, nutmeg, and black pepper.',
                'category' => 'Spices',
                'price' => 42.99,
                'cost_price' => 20.50,
                'stock_quantity' => 22,
                'min_stock_level' => 6,
                'image_path' => 'Ceylon Spices.jpg',
                'sku' => 'SPI-001',
                'status' => 'active',
                'weight' => 0.500,
                'dimensions' => '25cm x 15cm x 8cm',
                'tags' => 'spices, ceylon, collection, premium, organic',
                'featured' => true
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Traditional Jewelry Set',
                'description' => 'Elegant traditional Sri Lankan jewelry set with intricate designs. Perfect for special occasions and cultural events.',
                'category' => 'Jewelry',
                'price' => 125.00,
                'cost_price' => 62.50,
                'stock_quantity' => 8,
                'min_stock_level' => 2,
                'image_path' => 'Traditional Jewelry.jpg',
                'sku' => 'JEW-001',
                'status' => 'active',
                'weight' => 0.150,
                'dimensions' => 'One Size',
                'tags' => 'jewelry, traditional, elegant, cultural',
                'featured' => true
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Handwoven Basket',
                'description' => 'Traditional handwoven basket made from natural materials. Perfect for storage and home decoration.',
                'category' => 'Handicrafts',
                'price' => 28.75,
                'cost_price' => 14.25,
                'stock_quantity' => 20,
                'min_stock_level' => 5,
                'image_path' => 'TraditionalHandwovenBasket.jpg',
                'sku' => 'BAS-001',
                'status' => 'active',
                'weight' => 0.600,
                'dimensions' => '30cm x 25cm x 20cm',
                'tags' => 'basket, handwoven, traditional, natural, storage',
                'featured' => false
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Black Pepper Premium',
                'description' => 'High-quality Ceylon black pepper with intense flavor and aroma. Perfect for culinary use and seasoning.',
                'category' => 'Spices',
                'price' => 22.50,
                'cost_price' => 11.25,
                'stock_quantity' => 35,
                'min_stock_level' => 8,
                'image_path' => 'blackpepper.jpg',
                'sku' => 'PEP-001',
                'status' => 'active',
                'weight' => 0.200,
                'dimensions' => '12cm x 8cm x 5cm',
                'tags' => 'black pepper, spice, premium, ceylon',
                'featured' => false
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Cardamom Premium Grade',
                'description' => 'Premium grade cardamom pods with exceptional aroma and flavor. Essential for authentic Sri Lankan cuisine.',
                'category' => 'Spices',
                'price' => 38.99,
                'cost_price' => 18.50,
                'stock_quantity' => 16,
                'min_stock_level' => 4,
                'image_path' => 'cardmom.jpg',
                'sku' => 'CAR-001',
                'status' => 'active',
                'weight' => 0.100,
                'dimensions' => '10cm x 6cm x 4cm',
                'tags' => 'cardamom, spice, premium, aromatic',
                'featured' => true
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Cloves Whole',
                'description' => 'Whole cloves with rich aroma and flavor. Perfect for cooking, baking, and traditional medicine.',
                'category' => 'Spices',
                'price' => 19.75,
                'cost_price' => 9.50,
                'stock_quantity' => 25,
                'min_stock_level' => 6,
                'image_path' => 'cloves.jpg',
                'sku' => 'CLO-001',
                'status' => 'active',
                'weight' => 0.150,
                'dimensions' => '10cm x 8cm x 4cm',
                'tags' => 'cloves, spice, whole, aromatic',
                'featured' => false
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Wooden Handicrafts Collection',
                'description' => 'Beautiful collection of wooden handicrafts including bowls, decorative items, and traditional artifacts.',
                'category' => 'Handicrafts',
                'price' => 65.00,
                'cost_price' => 32.50,
                'stock_quantity' => 10,
                'min_stock_level' => 3,
                'image_path' => 'Wooden Handicrafts.jpg',
                'sku' => 'WOD-002',
                'status' => 'active',
                'weight' => 1.200,
                'dimensions' => '35cm x 25cm x 15cm',
                'tags' => 'wooden, handicrafts, collection, traditional',
                'featured' => false
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Cultural Art Piece',
                'description' => 'Authentic Sri Lankan cultural art piece showcasing traditional designs and craftsmanship.',
                'category' => 'Art',
                'price' => 95.50,
                'cost_price' => 47.75,
                'stock_quantity' => 6,
                'min_stock_level' => 2,
                'image_path' => 'culturalart.JPG',
                'sku' => 'ART-001',
                'status' => 'active',
                'weight' => 0.800,
                'dimensions' => '40cm x 30cm x 5cm',
                'tags' => 'art, cultural, traditional, authentic, decorative',
                'featured' => true
            ],
            [
                'product_code' => Product::generateProductCode(),
                'name' => 'Beli Mal Tea',
                'description' => 'Traditional Beli Mal herbal tea with natural healing properties. Known for its digestive benefits.',
                'category' => 'Tea',
                'price' => 16.25,
                'cost_price' => 8.00,
                'stock_quantity' => 24,
                'min_stock_level' => 6,
                'image_path' => 'belimaltea.jpg',
                'sku' => 'TEA-002',
                'status' => 'active',
                'weight' => 0.150,
                'dimensions' => '12cm x 8cm x 3cm',
                'tags' => 'herbal tea, beli mal, natural, healing, digestive',
                'featured' => false
            ]
        ];

        foreach ($products as $productData) {
            $productCode = $productData['product_code'];
            unset($productData['product_code']);

            $product = Product::firstOrNew(['sku' => $productData['sku']]);

            if (! $product->exists) {
                $product->product_code = $productCode;
            }

            $product->fill($productData)->save();
        }
    }
}
