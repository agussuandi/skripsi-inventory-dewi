<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Input Barang Kosong
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('barangkosong') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="id_barang">Nama Satuan</label>
                        <div class="col-md-9">
                            <select name="id_barang" id="id_barang" class="custom-select">
                                <option value="" selected disabled>Pilih Barang</option>
                                <?php foreach ($barang as $b) : ?>
                                    <option value="<?= $b['id_barang'] ?>"><?= $b['id_barang'] . ' | ' . $b['nama_barang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('id_barang', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="tanggal_kosong">Tanggal</label>
                        <div class="col-md-9">
                            <input value="<?= set_value('tanggal_kosong', date('Y-m-d')); ?>" name="tanggal_kosong" id="tanggal_kosong" type="text" class="form-control date" placeholder="Tanggal...">
                            <?= form_error('tanggal_kosong', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="aksi">Aksi</label>
                        <div class="col-md-9">
                            <input value="<?= set_value('aksi'); ?>" name="aksi" id="aksi" type="text" class="form-control" placeholder="Aksi...">
                            <?= form_error('aksi', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-9 offset-md-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>