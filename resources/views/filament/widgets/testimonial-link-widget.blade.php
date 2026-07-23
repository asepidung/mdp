<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between w-full">
            <div class="w-full min-w-0">
                <h2 class="text-lg font-bold">Link Form Testimoni Pelanggan</h2>
                <p class="text-sm text-gray-500 mb-4">Buat link khusus sekali pakai untuk dikirimkan ke pelanggan.</p>
                
                <x-filament::button wire:click="generateLink" color="primary">
                    Buat Link Baru
                </x-filament::button>

                @if($generatedLink)
                <div class="mt-6 flex flex-col sm:flex-row gap-3 w-full">
                    <input type="text" readonly value="{{ $generatedLink }}" class="w-full flex-1 rounded-lg border-gray-300 bg-gray-100 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    
                    <div class="shrink-0">
                        <x-filament::button
                            color="success"
                            icon="heroicon-m-clipboard-document"
                            class="w-full sm:w-auto justify-center"
                            x-on:click="
                                navigator.clipboard.writeText('{{ $generatedLink }}')
                                $tooltip('Link disalin!', { timeout: 1500 })
                            "
                        >
                            Salin
                        </x-filament::button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
