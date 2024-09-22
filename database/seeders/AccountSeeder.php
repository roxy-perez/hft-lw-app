<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los usuarios
        $users = User::all();

        // Para cada usuario, crear cuentas
        foreach ($users as $user) {
            // Crear una cuenta de efectivo
            $cashAccount = Account::create([
                'user_id' => $user->id,
                'name' => 'Efectivo',
                'balance' => 1000.00,
                'type' => 'cash',
            ]);

            // Actualizar el 'account_id' del usuario con el ID de la cuenta de efectivo
            $user->account_id = $cashAccount->id;
            $user->save();

            // Crear una cuenta de ahorros
            Account::create([
                'user_id' => $user->id,
                'name' => 'Cuenta de Ahorros',
                'balance' => 5000.00,
                'type' => 'savings',
            ]);

            // Crear una cuenta de crédito
            Account::create([
                'user_id' => $user->id,
                'name' => 'Tarjeta de Crédito',
                'balance' => -1500.00,
                'type' => 'credit',
            ]);

        }
    }
}
