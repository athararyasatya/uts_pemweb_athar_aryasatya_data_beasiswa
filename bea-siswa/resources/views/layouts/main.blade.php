<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemograman web Athar Aryasatya</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar  navbar-expand-lg bg-light sticky-top">
        <div class="container-fluid">
          <a class="navbar-brand ms-4" href="#">Beasiswa Universitas esaunggul</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-4">
              <li class="nav-item">
                <a class="nav-link " href="#">Daftar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Akun</a>
              </li>
             
            </ul>
          </div>
        </div>
      </nav>


      <section>
        <div class="container core">
            <div class="row ">
              <div class="col-md-8 col-lg-6 ">
                <h1 > Selamat Datang di Halaman Beasiswa Universitas Esaunggul</h1>
                <p>
                  Kami menawarkan berbagai paket beasiswa untuk membantu Anda mencapai impian akademis Anda. Silakan navigasikan melalui menu di atas untuk daftar dan melihat akun.
                </p>
                {{-- <a href="#beasiswa" class="btn btn-primary">Daftar Beasiswa</a> --}}
                
              </div>
              <div class="aww mb-4 col-lg-6  " >
                <img src="img/aw.png" class="img-fluid mb-8" alt="Gambar Beasiswa">
            </div>
            </div>
          </div>
      </section>

<section>
  <div class="container mt-5 mb-5" id="beasiswa">
    <div class="row">
        <div class="col-md-8 col-lg-6">
            <h2>Form Pendaftaran Beasiswa</h2>
            <form action="/store" id="formData" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="nomor-telpon" class="form-label">Nomor Telpon:</label>
                    <input type="tel" class="form-control" id="nomor-telpon" name="nomor_telpon" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
                <div class="mb-3">
                    <label for="nama-orang-tua" class="form-label">Nama Orang Tua:</label>
                    <input type="text" class="form-control" id="nama-orang-tua" name="nama_orang_tua" required>
                </div>
                <div class="mb-3">
                    <label for="umur" class="form-label">Umur:</label>
                    <input type="number" class="form-control" id="umur" name="umur" required>
                </div>
                <div class="mb-3">
                    <label for="foto-pelamar" class="form-label">Foto Pelamar:</label>
                    <input type="file" class="form-control" id="foto-pelamar" name="foto_pelamar" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label for="paket-beasiswa" class="form-label">Pilihan Paket Beasiswa:</label>
                    <select class="form-select" id="paket-beasiswa" name="paket_beasiswa" required>
                      <option value="paket2">Pilih paket</option>
                        <option value="paket1">Paket beasiswa akademik</option>
                        <option value="paket2">Paket beasiswa finansial</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dokumen" class="form-label">Upload Dokumen:</label>
                    <input type="file" class="form-control" id="dokumen" name="dokumen" required>
                </div>
                <button type="submit" class="btn btn-success">Daftar</button>
            </form>
        </div>
    </div>
</div>
  
</section>
      <section>
        <footer class="bg-dark text-white pt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h5>Beasiswa Universitas Esa Unggul</h5>
                <p>Universitas Esa Unggul menawarkan berbagai beasiswa untuk mendukung mahasiswa yang berprestasi dan membutuhkan bantuan finansial. Kami berkomitmen untuk memberikan akses pendidikan tinggi berkualitas bagi semua.</p>
            </div>
            
        </div>
    </div>
    <div class="bg-secondary text-center py-5">
        <p class="mb-0">© 2024 Universitas Esa Unggul. All rights reserved.</p>
        <p class="mb-0">By Athar Aryasatya</p></p>
    </div>
</footer>
      </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formData');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Kirim form data menggunakan AJAX
        const formData = new FormData(form);
        fetch(form.getAttribute('action'), {
            method: 'POST',
            body: formData,
            // Tambahkan ini untuk memastikan respons yang diterima adalah JSON
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Tampilkan sweet alert jika data berhasil disimpan
            Swal.fire({
                title: 'Terima kasih!',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'OK'
            });

            // Kosongkan nilai dari elemen-elemen formulir setelah berhasil disimpan
            form.reset();
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });
});
  </script>
  </body>
</html>