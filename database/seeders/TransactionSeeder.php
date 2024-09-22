<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Account;
use App\Models\Category;
use App\Models\TransactionType;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener los tipos de transacción
        $incomeType = TransactionType::where('name', 'income')->first();
        $expenseType = TransactionType::where('name', 'expense')->first();

        // Obtener todas las categorías
        $incomeCategories = Category::where('transaction_type_id', $incomeType->id)->get();
        $expenseCategories = Category::where('transaction_type_id', $expenseType->id)->get();

        // Obtener todos los usuarios
        $users = User::all();

        foreach ($users as $user) {
            // Obtener las cuentas del usuario
            $accounts = $user->accounts;

            foreach ($accounts as $account) {
                // Crear transacciones de ingreso
                for ($i = 0; $i < 5; $i++) {
                    $category = $incomeCategories->random();

                    Transaction::create([
                        'user_id' => $user->id,
                        'account_id' => $account->id,
                        'category_id' => $category->id,
                        'transaction_type_id' => $incomeType->id,
                        'amount' => rand(100, 1000),
                        'date' => Carbon::now()->subDays(rand(0, 30)),
                        'description' => 'Ingreso: ' . $category->name,
                    ]);
                }

                // Crear transacciones de gasto
                for ($i = 0; $i < 5; $i++) {
                    $category = $expenseCategories->random();

                    Transaction::create([
                        'user_id' => $user->id,
                        'account_id' => $account->id,
                        'category_id' => $category->id,
                        'transaction_type_id' => $expenseType->id,
                        'amount' => -rand(50, 500),
                        'date' => Carbon::now()->subDays(rand(0, 30)),
                        'description' => 'Gasto: ' . $category->name,
                    ]);
                }
            }
        }
    }
}
