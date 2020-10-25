<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<script>
    $(document).ready(function() {
        $('form').submit(function() {
            $('button[type="submit"]').prop('disabled', true).html(`<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only">Loading...</span></div>`);
        })

        $('#showPass').on('click', function(event) {
            event.preventDefault();
            if ($('#password').attr("type") == "text") {
                $('#password').attr('type', 'password');
                $('#toggle').removeClass('fa-eye text-primary');
                $('#toggle').addClass('fa-eye');
            } else if ($('#password').attr("type") == "password") {
                $('#password').attr('type', 'text');
                $('#toggle').removeClass('fa-eye');
                $('#toggle').addClass('fa-eye text-primary');
            }
        })

        $('#showPass1').on('click', function(event) {
            event.preventDefault();
            if ($('#password1').attr("type") == "text") {
                $('#password1').attr('type', 'password');
                $('#toggle1').removeClass('fa-eye text-primary');
                $('#toggle1').addClass('fa-eye');
            } else if ($('#password1').attr("type") == "password") {
                $('#password1').attr('type', 'text');
                $('#toggle1').removeClass('fa-eye');
                $('#toggle1').addClass('fa-eye text-primary');
            }
        })

        $('#showPass2').on('click', function(event) {
            event.preventDefault();
            if ($('#password2').attr("type") == "text") {
                $('#password2').attr('type', 'password');
                $('#toggle2').removeClass('fa-eye text-primary');
                $('#toggle2').addClass('fa-eye');
            } else if ($('#password2').attr("type") == "password") {
                $('#password2').attr('type', 'text');
                $('#toggle2').removeClass('fa-eye');
                $('#toggle2').addClass('fa-eye text-primary');
            }
        })
    });
</script>

</body>

</html>