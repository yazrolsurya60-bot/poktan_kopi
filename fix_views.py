import os

def update_view(filepath, header, footer):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Find start of main content
    start = content.find('<div class="d-flex justify-content-between')
    if start == -1: start = content.find('<div class="page-header')
    if start == -1: start = content.find('<div class="card-custom">')

    # Find end of main content
    end = content.find('</body>')
    if end == -1: end = len(content)
    else:
        end = content.rfind('</div>', 0, end)
        end = content.rfind('</div>', 0, end)

    main_content = content[start:end]

    # Fix actions
    main_content = main_content.replace('admin/produk/simpan', 'petani/produk/simpan')
    main_content = main_content.replace('admin/produk/update', 'petani/produk/update')
    main_content = main_content.replace('admin/produk', 'petani/produk')

    # If it's edit or tambah, make sure it has enctype and the gallery input
    if 'tambah' in filepath or 'edit' in filepath:
        if 'enctype="multipart/form-data"' not in main_content:
            main_content = main_content.replace('method="post"', 'method="post" enctype="multipart/form-data"')

        # Add foto_utama if not exists (for edit)
        if 'name="foto_utama"' not in main_content:
            img_input = '''
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Foto Utama</label>
                                <input type="file" name="foto_utama" class="form-control" accept="image/*">
                            </div>
'''
            main_content = main_content.replace('<div class="form-group mb-3">\n                                <label class="font-weight-bold">Status Produk', img_input + '<div class="form-group mb-3">\n                                <label class="font-weight-bold">Status Produk')

        # Add gallery input
        if 'name="galeri[]"' not in main_content:
            gal_input = '''
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Galeri Tambahan (Bisa pilih banyak)</label>
                                <input type="file" name="galeri[]" multiple class="form-control" accept="image/*">
                            </div>
'''
            main_content = main_content.replace('<div class="form-group mb-3">\n                                <label class="font-weight-bold">Status Produk', gal_input + '<div class="form-group mb-3">\n                                <label class="font-weight-bold">Status Produk')

    new_content = header + '\n<div class="main-content">\n' + main_content + '\n' + footer
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(new_content)
    print("Updated", filepath)

base_path = 'C:/Users/USER/.gemini/antigravity/scratch/poktan_kopi/'
with open(base_path + 'application/views/petani/v_produk.php', 'r', encoding='utf-8') as f:
    v_produk = f.read()

header_pos = v_produk.find('<!-- MAIN CONTENT -->')
header = v_produk[:header_pos]

footer_pos = v_produk.find('<script', header_pos)
footer = '</div>\n</div>\n' + v_produk[footer_pos:]

update_view(base_path + 'application/views/petani/produk_tambah.php', header, footer)
update_view(base_path + 'application/views/petani/produk_edit.php', header, footer)
update_view(base_path + 'application/views/petani/produk_detail.php', header, footer)
