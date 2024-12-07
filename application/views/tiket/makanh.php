<?php $this->load->view('templates/templates-user/header'); ?>

<div class="container my-5">
    <h1 class="text-center text-success mb-4">Tiket Makan Hewan</h1>

    <!-- Daftar Tiket Makan Hewan -->
    <div class="row">
        <?php if (!empty($tiket_makanh)): ?>
            <?php foreach ($tiket_makanh as $tiket): ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <!-- Menampilkan gambar berbeda untuk setiap tiket makan hewan -->
                        <img src="<?= base_url('assets/images/' . $tiket->foto); ?>" class="card-img-top" alt="<?= $tiket->nama_tiket; ?>" style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title text-success">
                                <?= $tiket->nama_tiket; ?>
                            </h5>
                            <p class="card-text">
                                <strong>Harga:</strong> Rp <?= number_format($tiket->harga, 0, ',', '.'); ?><br>
                                <strong>Stok:</strong> <?= $tiket->stok; ?>
                            </p>

                            <!-- Form untuk menambah tiket ke keranjang -->
                            <form action="<?= base_url('tiket/tambah_ke_keranjang'); ?>" method="post">
                                <input type="hidden" name="id_tiket" value="<?= $tiket->id_tiketmakanh; ?>">
                                <input type="hidden" name="nama_tiket" value="<?= $tiket->nama_tiket; ?>">
                                <input type="hidden" name="harga" value="<?= $tiket->harga; ?>">
                                <input type="hidden" name="jenis" value="makan_hewan">
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
            <p class="text-center text-danger">Tiket makan hewan tidak tersedia.</p>
        <?php endif; ?>
    </div>
</div>

<?php $this->load->view('templates/templates-user/footer'); ?>
