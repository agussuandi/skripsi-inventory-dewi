<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Riwayat Data Barang Kosong
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('barangkosong/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Barang Kosong
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Aksi</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($barangKosong as $key => $data): ?>
                    <tr>
                        <td><?=$key + 1?></td>
                        <td><?=$data['tanggal']?></td>
                        <td><?="{$data['id_barang']} {$data['nama_barang']}"?></td>
                        <td><?=$data['aksi']?></td>
                        <td>
                            <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('barangkosong/delete/') . $data['id'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>