<section class="informasi-section" style="padding: 60px 0px; background-color: #f1f5f9;">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-md-12 col-sm-12">
                <div class="informasi-container">
                    <div class="informasi-header">
                        <h2 class="informasi-title">Informasi yang wajib sedia setiap saat</h2>
                        <div class="informasi-controls">
                            <select id="kategori-filter" class="form-control filter-select">
                                <option value="all">Semua Kategori</option>
                                <?php 
                                $cat_shown = []; 
                                if($tableData){
                                    foreach($tableData as $t) {
                                        if(!in_array($t->kategori_id, $cat_shown)) {
                                            echo "<option value='cat-".$t->kategori_id."'>".$t->nama_kategori."</option>";
                                            $cat_shown[] = $t->kategori_id;
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="dokumen-search" placeholder="Cari dokumen..." class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table modern-table" id="dokumen-table">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No.</th>
                                    <th width="75%">Judul Dokumen</th>
                                    <th width="20%" class="text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $id = ''; 
                                if ($tableData) { 
                                    foreach ($tableData as $t) { 
                                        if ($id != $t->kategori_id): 
                                ?>
                                <tr class="category-row cat-<?= $t->kategori_id ?>" data-category="cat-<?= $t->kategori_id ?>">
                                    <td colspan="3" class="category-cell">
                                        <div class="category-header-title"><?= $t->nama_kategori ?></div>
                                    </td>
                                </tr>
                                <?php 
                                            $cat_no = 1;
                                            foreach ($tableData as $t1) { 
                                                if ($t->kategori_id == $t1->kategori_id): 
                                ?>
                                <tr class="item-row cat-<?= $t->kategori_id ?>" data-category="cat-<?= $t->kategori_id ?>">
                                    <td class="text-center"><?= $cat_no++ ?></td>
                                    <td class="item-title"><?= $t1->judul ?></td>
                                    <td class="text-center">
                                        <?php if ($t1->tipe == '0') { ?>
                                            <a href='{{ ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") }}://e-ppid.ptgaram.com/upload/<?= $t1->link ?>' class='btn-pill btn-download' target="_blank">
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                        <?php } else { ?>
                                            <a href='<?= $t1->link ?>' class='btn-pill btn-view' target="_blank">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php 
                                                endif; 
                                            } 
                                        endif; 
                                        $id = $t->kategori_id;
                                    }
                                } 
                                ?>
                            </tbody>
                        </table>
                        <div id="no-results" style="display:none; text-align:center; padding: 40px; color:#64748b; font-size: 16px;">
                            <i class="fas fa-search" style="font-size: 32px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                            Dokumen tidak ditemukan.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contact-info col-sm-4 col-xs-12" hidden>
                <div class="inner" style="padding: 15px 10px 10px 15px;">
                    <h4 align="left">Login Pemohon</h4><hr/>
                    <div class="contact-form">
                        <form method="post">
                            <div class="row clearfix">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" name="usern" id="usern" class="form-control" placeholder="Username" style="height: 35px">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" name="passw" id="passw" class="form-control" placeholder="Password" style="height: 35px">
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 text-left">
                                    <button type="submit" class="theme-btn btn-style-one"><i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .informasi-container {
        background: #ffffff;
        border-radius: 12px;
        padding: 30px 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .informasi-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 40px;
        flex-wrap: wrap;
        gap: 20px;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 20px;
    }
    .informasi-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        max-width: 50%;
        line-height: 1.4;
    }
    .informasi-controls {
        display: flex;
        gap: 15px;
        flex-grow: 1;
        justify-content: flex-end;
        flex-wrap: wrap;
    }
    .search-box {
        position: relative;
        width: 250px;
    }
    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }
    .search-box input {
        padding-left: 40px;
        border-radius: 25px;
        border: 1px solid #cbd5e1;
        height: 42px;
        box-shadow: none;
        transition: all 0.2s;
    }
    .search-box input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }
    .filter-select {
        width: auto;
        min-width: 180px;
        border-radius: 25px;
        border: 1px solid #cbd5e1;
        height: 42px;
        padding: 0 15px;
        color: #475569;
        font-weight: 500;
        background-color: #ffffff;
        transition: all 0.2s;
    }
    .filter-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }
    
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 0;
    }
    .modern-table thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
        padding: 16px 20px;
        border-bottom: 2px solid #e2e8f0;
        border-top: none;
    }
    .modern-table tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
        font-size: 15px;
        border-top: none;
    }
    .item-row {
        transition: background-color 0.2s;
    }
    .item-row:hover td {
        background-color: #f8fafc;
    }
    .category-cell {
        padding: 0 !important;
        border-bottom: none !important;
    }
    .category-header-title {
        background: #f1f5f9;
        color: #0f172a;
        font-weight: 700;
        padding: 12px 20px;
        font-size: 16px;
        border-left: 4px solid #2563eb;
        margin-top: 20px;
        margin-bottom: 5px;
        border-radius: 0 6px 6px 0;
        display: inline-block;
        min-width: 300px;
    }
    
    .btn-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        min-width: 90px;
    }
    .btn-view {
        background-color: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }
    .btn-view:hover {
        background-color: #2563eb;
        color: #ffffff;
        text-decoration: none;
    }
    .btn-download {
        background-color: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }
    .btn-download:hover {
        background-color: #16a34a;
        color: #ffffff;
        text-decoration: none;
    }
    
    @media (max-width: 768px) {
        .informasi-container { padding: 20px; }
        .informasi-title { max-width: 100%; margin-bottom: 5px; font-size: 20px; }
        .informasi-controls { width: 100%; justify-content: flex-start; }
        .search-box { width: 100%; }
        .filter-select { width: 100%; }
        .category-header-title { width: 100%; min-width: unset; margin-top: 10px; }
        .modern-table thead { display: none; }
        .modern-table tbody td { display: block; width: 100%; text-align: left !important; }
        .modern-table tbody td.text-center { text-align: left !important; }
        .item-row { display: block; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; padding-top: 10px; }
        .item-row td { border-bottom: none; padding: 8px 15px; }
    }
</style>

<script>
    $(document).ready(function() {
        function filterTable() {
            var searchTerm = $('#dokumen-search').val().toLowerCase();
            var category = $('#kategori-filter').val();
            var hasVisibleItem = false;
            
            $('.category-row').hide();
            
            $('.item-row').each(function() {
                var text = $(this).find('.item-title').text().toLowerCase();
                var itemCat = $(this).data('category');
                
                var matchSearch = text.indexOf(searchTerm) > -1;
                var matchCat = (category === 'all' || itemCat === category);
                
                if (matchSearch && matchCat) {
                    $(this).show();
                    $('.category-row.' + itemCat).show();
                    hasVisibleItem = true;
                } else {
                    $(this).hide();
                }
            });
            
            if (!hasVisibleItem) {
                $('#no-results').show();
                $('#dokumen-table').hide();
            } else {
                $('#no-results').hide();
                $('#dokumen-table').show();
            }
        }
        
        $('#dokumen-search').on('keyup', filterTable);
        $('#kategori-filter').on('change', filterTable);
    });
</script>


