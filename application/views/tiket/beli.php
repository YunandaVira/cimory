<?php $this->load->view('templates/templates-user/header'); ?> <!-- Include header -->

<div class="container mt-5">
    <h2 class="text-center">Detail Tiket</h2>

    <!-- Notifikasi Pembelian Sukses -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="card mt-4 shadow-lg rounded">
        <div class="row no-gutters">
            <!-- Gambar Tiket -->
            <div class="col-md-4">
                <img src="<?= base_url('uploads/tiket/'.$tiket['gambar']); ?>" class="card-img" alt="Tiket Image" style="object-fit: cover; height: 100%; border-radius: 10px;">
            </div>
            
            <!-- Info Tiket -->
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $tiket['nama_tiket']; ?></h5>
                    <p class="card-text">
                        <strong>Harga:</strong> Rp <?= number_format($tiket['harga'], 2, ',', '.'); ?><br>
                        <strong>Stok:</strong> <?= $tiket['stok']; ?>
                    </p>

                    <!-- Form Pembelian Tiket -->
                    <form action="<?= base_url('tiket/proses_beli'); ?>" method="post">
                        <input type="hidden" name="id_tiket" value="<?= $tiket[$kolom]; ?>">
                        <input type="hidden" name="tabel" value="<?= $tabel; ?>">
                        <input type="hidden" name="kolom" value="<?= $kolom; ?>">

                        <div class="form-group mb-3">
                            <label for="jumlah">Jumlah Tiket</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" max="<?= $tiket['stok']; ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Beli Tiket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/templates-user/footer'); ?> <!-- Include footer -->
