<?php $this->load->view('templates/templates-user/header'); ?>

<!-- Konten Halaman Anda (misalnya halaman tiket) -->
<div class="container my-5">
    <h1 class="text-center" style="font-family: 'Arial', sans-serif; color: black; font-weight: bold; letter-spacing: 2px;">Keranjang Pemesanan</h1>

    <?php if (!empty($keranjang)): ?>
        <div class="row">
            <?php $total = 0; $no = 1; ?>
            <?php foreach ($keranjang as $key => $item): ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm h-100 d-flex flex-column">
                        <div class="card-body d-flex flex-column">
                            <!-- Gambar tiket -->
                            <?php if (isset($item['foto']) && !empty($item['foto'])): ?>
                                <img src="<?= base_url('assets/images/' . $item['foto']); ?>" alt="<?= $item['nama_tiket']; ?>" class="card-img-top" style="object-fit: cover; height: 200px;">
                            <?php else: ?>
                                <img src="<?= base_url('assets/images/default.jpg'); ?>" alt="Tiket Default" class="card-img-top" style="object-fit: cover; height: 200px;">
                            <?php endif; ?>

                            <h5 class="card-title" style="color: black;"><?= $item['nama_tiket']; ?> (<?= ucfirst($item['jenis']); ?>)</h5>

                            <!-- Menampilkan keterangan Hari (Hanya untuk tiket masuk) -->
                            <?php if ($item['jenis'] == 'masuk' && isset($item['pilih_hari']) && !empty($item['pilih_hari'])): ?>
                                <p class="text-muted">
                                    <strong>Hari:</strong> 
                                    <?php
                                    if ($item['pilih_hari'] == 'weekday') {
                                        echo '<span class="badge bg-info text-dark">Weekday</span>';
                                    } elseif ($item['pilih_hari'] == 'weekend') {
                                        echo '<span class="badge bg-warning text-dark">Weekend</span>';
                                    }
                                    ?>
                                </p>
                            <?php endif; ?>
                            
                            <p class="card-text">
                                <strong>Harga:</strong> Rp <?= number_format($item['harga'], 0, ',', '.'); ?><br>
                                <strong>Jumlah:</strong> <span class="jumlah-tiket"><?= $item['jumlah']; ?></span><br>
                                <strong>Total:</strong> Rp <span class="total-harga"><?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></span>
                            </p>

                            <div class="d-flex justify-content-between mt-auto">
                                <!-- Tombol Kurang -->
                                <a href="javascript:void(0);" class="btn btn-sm btn-light kurang-btn" data-id="<?= $key; ?>" style="border: 1px solid #ccc; color: #6c757d; font-size: 20px; padding: 5px 10px; width: 30px; text-align: center;">-</a>

                                <!-- Tombol Tambah -->
                                <a href="javascript:void(0);" class="btn btn-sm btn-light tambah-btn" data-id="<?= $key; ?>" style="border: 1px solid #ccc; color: #6c757d; font-size: 20px; padding: 5px 10px; width: 30px; text-align: center;">+</a>
                            </div>

                            <div class="mt-2">
                                <a href="<?= base_url('tiket/hapus_dari_keranjang/' . $key); ?>" class="btn btn-danger btn-sm w-100">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $total += $item['harga'] * $item['jumlah']; ?>
            <?php endforeach; ?>
        </div>

        <!-- Total Harga dan Tombol Checkout -->
        <div class="text-end mt-3">
            <h4 class="text-success">Total Harga: Rp <?= number_format($total, 0, ',', '.'); ?></h4>
            <a href="<?= base_url('tiket/checkout'); ?>" class="btn btn-success w-100">Checkout</a>
        </div>
    <?php else: ?>
        <p class="text-center text-danger">Keranjang masih kosong.</p>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/templates-user/footer'); ?>

<!-- Tambahkan jQuery dan AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fungsi untuk menangani klik tombol tambah
        $('.tambah-btn').click(function() {
            var id = $(this).data('id');
            var card = $(this).closest('.card-body');
            var jumlah = card.find('.jumlah-tiket');
            var totalHarga = card.find('.total-harga');

            $.ajax({
                url: '<?= base_url('tiket/tambah_jumlah_keranjang/'); ?>' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Perbarui jumlah dan total harga pada halaman
                        var harga = response.harga;
                        var jumlahBaru = parseInt(jumlah.text()) + 1;
                        jumlah.text(jumlahBaru);
                        totalHarga.text('Rp ' + new Intl.NumberFormat('id-ID').format(harga * jumlahBaru));

                        // Update total harga keseluruhan
                        updateTotal();
                    }
                }
            });
        });

        // Fungsi untuk menangani klik tombol kurang
        $('.kurang-btn').click(function() {
            var id = $(this).data('id');
            var card = $(this).closest('.card-body');
            var jumlah = card.find('.jumlah-tiket');
            var totalHarga = card.find('.total-harga');

            $.ajax({
                url: '<?= base_url('tiket/kurang_jumlah_keranjang/'); ?>' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Perbarui jumlah dan total harga pada halaman
                        var harga = response.harga;
                        var jumlahBaru = parseInt(jumlah.text()) - 1;
                        if (jumlahBaru >= 1) {
                            jumlah.text(jumlahBaru);
                            totalHarga.text('Rp ' + new Intl.NumberFormat('id-ID').format(harga * jumlahBaru));

                            // Update total harga keseluruhan
                            updateTotal();
                        }
                    }
                }
            });
        });

        // Fungsi untuk menghitung total harga keseluruhan
        function updateTotal() {
            var totalHargaKeseluruhan = 0;
            $('.total-harga').each(function() {
                var total = parseInt($(this).text().replace('Rp ', '').replace(/\./g, ''));
                totalHargaKeseluruhan += total;
            });
            $('.text-success').text('Total Harga: Rp ' + new Intl.NumberFormat('id-ID').format(totalHargaKeseluruhan));
        }
    });
</script>
