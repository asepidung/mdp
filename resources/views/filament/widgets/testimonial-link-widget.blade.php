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
                <div class="mt-6 p-4 bg-gray-100 rounded-lg flex flex-col sm:flex-row sm:items-center justify-between gap-4 dark:bg-gray-800 w-full overflow-hidden box-border">
                    <div class="flex-1 min-w-0">
                        <code class="text-xs sm:text-sm text-gray-800 break-all dark:text-gray-200 block">{{ $generatedLink }}</code>
                    </div>
                    
                    <div class="shrink-0 w-full sm:w-auto">
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
