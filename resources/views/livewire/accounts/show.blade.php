<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use WireUi\Traits\WireUiActions;

use App\Models\Account;

new class extends Component {
    use WireUiActions;

    public function deleteAccount($id)
    {
        $account = Account::where('id', $id)->first();
        $this->authorize('delete', $account);
        $account->delete();

        $this->notification()->success(
            $title = __('Account deleted'),
            $description = __('The account has been successfully deleted.')
        );
    }

    public function with(): array
    {
        return [
            'accounts' => Auth::user()->accounts()->orderBy('name', 'asc')->get(),
        ];
    }
}; ?>

<main>
    <div class="space-y-2">
        @if ($accounts->isEmpty())
            <div class="p-6 text-center text-gray-600 dark:text-primary-200">
                <p class="text-lg font-semibold">No hay cuentas registradas</p>
                <p class="text-sm">¡Vamos a crear una!</p>
                <x-button label="Crear cuenta" rounded="full" right-icon="plus" interaction="primary"
                          class="mt-6 text-2xl bg-primary-500 font-semibold ring ring-offset-2 ring-secondary-300 hover:bg-tertiary-100"
                          href="{{ route('accounts.create') }}" wire:navigate/>
            </div>
        @else
            <x-button label="Crear cuenta" outline rounded="full" right-icon="plus" emerald
                      class="mb-12 text-md text-secondary-700 bg-primary-400 font-semibold ring ring-offset-2 ring-secondary-300 hover:bg-tertiary-400"
                      href="{{ route('accounts.create') }}" wire:navigate/>
            <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2 md:gap-6">
                @foreach ($accounts as $account)
                    <x-card wire:key="{{ $account->id }}"
                            class="mb-4 text-surface dark:text-surface-200 shadow-tertiary shadow-lg dark:shadow-primary-700">
                        <div class="flex items-center justify-between">
                            <div class="px-3 py-2">
                                <a href="{{route('accounts.edit', $account)}}" wire:navigate
                                   class="font-semibold text-lg text-gray-600 dark:text-primary-200 leading-tight hover:underline hover:text-tertiary-400 dark:hover:text-tertiary-200">
                                    {{ $account->name }}
                                </a>
                            </div>
                            <div class="px-3 font-mono text-md">
                                <p class="text-primary-600 dark:text-primary-400">
                                    @if ($account->balance > 0)
                                        <span class="text-green-600 dark:text-primary-500">{{ $account->balance }}
                                        </span>
                                    @else
                                        <span class="text-red-600 dark:text-tertiary-700">{{ $account->balance }}
                                        </span>
                                    @endif
                                    <x-heroicons::outline.currency-euro
                                        class="inline-flex text-gray-600 dark:text-primary-200"/>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-end text-xs">
                            <p class="px-3 my-8 text-gray-600 dark:text-primary-200">
                                Última actualización: {{ $account->updated_at->diffForHumans() }}
                            </p>
                        </div>
                        <hr class="h-px my-2 border-1 border-tertiary-200 dark:border-tertiary-700"/>
                        <div class="flex items-center justify-end text-xs">
                            <div class="px-3 py-2">
                                <x-button emerald label="Ver más" rounded="full" right-icon="eye"
                                          interaction="secondary"
                                          class="hidden mr-2 ring ring-offset-2 ring-secondary-300 items-center md:inline-flex"/>
                                <x-mini-button class="md:hidden" rounded primary icon="eye"/>
                                <x-button label="Borrar" rounded="full" right-icon="trash" interaction="secondary"
                                          class="hidden ring ring-offset-2 ring-secondary-300 md:inline-flex" spinner
                                          red
                                          wire:click="deleteAccount({{ $account->id }}) "/>
                                <x-mini-button class="md:hidden" rounded red icon="trash"
                                               wire:click="deleteAccount({{ $account->id }})"/>
                                <x-notifications/>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</main>
