<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Profile </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f5f7;
      font-family: 'Segoe UI', sans-serif;
    }
    .container-custom {
      max-width: 1240px;
      margin: 30px auto;
    }
    .profile-card {
      background: #fff;
      padding: 20px 24px;
      border-radius: 16px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 30px;
    }
    .profile-info {
      display: flex;
      gap: 24px;
      align-items: flex-start;
      width: 100%;
    }
    .profile-photo-wrapper {
      position: relative;
      width: 140px;
      height: 160px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .profile-photo {
      position: absolute;
      top: 10px;
      left: 10px;
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background-color: #ccc;
      background-size: cover;
      background-position: center;
      border: 4px solid #fff;
      box-shadow: 0 0 6px rgba(0, 0, 0, 0.08);
     }
    .progress-ring {
      position: relative;
      width: 140px;
      height: 140px;
    }

    .circle {
      transform: rotate(-90deg);
    }

    .circle .bg {
      fill: none;
      stroke: #e6e6e6;
      stroke-width: 8;
    }
    .circle .fg {
      fill: none;
      stroke: #198754; /* green */
      stroke-width: 8;
      transition: stroke-dashoffset 0.6s ease;
    }

    .progress-ring svg {
      position: absolute;
      top: 0;
      left: 0;
      transform: rotate(90deg);
    }

    .progress-label {
      font-size: 14px;
      font-weight: bold;
      color: #198754;
      margin-top: 8px;
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
        width: 470px;
        background: #fff4ef;
        border-radius: 12px;
        padding: 16px 18px;
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-height: 200px; /* Fixed height */
    }

    .prompt-box h6 {
      font-size: 15px;
      font-weight: 600;
      margin-bottom: 6px;
      color: #d32f2f;
    }
    .prompt-box li {
      font-size: 14px;
      margin-bottom: 8px;
      line-height: 1.4;
      display: flex;
      align-items: center;
      gap: 6px;

    }
    .prompt-box .btn {
      background: #f43f20;
      color: #fff;
      border-radius: 18px;
      padding: 6px 18px;
      font-size: 14px;
      font-weight:500;
      width: fit-content;
      align-self: center;
      margin-top: auto;
    }

    .scrollable-list {
      max-height: 100px;
      overflow-y: auto;
      padding-right: 6px;
      scrollbar-width: thin;
      scrollbar-color: #d1d1d1 transparent;
    }

    /* 🔹 For WebKit (Chrome, Edge, etc.) */
    .scrollable-list::-webkit-scrollbar {
      width: 4px;
    }
    .scrollable-list::-webkit-scrollbar-track {
      background: transparent;
    }
    .scrollable-list::-webkit-scrollbar-thumb {
      background-color: #c4c4c4;
      border-radius: 4px;
    }

    /* ❌ No up/down arrows */
    .scrollable-list::-webkit-scrollbar-button {
      display: none;
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
  .section-card p, .section-card div {
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
.info-row {
  display: flex;
  align-items: center;
  font-size: 14px;
  color: #333;
}

.info-row i {
  width: 18px;
  text-align: center;
  color: #444;
}
 .profile-divider {
  border: none;
  height: 1px;
  background-color: #e3e3e3;
  max-width: 650px;
  margin: 12px 0 18px 0;
}

.border-start {
  border-left: 1px solid #e0e0e0 !important;
}
</style>
</head>
<body>
  <?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<div class="container-custom">
  <!-- Top Full Width Profile Card -->
  <div class="profile-card">
  <div class="profile-info">
    <div class="profile-photo-wrapper">

      <!-- Green ring with photo inside -->
      <div class="progress-ring">
        <svg class="circle" width="140" height="140">
          <circle class="bg" cx="70" cy="70" r="60"></circle>
          <circle class="fg" cx="70" cy="70" r="60"
            stroke-dasharray="377"
            stroke-dashoffset="<?= 377 * (1 - intval($completionPercentage)/100) ?>">
          </circle>
        </svg>

        <!-- Profile photo sits centered in ring -->
        <div class="profile-photo" style="background-image: url('<?= $student['profile_photo'] ?? '' ?>');"></div>
      </div>

      <!-- Percentage label below -->
      <div class="progress-label">
        <?= esc($completionPercentage) ?>
      </div>

    </div>


      <div class="details w-100">
        <!-- Name + ID -->
        <div class="d-flex justify-content-between align-items-center flex-wrap">
          <h5 class="mb-1">
            <?= esc($student['full_name']) ?>
            <i class="fa fa-pen edit icon ms-2"></i>
          </h5>
        </div>

        <!-- Last updated -->
        <small class="text-muted d-block mb-3">
          Profile last updated –
          <?= !empty($student['updated_on']) ? date('d M, Y', strtotime($student['updated_on'])) : 'Not yet updated' ?>
        </small>

        <hr class="profile-divider" >


        <!-- Two-column layout -->
        <div class="row">
          <!-- LEFT -->
          <div class="col-md-6">
            <div class="info-row mb-2">
              <i class="fa fa-mobile-screen-button me-2"></i>
              <span><?= esc($student['mobile_no'] ?? 'Not added') ?></span>
            </div>

            <div class="info-row mb-2">
              <i class="fa fa-envelope me-2"></i>
              <span><?= esc($student['official_email'] ?? 'Email not added') ?></span>
              <i class="fa fa-circle-check text-success ms-2"></i>
            </div>

            <div class="info-row mb-2">
              <i class="fa fa-id-badge me-2"></i>
              <span><?= esc($student['appar_id'] ?? 'Roll No not added') ?></span>
            </div>
          </div>

          <!-- RIGHT -->
          <div class="col-md-6 border-start ps-4">
            <div class="info-row mb-2">
              <i class="fa fa-link me-2"></i>
               <?php if (!empty($student['linkedin'])): ?>
                <a href="<?= esc($student['linkedin']) ?>" target="_blank">LinkedIn</a>
               <?php else: ?>
                <span class="text-muted">LinkedIn</span>
               <?php endif; ?>
            </div>

            <div class="info-row mb-2">
              <i class="fa fa-laptop-code me-2"></i>
              <?php if (!empty($student['github'])): ?>
                <a href="<?= esc($student['github']) ?>" target="_blank">GitHub</a>
               <?php else: ?>
                <span class="text-muted">GitHub</span>
               <?php endif; ?>  
            </div>

             <div class="info-row mb-2">
              <i class="fa fa-file-lines me-2"></i>
              <?php if (!empty($student['resume_url'])): ?>
                <a href="<?= esc($student['resume_url']) ?>" download target="_blank">Resume Download</a>
              <?php else: ?>
                <span class="text-muted">Resume not uploaded</span>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>


    </div>

    

    <!-- Missing prompts box -->  
  <?php if (!empty($incompleteSections)): ?>
  <div class="prompt-box">

    <!-- Scrollable list without any border, arrows, or box -->
    <ul class="scrollable-list ps-3 mb-2">
      <?php foreach ($incompleteSections as $section): ?>
        <li>
          <?= esc($section['name']) ?>
          <span class="text-success">+<?= $section['percent'] ?>%</span>
        </li>
      <?php endforeach; ?>
    </ul>

    <!-- Fixed button -->
    <button class="btn btn-danger">
      Add <?= count($incompleteSections) ?> missing detail<?= count($incompleteSections) > 1 ? 's' : '' ?>
    </button>

  </div>
<?php endif; ?>


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
          <span class="edit icon" tabindex="0" data-bs-toggle="modal" data-bs-target="#profileSummaryModal" title="Edit Summary">
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
      
      <!-- Family Details Section -->
      <div id="family-details" class="section-card">
        <h5>
          Family Details
          <a href="#" data-bs-toggle="modal" data-bs-target="#familyDetailsModal">Add</a>
        </h5>

        <div class="mt-3">
          <?php if (!empty($familyDetails)): ?>
            <?php foreach ($familyDetails as $detail): ?>
              <div class="border p-3 mb-3 rounded bg-light">
                <div class="row">
                  <div class="col-md-4"><strong>Relation:</strong> <?= esc($detail['relation']) ?></div>
                  <div class="col-md-4"><strong>Name:</strong> <?= esc($detail['name']) ?></div>
                  <div class="col-md-4"><strong>Occupation:</strong> <?= esc($detail['occupation']) ?></div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-4"><strong>Contact:</strong> <?= esc($detail['contact']) ?></div>
                  <div class="col-md-4"><strong>Mobile:</strong> <?= esc($detail['mobile']) ?></div>
                  <div class="col-md-4"><strong>Email:</strong> <?= esc($detail['email']) ?></div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-4"><strong>Salary:</strong> ₹<?= esc(number_format((float)$detail['salary'], 2)) ?></div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No family details added yet.</p>
          <?php endif; ?>
        </div>
      </div>
      <!-- Experience Details Section -->
      <div id="experience-details" class="section-card">
        <h5>Experience Details 
          <a href="#" data-bs-toggle="modal" data-bs-target="#experienceDetailsModal">Add</a>
        </h5>
        <div id="experienceDetailsList" class="mt-3"></div>
      </div>
      <div id="education-details" class="section-card">
        <h5>
          Education Details 
          <a href="#" data-bs-toggle="modal" data-bs-target="#educationDetailsModal">Add</a>
        </h5>
        <div id="educationDetailsList" class="mt-3"></div>
      </div>
      
      <div id="skills" class="section-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="fw-bold text-dark mb-0">Skills</h5>
          <a href="#" data-bs-toggle="modal" data-bs-target="#addSkillModal" class="text-primary fw-semibold">Add</a>
        </div>
        <?php if (!empty($skills)): ?>
          <div class="list-group">
            <?php foreach ($skills as $skill): ?>
              <div class="list-group-item d-flex justify-content-between align-items-center rounded mb-2" style="background: #f9f9f9;">
                <span class="text-dark"><?= esc($skill['skill_name']) ?></span>
                <button 
                  class="btn btn-sm text-danger deleteSkillBtn" 
                  data-id="<?= $skill['id'] ?>" 
                  data-skill="<?= esc($skill['skill_name']) ?>"
                  data-bs-toggle="modal" 
                  data-bs-target="#deleteSkillModal">
                  <i class="bi bi-trash"></i>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="text-muted small">You haven't added any skills yet.</p>
        <?php endif; ?>
      </div>
      <div id="certifications" class="section-card">
        <h5>
          Licenses & Certifications 
          <a href="#" data-bs-toggle="modal" data-bs-target="#licenseModal">Add</a>
        </h5>
      </div>
      <div id="projects-publications" class="section-card">
        <h5>
          Projects & Publications 
          <a href="#" data-bs-toggle="modal" data-bs-target="#projectsModal">Add</a>
        </h5>
        <div id="projectList" class="mt-3">
          <!-- Project/Publication cards will be appended here -->
        </div>
      </div>
      <div id="languages" class="section-card"><h5>Languages <a href="#">Add</a></h5></div>
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
              <div class="col-md-6 mb-2"><strong>Mode of Admission:</strong> <?= esc($academic['mode_of_admission']) ?></div>
              <div class="col-md-6 mb-2"><strong>Rank:</strong> <?= esc($academic['entrance_rank']) ?: '—' ?></div>
              <div class="col-12">
                <strong>SGPA/CGPA:</strong>
                <ul class="mb-2">
                  <?php for ($i = 1; $i <= 10; $i++): ?>
                    <?php $sem = 'sem'.$i.'_sgpa_cgpa'; ?>
                    <?php if (!empty($academic[$sem])): ?>
                      <li>Sem <?= $i ?>: <?= esc($academic[$sem]) ?></li>
                    <?php endif; ?>
                  <?php endfor; ?>
                </ul>
              </div>
              <div class="col-md-4 mb-2"><strong>Current Active Backlogs:</strong> <?= esc($academic['active_backlogs']) ?></div>
              <div class="col-md-4 mb-2"><strong>Backlog History:</strong> <?= esc($academic['backlog_history']) ?></div>
              <div class="col-md-4 mb-2"><strong>Year Back:</strong> <?= esc($academic['year_back'] ? 'Yes' : 'No') ?></div>
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
            <div class="col-md-6 mb-2"><strong>Interested in Placements:</strong> <?= esc($preferences['interested_in_placements'] ? 'Yes' : 'No') ?></div>
            <div class="col-md-6 mb-2"><strong>Preferred Jobs:</strong> <?= esc($preferences['preferred_jobs']) ?: '—' ?></div>
            <div class="col-md-6 mb-2"><strong>Interested in Higher Studies:</strong> <?= esc($preferences['interested_in_higher_studies'] ? 'Yes' : 'No') ?></div>
            <div class="col-md-6 mb-2"><strong>Placement Coordinator Name:</strong> <?= esc($preferences['placement_coordinator_name']) ?></div>
            <div class="col-md-6 mb-2"><strong>Department:</strong> <?= esc($preferences['coordinator_department']) ?></div>
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
            <div class="col-md-6 mb-2"><strong>Training Attendance:</strong> <?= esc($training['training_attendance']) ?: '—' ?></div>
            <div class="col-md-6 mb-2"><strong>Training Score:</strong> <?= esc($training['training_score']) ?: '—' ?></div>
            <div class="col-12 mb-2"><strong>PX-Certificates:</strong> <?= esc($training['px_certificates']) ?: '—' ?></div>
          </div>
        <?php else: ?>
          <p class="text-muted">No placement training details available.</p>
        <?php endif; ?>
      </div>

      <div id="offers" class="section-card"><h5>Placement Offers <a href="#">Add</a></h5></div>
      <div id="documents" class="section-card">
        <h5>Documents 
          <a href="#" data-bs-toggle="modal" data-bs-target="#documentUploadModal">Upload</a>
        </h5>
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
<div class="modal fade" id="addSkillModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-md">
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
    <div class="modal-content" style="border-radius: 16px;">
      <form id="deleteSkillForm">
        <input type="hidden" name="skill_id" id="deleteSkillId">
        <div class="modal-header border-0">
          <h5 class="modal-title">Delete Skill</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <p class="mb-0">Are you sure you want to delete <strong id="skillNameLabel">this skill?</strong></p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
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
<!-- Experience Details Modal -->
<div class="modal fade" id="experienceDetailsModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 16px;">
      <div class="modal-header border-0">
        <h5 class="modal-title">Experience Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Add your work experience below.</p>
        
        <!-- Experience List -->
        <div id="experienceDetailsList" class="mb-3">
          <!-- Appended entries will appear here -->
        </div>

        <!-- Experience Form -->
        <form id="experienceForm">
          <div class="row mb-3">
            <div class="col-md-4">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" id="expTitle" placeholder="Job Title">
            </div>
            <div class="col-md-4">
              <label class="form-label">Employment Type</label>
              <select class="form-select" id="employmentType">
                <option selected disabled>Select</option>
                <option>Full-time</option>
                <option>Part-time</option>
                <option>Self-Employed</option>
                <option>Freelance</option>
                <option>Internship</option>
                <option>Trainee</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Company / Organisation</label>
              <input type="text" class="form-control" id="company" placeholder="Company Name">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4">
              <label class="form-label">Joining Date</label>
              <input type="month" class="form-control" id="joiningDate">
            </div>
            <div class="col-md-4">
              <label class="form-label d-block">Currently Working?</label>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="currentlyWorking">
                <label class="form-check-label" for="currentlyWorking">I am currently working in this role</label>
              </div>
            </div>
            <div class="col-md-4">
              <label class="form-label">Worked Till</label>
              <input type="month" class="form-control" id="workedTill">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4">
              <label class="form-label">Location</label>
              <input type="text" class="form-control" id="location" placeholder="Location">
            </div>
            <div class="col-md-4">
              <label class="form-label">Location Type</label>
              <select class="form-select" id="locationType">
                <option selected disabled>Select</option>
                <option>On-site</option>
                <option>Hybrid</option>
                <option>Remote</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Remarks</label>
              <input type="text" class="form-control" id="remarks" placeholder="Optional notes">
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="saveExperienceBtn">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Education Details Modal -->
<div class="modal fade" id="educationDetailsModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 16px;">
      <div class="modal-header border-0">
        <h5 class="modal-title">Education Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Add your educational qualifications below.</p>
        <div id="educationDetailsList" class="mb-3">
          <!-- Entries will be added here -->
        </div>

        <form id="educationForm">
          <div class="row mb-3">
            <div class="col-md-4">
              <label class="form-label">Qualification Type</label>
              <select class="form-select" id="qualificationType">
                <option selected disabled>Select</option>
                <option value="X / SSC">X / SSC</option>
                <option value="XII / PUC">XII / PUC</option>
                <option value="Diploma">Diploma</option>
                <option value="Graduation">Graduation</option>
                <option value="Post Graduation">Post Graduation</option>
                <option value="Ph.D">Ph.D</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Institution Name</label>
              <input type="text" class="form-control" id="institutionName" placeholder="Institution Name">
            </div>
            <div class="col-md-4">
              <label class="form-label">Board / University</label>
              <input type="text" class="form-control" id="board" placeholder="Board / University">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4">
              <label class="form-label">Course / Specialization</label>
              <input type="text" class="form-control" id="course" placeholder="Course or Specialization">
            </div>
            <div class="col-md-4">
              <label class="form-label">Course Type</label>
              <select class="form-select" id="courseType">
                <option selected disabled>Select</option>
                <option value="Full Time">Full Time</option>
                <option value="Part Time">Part Time</option>
                <option value="Correspondence">Correspondence</option>
                <option value="Distance Learning">Distance Learning</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Year of Passing</label>
              <input type="text" class="form-control" id="yearOfPassing" placeholder="Year of Passing">
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-4">
              <label class="form-label">Grade / Percentage</label>
              <input type="text" class="form-control" id="grade" placeholder="Grade or Percentage">
            </div>
            <div class="col-md-4">
              <label class="form-label">Result Status</label>
              <select class="form-select" id="resultStatus">
                <option selected disabled>Select</option>
                <option value="Passed">Passed</option>
                <option value="Pursuing">Pursuing</option>
                <option value="Waiting for Results">Waiting for Results</option>
              </select>
            </div>
            <div class="col-md-4 d-flex align-items-end justify-content-end">
              <button type="button" class="btn btn-link">+ Add More</button>
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="saveEducationBtn">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Licenses & Certifications Modal -->
<div class="modal fade" id="licenseModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 16px;">
      <div class="modal-header border-0">
        <h5 class="modal-title">Licenses & Certifications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Add details of your licenses or certifications below.</p>
        <div id="licenseList" class="mb-3">
          <!-- Entries will be added here -->
        </div>
        <form id="licenseForm">
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Name of the Licence / Certificate *</label>
              <input type="text" class="form-control" id="licenseName" placeholder="e.g., AWS Certified Developer">
            </div>
            <div class="col-md-6">
              <label class="form-label">Issuing Organization *</label>
              <input type="text" class="form-control" id="issuingOrg" placeholder="e.g., Amazon Web Services">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Issue Date (Month & Year) *</label>
              <input type="month" class="form-control" id="issueDate">
            </div>
            <div class="col-md-6">
              <label class="form-label">Expiry Date (Month & Year)</label>
              <input type="month" class="form-control" id="expiryDate">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">ID / Number</label>
              <input type="text" class="form-control" id="licenseId" placeholder="License ID or Certificate Number">
            </div>
            <div class="col-md-6">
              <label class="form-label">URL</label>
              <input type="url" class="form-control" id="licenseUrl" placeholder="Optional URL to verify">
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="saveLicenseBtn">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Projects & Publications Modal -->
<div class="modal fade" id="projectsModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 16px;">
      <div class="modal-header border-0">
        <h5 class="modal-title">Projects & Publications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p class="text-muted">Add your project or publication details below.</p>

        <!-- Appended List -->
        <div id="projectList" class="mb-4">
          <!-- Entries will appear here -->
        </div>

        <form id="projectForm">
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" id="title" placeholder="Enter title">
            </div>
            <div class="col-md-6">
              <label class="form-label d-block">Type</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="type" id="projectType" value="Project">
                  <label class="form-check-label" for="projectType">Project</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="type" id="publicationType" value="Publication">
                  <label class="form-check-label" for="publicationType">Publication</label>
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Publisher</label>
              <input type="text" class="form-control" id="publisher" placeholder="Publisher">
            </div>
            <div class="col-md-6">
              <label class="form-label">Completion Date</label>
              <input type="date" class="form-control" id="completionDate">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Authors / Co-Authors</label>
            <input type="text" class="form-control" id="authors" placeholder="Enter names separated by commas">
          </div>

          <div class="mb-3">
            <label class="form-label">Publication / Project URL</label>
            <input type="url" class="form-control" id="url" placeholder="https://example.com">
          </div>

          <div class="mb-4">
            <label class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="3" placeholder="Brief description"></textarea>
          </div>

          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="saveProjectBtn">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  
  <!--  Document Upload Modal -->
<div class="modal fade" id="documentUploadModal" tabindex="-1" aria-labelledby="documentUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('student/uploadDocument') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="documentUploadModalLabel">Upload Document</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="document_type" class="form-label">Document Type</label>
            <?= (new \App\Libraries\GlobalData())->renderDocumentTypeDropdown('document_type', old('document_type')) ?>
          </div>
          <div class="mb-3">
            <label for="document_file" class="form-label">Select File</label>
            <input type="file" name="document_file" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </div>
    </form>
  </div>
</div>
  
 <!--Edit Modal for personal info -->
<div class="modal fade" id="personalInfoModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form method="post" action="<?= base_url('/student/update-personal-info') ?>">
        <div class="modal-header border-0">
          <h5 class="modal-title">Edit Personal Information</h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body row g-3">
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
          <div class="col-md-12">
            <label>Communication Address</label>
            <input type="text" name="communication_address" class="form-control" value="<?= esc($student['communication_address']) ?>">
          </div>
          <div class="col-md-6">
            <label>State</label>
            <input type="text" name="communication_state" class="form-control" value="<?= esc($student['communication_state']) ?>">
          </div>
          <div class="col-md-6">
            <label>Pincode</label>
            <input type="text" name="communication_pincode" class="form-control" value="<?= esc($student['communication_pincode']) ?>">
          </div>
          <div class="col-md-12">
            <label>Permanent Address</label>
            <input type="text" name="permanent_address" class="form-control" value="<?= esc($student['permanent_address']) ?>">
          </div>
          <div class="col-md-6">
            <label>State</label>
            <input type="text" name="permanent_state" class="form-control" value="<?= esc($student['permanent_state']) ?>">
          </div>
          <div class="col-md-6">
            <label>Pincode</label>
            <input type="text" name="permanent_pincode" class="form-control" value="<?= esc($student['permanent_pincode']) ?>">
          </div>
          <div class="col-md-6">
            <label>PAN Number</label>
            <input type="text" name="pan_number" class="form-control" value="<?= esc($student['pan_number']) ?>">
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
            <input type="url" name="linkedin" class="form-control" value="<?= esc($student['linkedin'] ?? '') ?>">
          </div>
          <div class="col-md-6">
            <label>GitHub</label>
            <input type="url" name="github" class="form-control" value="<?= esc($student['github'] ?? '') ?>">
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
  
<!-- Family Details Modal -->
<div class="modal fade" id="familyDetailsModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form method="post" action="<?= base_url('/student/save-family-details') ?>">
        <div class="modal-header border-0">
          <h5 class="modal-title">Add Family Detail</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label>Relation</label>
            <?= (new \App\Libraries\GlobalData())->renderRelationTypeDropdown('relation', old('relation')) ?>
          </div>
          <div class="col-md-6">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Contact</label>
            <input type="text" name="contact" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Occupation</label>
            <input type="text" name="occupation" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Mobile</label>
            <input type="text" name="mobile" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Email ID</label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Salary</label>
            <input type="text" name="salary" class="form-control">
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
<script>
document.addEventListener('DOMContentLoaded', function () {
  const allSkills = [
    "Python", "Java", "SQL", "C++", "HTML", "CSS", "JavaScript",
    "React", "Node.js", "PHP", "MySQL", "MongoDB", "Git", "Figma"
  ];

  const skillInput = document.getElementById("skillInput");
  const suggestedSkills = document.getElementById("suggestedSkills");
  const formBody = document.getElementById("addSkillForm");
  const formContainer = document.getElementById("skillFormBody");
  const successView = document.getElementById("successMessage");
  const saveBtn = document.getElementById("saveSkillBtn");
  const addMoreBtn = document.getElementById("addMoreSkillBtn");

  // 1. Display Suggested Skills
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

  // 2. Filter Suggested Skills
  function filterSkills() {
    const keyword = skillInput.value.toLowerCase();
    const filtered = allSkills.filter(skill => skill.toLowerCase().includes(keyword));
    displaySkills(filtered);
  }

  skillInput.addEventListener('keyup', filterSkills);
  displaySkills(allSkills); // Initial display

  // 3. Add Skill via AJAX
  saveBtn.addEventListener('click', function () {
    const skillName = skillInput.value.trim();
    if (!skillName) return;

    fetch('<?= base_url('/student/add-skill') ?>', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ skill_name: skillName })
    })
    .then(res => res.ok ? res.text() : Promise.reject())
    .then(() => {
      // Show success view
      formContainer.classList.add('d-none');
      successView.classList.remove('d-none');

      // Add to DOM
      const listGroup = document.querySelector("#skills .list-group");
      if (listGroup) {
        const newItem = document.createElement("div");
        newItem.className = "list-group-item d-flex justify-content-between align-items-center rounded mb-2";
        newItem.style.background = "#f9f9f9";
        newItem.innerHTML = `
          <span class="text-dark">${skillName}</span>
          <button class="btn btn-sm text-danger deleteSkillBtn" data-id="TEMP" data-skill="${skillName}" data-bs-toggle="modal" data-bs-target="#deleteSkillModal">
            <i class="bi bi-trash"></i>
          </button>`;
        listGroup.appendChild(newItem);
      }

      // Reset input
      skillInput.value = '';
      filterSkills();
    })
    .catch(() => alert('Failed to add skill'));
  });

  // 4. Reset Modal on Add More
  addMoreBtn.addEventListener('click', function () {
    skillInput.value = '';
    formContainer.classList.remove('d-none');
    successView.classList.add('d-none');
    filterSkills();
  });

  // 5. Reset Modal on Close
  document.getElementById("addSkillModal").addEventListener("hidden.bs.modal", function () {
    skillInput.value = '';
    formContainer.classList.remove('d-none');
    successView.classList.add('d-none');
    filterSkills();
  });

  // 6. Delete Skill Logic
  let selectedSkillId = null;
  const deleteInput = document.getElementById('deleteSkillId');
  const skillNameLabel = document.getElementById('skillNameLabel');

  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.deleteSkillBtn');
    if (btn) {
      selectedSkillId = btn.getAttribute('data-id');
      const skillName = btn.getAttribute('data-skill');
      deleteInput.value = selectedSkillId;
      skillNameLabel.textContent = skillName;
    }
  });

  const confirmBtn = document.getElementById('confirmDeleteSkill');
  if (confirmBtn) {
    confirmBtn.addEventListener('click', function () {
      const skillId = deleteInput.value;
      fetch("<?= base_url('/student/delete-skill') ?>", {
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
          const modal = bootstrap.Modal.getInstance(document.getElementById('deleteSkillModal'));
          modal.hide();

          const skillItem = document.querySelector(`.deleteSkillBtn[data-id="${skillId}"]`)?.closest('.list-group-item');
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
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const saveBtn = document.getElementById("saveEducationBtn");
    const educationDetailsList = document.getElementById("educationDetailsList");

    if (saveBtn && educationDetailsList) {
      saveBtn.addEventListener("click", function () {
        const qualificationType = document.getElementById("qualificationType")?.value || "";
        const institutionName = document.getElementById("institutionName")?.value || "";
        const board = document.getElementById("board")?.value || "";
        const course = document.getElementById("course")?.value || "";
        const courseType = document.getElementById("courseType")?.value || "";
        const yearOfPassing = document.getElementById("yearOfPassing")?.value || "";
        const grade = document.getElementById("grade")?.value || "";
        const resultStatus = document.getElementById("resultStatus")?.value || "";

        if (
          !qualificationType || !institutionName || !board || !course ||
          !courseType || !yearOfPassing || !grade || !resultStatus
        ) {
          alert("Please fill out all education details.");
          return;
        }

        const educationHTML = `
          <div class="border rounded p-3 mb-2">
            <h6 class="mb-1">${qualificationType} - ${course}</h6>
            <p class="mb-1"><strong>${institutionName}</strong>, ${board}</p>
            <p class="mb-1">${courseType} | ${yearOfPassing}</p>
            <p class="mb-1">Grade: ${grade}</p>
            <p class="mb-0 text-muted">Status: ${resultStatus}</p>
          </div>
        `;

        educationDetailsList.insertAdjacentHTML("beforeend", educationHTML);

        // Clear form inputs
        document.getElementById("educationForm").reset();
      });
    }
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('educationDetailsModal'));
    document.getElementById('addEducationBtn').addEventListener('click', () => modal.show());
  });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("experienceForm");
  const saveBtn = document.getElementById("saveExperienceBtn");
  const list = document.getElementById("experienceDetailsList");
  const workedTill = document.getElementById("workedTill");
  const currentCheckbox = document.getElementById("currentlyWorking");

  // ✅ Defensive check to prevent the script from breaking
  if (!form || !saveBtn || !list) {
    console.warn("❌ Experience modal elements not found in DOM.");
    return;
  }

  saveBtn.addEventListener("click", function () {
    const title = document.getElementById("expTitle")?.value;
    const type = document.getElementById("employmentType")?.value;
    const company = document.getElementById("company")?.value;
    const joining = document.getElementById("joiningDate")?.value;
    const isCurrent = currentCheckbox?.checked;
    const till = workedTill?.value;
    const location = document.getElementById("location")?.value;
    const locationType = document.getElementById("locationType")?.value;
    const remarks = document.getElementById("remarks")?.value;

    if (!title || !type || !company || !joining || (!isCurrent && !till)) {
      alert("Please fill out required fields.");
      return;
    }

    const period = isCurrent ? "Present" : till;

    const experienceHTML = `
  <div class="border rounded p-3 mb-2">
    <h6 class="mb-1">${title || "N/A"} (${type || "N/A"})</h6>
    <p class="mb-1"><strong>${company || "N/A"}</strong></p>
    <p class="mb-1">${joining || "Start"} – ${period || "End"}</p>
    <p class="mb-1">Location: ${location || "Unknown"} (${locationType || "Type"})</p>
    ${remarks ? `<p class="mb-0 text-muted">Remarks: ${remarks}</p>` : ""}
  </div>`;


    list.insertAdjacentHTML("beforeend", experienceHTML);
    form.reset();
    if (workedTill) workedTill.disabled = false;
  });

  if (currentCheckbox && workedTill) {
    currentCheckbox.addEventListener("change", function () {
      workedTill.disabled = this.checked;
    });
  }
});
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const licenseForm = document.getElementById("licenseForm");
    const saveBtn = document.getElementById("saveLicenseBtn");
    const displaySection = document.getElementById("displayLicenses");

    saveBtn.addEventListener("click", function () {
      const name = document.getElementById("licenseName").value.trim();
      const org = document.getElementById("issuingOrg").value.trim();
      const issue = document.getElementById("issueDate").value;
      const expiry = document.getElementById("expiryDate").value;
      const id = document.getElementById("licenseId").value.trim();
      const url = document.getElementById("licenseUrl").value.trim();

      if (!name || !org || !issue) {
        alert("Please fill in all required fields (*)");
        return;
      }

      const container = document.createElement("div");
      container.className = "col-md-6";

      container.innerHTML = `
        <div class="border p-3 rounded shadow-sm bg-light">
          <h6 class="mb-1">${name}</h6>
          <p class="mb-0"><strong>Issued by:</strong> ${org}</p>
          <p class="mb-0"><strong>Issued:</strong> ${issue}${expiry ? ` | <strong>Expires:</strong> ${expiry}` : ''}</p>
          ${id ? `<p class="mb-0"><strong>ID:</strong> ${id}</p>` : ''}
          ${url ? `<p class="mb-0"><strong>URL:</strong> <a href="${url}" target="_blank">${url}</a></p>` : ''}
        </div>
      `;

      displaySection.appendChild(container);

      // Clear form
      licenseForm.reset();

      // Close modal
      const modal = bootstrap.Modal.getInstance(document.getElementById('licenseModal'));
      modal.hide();
    });
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('saveProjectBtn').addEventListener('click', function () {
      const title = document.getElementById('title').value;
      const type = document.querySelector('input[name="type"]:checked')?.value;
      const publisher = document.getElementById('publisher').value;
      const completionDate = document.getElementById('completionDate').value;
      const authors = document.getElementById('authors').value;
      const url = document.getElementById('url').value;
      const description = document.getElementById('description').value;

      if (!title || !type || !publisher || !completionDate || !authors || !url || !description) {
        alert('Please fill all fields before saving.');
        return;
      }

      const entryHTML = `
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">${title}</h5>
            <h6 class="card-subtitle mb-2 text-muted">${type} | ${publisher} | ${completionDate}</h6>
            <p class="card-text"><strong>Authors:</strong> ${authors}</p>
            <p class="card-text"><strong>Description:</strong> ${description}</p>
            <a href="${url}" target="_blank" class="card-link">View ${type}</a>
          </div>
        </div>
      `;

      document.getElementById('projectList').insertAdjacentHTML('beforeend', entryHTML);

      // Reset the form
      document.getElementById('projectForm').reset();
    });
  });
</script>

<!-- Bootstrap JS -->
<!-- Make sure this is included at the bottom of your page (before </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>