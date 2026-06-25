<?php
$v_produk = file_get_contents('application/views/petani/v_produk.php');

$header_pos = strpos($v_produk, '<!-- MAIN CONTENT -->');
$header = substr($v_produk, 0, $header_pos);

$footer_pos = strpos($v_produk, '<script', $header_pos);
$footer = "</div>\n</div>\n" . substr($v_produk, $footer_pos);

function update_view($file, $header, $footer) {
    $content = file_get_contents($file);
    
    // Extract the form/main content from the target file
    // For produk_tambah, it's inside <div class="card-custom"> or <div id="content">
    $start = strpos($content, '<div class="d-flex justify-content-between');
    if ($start === false) $start = strpos($content, '<div class="page-header');
    if ($start === false) $start = strpos($content, '<div class="card-custom">');
    
    // find the end (usually before <script> or </body>)
    $end = strpos($content, '</body>');
    if ($end === false) $end = strlen($content);
    else {
        // Find the closing div of content
        $end = strrpos(substr($content, 0, $end), '</div>');
        $end = strrpos(substr($content, 0, $end), '</div>');
    }
    
    $main_content = substr($content, $start, $end - $start);
    
    // In produk_tambah, form action is wrong: admin/produk/simpan -> petani/produk/simpan
    $main_content = str_replace('admin/produk/simpan', 'petani/produk/simpan', $main_content);
    $main_content = str_replace('admin/produk/update', 'petani/produk/update', $main_content);
    $main_content = str_replace('admin/produk', 'petani/produk', $main_content);

    // If it doesn't have enctype for edit, we might need to add it later.
    
    $new_content = $header . "\n<div class=\"main-content\">\n" . $main_content . "\n" . $footer;
    file_put_contents($file, $new_content);
    echo "Updated $file\n";
}

update_view('application/views/petani/produk_tambah.php', $header, $footer);
update_view('application/views/petani/produk_edit.php', $header, $footer);
update_view('application/views/petani/produk_detail.php', $header, $footer);

?>
