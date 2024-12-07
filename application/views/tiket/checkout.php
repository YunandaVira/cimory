<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Checkout</h2>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($keranjang)): ?>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Tiket</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    $grand_total = 0; 
                    ?>
                    <?php foreach ($keranjang as $key => $item): ?>
                        <?php $total = $item['jumlah'] * $item['harga']; ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($item['nama_tiket']); ?></td>
                            <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                            <td><?= $item['jumlah']; ?></td>
                            <td>Rp <?= number_format($total, 0, ',', '.'); ?></td>
                        </tr>
                        <?php $grand_total += $total; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Grand Total</strong></td>
                        <td><strong>Rp <?= number_format($grand_total, 0, ',', '.'); ?></strong></td>
                    </tr>
                </tbody>
            </table>

            <form action="<?= base_url('tiket/checkout'); ?>" method="post">
                <button type="submit" class="btn btn-success btn-block">Konfirmasi Pembelian</button>
            </form>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                Keranjang Anda kosong. <a href="<?= base_url('tiket'); ?>">Kembali ke daftar tiket</a>.
            </div>
        <?php endif; ?>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
