<?php if($this->session->flashdata('success')): ?>
    <script>
        $(document).ready(function() {
            toastr.success("<?php echo $this->session->flashdata('success'); ?>", "Success", {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            });
        });
    </script>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
    <script>
        $(document).ready(function() {
            toastr.error("<?php echo $this->session->flashdata('error'); ?>", "Error", {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            });
        });
    </script>
<?php endif; ?>

<?php if($this->session->flashdata('warning')): ?>
    <script>
        $(document).ready(function() {
            toastr.warning("<?php echo $this->session->flashdata('warning'); ?>", "Warning", {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            });
        });
    </script>
<?php endif; ?>

<?php if($this->session->flashdata('info')): ?>
    <script>
        $(document).ready(function() {
            toastr.info("<?php echo $this->session->flashdata('info'); ?>", "Info", {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            });
        });
    </script>
<?php endif; ?>
