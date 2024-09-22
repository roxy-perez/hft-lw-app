<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\TransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $income = TransactionType::where('name', 'income')->first();
        $expense = TransactionType::where('name', 'expense')->first();

        Category::create(['name' => 'Salario', 'transaction_type_id' => $income->id]);
        Category::create(['name' => 'Inversiones', 'transaction_type_id' => $income->id]);
        Category::create(['name' => 'Alimentación', 'transaction_type_id' => $expense->id]);
        Category::create(['name' => 'Transporte', 'transaction_type_id' => $expense->id]);
        Category::create(['name' => 'Salud', 'transaction_type_id' => $expense->id]);
        Category::create(['name' => 'Educación', 'transaction_type_id' => $expense->id]);
        Category::create(['name' => 'Entretenimiento', 'transaction_type_id' => $expense->id]);
        Category::create(['name' => 'Otros', 'transaction_type_id' => $expense->id]);
    }
}
