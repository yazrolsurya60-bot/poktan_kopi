<div class="container mt-4">
    <h2>Checkout</h2>
    <hr>
    
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alamat Pengiriman</div>
                <div class="card-body">
                    <form action="<?= base_url('pembeli/transaksi/proses_checkout') ?>" method="post">
                        <div class="form-group">
                            <label>Nama Penerima</label>
                            <input type="text" name="nama_penerima" class="form-control" value="<?= $user->nama ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="3" required placeholder="Masukkan alamat lengkap..."><?= set_value('alamat') ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" name="telepon" class="form-control" value="<?= $user->telepon ?? '' ?>" required>
                        </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Ringkasan Pesanan</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <?php foreach($keranjang as $item): ?>
                        <tr>
                            <td><?= $item->nama_produk ?> x<?= $item->qty ?></td>
                            <td class="text-right">Rp <?= number_format($item->harga_satuan * $item->qty, 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th>Subtotal</th>
                            <th class="text-right">Rp <?= number_format($total, 0, ',', '.') ?></th>
                        </tr>
                        <tr>
                            <td>Ongkir</td>
                            <td class="text-right" id="ongkir">Rp 25.000</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th class="text-right" id="total_akhir">Rp <?= number_format($total + 25000, 0, ',', '.') ?></th>
                        </tr>
                    </table>
                    
                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <div class="alert alert-secondary d-flex align-items-center mb-0" style="border-radius:8px;">
                            <i class="bi bi-cash-coin mr-2" style="font-size:1.2rem;"></i>
                            <strong>COD (Bayar di Tempat)</strong>
                        </div>
                        <input type="hidden" name="metode_bayar" value="COD">
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-block mt-3">Buat Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#alamat').on('change keyup', function() {
        var alamat = $(this).val();
        $.ajax({
            url: '<?= base_url("pembeli/transaksi/hitung_ongkir_ajax") ?>',
            type: 'POST',
            data: {alamat: alamat},
            dataType: 'json',
            success: function(response) {
                $('#ongkir').text('Rp ' + response.ongkir.toLocaleString('id-ID'));
                var total = <?= $total ?> + response.ongkir;
                $('#total_akhir').text('Rp ' + total.toLocaleString('id-ID'));
            }
        });
    });
});
</script>