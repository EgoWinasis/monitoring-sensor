

<section>
    <div class="container my-5 mx-auto">
        <div class="row">
            <h2 class="mx-auto">Data Sensor Jarak Dengan Wemos</h2>
            
            <div class="col-12">

                <table class="table table-striped" id="tableJarak">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Jarak</th>
                            <th scope="col">Buzzer</th>
                            <th scope="col">Tanggal dan Waktu</th>
                        </tr>
                    </thead>
                    <tbody id="bodyJarak">
                        <?php $i = 1;?>
                        <?php foreach ($jarak as $isi) : ?>
                            <tr>
                                <td><?= $i++?></td>
                                <td><?= $isi->jarak?></td>
                                <?php if($isi->buzzer == "Berbunyi") :?>
                                <td>
                                <div class="p-3 mb-2 bg-danger text-white">
                                    <?= $isi->buzzer?> <i class="fa fa-volume-up" aria-hidden="true"></i>
                                </div>
                                </td>
                                <?php else :?>
                                    <td>
                                        <div class="p-3 mb-2 bg-success text-white">
                                        <?= $isi->buzzer?> <i class="fa fa-volume-off" aria-hidden="true"></i>
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
