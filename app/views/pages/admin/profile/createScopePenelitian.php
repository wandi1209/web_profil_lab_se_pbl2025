<div class="container-fluid">

    <h3 class="fw-bold mb-4">Tambah Scope Penelitian</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="/admin/profile/storeScopePenelitian" method="POST">

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" placeholder="Masukkan kategori..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="konten" rows="5" class="form-control" placeholder="Masukkan konten..." required></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="/admin/profile/scopePenelitianLab" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>

</div>
