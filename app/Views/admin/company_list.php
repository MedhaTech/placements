<?= $this->extend('admin/layout/default'); ?>
<?= $this->section('content'); ?>

<!-- Breadcrumb Heading -->
<div class="container">
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Companies List</h6>
            <p class="page-title-description mr-0 d-none d-md-inline-block">Record of companies registered in the system.</p>
        </div>
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Companies List</li>
            </ol>
        </div>
    </div>
</div>

<!-- Top Action Bar -->
<div class="container">
    <div class="card p-4">
        <div class="page-title-left">
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h4 class="page-title-heading mb-1">Companies List</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= site_url('enroll-company'); ?>" class="btn btn-primary">+ Add New Company</a>
                </div>
            </div>
        </div>

        <!-- Toast Alerts -->
        <?php if (session()->getFlashdata('success')) : ?>
            <script>
                $(document).ready(function () {
                    $.toast({
                        heading: 'Success',
                        text: '<?= esc(session()->getFlashdata('success')); ?>',
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'top-right'
                    });
                });
            </script>
        <?php elseif (session()->getFlashdata('error')) : ?>
            <script>
                $(document).ready(function () {
                    $.toast({
                        heading: 'Error',
                        text: '<?= esc(session()->getFlashdata('error')); ?>',
                        showHideTransition: 'fade',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'top-right'
                    });
                });
            </script>
        <?php endif; ?>

        <!-- Companies Table -->
        <div class="table-responsive">
            <table id="companyTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Company ID</th>
                        <th>Company Name</th>
                        <th>HR Email &amp; Mobile</th>
                        <th>No. of Requirements<br><small>(# Job Profiles)</small></th>
                        <th>Total Vacancies</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($companies) && is_array($companies)) : ?>
                    <?php foreach ($companies as $row) :
                        $id        = (int) ($row['id'] ?? 0);
                        $name      = $row['company_name'] ?? '';
                        $hrEmail   = $row['poc_email'] ?? '';
                        $hrMobile  = $row['poc_contact'] ?? '';

                        // If you changed controller per last message, you can read these from SQL aggregates:
                        // $reqCount  = (int)($row['req_count'] ?? 0);
                        // $vacancies = (int)($row['vacancy_total'] ?? 0);
                        // Otherwise keep PHP-side computation:
                        $jobsForCompany = $jobRequirements[$id] ?? [];
                        $reqCount = is_array($jobsForCompany) ? count($jobsForCompany) : 0;
                        $vacancies = 0;
                        if (!empty($jobsForCompany)) {
                            foreach ($jobsForCompany as $jr) {
                                $vacancies += (int)($jr['vacancies'] ?? 0);
                            }
                        }

                        // --- Normalize status to boolean $isActive ---
                        $statusRaw = $row['status'] ?? ($row['is_active'] ?? null);
                        $isActive  = false;
                        if (is_numeric($statusRaw)) {
                            $isActive = ((int)$statusRaw === 1);
                        } elseif (is_string($statusRaw)) {
                            $val = strtolower(trim($statusRaw));
                            $isActive = in_array($val, ['active', '1', 'yes', 'true'], true);
                        }

                        $formattedId = 'CID' . str_pad((string)$id, 3, '0', STR_PAD_LEFT);
                    ?>
                    <tr>
                        <!-- Row cells -->
                        <td>#<?= esc($formattedId); ?></td>
                        <td><?= esc($name); ?></td>
                        <td>
                            <?= esc($hrEmail ?: '-'); ?><br>
                            <?= esc($hrMobile ?: '-'); ?>
                        </td>
                        <td><?= esc($reqCount); ?></td>
                        <td><?= esc($vacancies); ?></td>
                        <td class="text-center">
                            <a data-toggle="modal" data-target="#viewCompany<?= esc($id); ?>" class="btn btn-sm btn-light" title="View">
                                <i class="fa fa-eye text-info"></i>
                            </a>
                            <a data-toggle="modal" data-target="#editCompany<?= esc($id); ?>" class="btn btn-sm btn-light" title="Edit">
                                <i class="fa fa-edit text-primary"></i>
                            </a>

                            <!-- NEW: Toggle Active/Inactive -->
                            <form method="post" action="<?= site_url('companies/toggle-status'); ?>" style="display:inline;">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id" value="<?= esc($id); ?>">
                                <input type="hidden" name="current_status" value="<?= esc($statusRaw ?? ''); ?>">
                                <button type="submit" class="btn btn-sm btn-light"
                                        title="<?= $isActive ? 'Inactivate' : 'Activate'; ?>">
                                    <i class="fa <?= $isActive ? 'fa-ban text-warning' : 'fa-check text-success'; ?>"></i>
                                </button>
                            </form>

                            <a data-toggle="modal" data-target="#deleteCompany<?= esc($id); ?>" class="btn btn-sm btn-light" title="Delete">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="6" class="text-center">No companies found.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<script>
    $(document).ready(function () {
        $('#companyTable').DataTable();
    });
</script>

<!-- Toast -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
<!-- All View Modals -->
<?php if (!empty($companies) && is_array($companies)) : ?>
    <?php foreach ($companies as $row) :
        $id        = (int)($row['id'] ?? 0);
        $name      = $row['company_name'] ?? '';
        $hrEmail   = $row['poc_email'] ?? '';
        $hrMobile  = $row['poc_contact'] ?? '';
        $reqCount  = isset($jobRequirements[$id]) ? count($jobRequirements[$id]) : 0;
        $vacancies = 0;
        if (!empty($jobRequirements[$id])) {
            foreach ($jobRequirements[$id] as $jr) {
                $vacancies += (int)($jr['vacancies'] ?? 0);
            }
        }
        $statusRaw = $row['status'] ?? ($row['is_active'] ?? null);
        $isActive = false;
        if (is_numeric($statusRaw)) {
            $isActive = ((int)$statusRaw === 1);
        } elseif (is_string($statusRaw)) {
            $val = strtolower(trim($statusRaw));
            $isActive = in_array($val, ['active', '1', 'yes', 'true'], true);
        }
        $formattedId = 'CID' . str_pad((string)$id, 3, '0', STR_PAD_LEFT);
    ?>
    <div class="modal fade" id="viewCompany<?= esc($id); ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-scrollable">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white py-2">
                    <h5 class="modal-title font-weight-bold mb-0 text-white">Company Details</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body px-4 pt-3 pb-4">
                    <h6 class="font-weight-bold text-secondary">Company Info</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div><strong>Company ID:</strong> #<?= esc($formattedId); ?></div>
                            <div><strong>Company Name:</strong> <?= esc($name); ?></div>
                            <div><strong>Industry:</strong> <?= esc($row['industry_sector'] ?? '-'); ?></div>
                            <div><strong>Website:</strong> <?= esc($row['company_website'] ?? '-'); ?></div>
                        </div>
                        <div class="col-md-6">
                            <div><strong>Total Requirements:</strong> <?= esc($reqCount); ?></div>
                            <div><strong>Total Vacancies:</strong> <?= esc($vacancies); ?></div>
                            <div><strong>Status:</strong> <?= $isActive ? 'Active' : 'Inactive'; ?></div>
                            <div><strong>Address:</strong> <?= esc($row['company_address'] ?? '-'); ?></div>
                        </div>
                    </div>

                    <h6 class="font-weight-bold text-secondary">HR Contact (POC)</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div><strong>Name:</strong> <?= esc($row['poc_name'] ?? '-'); ?></div>
                            <div><strong>Email:</strong> <?= esc($hrEmail ?: '-'); ?></div>
                        </div>
                        <div class="col-md-6">
                            <div><strong>Designation:</strong> <?= esc($row['poc_designation'] ?? '-'); ?></div>
                            <div><strong>Mobile:</strong> <?= esc($hrMobile ?: '-'); ?></div>
                        </div>
                    </div>

                    <h6 class="font-weight-bold text-secondary">Recruiters</h6>
                    <?php if (!empty($recruiters[$id])): ?>
                        <div class="table-responsive mb-3">
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Designation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recruiters[$id] as $r): ?>
                                        <tr>
                                            <td><?= esc($r['name'] ?? '-'); ?></td>
                                            <td><?= esc($r['email'] ?? '-'); ?></td>
                                            <td><?= esc($r['contact'] ?? '-'); ?></td>
                                            <td><?= esc($r['designation'] ?? '-'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No recruiters found for this company.</p>
                    <?php endif; ?>

                    <h6 class="font-weight-bold text-secondary">Job Requirements</h6>
                    <?php if (!empty($jobRequirements[$id])): ?>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Job Profile</th>
                                        <th>Vacancies</th>
                                        <th>CTC</th>
                                        <th>Eligibility</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($jobRequirements[$id] as $jr): ?>
                                        <tr>
                                            <td><?= esc($jr['job_profile'] ?? '-'); ?></td>
                                            <td><?= esc($jr['vacancies'] ?? '0'); ?></td>
                                            <td><?= esc($jr['salary'] ?? '-'); ?></td>
                                            <td><?= esc($jr['eligibility'] ?? '-'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No job requirements listed.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteCompany<?= esc($id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form method="post" action="<?= site_url('companies/delete'); ?>">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?= esc($id); ?>">
                                    <div class="modal-content border-0 p-3 text-center">
                                        <div class="modal-header border-0 justify-content-center">
                                            <h5 class="modal-title text-danger font-weight-bold w-100">Confirm Deletion</h5>
                                            <button type="button" class="close position-absolute" style="top: 10px; right: 15px;" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete <strong><?= esc($name); ?></strong>?</p>
                                        </div>
                                        <div class="modal-footer border-0 justify-content-center">
                                            <button type="submit" class="btn btn-danger px-4 mr-2">Delete</button>
                                            <button type="button" class="btn btn-secondary px-4 ml-2" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- EDIT MODAL (prefilled) -->
                        <div class="modal fade" id="editCompany<?= esc($id); ?>" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-lg modal-dialog-centered">
                            <form method="post" action="<?= site_url('companies/update'); ?>">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="id" value="<?= esc($id); ?>">
                              <input type="hidden" name="hr_id" value="<?= esc($row['hr_id'] ?? 0); ?>">

                              <div class="modal-content border-0">
                                <div class="modal-header bg-primary text-white py-2">
                                  <h5 class="modal-title font-weight-bold mb-0 text-white">Edit Company</h5>
                                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
                                </div>

                                <div class="modal-body px-4 pt-3 pb-1">
                                  <div class="row">
                                    <!-- LEFT -->
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="mb-1 font-weight-600">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" value="<?= esc($row['company_name'] ?? ''); ?>" required>
                                      </div>

                                      <div class="form-group">
                                        <label class="mb-1 font-weight-600">Industry Sector</label>
                                        <input type="text" name="industry_sector" class="form-control" value="<?= esc($row['industry_sector'] ?? ''); ?>">
                                      </div>

                                      <div class="form-group">
                                        <label class="mb-1 font-weight-600">Website</label>
                                        <input type="text" name="company_website" class="form-control" value="<?= esc($row['company_website'] ?? ''); ?>">
                                      </div>

                                      <div class="form-group">
                                        <label class="mb-1 font-weight-600">Active</label><br>
                                        <?php $isActive = isset($row['is_active']) && (int)$row['is_active'] === 1; ?>
                                        <label class="mb-0">
                                          <input type="checkbox" name="is_active" value="1" <?= $isActive ? 'checked' : ''; ?>>
                                          <span class="ml-1"><?= $isActive ? 'Active' : 'Inactive'; ?></span>
                                        </label>
                                      </div>
                                    </div>

                                    <!-- RIGHT -->
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="mb-1 font-weight-600">Address</label>
                                        <textarea name="company_address" class="form-control" rows="3"><?= esc($row['company_address'] ?? ''); ?></textarea>
                                      </div>

                                      <div class="form-group">
                                        <label class="mb-1 font-weight-600">HR POC Name</label>
                                        <input type="text" name="poc_name" class="form-control" value="<?= esc($row['poc_name'] ?? ''); ?>">
                                      </div>

                                      <div class="form-group">
                                        <label class="mb-1 font-weight-600">HR POC Email</label>
                                        <input type="email" name="poc_email" class="form-control" value="<?= esc($row['poc_email'] ?? ''); ?>">
                                      </div>

                                      <div class="form-group">
                                        <label class="mb-1 font-weight-600">HR POC Mobile</label>
                                        <input type="text" name="poc_contact" class="form-control" value="<?= esc($row['poc_contact'] ?? ''); ?>">
                                      </div>

                                      <div class="form-group">
                                        <label class="mb-1 font-weight-600">HR POC Designation</label>
                                        <input type="text" name="poc_designation" class="form-control" value="<?= esc($row['poc_designation'] ?? ''); ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="modal-footer border-0 pt-0">
                                  <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                                  <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Cancel</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection(); ?>
