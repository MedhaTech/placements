<?= $this->extend('admin/layout/default') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-body p-4 bg-white">
      <h4 class="mb-4">Add Job Requirements</h4>
      <form method="POST" action="<?= base_url('/admin/save-job-requirements') ?>">
        <div id="job-requirements-list">
          <div class="job-entry border rounded p-3 mb-3 bg-light">
            <h6 class="mb-3 fw-bold">Job Requirement</h6>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Job Profile</label>
                <input type="text" name="job_profiles[]" class="form-control form-control-sm" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Vacancies</label>
                <input type="number" name="vacancies[]" class="form-control form-control-sm" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="locations[]" class="form-control form-control-sm" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">CTC Package</label>
                <input type="text" name="salary[]" class="form-control form-control-sm" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Eligibility Criteria</label>
                <input type="text" name="eligibility[]" class="form-control form-control-sm" required>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-between mt-3">
          <button type="button" class="btn btn-outline-primary" onclick="addJobRequirement()">+ Add More</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function addJobRequirement() {
    const container = document.getElementById('job-requirements-list');
    const block = document.createElement('div');
    block.classList.add('job-entry', 'border', 'rounded', 'p-3', 'mb-3', 'bg-light');
    block.innerHTML = `
      <h6 class="mb-3 fw-bold">Job Requirement</h6>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Job Profile</label>
          <input type="text" name="job_profiles[]" class="form-control form-control-sm" required>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Vacancies</label>
          <input type="number" name="vacancies[]" class="form-control form-control-sm" required>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Location</label>
          <input type="text" name="locations[]" class="form-control form-control-sm" required>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">CTC Package</label>
          <input type="text" name="salary[]" class="form-control form-control-sm" required>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Eligibility Criteria</label>
          <input type="text" name="eligibility[]" class="form-control form-control-sm" required>
        </div>
      </div>
    `;
    container.appendChild(block);
  }
</script>

<?= $this->endSection() ?>
