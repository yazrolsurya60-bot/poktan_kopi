<?php
header('Content-Type: text/plain; charset=utf-8');
$m = new mysqli('localhost', 'root', '', 'liberchain');
if ($m->connect_error) die('Gagal konek: ' . $m->connect_error);

echo "=== MULAI PERBAIKAN DATABASE ===\n\n";

// -------------------------------------------------------
// STEP 1: Bersihkan tracking orphan (id_transaksi tidak ada di tb_transaksi)
// -------------------------------------------------------
echo "--- STEP 1: Bersihkan tracking orphan ---\n";
$r = $m->query("DELETE t FROM tb_tracking t LEFT JOIN tb_transaksi tr ON tr.id_transaksi = t.id_transaksi WHERE tr.id_transaksi IS NULL");
echo "Tracking orphan dihapus: " . $m->affected_rows . " baris\n\n";

// -------------------------------------------------------
// STEP 2: Restore data transaksi dari dump (INSERT IGNORE untuk tidak tumpuk yg ada)
// -------------------------------------------------------
echo "--- STEP 2: Restore data transaksi lama ---\n";
$transaksi = [
    [1, 3, 15000000, 'Diproses', 'Transfer Bank', 'INV-000001', '2026-06-23 17:02:01'],
    [2, 3, 25000000, 'Dikirim',  'E-Wallet',      'INV-000002', '2026-06-23 17:02:01'],
    [3, 3, 14200000, 'Pending',  'COD',            'INV-000003', '2026-06-23 17:02:01'],
    [4, 2, 1500000,  'Diproses', 'Transfer',       'INV-PETANI-001', '2026-06-23 18:18:34'],
];
foreach ($transaksi as $t) {
    $m->query("INSERT IGNORE INTO tb_transaksi (id_transaksi, id_user, total_harga, status_pesanan, metode_bayar, invoice, id_tracking, created_at)
               VALUES ({$t[0]}, {$t[1]}, {$t[2]}, '{$t[3]}', '{$t[4]}', '{$t[5]}', NULL, '{$t[6]}')");
    echo "  Transaksi #{$t[5]}: " . ($m->affected_rows > 0 ? "DIBUAT" : "sudah ada") . "\n";
}
echo "\n";

// -------------------------------------------------------
// STEP 3: Sync tracking untuk semua transaksi yang belum punya
// -------------------------------------------------------
echo "--- STEP 3: Sync tracking untuk transaksi tanpa tracking ---\n";
$res = $m->query("SELECT id_transaksi, invoice FROM tb_transaksi WHERE id_tracking IS NULL OR id_tracking = 0");
$created = 0;
while ($row = $res->fetch_assoc()) {
    $id_tr = $row['id_transaksi'];
    // Cek apakah sudah ada di tb_tracking
    $chk = $m->query("SELECT id_tracking FROM tb_tracking WHERE id_transaksi = $id_tr");
    if ($chk && $chk->num_rows > 0) {
        $tr = $chk->fetch_assoc();
        $m->query("UPDATE tb_transaksi SET id_tracking = {$tr['id_tracking']} WHERE id_transaksi = $id_tr");
        echo "  #{$row['invoice']} → linked ke tracking ID {$tr['id_tracking']}\n";
    } else {
        $now = date('Y-m-d H:i:s');
        $m->query("INSERT INTO tb_tracking (id_transaksi, status_pengiriman, created_at, updated_at) VALUES ($id_tr, 'pending', '$now', '$now')");
        $id_tk = $m->insert_id;
        $m->query("UPDATE tb_transaksi SET id_tracking = $id_tk WHERE id_transaksi = $id_tr");
        echo "  #{$row['invoice']} → tracking baru ID $id_tk DIBUAT\n";
        $created++;
    }
}
echo "Total tracking baru: $created\n\n";

// -------------------------------------------------------
// STEP 4: Cek hasil akhir
// -------------------------------------------------------
echo "--- STEP 4: Verifikasi akhir ---\n";
$r = $m->query("SELECT t.id_tracking, t.id_transaksi, t.id_kurir, t.status_pengiriman, tr.invoice, k.nama_kurir
                FROM tb_tracking t
                LEFT JOIN tb_transaksi tr ON tr.id_transaksi = t.id_transaksi
                LEFT JOIN tb_kurir k ON k.id_kurir = t.id_kurir
                ORDER BY t.id_tracking");
echo sprintf("%-12s %-14s %-12s %-20s %-20s %-15s\n", "id_tracking", "id_transaksi", "id_kurir", "status_pengiriman", "invoice", "nama_kurir");
echo str_repeat("-", 90) . "\n";
while ($row = $r->fetch_assoc()) {
    echo sprintf("%-12s %-14s %-12s %-20s %-20s %-15s\n",
        $row['id_tracking'], $row['id_transaksi'], $row['id_kurir'] ?? 'NULL',
        $row['status_pengiriman'], $row['invoice'] ?? 'NULL', $row['nama_kurir'] ?? '-'
    );
}

echo "\n=== SELESAI ===\n";
$m->close();
