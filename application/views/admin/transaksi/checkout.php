<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4"><i class="fas fa-shopping-cart"></i> Checkout</h2>
            <hr>
        </div>
    </div>
    
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>
    
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>
    
    <form action="<?php echo base_url('transaksi/proses_checkout'); ?>" method="POST" id="formCheckout">
        <div class="row">
            <!-- Data Penerima -->
            <div class="col-md-7">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5><i class="fas fa-user"></i> Data Penerima</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Penerima <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_penerima" class="form-control" 
                                           value="<?php echo $user ? $user['nama'] : ''; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No HP <span class="text-danger">*</span></label>
                                    <input type="text" name="no_hp" class="form-control" 
                                           value="<?php echo $user ? $user['no_hp'] : ''; ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- EMAIL PEMBELI (WAJIB UNTUK GUEST) -->
                        <div class="form-group">
                            <label>
                                Email Pembeli
                                <?php if (!$this->session->userdata('id_user')): ?>
                                    <span class="text-danger">*</span>
                                <?php endif; ?>
                            </label>
                            <input type="email" name="email_pembeli" class="form-control"
                                   value="<?php echo $user ? $user['email'] : ''; ?>"
                                   <?php echo $this->session->userdata('id_user') ? 'readonly' : 'required'; ?>
                                   placeholder="email@example.com">
                            <?php if (!$this->session->userdata('id_user')): ?>
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i> 
                                    Email digunakan untuk <strong>tracking pesanan</strong> dan <strong>invoice</strong>.
                                </small>
                            <?php else: ?>
                                <small class="text-muted">
                                    <i class="fas fa-check-circle" style="color: green;"></i> 
                                    Email terdaftar sebagai member
                                </small>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label>Alamat Kirim <span class="text-danger">*</span></label>
                            <textarea name="alamat_kirim" class="form-control" rows="3" required><?php echo $user ? $user['alamat'] : ''; ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kota <span class="text-danger">*</span></label>
                                    <input type="text" name="kota_kirim" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode Pos <span class="text-danger">*</span></label>
                                    <input type="text" name="kode_pos" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Metode Pembayaran -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h5><i class="fas fa-credit-card"></i> Metode Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Pilih Metode <span class="text-danger">*</span></label>
                            <select name="metode_bayar" class="form-control" required>
                                <option value="">Pilih Metode</option>
                                <option value="Virtual Account">🏦 Virtual Account (BCA, Mandiri, BNI, BRI)</option>
                                <option value="E-Wallet">📱 E-Wallet (OVO, Gopay, DANA)</option>
                                <option value="COD">🚚 COD (Bayar di Tempat)</option>
                            </select>
                        </div>
                        <div class="alert alert-info">
                            <small>
                                <i class="fas fa-info-circle"></i> 
                                <?php if ($user): ?>
                                    ✅ Anda login sebagai member. Poin akan bertambah setiap transaksi.
                                <?php else: ?>
                                    👤 Guest checkout. <a href="<?php echo base_url('auth/register'); ?>" class="font-weight-bold">Daftar</a> untuk mendapatkan benefit member.
                                <?php endif; ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Ringkasan Pesanan -->
            <div class="col-md-5">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5><i class="fas fa-receipt"></i> Ringkasan Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-right">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart_items as $item): ?>
                                    <tr>
                                        <td>
                                            <small><?php echo $item['nama_produk']; ?></small>
                                            <br>
                                            <small class="text-muted"><?php echo $item['nama_petani']; ?></small>
                                        </td>
                                        <td class="text-center"><?php echo $item['jumlah']; ?></td>
                                        <td class="text-right">Rp <?php echo number_format($item['harga_satuan'] * $item['jumlah'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <hr>
                        
                        <div class="row mb-2">
                            <div class="col-6"><strong>Subtotal</strong></div>
                            <div class="col-6 text-right">
                                Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                            </div>
                        </div>
                        
                        <!-- ========================================== -->
                        <!-- BAGIAN ONGKIR -->
                        <!-- ========================================== -->
                        <div class="row mb-2">
                            <div class="col-12">
                                <strong>Ongkir</strong>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-5">
                                <small class="text-muted">Kota Asal</small>
                                <select name="kota_asal" id="kota_asal" class="form-control form-control-sm" style="border-radius:4px; border:1px solid #ccc; height:32px; font-size:13px; padding:2px 8px; width:100%;">
                                    <option value="">Kota Asal</option>
                                    <?php foreach ($kota as $k): ?>
                                    <option value="<?php echo $k; ?>"><?php echo $k; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-7">
                                <small class="text-muted">Kota Tujuan</small>
                                <select name="kota_tujuan" id="kota_tujuan" class="form-control" style="border-radius:4px; border:1px solid #ccc; font-size:15px; padding:8px 12px; height:45px; background:white; width:100%;">
                                    <option value="">-- Pilih Kota --</option>
                                    <?php foreach ($kota as $k): ?>
                                    <option value="<?php echo $k; ?>"><?php echo $k; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-12">
                                <button type="button" id="hitung_ongkir" class="btn btn-warning btn-sm" style="font-weight:600; border-radius:4px; padding:5px 12px; width:100%; font-size:0.82rem;">
                                    <i class="fas fa-calculator"></i> Hitung Ongkir
                                </button>
                            </div>
                        </div>
                        
                        <div class="row mt-2" id="ongkir_display">
                            <div class="col-12 text-right">
                                <span id="ongkir_biaya" style="font-size:1.2rem; font-weight:700; color:#E6A15C;">Rp 0</span>
                                <br>
                                <small id="ongkir_estimasi" class="text-muted"></small>
                                <input type="hidden" name="ongkir" id="ongkir" value="0">
                            </div>
                        </div>
                        <!-- ========================================== -->
                        <!-- END BAGIAN ONGKIR -->
                        <!-- ========================================== -->
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-6"><h5>Grand Total</h5></div>
                            <div class="col-6 text-right">
                                <h5 class="text-success" id="grand_total" style="font-size:1.5rem; font-weight:800;">
                                    Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                                </h5>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <!-- INFO GUEST -->
                        <?php if (!$this->session->userdata('id_user')): ?>
                            <div class="alert alert-warning" style="border-radius:8px; padding:8px 12px; font-size:0.78rem;">
                                <i class="fas fa-info-circle"></i> 
                                Kamu checkout sebagai <strong>Guest</strong>. Simpan <strong>invoice</strong> untuk tracking pesanan di 
                                <a href="<?php echo base_url('guest/tracking'); ?>" target="_blank" style="font-weight:700; text-decoration:underline;">
                                    Cek Pesanan
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <button type="submit" class="btn btn-success btn-block btn-lg" id="btnSubmit">
                            <i class="fas fa-check"></i> Buat Pesanan
                        </button>
                        <a href="<?php echo base_url('transaksi/keranjang'); ?>" class="btn btn-secondary btn-block">
                            <i class="fas fa-arrow-left"></i> Kembali ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#hitung_ongkir').click(function() {
        var kota_asal = $('#kota_asal').val();
        var kota_tujuan = $('#kota_tujuan').val();
        
        if (!kota_asal || !kota_tujuan) {
            alert('⚠️ Pilih kota asal dan tujuan terlebih dahulu!');
            return;
        }
        
        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menghitung...');
        
        $.ajax({
            url: '<?php echo base_url("transaksi/hitung_ongkir"); ?>',
            type: 'POST',
            data: {kota_asal: kota_asal, kota_tujuan: kota_tujuan},
            dataType: 'json',
            timeout: 10000,
            success: function(response) {
                if (response.status == 'success') {
                    var tarif = parseInt(response.tarif);
                    $('#ongkir').val(tarif);
                    $('#ongkir_biaya').text(response.tarif_formatted);
                    $('#ongkir_estimasi').text('🚚 Estimasi ' + response.estimasi + ' hari');
                    
                    var subtotal = <?php echo $subtotal; ?>;
                    var total = subtotal + tarif;
                    $('#grand_total').text('Rp ' + total.toLocaleString('id-ID'));
                    
                    $('#ongkir_biaya').css('color', '#28a745');
                    setTimeout(function() {
                        $('#ongkir_biaya').css('color', '#E6A15C');
                    }, 1500);
                    
                } else {
                    alert('❌ ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('❌ Gagal menghitung ongkir. Silakan coba lagi.\nError: ' + status);
                console.error('AJAX Error:', status, error);
            },
            complete: function() {
                $('#hitung_ongkir').prop('disabled', false).html('<i class="fas fa-calculator"></i> Hitung Ongkir');
            }
        });
    });
    
    $('#formCheckout').submit(function(e) {
        var ongkir = parseInt($('#ongkir').val());
        if (ongkir <= 0) {
            e.preventDefault();
            alert('⚠️ Silakan hitung ongkir terlebih dahulu!');
            $('#hitung_ongkir').focus();
            return false;
        }
        
        var nama = $('input[name="nama_penerima"]').val().trim();
        var alamat = $('textarea[name="alamat_kirim"]').val().trim();
        var nohp = $('input[name="no_hp"]').val().trim();
        var kota = $('input[name="kota_kirim"]').val().trim();
        var metode = $('select[name="metode_bayar"]').val();
        var email = $('input[name="email_pembeli"]').val().trim();
        
        if (!nama || !alamat || !nohp || !kota || !metode) {
            e.preventDefault();
            alert('⚠️ Semua field wajib diisi!');
            return false;
        }
        
        var id_user = <?php echo $this->session->userdata('id_user') ? 'true' : 'false'; ?>;
        if (!id_user && !email) {
            e.preventDefault();
            alert('⚠️ Email wajib diisi untuk tracking pesanan!');
            $('input[name="email_pembeli"]').focus();
            return false;
        }
        
        $('#btnSubmit').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Memproses...');
    });
});
</script>