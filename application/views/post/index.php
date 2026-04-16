<div id="main">
  <div class="main-container">

    <!-- ── Page Header ──────────────────────────────────────── -->
    <div class="page-header-card">
      <div>
        <h4><i class="ph ph-newspaper me-2 text-primary"></i><?php echo $this->lang->line('Post'); ?></h4>
        <p>Manage all news posts and announcements published on the platform.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item active"><?php echo $this->lang->line('Post'); ?></li>
        </ol>
      </nav>
    </div>

    <!-- ── Flash Messages ────────────────────────────────────── -->
    <div id="messages">
      <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3" role="alert">
          <i class="ph ph-check-circle me-2"></i><?php echo $this->session->flashdata('success'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php elseif($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3" role="alert">
          <i class="ph ph-warning-circle me-2"></i><?php echo $this->session->flashdata('error'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
    </div>

    <!-- ── DataTable Card ────────────────────────────────────── -->
    <div class="dt-card">
      <div class="dt-card-header">
        <div>
          <h5><i class="ph ph-list-bullets me-2 text-primary"></i>All Posts</h5>
          <p class="text-muted small mb-0">Showing all news and announcements in the system.</p>
        </div>
        <?php if(in_array('createPost', $user_permission)): ?>
          <a href="<?php echo base_url('post/create') ?>" class="btn-dt-add">
            <i class="ph ph-plus"></i> <?php echo $this->lang->line('Add Post'); ?>
          </a>
        <?php endif; ?>
      </div>

      <div class="dt-card-body">
        <div class="table-responsive datatable-wrapper">
          <table class="table align-middle mb-0" id="manageTable">
            <thead>
              <tr>
                <th width="15%"><?php echo $this->lang->line('Category'); ?></th>
                <th width="33%"><?php echo $this->lang->line('Title'); ?></th>
                <th width="10%"><?php echo $this->lang->line('Date from'); ?></th>
                <th width="10%"><?php echo $this->lang->line('Date to'); ?></th>
                <th width="7%"><?php echo $this->lang->line('Web Visibility'); ?></th>
                <th width="5%"><?php echo $this->lang->line('Active'); ?></th>
                <?php if(in_array('updatePost', $user_permission) || in_array('deletePost', $user_permission)): ?>
                  <th width="10%"><?php echo $this->lang->line('Action'); ?></th>
                <?php endif; ?>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div><!-- /.dt-card -->

  </div>
</div>


<!----------------------------------------------------------- Delete ------------------------------------------------------------------>

<?php if(in_array('deletePost', $user_permission)): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold">
          <i class="ph ph-trash text-danger me-2"></i><?php echo $this->lang->line('Delete Post'); ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form role="form" action="<?php echo base_url('post/remove') ?>" method="post" id="removeForm">
        <div class="modal-body text-muted">
          <div class="alert alert-danger bg-danger bg-opacity-10 border-0 rounded-3 d-flex align-items-center gap-2 mb-0">
            <i class="ph ph-warning fs-5 text-danger"></i>
            <span><?php echo $this->lang->line('Do you really want to delete?'); ?> This action cannot be undone.</span>
          </div>
        </div>
        <div class="modal-footer border-0 pt-0 gap-2">
          <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">
            <i class="ph ph-x me-1"></i><?php echo $this->lang->line('Close'); ?>
          </button>
          <button type="submit" class="btn btn-danger rounded-3 px-4">
            <i class="ph ph-trash me-1"></i><?php echo $this->lang->line('Delete'); ?>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>


<!----------------------------------------------------------- Javascript ------------------------------------------------------------------>

<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#mainPostNav").addClass('active');

  // Initialize DataTable
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'post/fetchPostData',
    'language': {'url': "<?php echo $this->session->link_language; ?>"},
    'order': [[0, 'asc']],
    'columnDefs': [
      {
        // Web Visibility badge
        targets: 5,
        render: function(data) {
          if(data == 1 || data == 'Yes' || data == 'yes') {
            return '<span class="dt-badge dt-badge-success"><i class="ph ph-eye"></i> Visible</span>';
          }
          return '<span class="dt-badge dt-badge-secondary"><i class="ph ph-eye-slash"></i> Hidden</span>';
        }
      },
      {
        // Active badge
        targets: 6,
        render: function(data) {
          if(data == 1 || data == 'Yes' || data == 'yes' || data == 'Active') {
            return '<span class="dt-badge dt-badge-success"><i class="ph ph-check-circle"></i> Active</span>';
          }
          return '<span class="dt-badge dt-badge-danger"><i class="ph ph-x-circle"></i> Inactive</span>';
        }
      }
    ]
  });

});

// Remove function
function removeFunc(id) {
  if(id) {
    $("#removeModal").modal('show');
    $("#removeForm").off('submit').on('submit', function() {
      var form = $(this);
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { post_id: id },
        dataType: 'json',
        success: function(response) {
          manageTable.ajax.reload(null, false);
          $("#removeModal").modal('hide');

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">' +
              '<i class="ph ph-check-circle me-2"></i>' + response.messages +
              '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
            '</div>');
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible fade show rounded-3" role="alert">' +
              '<i class="ph ph-warning me-2"></i>' + response.messages +
              '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
            '</div>');
          }
        }
      });

      return false;
    });
  }
}
</script>
