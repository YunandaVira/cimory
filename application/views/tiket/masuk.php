<?php $this->load->view('templates/templates-user/header'); ?>

<div class="container my-5">
    <h1 class="text-center text-success mb-4">Tiket Masuk</h1>

    <!-- Pilihan Hari dan Jenis Tiket -->
    <form method="get" action="<?= base_url('tiket/masuk'); ?>" class="mb-4">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <!-- Pilihan Hari -->
                <select name="hari" class="form-select custom-select" onchange="this.form.submit()">
                    <option value="">Pilih Hari</option>
                    <option value="weekday" <?= $this->input->get('hari') == 'weekday' ? 'selected' : ''; ?>>Weekday</option>
                    <option value="weekend" <?= $this->input->get('hari') == 'weekend' ? 'selected' : ''; ?>>Weekend</option>
                    <option value="semua" <?= $this->input->get('hari') == 'semua' ? 'selected' : ''; ?>>Semua</option>
                </select>
            </div>

            <div class="col-md-4">
                <!-- Pilihan Jenis Tiket (Anak / Dewasa) -->
                <select name="jenis_tiket" class="form-select custom-select" onchange="this.form.submit()">
                    <option value="">Pilih Jenis Tiket</option>
                    <option value="anak" <?= $this->input->get('jenis_tiket') == 'anak' ? 'selected' : ''; ?>>Anak</option>
                    <option value="dewasa" <?= $this->input->get('jenis_tiket') == 'dewasa' ? 'selected' : ''; ?>>Dewasa</option>
                </select>
            </div>
        </div>
    </form>

    <!-- Daftar Tiket -->
    <div class="row">
        <?php if (!empty($tiket_masuk)): ?>
            <?php foreach ($tiket_masuk as $tiket): ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <!-- Menampilkan gambar sesuai dengan nama file foto di database -->
                        <?php if (!empty($tiket->foto)): ?>
                            <img src="<?= base_url('assets/images/' . $tiket->foto); ?>" class="card-img-top" alt="<?= $tiket->nama_tiket; ?>" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <!-- Gambar default jika tidak ada foto yang disediakan -->
                            <img src="<?= base_url('assets/images/default_tiket.jpg'); ?>" class="card-img-top" alt="<?= $tiket->nama_tiket; ?>" style="height: 200px; object-fit: cover;">
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title text-success">
                                <?= $tiket->nama_tiket; ?>
                                <!-- Menambahkan keterangan hari -->
                                <?php if ($tiket->pilih_hari == 'weekday'): ?>
                                    <span class="badge bg-info text-dark">Weekday</span>
                                <?php elseif ($tiket->pilih_hari == 'weekend'): ?>
                                    <span class="badge bg-warning text-dark">Weekend</span>
                                <?php endif; ?>
                            </h5>
                            <p class="card-text">
                                <strong>Harga:</strong> Rp <?= number_format($tiket->harga, 0, ',', '.'); ?><br>
                                <strong>Stok:</strong> <?= $tiket->stok; ?>
                            </p>

                            <!-- Form untuk menambah tiket ke keranjang -->
                            <form action="<?= base_url('tiket/tambah_ke_keranjang'); ?>" method="post">
                                <input type="hidden" name="id_tiket" value="<?= $tiket->id_tiketmasuk; ?>">
                                <input type="hidden" name="nama_tiket" value="<?= $tiket->nama_tiket; ?>">
                                <input type="hidden" name="harga" value="<?= $tiket->harga; ?>">
                                <input type="hidden" name="jenis" value="masuk">
                                <div class="input-group mb-2">
                                    <input type="number" name="jumlah" class="form-control" min="1" max="<?= $tiket->stok; ?>" placeholder="Jumlah" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Tambah ke Keranjang</button>
                            </form>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-danger">Tiket tidak tersedia untuk kategori hari atau jenis tiket yang dipilih.</p>
        <?php endif; ?>
    </div>
</div>

<?php $this->load->view('templates/templates-user/footer'); ?>
