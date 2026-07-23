<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold">Link Form Testimoni Pelanggan</h2>
                <p class="text-sm text-gray-500 mb-4">Buat link khusus sekali pakai untuk dikirimkan ke pelanggan.</p>
                
                <x-filament::button wire:click="generateLink" color="primary">
                    Buat Link Baru
                </x-filament::button>

                @if($generatedLink)
                <div class="mt-6 p-4 bg-gray-100 rounded-lg flex items-center justify-between gap-4 dark:bg-gray-800">
                    <code class="text-sm text-gray-800 break-all dark:text-gray-200">{{ $generatedLink }}</code>
                    
                    <x-filament::button
                        color="success"
                        icon="heroicon-m-clipboard-document"
                        x-on:click="
                            navigator.clipboard.writeText('{{ $generatedLink }}')
                            $tooltip('Link disalin!', { timeout: 1500 })
                        "
                    >
                        Salin
                    </x-filament::button>
                </div>
                @endif
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
