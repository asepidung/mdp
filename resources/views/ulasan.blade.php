<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulis Ulasan - Mbok Dewor Puding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .star-rating input { display: none; }
        .star-rating label { cursor: pointer; color: #D1D5DB; transition: color 0.2s; }
        .star-rating label:hover, .star-rating label:hover ~ label, .star-rating input:checked ~ label { color: #F59E0B; }
        .star-rating { flex-direction: row-reverse; display: flex; justify-content: flex-end; }
    </style>
</head>
<body class="bg-[#F3EFE9] min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl p-8 border border-amber-100">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-[#1F1109] mb-2">Ceritakan Pengalamanmu!</h1>
            <p class="text-sm text-gray-500">Ulasan Anda sangat berarti bagi Mbok Dewor Puding.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-xl text-center font-medium mb-6 border border-green-200">
                ✅ {{ session('success') }}
            </div>
        @else
            <form action="{{ route('ulasan.store', $token) }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-bold text-[#1F1109] mb-2">Nama Anda</label>
                    <input type="text" name="customer_name" required 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#D97706] focus:border-transparent outline-none transition-all"
                        placeholder="Contoh: Asep Idung" value="{{ old('customer_name') }}">
                    @error('customer_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#1F1109] mb-2">Rating Bintang</label>
                    <div class="star-rating gap-1 text-4xl">
                        <input type="radio" id="star5" name="rating" value="5" {{ old('rating', 5) == 5 ? 'checked' : '' }} />
                        <label for="star5" title="5 bintang">★</label>
                        <input type="radio" id="star4" name="rating" value="4" {{ old('rating') == 4 ? 'checked' : '' }} />
                        <label for="star4" title="4 bintang">★</label>
                        <input type="radio" id="star3" name="rating" value="3" {{ old('rating') == 3 ? 'checked' : '' }} />
                        <label for="star3" title="3 bintang">★</label>
                        <input type="radio" id="star2" name="rating" value="2" {{ old('rating') == 2 ? 'checked' : '' }} />
                        <label for="star2" title="2 bintang">★</label>
                        <input type="radio" id="star1" name="rating" value="1" {{ old('rating') == 1 ? 'checked' : '' }} />
                        <label for="star1" title="1 bintang">★</label>
                    </div>
                    @error('rating') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#1F1109] mb-2">Ulasan</label>
                    <textarea name="content" required rows="4"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#D97706] focus:border-transparent outline-none transition-all resize-none"
                        placeholder="Gimana rasa pudingnya? Lumer kan?">{{ old('content') }}</textarea>
                    @error('content') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full bg-[#D97706] hover:bg-[#B45309] text-white font-bold py-4 rounded-xl transition-colors shadow-lg shadow-orange-200">
                    Kirim Ulasan Sekarang
                </button>
            </form>
        @endif

    </div>

</body>
</html>
