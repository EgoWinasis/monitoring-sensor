

<section>
    <div class="container my-5 mx-auto">
        <div class="row">
            <h2 class="mx-auto">Data Sensor Api Dengan Wemos</h2>
            
            <div class="col-12">

                <table class="table table-striped" id="tableApi">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Status</th>
                            <th scope="col">LED</th>
                            <th scope="col">Tanggal dan Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                        <?php foreach ($flame as $isi) : ?>
                            <tr>
                                <td><?= $i++?></td>
                                <td><?= $isi->status == "true"? "Api Terdeteksi" : "Api Tidak Terdeteksi"?></td>
                                <?php if($isi->led == "Menyala") :?>
                                <td>
                                <div class="p-3 mb-2 bg-danger text-white">
                                    <?= $isi->led?> <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                                </div>
                                </td>
                                <?php else :?>
                                    <td>
                                    <div class="p-3 mb-2 bg-success text-white">
                                    <?= $isi->led?> <i class="fa fa-window-close" aria-hidden="true"></i>
                                    </div>
                                    </td>
                                <?php endif ?>
                                <td><?= $isi->createdAt ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</section>