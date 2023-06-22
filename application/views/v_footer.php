<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 50px;">
    <div class="container-fluid text-center">
        <h6 class="navbar-brand mx-auto">Made by : Ego Winasis - Tri Wahyudi P.</h6>
    </div>

</nav>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->




<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#tableJarak').DataTable();
    });
    $(document).ready(function() {
        $('#tableApi').DataTable();
    });
    $(document).ready(function() {
        $('#tableRelaySatu').DataTable();
    });
    $(document).ready(function() {
        $('#tableRelayDua').DataTable();
    });

    $(document).ready(function() {
        setInterval(function() {
            var table = $('#tableJarak').DataTable();

            $.ajax({
                url: "<?= base_url() ?>data/getJarak", // change this to the URL of your server-side script that retrieves the data
                method: "GET",
                dataType: "json",
                success: function(data) {
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        }, 60000); // This will execute the AJAX function every 60 seconds (i.e., 1 minute)
    });

    $(document).ready(function() {
        setInterval(function() {
            var table = $('#tableApi').DataTable();

            $.ajax({
                url: "<?= base_url() ?>data/getApi", // change this to the URL of your server-side script that retrieves the data
                method: "GET",
                dataType: "json",
                success: function(data) {
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        }, 60000); // This will execute the AJAX function every 60 seconds (i.e., 1 minute)
    });
</script>


<script>
    $('#buzzer').change(function() {

        let isChecked = $('#buzzer')[0].checked;


        if (isChecked == true) {
        
            $('#buzzer').attr('checked', true);
            $('#buzzer').val('true');
            $('#sensor-jarak').attr('checked', false);
            $('#sensor-jarak').val('false');

            $('#sensor-jarak').parent().removeClass('btn-success');
            $('#sensor-jarak').parent().addClass('btn-light off');
        } else {
        
            $('#buzzer').attr('checked', false);
            $('#buzzer').val('false');
            $('#sensor-jarak').attr('checked', true);
            $('#sensor-jarak').val('true');


            $('#sensor-jarak').parent().addClass('btn-success');
            $('#sensor-jarak').parent().removeClass('btn-light off');
        }
    })

    $('#sensor-jarak').change(function() {

        let isChecked = $('#sensor-jarak')[0].checked;


        if (isChecked == true) {
        
            $('#sensor-jarak').attr('checked', true);
            $('#sensor-jarak').val('true');

            $('#buzzer').removeAttr('checked');
            $('#buzzer').val('false');

            $('#buzzer').parent().removeClass('btn-success');
            $('#buzzer').parent().addClass('btn-light off');
        } else {
        
            $('#sensor-jarak').removeAttr('checked');
            $('#sensor-jarak').val('false');

            $('#buzzer').attr('checked', true);
            $('#buzzer').val('true');


            $('#buzzer').parent().addClass('btn-success');
            $('#buzzer').parent().removeClass('btn-light off');
        }
    })

    $('#led').change(function() {

        let isChecked = $('#led')[0].checked;


        if (isChecked == true) {
        
            $('#led').attr('checked', true);
            $('#led').val('true');
            
            $('#sensor-api').removeAttr('checked');
            $('#sensor-api').val('false');

            $('#sensor-api').parent().removeClass('btn-success');
            $('#sensor-api').parent().addClass('btn-light off');
        } else {
        
            $('#led').removeAttr('checked');
            $('#led').val('false');

            $('#sensor-api').attr('checked', true);
            $('#sensor-api').val('true');

            $('#sensor-api').parent().addClass('btn-success');
            $('#sensor-api').parent().removeClass('btn-light off');
        }
    })

    $('#sensor-api').change(function() {

        let isChecked = $('#sensor-api')[0].checked;


        if (isChecked == true) {
        
            $('#sensor-api').attr('checked', true);
            $('#sensor-api').val('true');

            $('#led').removeAttr('checked');
            $('#led').val('false');

            $('#led').parent().removeClass('btn-success');
            $('#led').parent().addClass('btn-light off');
        } else {
        
            $('#sensor-api').removeAttr('checked');
            $('#sensor-api').val('false');

            $('#led').attr('checked', true);
            $('#led').val('true');

            $('#led').parent().addClass('btn-success');
            $('#led').parent().removeClass('btn-light off');
        }
    })


    $('#btn-simpan').click(function(e){
        e.preventDefault();
        let buzzer = $('#buzzer').val();
        let jarak = $('#sensor-jarak').val();
        let led = $('#led').val();
        let api = $('#sensor-api').val();

        
        var data = {
            buzzer: buzzer,
            jarak: jarak,
            led: led,
            api: api
        };

        // Send the AJAX request
        $.ajax({
            url: '<?= base_url() ?>data/sendKontrol', // Replace this with your server-side script URL
            type: 'POST',
            data: data,
            success: function(response) {
                Swal.fire(
                    'Berhasil',
                    'Pengaturan Tersimpan',
                    'success'
                    
                    )
                setTimeout(() => {
                    location.reload();
                   
                }, 1000);
               
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error sending data: ' + errorThrown);
            }
        });
    });
</script>
</body>

</html>