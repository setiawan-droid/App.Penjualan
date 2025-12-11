# ===========================================
#   TEST SUITE : MENU LOGIN
# ===========================================

Fitur: Menu Login
  Untuk memastikan proses login berjalan dengan benar
  Sebagai pengguna aplikasi
  Saya ingin bisa masuk menggunakan email dan password yang valid

  # -------------------------
  # SCENARIO POSITIF
  # -------------------------

  Skenario: Login berhasil dengan kredensial yang valid
    Dengan saya berada di halaman login
    Ketika saya mengisi email "user@example.com"
    Dan saya mengisi password "password"
    Dan saya menekan tombol "Log in"
    Maka saya harus diarahkan ke halaman dashboard
    Dan saya melihat pesan "Login berhasil"

  Skenario: Login berhasil dan remember me aktif
    Dengan saya berada di halaman login
    Ketika saya mengisi email "user@example.com"
    Dan saya mengisi password "password"
    Dan saya mencentang "Remember me"
    Dan saya menekan tombol "Log in"
    Maka saya harus tetap login ketika membuka aplikasi kembali

  # -------------------------
  # SCENARIO NEGATIF
  # -------------------------

  Skenario: Login gagal karena password salah
    Dengan saya berada di halaman login
    Ketika saya mengisi email "user@example.com"
    Dan saya mengisi password "salah"
    Dan saya menekan tombol "Log in"
    Maka saya melihat pesan error "Email atau password salah"

  Skenario: Login gagal karena email tidak terdaftar
    Dengan saya berada di halaman login
    Ketika saya mengisi email "tidakada@example.com"
    Dan saya mengisi password "password"
    Dan saya menekan tombol "Log in"
    Maka saya melihat pesan error "Email tidak terdaftar"

  Skenario: Login gagal karena form kosong
    Dengan saya berada di halaman login
    Ketika saya menekan tombol "Log in"
    Maka saya melihat pesan error "Email wajib diisi"
    Dan saya melihat pesan error "Password wajib diisi"
