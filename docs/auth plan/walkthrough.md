# Ringkasan Pemisahan Tabel Pemohon dan Admin

Saya telah berhasil merombak ulang kerangka otentikasi agar persis mengikuti gaya arsitektur CI3 lama di mana Admin dan Pemohon dipisahkan di level tabel, namun tetap modern dengan pendekatan Multi-Guard Authentication bawaan Laravel.

## Yang Telah Diselesaikan:
1. **Pembuatan Tabel Terpisah**
   - Tabel `users`: Dikembalikan fungsinya murni khusus untuk menampung *Super Admin* dan *Admin*.
   - Tabel `pemohon`: Diciptakan tabel mandiri baru yang khusus menampung data pemohon publik.
2. **Penerapan Multi-Guard**
   - `Auth::guard('web')`: Digunakan untuk melindungi rute dan mengecek sesi login para Admin.
   - `Auth::guard('pemohon')`: Digunakan untuk melindungi rute dan mengecek sesi login para Pemohon.
3. **Penyatuan Form Login di `/daftar`**
   - Logika form login (di `/daftar`) telah diubah sehingga saat user menekan tombol Login, sistem akan terlebih dahulu mengecek ketersediaan email di tabel `users` (Admin). Jika gagal, sistem akan otomatis mencarinya di tabel `pemohon`.
   - Form Registrasi (Daftar) dirancang murni hanya akan menyimpan data ke tabel `pemohon`.
4. **Reseeding Database**
   - Seluruh data dummy bawaan Anda (Admin dan Aldi si pemohon) kini sudah tersemai (di-seed) ke dalam jalurnya masing-masing.

## Validasi
Seluruh rute publik, middleware proteksi, serta pengarah (redirect) otomatis sesudah registrasi telah terkalibrasi. Anda dapat mengujinya langsung dari *browser*.
