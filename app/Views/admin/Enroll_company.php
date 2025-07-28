<?= $this->extend('admin/layout/default') ?>


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

<?php $recruiters = old('recruiters') ?? [[]]; ?>
<?php foreach ($recruiters as $i => $rec): ?>
    <div class="recruiter-block">
        <input type="text" name="recruiters[<?= $i ?>][full_name]" value="<?= esc($rec['full_name'] ?? '') ?>" />
        <input type="email" name="recruiters[<?= $i ?>][email]" value="<?= esc($rec['email'] ?? '') ?>" />
        <!-- add others -->
    </div>
<?php endforeach; ?>

<?= $this->section('content') ?>
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-body p-4 bg-white">
      <h4 class="mb-4">Company Registration Form</h4>

    <form action="<?= base_url('submit-company-registration') ?>" method="POST" id="companyRegistrationForm">
        <!-- Company Info -->
        <div class="mb-3">
            <label class="form-label">Company Name</label>
            <input type="text" class="form-control" name="company_name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Company Website</label>
            <input type="url" class="form-control" name="company_website">
        </div>
        <div class="mb-3">
            <label class="form-label">Company Address</label>
            <textarea class="form-control" name="company_address" rows="2" required></textarea>
        </div>

        <!-- HR Info -->
        <h5>Information of HR</h5>
        <div class="mb-3">
            <label class="form-label">Point of Contact Name</label>
            <input type="text" class="form-control" name="poc_name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Official Email ID</label>
            <input type="email" class="form-control" name="poc_email" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Designation of POC</label>
            <input type="text" class="form-control" name="poc_designation" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contact Number</label>
            <input type="tel" class="form-control" name="poc_contact" required>
        </div>

        <!-- Industry -->
        <div class="mb-3">
            <label class="form-label">Industry Sector</label>
            <input type="text" class="form-control" name="industry_sector">
        </div>
        <div class="mb-3">
            <label class="form-label">No. of Recruiters</label>
            <input type="number" class="form-control" name="num_recruiters" id="recruiter-count" value="1" readonly>
        </div>

        <!-- Recruiter Fields -->
        <h5>Recruiters in Drive</h5>
        <div id="recruiter-list">
            <div class="recruiter-block border p-3 mb-3">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" name="recruiters[0][name]" placeholder="Full Name" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="email" class="form-control" name="recruiters[0][email]" placeholder="Official Email ID" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" name="recruiters[0][designation]" placeholder="Designation" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="tel" class="form-control" name="recruiters[0][contact]" placeholder="Contact Number" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" name="recruiters[0][signature]" placeholder="Signature" required>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-outline-secondary mb-0" onclick="addRecruiter()">+ Add Recruiter</button>

        <button type="submit" class="btn btn-primary mt-23">Submit</button>
       </form>
    </div>
  </div>
</div>

<script>
    let recruiterIndex = 1;

    function addRecruiter() {
        const container = document.getElementById('recruiter-list');
        const countField = document.getElementById('recruiter-count');
        const block = document.createElement('div');
        block.classList.add('recruiter-block', 'border', 'p-3', 'mb-3');
        block.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-2">
                    <input type="text" class="form-control" name="recruiters[${recruiterIndex}][name]" placeholder="Full Name" required>
                </div>
                <div class="col-md-6 mb-2">
                    <input type="email" class="form-control" name="recruiters[${recruiterIndex}][email]" placeholder="Official Email ID" required>
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" class="form-control" name="recruiters[${recruiterIndex}][designation]" placeholder="Designation" required>
                </div>
                <div class="col-md-6 mb-2">
                    <input type="tel" class="form-control" name="recruiters[${recruiterIndex}][contact]" placeholder="Contact Number" required>
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" class="form-control" name="recruiters[${recruiterIndex}][signature]" placeholder="Signature" required>
                </div>
            </div>
        `;
        container.appendChild(block);
        recruiterIndex++;
        countField.value = recruiterIndex;
    }
</script>
<?= $this->endSection() ?>
