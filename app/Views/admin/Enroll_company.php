<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>


<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->get('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session()->get('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>



<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-body p-4 bg-white">
      <h4 class="mb-4">Company Registration Form</h4>

    <form action="<?= base_url('submit-company-registration') ?>" method="POST" id="companyRegistrationForm">
        <!-- Company Info -->
       <h5>Company Information</h5>

        <!-- First row: Company Name & Website -->
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label">Company Name</label>
              <input type="text" class="form-control" name="company_name" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label">Company Website</label>
              <input type="url" class="form-control" name="company_website">
            </div>
          </div>
        </div>

        <!-- Second row: Address -->
        <div class="row">
          <div class="col-6">
            <div class="mb-3">
              <label class="form-label">Company Address</label>
              <textarea class="form-control" name="company_address" rows="2" required></textarea>
            </div>
          </div>
        </div>
      


        <!-- HR Info -->
        <h5>Information of HR</h5>
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label">Point of Contact Name</label>
              <input type="text" class="form-control" name="poc_name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Designation of POC</label>
              <input type="text" class="form-control" name="poc_designation" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Industry Sector</label>
              <input type="text" class="form-control" name="industry_sector">
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label">Official Email ID</label>
              <input type="email" class="form-control" name="poc_email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Contact Number</label>
              <input type="tel" class="form-control" name="poc_contact" required>
            </div>
          </div>
        </div>
      

        <!-- Recruiter Fields -->
        <h5>Recruiters in Drive</h5>
        <div id="recruiter-list">
            <?php $recruiters = old('recruiters') ?? [[]]; ?>
            <?php foreach ($recruiters as $i => $rec): ?>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="recruiters[<?= $i ?>][name]" value="<?= esc($rec['name'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Official Email ID</label>
                        <input type="email" class="form-control" name="recruiters[<?= $i ?>][email]" value="<?= esc($rec['email'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Designation</label>
                        <input type="text" class="form-control" name="recruiters[<?= $i ?>][designation]" value="<?= esc($rec['designation'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Contact Number</label>
                        <input type="tel" class="form-control" name="recruiters[<?= $i ?>][contact]" value="<?= esc($rec['contact'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Signature</label>
                        <input type="text" class="form-control" name="recruiters[<?= $i ?>][signature]" value="<?= esc($rec['signature'] ?? '') ?>" required>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="d-flex justify-content-between mt-3">
        <button type="button" class="btn btn-outline-secondary mb-0" onclick="addRecruiter()">+ Add Recruiter</button>
        </div>
           
          <!-- Job Requirment Fields -->
        <h4 class="mb-4">Job Requirement</h4> <!-- ✅ Changed heading -->
        <div id="job-requirements-list">
          
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Job Profile</label>
                <input type="text" name="job_profiles[]" class="form-control form-control-sm" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Vacancies</label>
                <input type="number" name="vacancies[]" class="form-control form-control-sm" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="locations[]" class="form-control form-control-sm" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">CTC Package</label>
                <input type="text" name="salary[]" class="form-control form-control-sm" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Eligibility Criteria</label>
                <input type="text" name="eligibility[]" class="form-control form-control-sm" required>
              </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-3">
          <button type="button" class="btn btn-outline-primary" onclick="addJobRequirement()">+ Add More</button>
          <button type="submit" class="btn btn-primary mt-23">Submit</button>
        </div>
       </form>
    </div>
  </div>
</div>

<script>
    let recruiterIndex = 1;

    function addRecruiter() {
        recruiterIndex++;

        const container = document.getElementById('recruiter-list');

        const block = document.createElement('div');
        block.classList.add('recruiter-block', 'border', 'p-3', 'mb-3', 'bg-light');

        block.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Add Recruiter <span class="recruiter-number">${recruiterIndex}</span></h6>
                <button type="button" class="btn p-0 text-danger" onclick="removeRecruiter(this)" title="Remove">
                    <i class="fa fa-times fs-5"></i>
                </button>
            </div>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="recruiters[${recruiterIndex - 1}][name]" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Official Email ID</label>
                    <input type="email" class="form-control" name="recruiters[${recruiterIndex - 1}][email]" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Designation</label>
                    <input type="text" class="form-control" name="recruiters[${recruiterIndex - 1}][designation]" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Contact Number</label>
                    <input type="tel" class="form-control" name="recruiters[${recruiterIndex - 1}][contact]" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Signature</label>
                    <input type="text" class="form-control" name="recruiters[${recruiterIndex - 1}][signature]" required>
                </div>
            </div>
        `;

        container.appendChild(block);
        updateRecruiterNumbers();
    }

    function removeRecruiter(button) {
        const block = button.closest('.recruiter-block');
        block.remove();
        updateRecruiterNumbers();
    }

    function updateRecruiterNumbers() {
        const blocks = document.querySelectorAll('#recruiter-list .recruiter-block');
        blocks.forEach((block, index) => {
            const numberSpan = block.querySelector('.recruiter-number');
            if (numberSpan) {
                numberSpan.textContent = index + 2; // Starts from 2
            }
        });
    }
</script>


<script>
  let jobCount = 1; // Start at 1 so the first block added becomes "Job Requirement 2"

  function addJobRequirement() {
    jobCount++; // Increments to 2, 3, etc.

    const container = document.getElementById('job-requirements-list');

    const block = document.createElement('div');
    block.classList.add('job-entry', 'border', 'rounded', 'p-3', 'mb-3', 'bg-light');

    block.innerHTML = `
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Add Job Requirement <span class="job-number">${jobCount}</span></h6>
        <button type="button" class="btn p-0 text-danger" onclick="removeJobRequirement(this)" title="Remove">
          <i class="fa fa-times fs-5"></i>
        </button>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Job Profile</label>
          <input type="text" name="job_profiles[]" class="form-control form-control-sm" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Vacancies</label>
          <input type="number" name="vacancies[]" class="form-control form-control-sm" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Location</label>
          <input type="text" name="locations[]" class="form-control form-control-sm" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">CTC Package</label>
          <input type="text" name="salary[]" class="form-control form-control-sm" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Eligibility Criteria</label>
          <input type="text" name="eligibility[]" class="form-control form-control-sm" required>
        </div>
      </div>
    `;

    container.appendChild(block);
    updateJobNumbers();
  }

  function removeJobRequirement(button) {
    const block = button.closest('.job-entry');
    block.remove();
    updateJobNumbers();
  }

  function updateJobNumbers() {
    const blocks = document.querySelectorAll('#job-requirements-list .job-entry');
    blocks.forEach((block, index) => {
      const numberSpan = block.querySelector('.job-number');
      if (numberSpan) {
        numberSpan.textContent = index + 2; // Start from 2
      }
    });
  }
</script>

<?= $this->endSection() ?>
