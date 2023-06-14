<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Form Laporan
                </h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="transaksi">Laporan Transaksi</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-radio">
                            <input value="barang_masuk" type="radio" id="barang_masuk" name="transaksi" class="custom-control-input">
                            <label class="custom-control-label" for="barang_masuk">Barang Masuk</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input value="barang_keluar" type="radio" id="barang_keluar" name="transaksi" class="custom-control-input">
                            <label class="custom-control-label" for="barang_keluar">Barang Keluar</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input value="keuntungan" type="radio" id="keuntungan" name="transaksi" class="custom-control-input">
                            <label class="custom-control-label" for="keuntungan">Keuntungan</label>
                        </div>
                        <?= form_error('transaksi', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-lg-3 text-lg-right" for="tanggal">Tanggal</label>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="dari">Dari</label>
                                <input type="text" readonly name="dari" id="dari" value="<?= set_value('dari') ?? $dari; ?>" class="form-control" />
                                <?= form_error('dari', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-lg-6">
                                <label for="sampai">Sampai</label>
                                <input type="text" readonly name="sampai" id="sampai" value="<?= set_value('sampai') ?? $sampai; ?>" class="form-control" />
                                <?= form_error('sampai', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-9 offset-lg-3">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-print"></i>
                            </span>
                            <span class="text">
                                Cetak
                            </span>
                        </button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', event => {
        $('#dari').datepicker({uiLibrary: 'bootstrap4'});
        $('#sampai').datepicker({uiLibrary: 'bootstrap4'});
    })
</script>