# Laporan Audit Keamanan, Performa & Arsitektur Proyek Mbok Dewor Pudding

Berdasarkan penelusuran yang dilakukan pada *source code* proyek Laravel "Mbok Dewor Pudding", ditemukan beberapa hal yang menjadi sorotan penting dan perlu ditinjau ulang demi menjaga keamanan, kerapian kode, dan performa website.

Berikut adalah temuan-temuannya:

## 1. 🚨 [Keamanan Kritis] Celah Eksekusi Cache via Rute Tidak Aman
- **Lokasi File**: `routes/web.php`
- **Baris/Bagian Kode**: `Route::get('/fix-hosting', function () { ... })`
- **Masalah**: Endpoint `/fix-hosting` ini memanggil `\Illuminate\Support\Facades\Artisan::call('optimize:clear')` dan memanipulasi symlink pada folder `storage` tanpa perlindungan apapun (tanpa autentikasi atau *middleware*).
- **Risiko**: Siapa saja yang mengetahui endpoint ini (atau *bot*) dapat memanggil URL ini berulang-ulang, yang akan membebani server dan dapat memicu *Denial of Service (DoS)* karena cache aplikasi terus dihapus dan dibentuk ulang.
- **Rekomendasi Perbaikan**: Lindungi rute ini dengan middleware `auth` dan proteksi khusus (hanya admin yang dapat memanggil), pindahkan eksekusinya ke *button* di halaman admin panel Filament, atau gunakan command SSH saja alih-alih mengeksposnya di web publik.
- **Tindakan yang Diambil:** ✅ **Diperbaiki.** Mengingat server telah dilengkapi fitur SSH (berdasarkan tangkapan layar dashboard Hostinger), kerentanan ini kini telah ditutup dengan menambahkan middleware `auth` pada rute `/fix-hosting`. Rute ini sekarang sepenuhnya aman dan hanya bisa diakses saat admin sudah *login*, sementara untuk optimasi tingkat lanjut tetap bisa dilakukan langsung via SSH.

## 2. 🚨 [Keamanan Kritis] Akses Pintu Belakang Filament Terbuka
- **Lokasi File**: `app/Models/User.php`
- **Baris/Bagian Kode**: `public function canAccessPanel(Panel $panel): bool { return true; }`
- **Masalah**: Fungsi untuk membatasi siapa saja yang berhak masuk ke dashboard Filament saat ini me- *return* `true` secara konstan/permanen.
- **Risiko**: Jika sistem di masa depan memiliki fitur *Registration* pengguna umum, maka *semua* pengguna terdaftar berhak masuk dan mengakses dashboard manajemen backend Filament, karena tidak ada pengecekan level user (role).
- **Rekomendasi Perbaikan**: Buat pengecekan sederhana yang lebih aman. Contoh: `return str_ends_with($this->email, '@yourdomain.com')` atau cek relasi role `return $this->is_admin === true`.
- **Tindakan yang Diambil:** ⏭️ **Dilewati (Skipped).** Saat ini tidak ada fitur registrasi publik, sehingga `return true` masih aman. Mengunci fungsi ini berpotensi memblokir akses login akun admin yang sedang digunakan.

## 3. ⚠️ [Arsitektur & Kode Bersih] Logika Bisnis Bertumpuk di File Routing
- **Lokasi File**: `routes/web.php`
- **Baris/Bagian Kode**: `Route::get('/', function () { ... })`
- **Masalah**: Pemanggilan data menggunakan *Eloquent Model* (Product, Category, Testimonial, SiteSetting) semuanya dilakukan di dalam *closure* routing.
- **Risiko**: Melanggar konsep dasar struktur MVC (Model-View-Controller) pada Laravel. Di masa depan jika halaman beranda bertambah kompleks, isi file `routes/web.php` akan menjadi sangat panjang, rumit, dan sulit untuk di- *testing*.
- **Rekomendasi Perbaikan**: Pindahkan semua query database tersebut ke sebuah class Controller, misalnya `HomeController@index`. File routing sebaiknya cukup bersih dan hanya berfungsi sebagai peta pengarah.
- **Tindakan yang Diambil:** ✅ **Diperbaiki.** Logika pengambilan database telah diekstrak dan dipindahkan dari `routes/web.php` ke `app/Http/Controllers/HomeController.php`. Struktur kode kini rapi mematuhi pola MVC.

## 4. ⚠️ [Risiko Spam] Testimoni Langsung Tayang
- **Lokasi File**: `app/Http/Controllers/TestimonialController.php`
- **Baris/Bagian Kode**: `Testimonial::create(['is_active' => true, ...])` pada method `store`.
- **Masalah**: Setiap ulasan pelanggan yang masuk akan di- *save* dengan status aktif (`is_active = true`), sehingga secara otomatis dan langsung tampil di halaman depan website.
- **Risiko**: Jika link ulasan tersebar atau dieksploitasi oleh bot, *spam* dan ulasan buruk dengan kata-kata tidak pantas akan langsung tayang dan dilihat oleh publik tanpa penyaringan dari admin.
- **Rekomendasi Perbaikan**: Ubah nilai defaultnya menjadi `'is_active' => false`. Buat prosedur di mana admin akan melihat ulasan yang baru masuk di Filament, meninjaunya terlebih dahulu, barulah jika valid statusnya diubah menjadi *Active*.
- **Tindakan yang Diambil:** ⏭️ **Dilewati (Skipped).** Sesuai alur operasional, testimoni sengaja diatur agar langsung tayang untuk kepraktisan. Jika terdapat *spam*, admin dapat menonaktifkannya kapan saja via panel.

## 5. 💡 [Performa] Penggunaan Tailwind CSS versi CDN di Production
- **Lokasi File**: `resources/views/welcome.blade.php`
- **Baris/Bagian Kode**: `<script src="https://cdn.tailwindcss.com"></script>`
- **Masalah**: Walaupun praktis saat tahap *development*, menjalankan *compiler* Tailwind secara *on-the-fly* lewat CDN di browser pengunjung (client) sangat tidak disarankan untuk *production*.
- **Risiko**: Waktu buka (load) website menjadi sedikit lebih lambat, karena *browser* pengguna harus mengunduh dan menjalankan file JS yang cukup besar untuk memproses styling.
- **Rekomendasi Perbaikan**: Proyek ini terpantau sudah memiliki file `vite.config.js` yang siap pakai. Silakan integrasikan styling-nya dengan `@vite('resources/css/app.css')` agar CSS di-*compile* secara final (*minified*) oleh server.
- **Tindakan yang Diambil:** ⏭️ **Dilewati (Skipped).** Mengingat *shared hosting* klien umumnya tidak mendukung *build tools* seperti Node.js, pemaksaan beralih ke Vite berpotensi merusak *styling web* di server *production*. Tailwind versi CDN tetap dipertahankan demi kompatibilitas dan kestabilan.

---
*Laporan ini dibuat berdasarkan audit source code yang terdapat pada project workspace lokal.*
