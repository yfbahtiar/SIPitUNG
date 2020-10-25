<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>&copy; <?= date('Y'); ?> <strong>SIPitUNG</strong> Member of <a class="text-primary font-weight-bold">gpsbekonang</a>. <i>versi 1.4.1</i></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>" id="logOut">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- dataTables -->
<script src="<?= base_url('assets/'); ?>js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/dataTables.bootstrap4.min.js"></script>

<!-- styleRupiah -->
<script src="<?= base_url('assets/'); ?>js/rupiah.js"></script>

<!-- customJs -->
<script src="<?= base_url('assets/'); ?>js/custom.js"></script>

<script>
    $(document).ready(function() {
        $('.toChangeRoleAccess').on('click', function() {
            const menuId = $(this).data('menu');
            const roleId = $(this).data('role');

            $.ajax({
                url: "<?= base_url('admin/changeaccess'); ?>",
                type: "post",
                data: {
                    menuId: menuId,
                    roleId: roleId
                },
                success: function() {
                    document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
                }
            });
        })

        $.ajax({
            url: "<?= base_url() ?>user/gettotalalert",
            type: "POST",
            dataType: "json",
            data: {},
            success: function(data) {
                $("#userAlert").html(data.userAlert);
            }
        })

        $('#logOut').on('click', function() {
            $('#logOut').addClass('disabled').html(`<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only">Loading...</span></div>`);
        })

        $('form').submit(function() {
            $('button[type="submit"]').prop('disabled', true).html(`<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only">Loading...</span></div>`);
        })

        $('#showPass').on('click', function(event) {
            event.preventDefault();
            if ($('#current_password').attr("type") == "text") {
                $('#current_password').attr('type', 'password');
                $('#toggle').removeClass('fa-eye text-primary');
                $('#toggle').addClass('fa-eye');
            } else if ($('#current_password').attr("type") == "password") {
                $('#current_password').attr('type', 'text');
                $('#toggle').removeClass('fa-eye');
                $('#toggle').addClass('fa-eye text-primary');
            }
        })

        $('#showPass1').on('click', function(event) {
            event.preventDefault();
            if ($('#new_password1').attr("type") == "text") {
                $('#new_password1').attr('type', 'password');
                $('#toggle1').removeClass('fa-eye text-primary');
                $('#toggle1').addClass('fa-eye');
            } else if ($('#new_password1').attr("type") == "password") {
                $('#new_password1').attr('type', 'text');
                $('#toggle1').removeClass('fa-eye');
                $('#toggle1').addClass('fa-eye text-primary');
            }
        })

        $('#showPass2').on('click', function(event) {
            event.preventDefault();
            if ($('#new_password2').attr("type") == "text") {
                $('#new_password2').attr('type', 'password');
                $('#toggle2').removeClass('fa-eye text-primary');
                $('#toggle2').addClass('fa-eye');
            } else if ($('#new_password2').attr("type") == "password") {
                $('#new_password2').attr('type', 'text');
                $('#toggle2').removeClass('fa-eye');
                $('#toggle2').addClass('fa-eye text-primary');
            }
        })
    });
</script>

</body>

</html>