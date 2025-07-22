<?= $this->extend('student/layout/default') ?>
<?= $this->section('content') ?>

<style>
  .container-custom {
    max-width: 1240px;
    margin: 30px auto;
  }

  .profile-card {
    background: #fff;
    padding: 24px;
    border-radius: 16px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 30px;
  }

  .profile-info {
    display: flex;
    gap: 20px;
  }
    .custom-checkbox {
    transform: scale(0.8);
    margin-right: 6px;
  }

  .form-label-with-checkbox {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .profile-photo {
    width: 90px;
    height: 90px;
    background: #ddd;
    border-radius: 50%;
    position: relative;
  }

  .progress-circle {
    position: absolute;
    bottom: -10px;
    left: 20px;
    background: #fff;
    border-radius: 12px;
    padding: 4px 10px;
    font-size: 13px;
    font-weight: bold;
    color: red;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
  }

  .details h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
  }

  .details small {
    font-size: 13px;
    color: #666;
  }

  .details p {
    font-size: 14px;
    margin: 4px 0;
  }

  .prompt-box {
    width: 320px;
    background: #fff4ef;
    border-radius: 12px;
    padding: 20px;
  }

  .prompt-box li {
    font-size: 14px;
    margin-bottom: 8px;
  }

  .prompt-box .btn {
    background: #f43f20;
    color: #fff;
    border-radius: 20px;
    padding: 6px 20px;
    font-size: 14px;
    border: none;
  }

  .main-body {
    display: flex;
    gap: 24px;
  }

  .quick-links {
    width: 260px;
    background: #fff;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    height: fit-content;
  }

  .quick-links h6 {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 16px;
  }

  .quick-links a {
    display: block;
    font-size: 14px;
    color: #0059b3;
    text-decoration: none;
    margin-bottom: 10px;
  }

  .profile-section {
    flex: 1;
  }

  .section-card {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 1px 6px rgba(0, 0, 0, 0.03);
  }

  .section-card h5 {
    font-size: 16px;
    display: flex;
    justify-content: space-between;
  }

  .section-card a {
    font-size: 14px;
    color: #0073e6;
    text-decoration: none;
  }

  .modal textarea {
    border-radius: 12px;
  }

  .modal-content {
    border-radius: 16px;
    background-color: #fff;
  }

  .modal-body label {
    font-weight: 500;
    margin-bottom: 4px;
  }

  .modal-body input,
  .modal-body select {
    border-radius: 10px;
    padding: 10px 14px;
  }

  .modal-body .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.25);
  }

  .section-card p,
  .section-card div {
    font-size: 14px;
    color: #444;
  }

  .badge {
    background-color: #f3f6f8;
    font-weight: 500;
  }

  .edit.icon {
    cursor: pointer;
    padding: 4px;
    border-radius: 4px;
    transition: background-color 0.2s;
  }

  .edit.icon:hover {
    background-color: #eef4fa;
  }

  .input-group input.form-control-sm {
    border-radius: 8px;
  }

  .btn-outline-danger.btn-sm {
    border-radius: 8px;
  }

  .badge {
    font-size: 13px;
    font-weight: 500;
    background-color: #f8f9fa;
    border: 1px solid #ccc;
  }

  .removeSkillIcon i {
    font-size: 14px;
    margin-left: 6px;
  }

  .list-group-item {
    border: 1px solid #e1e5ea;
    background-color: #f8f9fa;
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 14px;
  }

  .list-group-item:hover {
    background-color: #eef4ff;
    transition: 0.2s;
  }
</style>

<div class="container-fluid">
  <div class="container-custom">
    <!-- Top Full Width Profile Card -->
    <div class="profile-card">
      <div class="profile-info">
        <div class="profile-photo">
          <!-- You can replace this div with an <img> tag once you have image support -->
          <div class="progress-circle"><?= $completionPercentage ?? '5%' ?></div>
        </div>
        <div class="details">
          <h5><?= esc($student['full_name']) ?> <?= esc($student['appar_id']) ?> ✏️</h5>
          <small>Profile last updated -
            <?= !empty($student['updated_at']) ? date('F j, Y', strtotime($student['updated_at'])) : 'Not yet updated' ?></small>
          <p>📍 <?= !empty($student['preferred_location']) ? esc($student['preferred_location']) : 'Add location' ?></p>
          <p>🧑‍🎓 <?= !empty($student['experience_level']) ? esc($student['experience_level']) : 'Fresher' ?></p>
          <p>📅
            <?= !empty($student['availability']) ? 'Available from ' . esc($student['availability']) : 'Add availability to join' ?>
          </p>
        </div>
      </div>

      <!-- Missing prompts box -->
      <div class="prompt-box">
        <ul class="ps-3">
          <?php if (empty($student['mobile_no'])): ?>
            <li>📱 Verify mobile number <span class="text-success">+10%</span></li>
          <?php endif; ?>

          <?php if (empty($student['preferred_location'])): ?>
            <li>📍 Add preferred location <span class="text-success">+2%</span></li>
          <?php endif; ?>

          <?php if (empty($student['resume_path'])): ?>
            <li>📄 Add resume <span class="text-success">+10%</span></li>
          <?php endif; ?>
        </ul>

        <?php
        // Count missing fields for a score system
        $missing = 0;
        $missing += empty($student['mobile_no']) ? 1 : 0;
        $missing += empty($student['preferred_location']) ? 1 : 0;
        $missing += empty($student['resume_path']) ? 1 : 0;
        $totalMissing = $missing * 1; // You can adjust scoring logic
        ?>
        <button class="btn">Add <?= $totalMissing ?> missing details</button>
      </div>
    </div>
    <!-- Main Body with Sidebar + Sections -->
    <div class="main-body">
      <!-- Sidebar -->
      <div class="quick-links">
        <h6>Quick Links</h6>
        <a href="#profile-summary">Profile Summary</a>
        <a href="#personal-info">Personal Information</a>
        <a href="#family-details">Family Details</a>
        <a href="#experience">Experience Details</a>
        <a href="#skills">Key Skills</a>
        <a href="#education">Education Details</a>
        <a href="#certifications">Licenses & Certifications</a>
        <a href="#projects">Projects & Publications</a>
        <a href="#languages">Languages</a>
        <a href="#academic-info">Current Academic Information</a>
        <a href="#preferences">Placement Preferences</a>
        <a href="#training">Placement Training</a>
        <a href="#offers">Placement Offers</a>
        <a href="#documents">Documents</a>
      </div>

      <!-- Sections Area -->
      <div class="profile-section">
        <div id="profile-summary" class="section-card">
          <h5 class="d-flex align-items-center gap-2">
            <span>Profile Summary</span>
            <span class="edit icon" tabindex="0" data-bs-toggle="modal" data-bs-target="#profileSummaryModal"
              title="Edit Summary">
              <i class="fa-solid fa-pen-to-square text-primary" style="font-size: 15px;"></i>
            </span>
          </h5>

          <p><?= !empty($student['profile_summary']) ? esc($student['profile_summary']) : 'No summary added yet.' ?></p>
        </div>

       <div id="personal-info" class="section-card">
          <h5 class="d-flex align-items-center gap-2 fw-bold mb-3 text-dark" style="font-size: 16px;">
            <span>Personal Information</span>
            <span class="edit icon" tabindex="0" data-bs-toggle="modal" data-bs-target="#personalInfoModal"
              title="Edit Personal Info">
              <i class="fa-solid fa-pen-to-square text-primary" style="font-size: 15px;"></i>
            </span>
          </h5>

          <div class="row text-muted small">
            <!-- Top Fields -->
            <div class="col-md-6 mb-2"><strong>Full Name:</strong> <?= esc($student['full_name']) ?></div>
            <div class="col-md-6 mb-2"><strong>Mobile No:</strong> <?= esc($student['mobile_no']) ?></div>
            <div class="col-md-6 mb-2"><strong>WhatsApp No:</strong> <?= esc($student['whatsapp_no']) ?></div>
            <div class="col-md-6 mb-2"><strong>Personal Email:</strong> <?= esc($student['personal_email']) ?></div>
            <div class="col-md-6 mb-2"><strong>Official Email:</strong> <?= esc($student['official_email']) ?></div>
            <div class="col-md-6 mb-2"><strong>Gender:</strong> <?= esc($student['gender']) ?></div>
            <div class="col-md-6 mb-2"><strong>Date of Birth:</strong> <?= esc($student['date_of_birth']) ?></div>
            <div class="col-md-6 mb-2"><strong>Native Place:</strong> <?= esc($student['native_place']) ?></div>
            <div class="col-md-6 mb-2"><strong>PAN Number:</strong> <?= esc($student['pan_number']) ?></div>
            <div class="col-md-6 mb-2"><strong>Aadhar Number:</strong> <?= esc($student['aadhar_number']) ?></div>
            <div class="col-md-6 mb-2"><strong>APPAR ID:</strong> <?= esc($student['appar_id']) ?></div>
            <div class="col-md-6 mb-2">
              <strong>LinkedIn:</strong>
              <a href="<?= esc($student['linkedin']) ?>" target="_blank" class="text-decoration-none">
                <?= esc($student['linkedin']) ?>
              </a>
            </div>
            <div class="col-md-6 mb-2">
              <strong>GitHub:</strong>
              <a href="<?= esc($student['github']) ?>" target="_blank" class="text-decoration-none">
                <?= esc($student['github']) ?>
              </a>
            </div>

            <!-- Divider -->
            <div class="col-12 mt-3 mb-2">
              <hr>
              <strong class="text-dark">Communication Address</strong>
            </div>

            <!-- Communication Address -->
            <div class="col-md-12 mb-2"><strong>Address:</strong> <?= esc($student['communication_address']) ?></div>
            <div class="col-md-6 mb-2"><strong>State:</strong> <?= esc($student['communication_state']) ?></div>
            <div class="col-md-6 mb-2"><strong>Pincode:</strong> <?= esc($student['communication_pincode']) ?></div>

            <!-- Divider -->
            <div class="col-12 mt-3 mb-2">
              <hr>
              <strong class="text-dark">Permanent Address</strong>
            </div>

            <!-- Permanent Address -->
            <div class="col-md-12 mb-2"><strong>Address:</strong> <?= esc($student['permanent_address']) ?></div>
            <div class="col-md-6 mb-2"><strong>State:</strong> <?= esc($student['permanent_state']) ?></div>
            <div class="col-md-6 mb-2"><strong>Pincode:</strong> <?= esc($student['permanent_pincode']) ?></div>
          </div>
        </div>



        <div id="family-details" class="section-card">
          <h5>Family Details
            <a href="#" data-bs-toggle="modal" data-bs-target="#familyDetailsModal">Add</a>
          </h5>
          <div id="familyDetailsList" class="mt-3"></div>
        </div>
        <div id="experience" class="section-card">
          <h5>Experience Details <a href="#">Add</a></h5>
        </div>

       <div id="skills" class="section-card"> 
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-dark mb-0">Skills</h5>
            <a href="#" data-bs-toggle="modal" data-bs-target="#addSkillModal" class="text-primary fw-semibold">Add</a>
          </div>
          <?php if (!empty($skills)): ?>
            <div class="d-flex flex-wrap gap-2">
              <?php foreach ($skills as $skill): ?>
                <div class="badge rounded-pill bg-light text-dark border d-flex align-items-center" style="font-size: 14px; padding: 10px 14px;">
                  <?= esc($skill['skill_name']) ?>
                  <button type="button"
                          class="btn-close btn-close-sm ms-2"
                          aria-label="Remove"
                          style="font-size: 10px;"
                          data-id="<?= $skill['id'] ?>"
                          data-skill="<?= esc($skill['skill_name']) ?>"
                          data-bs-toggle="modal"
                          data-bs-target="#deleteSkillModal"></button>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p class="text-muted small">You haven't added any skills yet.</p>
          <?php endif; ?>
        </div>
        <div id="education" class="section-card">
          <h5>Education Details <a href="#">Add</a></h5>
        </div>
        <div id="certifications" class="section-card">
          <h5>Licenses & Certifications <a href="#">Add</a></h5>
        </div>
        <div id="projects" class="section-card">
          <h5>Projects & Publications <a href="#">Add</a></h5>
        </div>
        <div id="languages" class="section-card">
          <h5>Languages <a href="#">Add</a></h5>
        </div>
        <?php
        // 🔹 Place this block where you're rendering student dashboard sections
        ?>
        <div id="academic-info" class="section-card">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-dark mb-0">Current Academic Information</h5>
            <a href="#" class="text-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#academicInfoModal">
              <i class="bi bi-pencil-square"></i>
            </a>
          </div>

          <?php if (!empty($academic)): ?>
            <div class="row">
              <div class="col-md-6 mb-2"><strong>Pursuing Degree:</strong> <?= esc($academic['pursuing_degree']) ?></div>
              <div class="col-md-6 mb-2"><strong>Department:</strong> <?= esc($academic['department_name']) ?></div>
              <div class="col-md-6 mb-2"><strong>Year of Joining:</strong> <?= esc($academic['year_of_joining']) ?></div>
              <div class="col-md-6 mb-2"><strong>Type of Entry:</strong> <?= esc($academic['type_of_entry']) ?></div>
              <div class="col-md-6 mb-2"><strong>Mode of Admission:</strong> <?= esc($academic['mode_of_admission']) ?>
              </div>
              <div class="col-md-6 mb-2"><strong>Rank:</strong> <?= esc($academic['entrance_rank']) ?: '—' ?></div>
              <div class="col-12">
                <strong>SGPA/CGPA:</strong>
                <ul class="mb-2">
                  <?php for ($i = 1; $i <= 10; $i++): ?>
                    <?php $sem = 'sem' . $i . '_sgpa_cgpa'; ?>
                    <?php if (!empty($academic[$sem])): ?>
                      <li>Sem <?= $i ?>: <?= esc($academic[$sem]) ?></li>
                    <?php endif; ?>
                  <?php endfor; ?>
                </ul>
              </div>
              <div class="col-md-4 mb-2"><strong>Current Active Backlogs:</strong>
                <?= esc($academic['active_backlogs']) ?></div>
              <div class="col-md-4 mb-2"><strong>Backlog History:</strong> <?= esc($academic['backlog_history']) ?></div>
              <div class="col-md-4 mb-2"><strong>Year Back:</strong> <?= esc($academic['year_back'] ? 'Yes' : 'No') ?>
              </div>
              <div class="col-md-4 mb-2"><strong>Academic Gaps:</strong> <?= esc($academic['academic_gaps']) ?></div>
            </div>
          <?php else: ?>
            <p class="text-muted small">No academic details added yet.</p>
          <?php endif; ?>
        </div>

        <!-- Placement Preferences Section -->
        <div id="preferences" class="section-card">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="fw-bold text-dark mb-0">Placement Preferences</h5>
            <a href="#" data-bs-toggle="modal" data-bs-target="#placementPreferencesModal" class="text-danger">
              <i class="bi bi-pencil-square text-primary"></i>
            </a>
          </div>

          <?php if (!empty($preferences)): ?>
            <div class="row">
              <div class="col-md-6 mb-2"><strong>Interested in Placements:</strong>
                <?= esc($preferences['interested_in_placements'] ? 'Yes' : 'No') ?></div>
              <div class="col-md-6 mb-2"><strong>Preferred Jobs:</strong>
                <?= esc($preferences['preferred_jobs']) ?: '—' ?></div>
              <div class="col-md-6 mb-2"><strong>Interested in Higher Studies:</strong>
                <?= esc($preferences['interested_in_higher_studies'] ? 'Yes' : 'No') ?></div>
              <div class="col-md-6 mb-2"><strong>Placement Coordinator Name:</strong>
                <?= esc($preferences['placement_coordinator_name']) ?></div>
              <div class="col-md-6 mb-2"><strong>Department:</strong> <?= esc($preferences['coordinator_department']) ?>
              </div>
              <div class="col-md-6 mb-2"><strong>Mobile:</strong> <?= esc($preferences['coordinator_mobile']) ?></div>
            </div>
          <?php else: ?>
            <p class="text-muted small">You haven't filled placement preferences yet.</p>
          <?php endif; ?>
        </div>
        <div id="training" class="section-card">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-dark mb-0">Placement Training</h5>
            <i class="bi bi-lock text-muted" title="Only admin can edit this"></i>
          </div>

          <?php if (!empty($training)): ?>
            <div class="row">
              <div class="col-md-6 mb-2"><strong>Training Attendance:</strong>
                <?= esc($training['training_attendance']) ?: '—' ?></div>
              <div class="col-md-6 mb-2"><strong>Training Score:</strong> <?= esc($training['training_score']) ?: '—' ?>
              </div>
              <div class="col-12 mb-2"><strong>PX-Certificates:</strong> <?= esc($training['px_certificates']) ?: '—' ?>
              </div>
            </div>
          <?php else: ?>
            <p class="text-muted">No placement training details available.</p>
          <?php endif; ?>
        </div>

        <div id="offers" class="section-card">
          <h5>Placement Offers <a href="#">Add</a></h5>
        </div>
        <div id="documents" class="section-card">
          <h5>Documents <a href="#">Upload</a></h5>
        </div>
      </div>
    </div>
  </div>

<!-- Modal for profile summary -->
<div class="modal fade" id="profileSummaryModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 16px;">
      <form method="post" action="<?= base_url('/student/update-profile-summary') ?>">
        <div class="modal-header border-0">
          <h5 class="modal-title">Edit Profile Summary <span class="text-success">+8%</span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="text-muted">Give recruiters a brief overview of your career goals, key achievements, and interests.</p>
          <textarea class="form-control" name="summary" rows="6" maxlength="1000" placeholder="Type here..."><?= esc($student['profile_summary']) ?></textarea>
          <div class="text-end small text-muted mt-1">1000 characters max</div>
        </div>
        <div class="modal-footer border-0">
          <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Add Skill Modal -->
<div class="modal fade" id="addSkillModal" tabindex="-1" >
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 16px;">
      <form method="post" id="addSkillForm">
        <div class="modal-header border-0">
          <h5 class="modal-title">Add Skill</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body px-4 pb-3" id="skillFormBody">
          <label for="skillInput" class="form-label fw-semibold">Skill</label>
          <input type="text" id="skillInput" name="skill_name" class="form-control" placeholder="Type a skill..." required>
          <div class="mt-3">
            <p class="mb-1 fw-semibold text-muted">Suggested based on your profile</p>
            <div id="suggestedSkills" class="d-flex flex-wrap gap-2">
              <?php $suggested = ['Python', 'Java', 'HTML', 'CSS', 'JavaScript', 'SQL', 'Machine Learning', 'Communication']; ?>
              <?php foreach ($suggested as $skill): ?>
                <span class="badge bg-light border text-dark px-3 py-2 suggested-skill" style="cursor:pointer;">
                  <?= esc($skill) ?>
                </span>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="text-end mt-4">
            <button type="button" class="btn btn-primary" id="saveSkillBtn">Save</button>
          </div>
        </div>
        <div class="modal-body px-4 text-center d-none" id="successMessage">
          <i class="fa-solid fa-circle-check text-success fs-2 mb-3"></i>
          <h6 class="text-success">Skill added successfully</h6>
          <div class="d-flex justify-content-center gap-3 mt-3">
            <button type="button" class="btn btn-outline-primary btn-sm" id="addMoreSkillBtn">+ Add more</button>
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No Thanks</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Skill Modal -->
<div class="modal fade" id="deleteSkillModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal">
      <form id="deleteSkillForm">
        <input type="hidden" name="skill_id" id="deleteSkillId">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title">Delete Skill</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center pt-2">
          <p>Are you sure you want to delete <strong id="skillNameLabel">this skill?</strong></p>
        </div>
        <div class="modal-footer border-0 justify-content-center pt-1">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteSkill">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Academic Info Modal -->
<div class="modal fade" id="academicInfoModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 16px;">
      <form method="post" action="<?= base_url('/student/update-academic-info') ?>">
        <div class="modal-header border-0">
          <h5 class="modal-title">Edit Academic Information</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3 px-4">
          <div class="col-md-6">
            <label>Pursuing Degree</label>
            <select name="pursuing_degree" class="form-control" required>
              <?php foreach ($pursuingDegrees as $deg): ?>
                <option value="<?= $deg ?>" <?= isset($academic['pursuing_degree']) && $academic['pursuing_degree'] == $deg ? 'selected' : '' ?>><?= $deg ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6">
            <label>Department</label>
            <select name="department_id" class="form-control" required>
              <?php foreach ($departments as $dept): ?>
                <option value="<?= $dept['id'] ?>" <?= isset($academic['department_id']) && $academic['department_id'] == $dept['id'] ? 'selected' : '' ?>>
                  <?= esc($dept['department_name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6">
            <label>Year of Joining</label>
            <input type="number" name="year_of_joining" class="form-control" value="<?= isset($academic['year_of_joining']) ? esc($academic['year_of_joining']) : '' ?>">
          </div>

          <div class="col-md-6">
            <label>Type of Entry</label>
            <select name="type_of_entry" class="form-control">
              <?php foreach ($entryTypes as $type): ?>
                <option value="<?= $type ?>" <?= isset($academic['type_of_entry']) && $academic['type_of_entry'] == $type ? 'selected' : '' ?>><?= $type ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6">
            <label>Mode of Admission</label>
            <select name="mode_of_admission" class="form-control">
              <?php foreach ($admissionModes as $mode): ?>
                <option value="<?= $mode ?>" <?= isset($academic['mode_of_admission']) && $academic['mode_of_admission'] == $mode ? 'selected' : '' ?>><?= $mode ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6">
            <label>Entrance Rank (Optional)</label>
            <input type="text" name="entrance_rank" class="form-control" value="<?= isset($academic['entrance_rank']) ? esc($academic['entrance_rank']) : '' ?>">
          </div>

          <?php for ($i = 1; $i <= 10; $i++): ?>
            <div class="col-md-6">
              <label>Semester <?= $i ?> SGPA/CGPA</label>
              <input type="text" name="sem<?= $i ?>_sgpa_cgpa" class="form-control" value="<?= isset($academic['sem' . $i . '_sgpa_cgpa']) ? esc($academic['sem' . $i . '_sgpa_cgpa']) : '' ?>">
            </div>
          <?php endfor; ?>

          <div class="col-md-6">
            <label>Current Active Backlogs</label>
            <input type="number" name="active_backlogs" class="form-control" value="<?= isset($academic['active_backlogs']) ? esc($academic['active_backlogs']) : '' ?>">
          </div>

          <div class="col-md-6">
            <label>Backlog History</label>
            <input type="number" name="backlog_history" class="form-control" value="<?= isset($academic['backlog_history']) ? esc($academic['backlog_history']) : '' ?>">
          </div>

          <div class="col-md-6">
            <label>Year Back</label>
            <select name="year_back" class="form-control">
              <?php foreach ($yesNoOptions as $opt): ?>
                <option value="<?= $opt ?>" <?= isset($academic['year_back']) && $academic['year_back'] == $opt ? 'selected' : '' ?>><?= $opt ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6">
            <label>Academic Gaps (Before/During Degree)</label>
            <input type="number" name="academic_gaps" class="form-control" value="<?= isset($academic['academic_gaps']) ? esc($academic['academic_gaps']) : '' ?>">
          </div>

        </div>

        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Placement Preferences Modal -->
<div class="modal fade" id="placementPreferencesModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form method="post" action="<?= base_url('/student/update-placement-preferences') ?>">
        <div class="modal-header border-0">
          <h5 class="modal-title">Edit Placement Preferences</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3 px-4">
          <div class="col-md-6">
            <label>Interested in Placements</label>
            <select name="interested_in_placements" class="form-control" required>
              <?php foreach ($yesNoOptions as $opt): ?>
                <option value="<?= $opt ?>" <?= isset($preferences['interested_in_placements']) && ($preferences['interested_in_placements'] ? 'Yes' : 'No') == $opt ? 'selected' : '' ?>><?= $opt ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6">
            <label>Preferred Jobs</label>
            <input type="text" name="preferred_jobs" class="form-control" value="<?= esc($preferences['preferred_jobs'] ?? '') ?>">
          </div>

          <div class="col-md-6">
            <label>Interested in Higher Studies</label>
            <select name="interested_in_higher_studies" class="form-control" required>
              <?php foreach ($yesNoOptions as $opt): ?>
                <option value="<?= $opt ?>" <?= isset($preferences['interested_in_higher_studies']) && ($preferences['interested_in_higher_studies'] ? 'Yes' : 'No') == $opt ? 'selected' : '' ?>><?= $opt ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6">
            <label>Placement Coordinator Name <small class="text-muted">(Not editable)</small></label>
            <input type="text" class="form-control" value="<?= esc($preferences['placement_coordinator_name'] ?? '') ?>" disabled>
          </div>

          <div class="col-md-6">
            <label>Coordinator Department <small class="text-muted">(Not editable)</small></label>
            <input type="text" class="form-control" value="<?= esc($preferences['coordinator_department'] ?? '') ?>" disabled>
          </div>

          <div class="col-md-6">
            <label>Coordinator Mobile <small class="text-muted">(Not editable)</small></label>
            <input type="text" class="form-control" value="<?= esc($preferences['coordinator_mobile'] ?? '') ?>" disabled>
          </div>
        </div>

        <div class="modal-footer border-0">
          <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal for personal info -->
<div class="modal fade" id="personalInfoModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form method="post" action="<?= base_url('/student/update-personal-info') ?>">
        <div class="modal-header border-0">
          <h5 class="modal-title">Edit Personal Information</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3">
          <!-- Personal Info -->
          <div class="col-md-6">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control" value="<?= esc($student['full_name']) ?>" required>
          </div>
          <div class="col-md-6">
            <label>Mobile No</label>
            <input type="text" name="mobile_no" class="form-control" value="<?= esc($student['mobile_no']) ?>">
          </div>
          <div class="col-md-6">
            <label>WhatsApp No</label>
            <input type="text" name="whatsapp_no" class="form-control" value="<?= esc($student['whatsapp_no']) ?>">
          </div>
          <div class="col-md-6">
            <label>Personal Email</label>
            <input type="email" name="personal_email" class="form-control" value="<?= esc($student['personal_email']) ?>">
          </div>
          <div class="col-md-6">
            <label>Official Email</label>
            <input type="email" name="official_email" class="form-control" value="<?= esc($student['official_email']) ?>">
          </div>
          <div class="col-md-6">
            <label>Gender</label>
            <select name="gender" class="form-control">
              <option value="Male" <?= $student['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
              <option value="Female" <?= $student['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
              <option value="Other" <?= $student['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
          </div>
          <div class="col-md-6">
            <label>Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" value="<?= esc($student['date_of_birth']) ?>">
          </div>
          <div class="col-md-6">
            <label>Native Place</label>
            <input type="text" name="native_place" class="form-control" value="<?= esc($student['native_place']) ?>">
          </div>
          <div class="col-md-6">
            <label>PAN Number</label>
            <input type="text" name="pan_number" class="form-coVntrol" value="<?= esc($student['pan_number']) ?>">
          </div>
          <div class="col-md-6">
            <label>Aadhar Number</label>
            <input type="text" name="aadhar_number" class="form-control" value="<?= esc($student['aadhar_number']) ?>">
          </div>
          <div class="col-md-6">
            <label>APPAR ID</label>
            <input type="text" name="appar_id" class="form-control" value="<?= esc($student['appar_id']) ?>">
          </div>
          <div class="col-md-6">
            <label>LinkedIn</label>
            <input type="url" name="linkedin" class="form-control" value="<?= esc($student['linkedin']) ?>">
          </div>
          <div class="col-md-6">
            <label>GitHub</label>
            <input type="url" name="github" class="form-control" value="<?= esc($student['github']) ?>">
          </div>

  <!-- Communication Address Fields -->
          <div class="col-md-12">
            <label>Communication Address</label>
            <input type="text" id="communicationAddress" name="communication_address" class="form-control" value="<?= esc($student['communication_address']) ?>">
          </div>
          <div class="col-md-6">
            <label>State</label>
            <?= (new \App\Libraries\GlobalData())->renderStateDropdown('communication_state', $student['communication_state']) ?>
          </div>

          <div class="col-md-6">
            <label>Pincode</label>
            <input type="text" id="communicationPincode" name="communication_pincode" class="form-control" value="<?= esc($student['communication_pincode']) ?>">
          </div>

          <!-- Permanent Address Header + Checkbox in same row -->
          <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
              <label for="permanentAddress">Permanent Address</label>
              <div class="d-flex align-items-center" style="gap: 6px;">
                <input type="checkbox" id="sameAsComm" style="width: 12px; height: 12px; margin-top: 2px;" />
                <label for="sameAsComm" class="mb-0 text-muted" style="font-size: 13px;">Same as Communication Address</label>
              </div>
            </div>
            <input type="text" id="permanentAddress" name="permanent_address" class="form-control mt-2" value="<?= esc($student['permanent_address']) ?>">
          </div>
          <div class="col-md-6">
            <label>State</label>
            <?= (new \App\Libraries\GlobalData())->renderStateDropdown('permanent_state', $student['permanent_state']) ?>
          </div>

          <div class="col-md-6">
            <label>Pincode</label>
            <input type="text" id="permanentPincode" name="permanent_pincode" class="form-control" value="<?= esc($student['permanent_pincode']) ?>">
          </div>

        <div class="modal-footer border-0">
          <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- Family Details Modal -->
<div class="modal fade" id="familyDetailsModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 16px;">
      <div class="modal-header border-0">
        <h5 class="modal-title">Family Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Add details of your family members below.</p>
        <form id="familyForm">
          <div id="familyInputs">
            <div class="row g-3 family-entry mb-3">
              <div class="col-md-4">
                <label class="form-label">Relation</label>
                <select class="form-select" name="relation[]">
                  <option value="">Select</option>
                  <?php foreach ($relationTypes as $relation): ?>
                    <option value="<?= esc($relation) ?>"><?= esc($relation) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name[]" placeholder="Full Name">
              </div>
              <div class="col-md-4">
                <label class="form-label">Occupation</label>
                <input type="text" class="form-control" name="occupation[]" placeholder="Occupation">
              </div>
              <div class="col-md-4">
                <label class="form-label">Contact</label>
                <input type="text" class="form-control" name="contact[]" placeholder="Contact Number">
              </div>
              <div class="col-md-4">
                <label class="form-label">Mobile</label>
                <input type="text" class="form-control" name="mobile[]" placeholder="Mobile Number">
              </div>
              <div class="col-md-4">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email[]" placeholder="Email ID">
              </div>
              <div class="col-md-4">
                <label class="form-label">Salary</label>
                <input type="text" class="form-control" name="salary[]" placeholder="Salary">
              </div>
            </div>
          </div>

          <div class="text-end">
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addFamilyEntry()">+ Add More</button>
          </div>
        </form>
      </div>
      <div class="modal-footer border-0">
        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<!-- Before </body> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const allSkills = [
    "Python", "Java", "SQL", "C++", "HTML", "CSS", "JavaScript",
    "React", "Node.js", "PHP", "MySQL", "MongoDB", "Git", "Figma"
  ];

  const skillInput = document.getElementById("skillInput");
  const suggestedSkills = document.getElementById("suggestedSkills");
  const formContainer = document.getElementById("skillFormBody");
  const successView = document.getElementById("successMessage");
  const saveBtn = document.getElementById("saveSkillBtn");
  const addMoreBtn = document.getElementById("addMoreSkillBtn");

  function displaySkills(skills) {
    suggestedSkills.innerHTML = "";
    skills.forEach(skill => {
      const badge = document.createElement("span");
      badge.className = "badge bg-light border text-dark px-3 py-2 rounded-pill suggested-skill";
      badge.style.cursor = "pointer";
      badge.innerText = skill;
      badge.onclick = () => {
        skillInput.value = skill;
      };
      suggestedSkills.appendChild(badge);
    });
  }

  function filterSkills() {
    const keyword = skillInput.value.toLowerCase();
    const filtered = allSkills.filter(skill => skill.toLowerCase().includes(keyword));
    displaySkills(filtered);
  }

  skillInput.addEventListener('keyup', filterSkills);
  displaySkills(allSkills);

  saveBtn.addEventListener('click', function () {
    const skillName = skillInput.value.trim();
    if (!skillName) return;

    fetch('/student/add-skill', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ skill_name: skillName })
    })
    .then(res => res.ok ? res.text() : Promise.reject())
  .then(() => {
  formContainer.classList.add('d-none');
  successView.classList.remove('d-none');

  const skillContainer = document.querySelector("#skills .d-flex.flex-wrap");
  if (skillContainer) {
    const newSkill = document.createElement("div");
    newSkill.className = "badge rounded-pill bg-light text-dark border d-flex align-items-center";
    newSkill.style.fontSize = "14px";
    newSkill.style.padding = "10px 14px";
    newSkill.innerHTML = `
      ${skillName}
      <button type="button"
              class="btn-close btn-close-sm ms-2"
              aria-label="Remove"
              style="font-size: 10px;"
              data-id="TEMP"
              data-skill="${skillName}"
              data-bs-toggle="modal"
              data-bs-target="#deleteSkillModal"></button>
    `;
    skillContainer.appendChild(newSkill);
  }

  skillInput.value = '';
  filterSkills();

  // ✅ Close the modal after success
  const modal = bootstrap.Modal.getInstance(document.getElementById('addSkillModal'));
  modal?.hide();
})

    .catch(() => alert('Failed to add skill'));
  });

  addMoreBtn.addEventListener('click', function () {
    skillInput.value = '';
    formContainer.classList.remove('d-none');
    successView.classList.add('d-none');
    filterSkills();
  });

  document.getElementById("addSkillModal").addEventListener("hidden.bs.modal", function () {
    skillInput.value = '';
    formContainer.classList.remove('d-none');
    successView.classList.add('d-none');
    filterSkills();
  });

  // Delete Skill Logic
  const deleteInput = document.getElementById('deleteSkillId');
  const skillNameLabel = document.getElementById('skillNameLabel');

  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-close');
    if (btn && btn.dataset.skill) {
      deleteInput.value = btn.dataset.id;
      skillNameLabel.textContent = btn.dataset.skill;
    }
  });

  const confirmBtn = document.getElementById('confirmDeleteSkill');
  if (confirmBtn) {
    confirmBtn.addEventListener('click', function () {
      const skillId = deleteInput.value;
      fetch("/student/delete-skill", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'skill_id=' + encodeURIComponent(skillId)
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          bootstrap.Modal.getInstance(document.getElementById('deleteSkillModal')).hide();
          const skillItem = document.querySelector(`.btn-close[data-id="${skillId}"]`)?.parentElement;
          if (skillItem) skillItem.remove();
        } else {
          alert('Error deleting skill');
        }
      })
      .catch(() => alert('Error connecting to server'));
    });
  }
});
</script>

<!-- JavaScript for checkbox -->
<script>
  document.getElementById("sameAsComm").addEventListener("change", function () {
    const isChecked = this.checked;

    const commAddress = document.getElementById("communicationAddress").value;
    const commState = document.getElementById("communicationState").value;
    const commPincode = document.getElementById("communicationPincode").value;

    document.getElementById("permanentAddress").value = isChecked ? commAddress : '';
    document.getElementById("permanentState").value = isChecked ? commState : '';
    document.getElementById("permanentPincode").value = isChecked ? commPincode : '';
  });
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('sameAsComm');
    const commAddress = document.getElementById('communicationAddress');
    const commState = document.getElementById('communication_state');
    const commPincode = document.getElementById('communicationPincode');

    const permAddress = document.getElementById('permanentAddress');
    const permState = document.getElementById('permanent_state');
    const permPincode = document.getElementById('permanentPincode');

    checkbox.addEventListener('change', function () {
        if (this.checked) {
            permAddress.value = commAddress.value;
            permState.value = commState.value;
            permPincode.value = commPincode.value;
        } else {
            permAddress.value = '';
            permState.value = '';
            permPincode.value = '';
        }
    });
});
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const $rightSidebar = document.getElementsByClassName('right-sidebar')[0];
    const $chatPanel = document.getElementsByClassName('chat-panel')[0];

    if ($rightSidebar && $chatPanel) {
      document.addEventListener('click', function (event) {
        const isInsideContainer =
          $rightSidebar.contains(event.target) || $chatPanel.contains(event.target);

        if (!isInsideContainer) {
          document.body.classList.remove('right-sidebar-expand');

          const toggle = document.getElementsByClassName('right-sidebar-toggle');
          for (let i = 0; i < toggle.length; i++) {
            toggle[i].classList.remove('active');
          }

          $chatPanel.hidden = 'hidden';
        }
      });
    }
  });
</script>


<?= $this->endSection() ?>