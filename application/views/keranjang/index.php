<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h2>
            <hr>
            
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
            <?php endif; ?>
            
            <?php if (empty($cart_items)): ?>
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-shopping-basket fa-4x mb-3"></i>
                    <h4>Keranjang Kosong</h4>
                    <p>Silakan belanja produk kopi terbaik kami.</p>
                    <a href="<?php echo base_url('landing'); ?>" class="btn btn-primary">
                        <i class="fas fa-store"></i> Lihat Produk
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cart-body">
                            <?php foreach ($cart_items as $item): ?>
                            <?php $subtotal = $item['harga_satuan'] * $item['jumlah']; ?>
                            <tr id="cart-row-<?php echo $item['id_keranjang']; ?>">
                                <td>
                                    <img src="<?php echo base_url('uploads/produk/' . ($item['foto_produk'] ?: 'default.jpg')); ?>" 
                                         style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                    <?php echo $item['nama_produk']; ?>
                                    <br>
                                    <small class="text-muted">oleh <?php echo $item['nama_petani']; ?></small>
                                </td>
                                <td class="text-center">Rp <?php echo number_format($item['harga_satuan'], 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <div class="input-group" style="max-width: 120px; margin: 0 auto;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-outline-secondary btn-qty" 
                                                    data-id="<?php echo $item['id_keranjang']; ?>" 
                                                    data-action="minus">-</button>
                                        </div>
                                        <input type="number" class="form-control form-control-sm text-center qty-input" 
                                               value="<?php echo $item['jumlah']; ?>" 
                                               min="1" max="<?php echo $item['stok_produk']; ?>"
                                               data-id="<?php echo $item['id_keranjang']; ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-outline-secondary btn-qty" 
                                                    data-id="<?php echo $item['id_keranjang']; ?>" 
                                                    data-action="plus">+</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center subtotal" id="subtotal-<?php echo $item['id_keranjang']; ?>">
                                    Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger btn-hapus" 
                                            data-id="<?php echo $item['id_keranjang']; ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-active">
                                <th colspan="3" class="text-right">Total</th>
                                <th class="text-center" id="total_keranjang">Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?php echo base_url('landing'); ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Lanjutkan Belanja
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?php echo base_url('transaksi/checkout'); ?>" class="btn btn-success btn-lg">
                            <i class="fas fa-check"></i> Checkout
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.qty-input').on('change', function() {
        var id = $(this).data('id');
        var qty = parseInt($(this).val());
        if (qty < 1) qty = 1;
        $(this).val(qty);
        updateCart(id, qty);
    });
    
    $('.btn-qty').on('click', function() {
        var id = $(this).data('id');
        var action = $(this).data('action');
        var input = $('.qty-input[data-id="' + id + '"]');
        var qty = parseInt(input.val());
        
        if (action == 'plus') {
            qty++;
        } else {
            qty--;
        }
        
        if (qty < 1) qty = 1;
        var max = parseInt(input.attr('max'));
        if (qty > max) {
            alert('Stok tidak mencukupi');
            return;
        }
        
        input.val(qty);
        updateCart(id, qty);
    });
    
    $('.btn-hapus').on('click', function() {
        if (!confirm('Hapus item ini dari keranjang?')) return;
        var id = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url("transaksi/hapus_keranjang"); ?>',
            type: 'POST',
            data: {id_keranjang: id},
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    $('#cart-row-' + id).fadeOut(300, function() {
                        $(this).remove();
                        $('#total_keranjang').text('Rp ' + response.total_harga);
                        if (response.total_item == 0) {
                            location.reload();
                        }
                    });
                } else {
                    alert(response.message);
                }
            }
        });
    });
    
    function updateCart(id, qty) {
        $.ajax({
            url: '<?php echo base_url("transaksi/update_keranjang"); ?>',
            type: 'POST',
            data: {id_keranjang: id, jumlah: qty},
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    var row = $('#cart-row-' + id);
                    var priceText = row.find('td:eq(1)').text().replace(/[^0-9]/g, '');
                    var price = parseInt(priceText);
                    var subtotal = price * qty;
                    $('#subtotal-' + id).text('Rp ' + subtotal.toLocaleString('id-ID'));
                    $('#total_keranjang').text('Rp ' + response.total_harga);
                } else {
                    alert(response.message);
                }
            }
        });
    }
});
</script>