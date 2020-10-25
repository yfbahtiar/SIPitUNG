// dataTables
$('#example').DataTable();

// select data nasabah
$(document).ready(function () {

    $(document).on('click', '#nasabah', function (e) {
        document.getElementById("id_nasabah").value = $(this).attr('data-id_nasabah');
        document.getElementById("nama").value = $(this).attr('data-nama');
        document.getElementById("saldo").value = $(this).attr('data-saldo_awal');
        $('#modal').modal('hide');
    });

});

// modify iput name file upload
$('.custom-file-input').on('change', function () {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
