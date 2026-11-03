<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create super admin user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        // Create staff user
        $staff = User::create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // Create categories
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic devices and accessories'],
            ['name' => 'Groceries', 'description' => 'Food items and daily essentials'],
            ['name' => 'Clothing', 'description' => 'Apparel and fashion items'],
            ['name' => 'Stationery', 'description' => 'Office and school supplies'],
            ['name' => 'Home & Kitchen', 'description' => 'Household and kitchen items'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create suppliers
        $suppliers = [
            ['name' => 'ABC Trading Co.', 'phone' => '01711-123456', 'email' => 'abc@trading.com', 'address' => 'Dhaka, Bangladesh'],
            ['name' => 'XYZ Distributors', 'phone' => '01811-654321', 'email' => 'xyz@dist.com', 'address' => 'Chittagong, Bangladesh'],
            ['name' => 'Local Wholesale', 'phone' => '01911-111222', 'email' => 'local@wholesale.com', 'address' => 'Sylhet, Bangladesh'],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }

        // Create sample products
        $products = [
            ['name' => 'Wireless Mouse', 'sku' => 'ELEC-001', 'category_id' => 1, 'supplier_id' => 1, 'unit' => 'pcs', 'cost_price' => 350, 'selling_price' => 500, 'quantity' => 25, 'min_stock_level' => 10],
            ['name' => 'USB Cable', 'sku' => 'ELEC-002', 'category_id' => 1, 'supplier_id' => 1, 'unit' => 'pcs', 'cost_price' => 80, 'selling_price' => 150, 'quantity' => 50, 'min_stock_level' => 20],
            ['name' => 'Rice (5kg)', 'sku' => 'GROC-001', 'category_id' => 2, 'supplier_id' => 2, 'unit' => 'pack', 'cost_price' => 280, 'selling_price' => 320, 'quantity' => 30, 'min_stock_level' => 15],
            ['name' => 'Sugar (1kg)', 'sku' => 'GROC-002', 'category_id' => 2, 'supplier_id' => 2, 'unit' => 'pack', 'cost_price' => 95, 'selling_price' => 110, 'quantity' => 5, 'min_stock_level' => 20],
            ['name' => 'T-Shirt (M)', 'sku' => 'CLTH-001', 'category_id' => 3, 'supplier_id' => 3, 'unit' => 'pcs', 'cost_price' => 200, 'selling_price' => 350, 'quantity' => 15, 'min_stock_level' => 10],
            ['name' => 'Notebook (100 pages)', 'sku' => 'STAT-001', 'category_id' => 4, 'supplier_id' => 1, 'unit' => 'pcs', 'cost_price' => 25, 'selling_price' => 40, 'quantity' => 100, 'min_stock_level' => 50],
            ['name' => 'Ballpoint Pen', 'sku' => 'STAT-002', 'category_id' => 4, 'supplier_id' => 1, 'unit' => 'pcs', 'cost_price' => 8, 'selling_price' => 15, 'quantity' => 3, 'min_stock_level' => 30],
            ['name' => 'Water Bottle (1L)', 'sku' => 'HOME-001', 'category_id' => 5, 'supplier_id' => 3, 'unit' => 'pcs', 'cost_price' => 120, 'selling_price' => 180, 'quantity' => 40, 'min_stock_level' => 15],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Create sample stock movements to demonstrate history
        $stockMovements = [
            // Wireless Mouse movements
            ['product_id' => 1, 'user_id' => 1, 'type' => 'in', 'quantity' => 50, 'reference' => 'PO-001', 'notes' => 'Initial stock purchase', 'created_at' => Carbon::now()->subDays(30)],
            ['product_id' => 1, 'user_id' => 2, 'type' => 'out', 'quantity' => 10, 'reference' => 'SALE-001', 'notes' => 'Sold to customer', 'created_at' => Carbon::now()->subDays(25)],
            ['product_id' => 1, 'user_id' => 2, 'type' => 'out', 'quantity' => 8, 'reference' => 'SALE-005', 'notes' => 'Bulk sale', 'created_at' => Carbon::now()->subDays(15)],
            ['product_id' => 1, 'user_id' => 1, 'type' => 'out', 'quantity' => 7, 'reference' => 'SALE-010', 'notes' => 'Regular sale', 'created_at' => Carbon::now()->subDays(5)],
            
            // USB Cable movements
            ['product_id' => 2, 'user_id' => 1, 'type' => 'in', 'quantity' => 100, 'reference' => 'PO-001', 'notes' => 'Initial stock', 'created_at' => Carbon::now()->subDays(30)],
            ['product_id' => 2, 'user_id' => 2, 'type' => 'out', 'quantity' => 25, 'reference' => 'SALE-002', 'notes' => 'Wholesale order', 'created_at' => Carbon::now()->subDays(20)],
            ['product_id' => 2, 'user_id' => 2, 'type' => 'out', 'quantity' => 15, 'reference' => 'SALE-007', 'notes' => 'Retail sales', 'created_at' => Carbon::now()->subDays(10)],
            ['product_id' => 2, 'user_id' => 1, 'type' => 'out', 'quantity' => 10, 'reference' => 'SALE-012', 'notes' => 'Customer order', 'created_at' => Carbon::now()->subDays(2)],

            // Rice movements
            ['product_id' => 3, 'user_id' => 1, 'type' => 'in', 'quantity' => 50, 'reference' => 'PO-002', 'notes' => 'Monthly restock', 'created_at' => Carbon::now()->subDays(28)],
            ['product_id' => 3, 'user_id' => 2, 'type' => 'out', 'quantity' => 12, 'reference' => 'SALE-003', 'notes' => 'Daily sales', 'created_at' => Carbon::now()->subDays(18)],
            ['product_id' => 3, 'user_id' => 2, 'type' => 'out', 'quantity' => 8, 'reference' => 'SALE-008', 'notes' => 'Weekend sale', 'created_at' => Carbon::now()->subDays(7)],

            // Sugar movements (low stock example)
            ['product_id' => 4, 'user_id' => 1, 'type' => 'in', 'quantity' => 30, 'reference' => 'PO-002', 'notes' => 'Stock purchase', 'created_at' => Carbon::now()->subDays(28)],
            ['product_id' => 4, 'user_id' => 2, 'type' => 'out', 'quantity' => 15, 'reference' => 'SALE-004', 'notes' => 'Bulk customer', 'created_at' => Carbon::now()->subDays(14)],
            ['product_id' => 4, 'user_id' => 2, 'type' => 'out', 'quantity' => 10, 'reference' => 'SALE-009', 'notes' => 'Regular sales', 'created_at' => Carbon::now()->subDays(3)],

            // T-Shirt movements
            ['product_id' => 5, 'user_id' => 1, 'type' => 'in', 'quantity' => 25, 'reference' => 'PO-003', 'notes' => 'New collection', 'created_at' => Carbon::now()->subDays(21)],
            ['product_id' => 5, 'user_id' => 2, 'type' => 'out', 'quantity' => 10, 'reference' => 'SALE-006', 'notes' => 'Store sales', 'created_at' => Carbon::now()->subDays(12)],

            // Notebook movements
            ['product_id' => 6, 'user_id' => 1, 'type' => 'in', 'quantity' => 150, 'reference' => 'PO-004', 'notes' => 'School season stock', 'created_at' => Carbon::now()->subDays(25)],
            ['product_id' => 6, 'user_id' => 2, 'type' => 'out', 'quantity' => 30, 'reference' => 'SALE-011', 'notes' => 'School order', 'created_at' => Carbon::now()->subDays(8)],
            ['product_id' => 6, 'user_id' => 2, 'type' => 'out', 'quantity' => 20, 'reference' => 'SALE-013', 'notes' => 'Office supplies order', 'created_at' => Carbon::now()->subDays(1)],

            // Ballpoint Pen movements (low stock example)
            ['product_id' => 7, 'user_id' => 1, 'type' => 'in', 'quantity' => 50, 'reference' => 'PO-004', 'notes' => 'Bulk purchase', 'created_at' => Carbon::now()->subDays(25)],
            ['product_id' => 7, 'user_id' => 2, 'type' => 'out', 'quantity' => 25, 'reference' => 'SALE-011', 'notes' => 'School order', 'created_at' => Carbon::now()->subDays(8)],
            ['product_id' => 7, 'user_id' => 2, 'type' => 'out', 'quantity' => 22, 'reference' => 'SALE-014', 'notes' => 'Office order', 'created_at' => Carbon::now()->subDays(1)],

            // Water Bottle movements
            ['product_id' => 8, 'user_id' => 1, 'type' => 'in', 'quantity' => 60, 'reference' => 'PO-005', 'notes' => 'Summer stock', 'created_at' => Carbon::now()->subDays(20)],
            ['product_id' => 8, 'user_id' => 2, 'type' => 'out', 'quantity' => 15, 'reference' => 'SALE-015', 'notes' => 'Gym orders', 'created_at' => Carbon::now()->subDays(10)],
            ['product_id' => 8, 'user_id' => 2, 'type' => 'out', 'quantity' => 5, 'reference' => 'SALE-016', 'notes' => 'Walk-in customers', 'created_at' => Carbon::now()->subDays(2)],
        ];

        foreach ($stockMovements as $movement) {
            StockMovement::create($movement);
        }
    }
}
