<section>
    <div class="container mt-5 mx-auto">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="mx-auto">Kontrol Relay</h2>
            </div>

            <div class="col-6">
                <div class="my-3 col-3">
                    <h6>Buzzer</h6>
                    <input type="checkbox" id="buzzer" value="false" data-toggle="toggle" data-onstyle="success">
                </div>
                <div class="my-3 col-3">
                    <h6>Sensor Jarak</h6>
                    <input type="checkbox" id="sensor-jarak" checked="checked" value="true" data-toggle="toggle" data-onstyle="success">
                </div>
                <table class="table table-striped" id="tableRelaySatu">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Buzzer</th>
                            <th scope="col">Sensor Jarak</th>
                            <th scope="col">Tanggal dan Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($relaySatu as $isi) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <?php if ($isi->status == "true") : ?>
                                    <td>
                                        <div class="p-3 mb-2 bg-danger text-white">
                                            Aktif
                                        </div>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <div class="p-3 mb-2 bg-success text-white">
                                            Non-Aktif
                                        </div>
                                    </td>
                                <?php endif ?>
                                <?php if ($isi->sensor == "true") : ?>
                                    <td>
                                        <div class="p-3 mb-2 bg-danger text-white">
                                            Aktif
                                        </div>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <div class="p-3 mb-2 bg-success text-white">
                                            Non-Aktif
                                        </div>
                                    </td>
                                <?php endif ?>
                                <td><?= $isi->createdAt ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <div class="my-3">
                    <h6>LED</h6>
                    <input type="checkbox" id="led" value="false" data-toggle="toggle" data-onstyle="success">
                </div>
                <div class="my-3">
                    <h6>Sensor Api</h6>
                    <input type="checkbox" id="sensor-api" checked value="true" data-toggle="toggle" data-onstyle="success">
                </div>
                <table class="table table-striped" id="tableRelayDua">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">LED</th>
                            <th scope="col">Sensor Api</th>
                            <th scope="col">Tanggal dan Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($relayDua as $isi) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <?php if ($isi->status == "true") : ?>
                                    <td>
                                        <div class="p-3 mb-2 bg-danger text-white">
                                            Aktif
                                        </div>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <div class="p-3 mb-2 bg-success text-white">
                                            Non-Aktif
                                        </div>
                                    </td>
                                <?php endif ?>
                                <?php if ($isi->sensor == "true") : ?>
                                    <td>
                                        <div class="p-3 mb-2 bg-danger text-white">
                                            Aktif
                                        </div>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <div class="p-3 mb-2 bg-success text-white">
                                            Non-Aktif
                                        </div>
                                    </td>
                                <?php endif ?>
                                <td><?= $isi->createdAt ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>


            <div class="col-12 my-5 pull-right">
                <button type="button" class="btn btn-primary" id="btn-simpan">Simpan</button>
            </div>
        </div>

    </div>
</section>