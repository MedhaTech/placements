<?php
use App\Libraries\GlobalData;
$globalData = new GlobalData();
?>
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

.doc-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr); /* 3 columns */
  gap: 12px 20px;
  margin-top: 20px;
}

.doc-item {
  display: flex;
  align-items: center;
  font-size: 14px;
  font-weight: 500;
  text-transform: uppercase;
  gap: 8px;
}

.doc-item .tick {
  color: green;
  font-size: 18px;
}

.doc-item .cross {
  color: red;
  font-size: 18px;
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
        <div class="profile-photo" style="background-image: url('<?= esc($photoUrl) ?>');"></div>
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
              <?php if (!empty($student['reg_no'])): ?>
                <span><?= esc($student['reg_no']) ?></span>
              <?php else: ?>
                <span class="text-danger">Fill Reg No in Personal Info</span>
              <?php endif; ?>
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

              <?php if (!empty($resumeUrl)): ?>
                <?php
                  $resumeName = basename($resumeUrl); // Extract filename from the full path
                ?>
                <a href="<?= esc($resumeUrl) ?>" download="<?= esc($resumeName) ?>" target="_blank">
                  <?= esc($resumeName) ?>
                </a>
                <a href="#" class="ms-3 text-primary" data-bs-toggle="modal" data-bs-target="#resumeUploadModal">
                  Reupload
                </a>
              <?php else: ?>
                <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#resumeUploadModal">
                  Upload
                </a>
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
            <div class="col-md-6 mb-2"><strong>Reg no/Roll no:</strong> <?= esc($student['reg_no']) ?></div>
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
          <a href="#" data-bs-toggle="modal" data-bs-target="#editFamilyModal" onclick="openFamilyModal()">Add</a>
        </h5>

        <div class="mt-3">
          <?php if (!empty($familyDetails)): ?>
            <?php foreach ($familyDetails as $detail): ?>
              <div class="border p-3 mb-3 rounded bg-light position-relative">
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

                <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                  <a href="javascript:void(0);" onclick='editFamily(<?= json_encode($detail, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)' class="text-primary" title="Edit">
                    <i class="bi bi-pencil-square fs-5"></i>
                  </a>
                  <a href="javascript:void(0);" onclick='confirmDeleteFamily(<?= $detail["id"] ?>, "<?= esc(addslashes($detail["name"])) ?>")' class="text-danger" title="Delete">
                    <i class="bi bi-trash fs-5"></i>
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No family details added yet.</p>
          <?php endif; ?>
        </div>
      </div>


      <!-- Experience Details Section -->
      <div id="experience-details" class="section-card mt-4">
  <h5>
    Experience Details
    <a href="#" data-bs-toggle="modal" data-bs-target="#experienceDetailsModal">Add</a>
  </h5>

  <div class="mt-3">
    <?php if (!empty($experienceDetails)) : ?>
      <?php foreach ($experienceDetails as $exp) : ?>
        <div class="border rounded bg-light p-2 mb-2 position-relative small">
          <!-- Header Row -->
          <div class="d-flex justify-content-between align-items-start mb-1">
            <div><strong><?= esc($exp['title']) ?></strong></div>
            <div class="d-flex gap-2">
              <a href="javascript:void(0);" onclick='editExperience(<?= json_encode($exp, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)' class="text-primary" title="Edit">
                <i class="bi bi-pencil-square fs-6"></i>
              </a>
              <a href="javascript:void(0);" onclick='confirmDeleteExperience(<?= $exp["id"] ?>, "<?= esc(addslashes($exp["title"])) ?>")' class="text-danger" title="Delete">
                <i class="bi bi-trash fs-6"></i>
              </a>
            </div>
          </div>

          <div><b>Organization:</b> <?= esc($exp['organization']) ?></div>
          <div><b>Type:</b> <?= esc($exp['employment_type']) ?> | <?= esc($exp['location_type']) ?></div>
          <div><b>Location:</b> <?= esc($exp['location']) ?></div>
          <div>
            <b>Duration:</b>
            <?= date('M Y', strtotime($exp['joining_date'])) ?>
            <?php if (!$exp['is_current']) : ?>
              to <?= date('M Y', strtotime($exp['end_date'])) ?>
            <?php else : ?>
              (Currently working)
            <?php endif; ?>
          </div>
          <?php if (!empty($exp['remarks'])) : ?>
            <div><b>Remarks:</b> <em><?= esc($exp['remarks']) ?></em></div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p>No experience details added yet.</p>
    <?php endif; ?>
  </div>
</div>



      <!-- Education Details Section -->
      <div id="education-details" class="section-card mt-4">
        <h5>
          Education Details
          <a href="#" data-bs-toggle="modal" data-bs-target="#educationDetailsModal">Add</a>
        </h5>
        <div class="mt-3 d-flex flex-wrap gap-3">
          <?php if (!empty($educationDetails)): ?>
            <?php foreach ($educationDetails as $edu): ?>
              <div class="border p-3 mb-3 rounded bg-light position-relative" style="width: 300px; min-height: 200px;">
              <div><strong>Qualification:</strong> <?= esc($edu['qualification_type']) ?></div>
              <div><strong>Institution:</strong> <?= esc($edu['institution_name']) ?></div>
              <div><strong>Board / University:</strong> <?= esc($edu['board_university']) ?></div>
              <div><strong>Specialization:</strong> <?= esc($edu['course_specialization']) ?></div>
              <div><strong>Course Type:</strong> <?= esc($edu['course_type']) ?></div>
              <div><strong>Year of Passing:</strong> <?= esc($edu['year_of_passing']) ?></div>
              <div><strong>Grade / Percentage:</strong> <?= esc($edu['grade_percentage']) ?></div>

              <?php
                $status = strtolower($edu['result_status']);
                $badgeClass = 'bg-secondary';
                if ($status === 'passed') {
                  $badgeClass = 'bg-success';
                } elseif ($status === 'awaiting results') {
                  $badgeClass = 'bg-warning text-dark';
                } elseif ($status === 'pursuing') {
                  $badgeClass = 'bg-info text-dark';
                }
              ?>
              <div><strong>Status:</strong> <span class="badge <?= $badgeClass ?>"><?= esc($edu['result_status']) ?></span></div>

              <!-- Icons -->
              <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                <a href="javascript:void(0);" onclick='editEducation(<?= json_encode($edu, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)' class="text-primary" title="Edit">
                  <i class="bi bi-pencil-square fs-5"></i>
                </a>
                <a href="javascript:void(0);" onclick='confirmDeleteEducation(<?= $edu["id"] ?>, "<?= esc(addslashes($edu["qualification_type"])) ?>")' class="text-danger" title="Delete">
                  <i class="bi bi-trash fs-5"></i>
                </a>
              </div>
            </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No education details added yet.</p>
          <?php endif; ?>
        </div>
      </div>


        <!--Skills Section-->
        <div id="skills" class="section-card"> 
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-dark mb-0">Skills</h5>
            <a href="#" data-bs-toggle="modal" data-bs-target="#addSkillModal" class="text-primary fw-semibold">Add</a>
          </div>
          <?php if (!empty($skills)): ?>
            <div class="d-flex flex-wrap gap-2" id="skillsList">
              <?php foreach ($skills as $skill): ?>
                <div class="badge rounded-pill px-3 py-2 border text-dark d-flex align-items-center" style="font-size: 14px; background-color: #f4f3f8;">
                  <?= esc($skill['skill_name']) ?>
                <button 
                    type="button"
                    class="btn btn-sm btn-link text-dark ms-2 p-0 deleteSkillBtn" 
                    data-id="<?= $skill['id'] ?>" 
                    data-skill="<?= esc($skill['skill_name']) ?>"
                    data-bs-toggle="modal" 
                    data-bs-target="#deleteSkillModal"
                    style="line-height: 1; text-decoration: none;">
                    &times;
                  </button>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p class="text-muted small">You haven't added any skills yet.</p>
          <?php endif; ?>
        </div>
     
      <!-- Licenses & Certifications Section -->
      <div id="certifications-section" class="section-card">
        <h5>Licenses & Certifications 
          <a href="#" data-bs-toggle="modal" data-bs-target="#certificationModal">Add</a>
        </h5>
        <div id="certificationsList" class="mt-3 d-flex flex-wrap gap-3">
          <?php if (!empty($licensesCertifications)) : ?>
            <?php foreach ($licensesCertifications as $cert) : ?>
              <div class="border rounded bg-light p-3" style="width: 360px; min-height: 200px;">
                <!-- Header row with title and icons -->
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <strong><?= esc($cert['certificate_name']) ?></strong>
                  <div class="d-flex gap-2">
                    <a href="javascript:void(0);" onclick='editCertification(<?= json_encode($cert, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)' class="text-primary" title="Edit">
                      <i class="bi bi-pencil-square fs-5"></i>
                    </a>
                    <a href="javascript:void(0);" onclick='confirmDeleteCertification(<?= $cert["id"] ?>, "<?= esc(addslashes($cert["certificate_name"])) ?>")' class="text-danger" title="Delete">
                      <i class="bi bi-trash fs-5"></i>
                    </a>
                  </div>
                </div>

                <!-- Card Content -->
                <div>
                  <div><strong>Issued By:</strong> <?= esc($cert['issuing_organization']) ?></div>
                  <div><strong>Issue Date:</strong> <?= date('M Y', strtotime($cert['issue_date'])) ?></div>
                  <?php if ($cert['expiry_date']) : ?>
                    <div><strong>Expiry:</strong> <?= date('M Y', strtotime($cert['expiry_date'])) ?></div>
                  <?php endif; ?>
                  <?php if ($cert['reg_no']) : ?>
                    <div><strong>ID:</strong> <?= esc($cert['reg_no']) ?></div>
                  <?php endif; ?>
                  <?php if ($cert['url']) : ?>
                    <div><strong>URL:</strong> <a href="<?= esc($cert['url']) ?>" target="_blank">Link</a></div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <p>No certifications added yet.</p>
          <?php endif; ?>
        </div>
      </div>

      <!-- Projects & Publication Section -->
      <div id="projects-publications-section" class="section-card mt-4">
        <h5>Projects & Publications
          <a href="#" data-bs-toggle="modal" data-bs-target="#projectsPublicationsModal">Add</a>
        </h5>
        <div id="projectsPublicationsList" class="mt-3">
          <?php if (!empty($projectsPublications)): ?>
            <?php foreach ($projectsPublications as $item): ?>
              <div class="card mb-2">
                <div class="card-body">
                  <h6 class="card-title">
                    <?= esc($item['title']) ?> 
                    <span class="badge bg-info"><?= esc($item['publishing_type']) ?></span>
                  </h6>

                  <!-- ✅ Combined Publisher, Date, Authors in one line -->
                  <?php if (!empty($item['publisher']) || !empty($item['completion_date']) || !empty($item['authors'])): ?>
                    <p class="d-flex flex-wrap gap-3 mb-2 small text-muted">
                      <?php if (!empty($item['publisher'])): ?>
                        <span><strong>Publisher:</strong> <?= esc($item['publisher']) ?></span>
                      <?php endif; ?>
                      <?php if (!empty($item['completion_date'])): ?>
                        <span><strong>Completion Date:</strong> <?= esc(date('d-m-Y', strtotime($item['completion_date']))) ?></span>
                      <?php endif; ?>
                      <?php if (!empty($item['authors'])): ?>
                        <span><strong>Authors / Co-Authors:</strong> <?= esc($item['authors']) ?></span>
                      <?php endif; ?>
                    </p>
                  <?php endif; ?>

                  <?php if (!empty($item['publication_url'])): ?>
                    <p><strong>URL:</strong> <a href="<?= esc($item['publication_url']) ?>" target="_blank"><?= esc($item['publication_url']) ?></a></p>
                  <?php endif; ?>

                  <?php if (!empty($item['description'])): ?>
                    <p><strong>Description:</strong> <?= esc($item['description']) ?></p>
                  <?php endif; ?>

                  <!-- ✅ Edit/Delete buttons -->
                  <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                    <a href="javascript:void(0);" onclick='editProjectPublication(<?= json_encode($item, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)' class="text-primary" title="Edit">
                      <i class="bi bi-pencil-square fs-5"></i>
                    </a>
                    <a href="javascript:void(0);" onclick='confirmDeleteProjectPublication(<?= $item["id"] ?>, "<?= esc(addslashes($item["title"])) ?>")' class="text-danger" title="Delete">
                      <i class="bi bi-trash fs-5"></i>
                    </a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-muted">No projects or publications added yet.</p>
          <?php endif; ?>
        </div>
      </div>

      <!-- Languages Section -->
    <div id="languages" class="section-card mt-4">
      <h5>
        Languages
        <a href="#" data-bs-toggle="modal" data-bs-target="#languagesModal" onclick="openLanguageModal()">Add</a>
      </h5>

      <div class="mt-3">
        <?php if (!empty($studentLanguages)): ?>
          <div class="container-fluid px-0">
            <div class="row">
              <?php foreach ($studentLanguages as $index => $lang): ?>
                <div class="col-md-6 mb-3">
                  <div class="border p-3 rounded bg-light position-relative h-100">
                    <div class="row">
                      <div class="col-6"><strong>Language:</strong> <?= esc($lang['language_name']) ?></div>
                      <div class="col-6"><strong>Proficiency:</strong> <?= esc($lang['proficiency']) ?></div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-4"><strong>Read:</strong> <?= $lang['can_read'] ? 'Yes' : 'No' ?></div>
                      <div class="col-4"><strong>Write:</strong> <?= $lang['can_write'] ? 'Yes' : 'No' ?></div>
                      <div class="col-4"><strong>Speak:</strong> <?= $lang['can_speak'] ? 'Yes' : 'No' ?></div>
                    </div>

                    <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                      <a href="javascript:void(0);" onclick='editLanguage(<?= json_encode($lang, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)' class="text-primary" title="Edit">
                        <i class="bi bi-pencil-square fs-5"></i>
                      </a>
                      <a href="javascript:void(0);" onclick='confirmDeleteLanguage(<?= $lang["id"] ?>, "<?= esc(addslashes($lang["language_name"])) ?>")' class="text-danger" title="Delete">
                        <i class="bi bi-trash fs-5"></i>
                      </a>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php else: ?>
          <p class="text-muted">No languages added yet.</p>
        <?php endif; ?>
      </div>
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
              <div class="col-md-6 mb-2"><strong>Mode of Admission:</strong> <?= esc($academic['mode_of_admission']) ?></div>
              <div class="col-md-6 mb-2"><strong>Rank:</strong> <?= esc($academic['entrance_rank']) ?: '—' ?></div>
              <div class="col-12">
                <strong>SGPA/CGPA:</strong>
                <ul class="mb-2">
               <?php for ($i = 1; $i <= 10; $i++): ?>
                  <?php
                    $key = "sem{$i}_sgpa_cgpa";
                    $value = isset($academic[$key]) ? trim($academic[$key]) : '';
                  ?>
                  <?php if (!empty($value)): ?>
                    <div class="col-md-6 mb-2">
                      <strong>Semester <?= $i ?> SGPA/CGPA:</strong>
                      <?= esc($value) ?>
                    </div>
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
              <?php if (!empty($placement)) : ?>
              <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                  <p><strong>Interested in Placements:</strong> <?= $placement['interested_in_placements'] ? 'Yes' : 'No' ?></p>
                  <p><strong>Preferred Jobs:</strong> <?= esc($placement['preferred_jobs']) ?></p>
                  <p><strong>Interested in Higher Studies:</strong> <?= $placement['interested_in_higher_studies'] ? 'Yes' : 'No' ?></p>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                  <p><strong>Placement Coordinator Name:</strong> <?= esc($placement['placement_coordinator_name']) ?></p>
                  <p><strong>Department:</strong> <?= esc($placement['coordinator_department']) ?></p>
                  <p><strong>Mobile:</strong> <?= esc($placement['coordinator_mobile']) ?></p>
                </div>
              </div>
            <?php else : ?>
              <p>No placement preferences set yet.</p>
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

      <!-- Placement Offers Section -->
      <div id="placementOffersSection" class="section-card">
        <h5>
          Placement Offers 
          <a href="#" data-bs-toggle="modal" data-bs-target="#placementOffersModal">Add</a>
        </h5>

        <div id="placementOffersList" class="mt-2">
          <?php if (!empty($placementOffers)): ?>
            <div class="row">
              <?php foreach ($placementOffers as $offer): ?>
                <div class="col-md-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="card-title">
                        <?= esc($offer['company_name']) ?> — <?= esc($offer['job_title']) ?>
                        <span class="badge bg-success float-end"><?= esc($offer['offer_status']) ?></span>
                      </h6>
                      <p><strong>Offered Salary (LPA):</strong> <?= esc($offer['offered_salary']) ?></p>
                      <p><strong>Status:</strong> <?= esc($offer['status']) ?></p>
                      <div class="d-flex justify-content-end gap-3 mt-3">
                        <a href="javascript:void(0);" onclick='editPlacementOffer(<?= json_encode($offer, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)' class="text-primary" title="Edit">
                          <i class="bi bi-pencil-square fs-5"></i>
                        </a>
                        <a href="javascript:void(0);" onclick='confirmDeletePlacementOffer(<?= $offer["id"] ?>, "<?= esc(addslashes($offer["company_name"])) ?>")' class="text-danger" title="Delete">
                          <i class="bi bi-trash fs-5"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p class="text-muted">No placement offers added yet.</p>
          <?php endif; ?>
        </div>
      </div>



      <!--documents-->
      <div id="documents" class="section-card">
        <h5>Documents
          <a href="#" data-bs-toggle="modal" data-bs-target="#documentUploadModal">Upload</a>
        </h5>
        <?php
        $studentModel = new \App\Models\StudentModel();
        $uploadedDocs = $studentModel->getUploadedDocumentTypes(session()->get('student_id'));

        // Global document types
        $requiredDocs = [
            'PHOTO', 'PAN CARD', 'AADHAR CARD', 'COLLEGE ID CARD', 'RESUME',
            'PASSPORT', 'X CERTIFICATE', 'XII CERTIFICATE', 'UG CERTIFICATE',
            'PG CERTIFICATE', 'DIPLOMA CERTIFICATE', 'INTERNSHIP CERTIFICATE',
            'EXPERIENCE CERTIFICATE', 'SKILL CERTIFICATE', 'OFFER LETTER'
        ];
        ?>

       <div class="doc-grid">
          <?php foreach ($requiredDocs as $docType): ?>
            <div class="doc-item">
              <?= strtoupper($docType) ?>
            
                <?php if (in_array(strtoupper($docType), $uploadedDocs)): ?>
    <i class="fa fa-circle-check text-success ms-2"></i>

    <?php
      $documentPath = $studentModel->getStudentDocumentPath(session()->get('student_id'), strtoupper($docType));
      $fullPath = FCPATH . $documentPath;
      if (!empty($documentPath) && file_exists($fullPath)):
    ?>
      <!-- Download Icon -->
      <a href="<?= base_url($documentPath) ?>" download class="ms-2 text-decoration-none" title="Download <?= strtoupper($docType) ?>">
        <i class="fa fa-download text-primary"></i>
      </a>

      <!-- View Icon -->
      <a href="#" class="ms-2 text-decoration-none" 
   title="View <?= strtoupper($docType) ?>" 
   data-bs-toggle="modal" 
   data-bs-target="#viewDocumentModal" 
   data-doc-url="<?= base_url($documentPath) ?>" 
   data-doc-name="<?= strtoupper($docType) ?>">
  <i class="fa fa-eye text-info"></i>
</a>
    <?php endif; ?>
<?php else: ?>
    <i class="fa fa-circle-xmark text-danger ms-2"></i>
<?php endif; ?>

            </div>
          <?php endforeach; ?>
        </div>
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
          <h5 class="modal-title">Edit Profile Summary <span class="text-success">+7%</span></h5>
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

<!-- View Document Modal -->
<div class="modal fade" id="viewDocumentModal" tabindex="-1" aria-labelledby="viewDocumentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewDocumentModalLabel">View Document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <iframe id="documentViewer" src="" width="100%" height="600px" frameborder="0"></iframe>
      </div>
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
            <?= $globalData->renderSelect('pursuing_degree', $pursuingDegrees, $academic['pursuing_degree'] ?? '') ?>
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
            <input type="number" name="year_of_joining" class="form-control" value="<?= esc($academic['year_of_joining'] ?? '') ?>">
          </div>

          <div class="col-md-6">
            <label>Type of Entry</label>
            <?= $globalData->renderSelect('type_of_entry', $entryTypes, $academic['type_of_entry'] ?? '') ?>
          </div>

          <div class="col-md-6">
            <label>Mode of Admission</label>
            <?= $globalData->renderSelect('mode_of_admission', $admissionModes, $academic['mode_of_admission'] ?? '') ?>
          </div>

          <div class="col-md-6">
            <label>Entrance Rank (Optional)</label>
            <input type="text" name="entrance_rank" class="form-control" value="<?= isset($academic['enterance_rank']) ? esc($academic['enterance_rank']) : '' ?>">
          </div>

          <!-- Dynamic Semester Inputs -->
          <div class="col-md-12">
            <label class="form-label">Semester SGPA/CGPA</label>
            <div id="semesterInputs">
              <?php
                $hasSemester = false;
                for ($i = 1; $i <= 10; $i++):
                  $key = 'sem' . $i . '_sgpa_cgpa';
                  if (!empty($academic[$key])): $hasSemester = true;
              ?>
                <div class="d-flex align-items-center mb-2 semester-group">
                  <input type="text" name="semesters[]" class="form-control me-2" value="<?= esc($academic[$key]) ?>" placeholder="Semester <?= $i ?> SGPA/CGPA">
                  <button type="button" class="btn btn-danger btn-sm remove-semester">X</button>
                </div>
              <?php
                  endif;
                endfor;

                // If no semesters exist, show one empty input by default
                if (!$hasSemester):
              ?>
                <div class="d-flex align-items-center mb-2 semester-group">
                  <input type="text" name="semesters[]" class="form-control me-2" placeholder="Semester 1 SGPA/CGPA">
                  <button type="button" class="btn btn-danger btn-sm remove-semester d-none">X</button>
                </div>
              <?php endif; ?>
            </div>

            <button type="button" id="addSemesterBtn" class="btn btn-outline-primary btn-sm mt-2">+ Add Semester</button>
          </div>

          <div class="col-md-6">
            <label>Current Active Backlogs</label>
            <input type="number" name="active_backlogs" class="form-control" value="<?= esc($academic['active_backlogs'] ?? '') ?>">
          </div>

          <div class="col-md-6">
            <label>Backlog History</label>
            <input type="number" name="backlog_history" class="form-control" value="<?= esc($academic['backlog_history'] ?? '') ?>">
          </div>

          <div class="col-md-6">
            <label>Year Back</label>
            <?= $globalData->renderYesNoDropdown('year_back', $academic['year_back'] ?? '') ?>
          </div>

          <div class="col-md-6">
            <label>Academic Gaps (Before/During Degree)</label>
            <input type="number" name="academic_gaps" class="form-control" value="<?= esc($academic['academic_gaps'] ?? '') ?>">
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
      <form method="post" action="<?= site_url('student/save-experience-details') ?>">
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" name="title" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Employment Type</label>
              <?= (new \App\Libraries\GlobalData())->renderEmploymentTypeDropdown ('employment_type', old('employment_type')) ?>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Organization</label>
              <input type="text" class="form-control" name="organization">
            </div>
            <div class="col-md-6">
              <label class="form-label">Joining Date</label>
              <input type="month" class="form-control" name="joining_date">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="is_current" id="is_current">
                <label class="form-check-label" for="is_current">
                  I am currently working in this role
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">End Date</label>
              <input type="month" class="form-control" name="end_date">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Location</label>
              <input type="text" class="form-control" name="location">
            </div>
            <div class="col-md-6">
              <label class="form-label">Location Type</label>
              <?= (new \App\Libraries\GlobalData())->renderLocationTypeDropdown ('location', old('location')) ?>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Remarks</label>
            <textarea class="form-control" name="remarks" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Experience Modal -->
<div class="modal fade" id="editExperienceDetailsModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="editExperienceForm" method="post" action="<?= base_url('/student/update-experience') ?>">
        <input type="hidden" name="experience_id" id="experience_id">

        <div class="modal-header border-0">
          <h5 class="modal-title" id="editExperienceModalTitle">Edit Experience</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label>Title</label>
            <input type="text" name="title" id="experience_title" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Employment Type</label>
            <?= (new \App\Libraries\GlobalData())->renderEmploymentTypeDropdown('employment_type', old('employment_type')) ?>
          </div>
          <div class="col-md-6">
            <label>Organization</label>
            <input type="text" name="organization" id="experience_organization" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Joining Date</label>
            <input type="date" name="joining_date" id="experience_joining_date" class="form-control">
          </div>
          <div class="col-md-6">
            <label>End Date</label>
            <input type="date" name="end_date" id="experience_end_date" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Currently Working?</label><br>
            <input type="checkbox" name="is_current" id="experience_is_current">
          </div>
          <div class="col-md-6">
            <label>Location</label>
            <input type="text" name="location" id="experience_location" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Location Type</label>
            <?= (new \App\Libraries\GlobalData())->renderLocationTypeDropdown('location_type', old('location_type')) ?>
          </div>
          <div class="col-md-12">
            <label>Remarks</label>
            <textarea name="remarks" id="experience_remarks" class="form-control"></textarea>
          </div>
        </div>

        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete Experience Modal -->
<div class="modal fade" id="deleteExperienceModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="deleteExperienceForm" method="post" action="<?= base_url('/student/delete-experience') ?>">
        <input type="hidden" name="delete_experience_id" id="delete_experience_id">
        <div class="modal-header border-0">
          <h5 class="modal-title">Delete Experience</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <p class="mb-0">
            Are you sure you want to delete the experience titled 
            <strong id="delete_experience_title_label">this title</strong>?
          </p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
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
      <form action="<?= site_url('student/save-education-details') ?>" method="post">
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Qualification Type</label>
              <?= (new \App\Libraries\GlobalData())->renderQualificationTypeDropdown('qualification_type', old('qualification_type')) ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Institution Name</label>
              <input type="text" name="institution_name" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Board / University</label>
              <input type="text" name="board_university" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Course / Specialization</label>
              <input type="text" name="course_specialization" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Course Type</label>
              <?= (new \App\Libraries\GlobalData())->renderCourseTypeDropdown('course_type', old('course_type')) ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Year of Passing</label>
              <input type="number" name="year_of_passing" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Grade / Percentage</label>
              <input type="text" name="grade_percentage" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Result Status</label>
              <?= (new \App\Libraries\GlobalData())->renderResultStatusDropdown('result_status', old('result_status')) ?>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="submit" class="btn btn-primary">Save Details</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Education Modal -->
<div class="modal fade" id="editEducationDetailsModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="editEducationForm" method="post" action="<?= base_url('/student/update-education') ?>">
        <input type="hidden" name="education_id" id="education_id">

        <div class="modal-header border-0">
          <h5 class="modal-title" id="editEducationModalTitle">Edit Education</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label>Qualification Type</label>
            <?= (new \App\Libraries\GlobalData())->renderQualificationTypeDropdown('qualification_type', old('qualification_type')) ?>
          </div>
          <div class="col-md-6">
            <label>Institution Name</label>
            <input type="text" name="institution_name" id="education_institution_name" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Board / University</label>
            <input type="text" name="board_university" id="education_board_university" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Course / Specialization</label>
            <input type="text" name="course_specialization" id="education_course_specialization" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Course Type</label>
            <?= (new \App\Libraries\GlobalData())->renderCourseTypeDropdown('course_type', old('course_type')) ?>
          </div>
          <div class="col-md-6">
            <label>Year of Passing</label>
            <input type="text" name="year_of_passing" id="education_year_of_passing" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Grade / Percentage</label>
            <input type="text" name="grade_percentage" id="education_grade_percentage" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Result Status</label>
            <?= (new \App\Libraries\GlobalData())->renderResultStatusDropdown('result_status', old('result_status')) ?>
          </div>
        </div>

        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete Education Modal -->
<div class="modal fade" id="deleteEducationModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="deleteEducationForm" method="post" action="<?= base_url('/student/delete-education') ?>">
        <input type="hidden" name="delete_education_id" id="delete_education_id">
        <div class="modal-header border-0">
          <h5 class="modal-title">Delete Education</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <p class="mb-0">
            Are you sure you want to delete the education record: 
            <strong id="delete_education_title_label">this qualification</strong>?
          </p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Licenses & Certifications Modal -->
<div class="modal fade" id="certificationModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 16px;">
      <form action="<?= base_url('/student/save-certification') ?>" method="post">
        <div class="modal-header border-0">
          <h5 class="modal-title">Add License / Certification</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body pt-0">
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Name of the Certificate *</label>
              <input type="text" name="certificate_name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Issuing Organization *</label>
              <input type="text" name="issuing_organization" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Issue Date</label>
              <input type="month" name="issue_date" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Expiry Date</label>
              <input type="month" name="expiry_date" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">ID / Number</label>
              <input type="text" name="reg_no" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">URL</label>
              <input type="url" name="url" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Certification Modal -->
<div class="modal fade" id="editCertificationModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="editCertificationForm" method="post" action="<?= base_url('/student/update-certification') ?>">
        <input type="hidden" name="certification_id" id="certification_id">

        <div class="modal-header border-0">
          <h5 class="modal-title" id="editCertificationModalTitle">Edit Certification</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label>Certificate Name</label>
            <input type="text" name="certificate_name" id="certification_name" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Issuing Organization</label>
            <input type="text" name="issuing_organization" id="certification_organization" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Issue Date</label>
            <input type="date" name="issue_date" id="certification_issue_date" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Expiry Date</label>
            <input type="date" name="expiry_date" id="certification_expiry_date" class="form-control">
          </div>
          <div class="col-md-6">
            <label>ID / Number</label>
            <input type="text" name="reg_no" id="certification_reg_no" class="form-control">
          </div>
          <div class="col-md-6">
            <label>URL</label>
            <input type="url" name="url" id="certification_url" class="form-control">
          </div>
        </div>

        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete Certification Modal -->
<div class="modal fade" id="deleteCertificationModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="deleteCertificationForm" method="post" action="<?= base_url('/student/delete-certification') ?>">
        <input type="hidden" name="delete_certification_id" id="delete_certification_id">
        <div class="modal-header border-0">
          <h5 class="modal-title">Delete Certification</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <p class="mb-0">
            Are you sure you want to delete the certification: 
            <strong id="delete_certification_title_label">this certificate</strong>?
          </p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Projects & Publications Modal -->
<div class="modal fade" id="projectsPublicationsModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="projectsPublicationsForm">
        <div class="modal-header">
          <h5 class="modal-title">Add Project / Publication</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Type</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="publishing_type" value="Project" required>
              <label class="form-check-label">Project</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="publishing_type" value="Publication" required>
              <label class="form-check-label">Publication</label>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Publisher</label>
            <input type="text" class="form-control" name="publisher">
          </div>

          <div class="mb-3">
            <label class="form-label">Completion Date</label>
            <input type="date" class="form-control" name="completion_date">
          </div>

          <div class="mb-3">
            <label class="form-label">Authors / Co-Authors</label>
            <textarea class="form-control" name="authors"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Publication / Project URL</label>
            <input type="url" class="form-control" name="publication_url">
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="saveProjectsPublicationsBtn" class="btn btn-primary">Save</button>
        </div>
      </form>
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

<!-- Resume Upload Modal -->
<div class="modal fade" id="resumeUploadModal" tabindex="-1" aria-labelledby="resumeUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('student/uploadDocument') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="document_type" value="RESUME">

        <div class="modal-header">
          <h5 class="modal-title" id="resumeUploadModalLabel">Upload Resume</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <label for="resumeFile" class="form-label">Choose your resume file</label>
          <input type="file" id="resumeFile" name="document_file" class="form-control" accept=".pdf,.doc,.docx" required>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Upload</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
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
             <label for="gender" class="form-label">Gender</label>
             <?= (new \App\Libraries\GlobalData())->renderGenderDropdown('gender', old('gender', $student['gender'] ?? '')) ?>
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
            <label>Reg no/Roll no</label>
            <input type="text" name="reg_no" class="form-control" value="<?= esc($student['reg_no']) ?>">
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

<!-- Placement Offers Modal -->
<div class="modal fade" id="placementOffersModal" tabindex="-1" aria-labelledby="placementOffersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="<?= base_url('student/savePlacementOffer') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Placement Offer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Company Name</label>
              <input type="text" name="company_name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Job Title</label>
              <input type="text" name="job_title" class="form-control" required>
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Offered Salary (LPA)</label>
              <input type="number" step="0.1" name="offered_salary" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Application Status</label>
              <?= (new \App\Libraries\GlobalData())->renderApplicationStatusDropdown('status', old('status')) ?>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Offer Status</label>
              <?= (new \App\Libraries\GlobalData())->renderOfferStatusDropdown('offer_status', old('offer_status')) ?>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Languages Modal -->
<div class="modal fade" id="languagesModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form method="post" action="<?= base_url('/student/save-language') ?>">
        <div class="modal-header border-0">
          <h5 class="modal-title">Add Language</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label>Language</label>
            <?= (new \App\Libraries\GlobalData())->renderSelect('language_name', ['English', 'Hindi', 'Tamil', 'Telugu', 'Kannada'], old('language_name')) ?>
          </div>

          <div class="col-md-6">
            <label>Proficiency</label>
            <?= (new \App\Libraries\GlobalData())->renderProficiencyLevelDropdown('proficiency', old('proficiency')) ?>
          </div>

          <div class="col-md-4 form-check">
            <input class="form-check-input" type="checkbox" name="can_read" id="can_read" value="1">
            <label class="form-check-label" for="can_read">Can Read</label>
          </div>

          <div class="col-md-4 form-check">
            <input class="form-check-input" type="checkbox" name="can_write" id="can_write" value="1">
            <label class="form-check-label" for="can_write">Can Write</label>
          </div>

          <div class="col-md-4 form-check">
            <input class="form-check-input" type="checkbox" name="can_speak" id="can_speak" value="1">
            <label class="form-check-label" for="can_speak">Can Speak</label>
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

<!-- Family Details Edit Modal -->
<div class="modal fade" id="editFamilyModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="familyDetailsForm" method="post" action="<?= base_url('/student/save-family-detail') ?>">
        <input type="hidden" name="family_id" id="family_id">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="familyModalTitle">Add Family Detail</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label for="relation" class="form-label">Relation</label>
            <?= (new \App\Libraries\GlobalData())->renderRelationTypeDropdown('relation', old('relation')) ?>
          </div>
          <div class="col-md-6">
            <label>Name</label>
            <input type="text" name="name" id="family_name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Occupation</label>
            <input type="text" name="occupation" id="family_occupation" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Contact</label>
            <input type="text" name="contact" id="family_contact" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Mobile</label>
            <input type="text" name="mobile" id="family_mobile" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Email ID</label>
            <input type="email" name="email" id="family_email" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Salary</label>
            <input type="number" name="salary" id="family_salary" class="form-control">
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

<!-- Delete Family Detail Modal -->
<div class="modal fade" id="deleteFamilyModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="deleteFamilyForm" method="post" action="<?= base_url('/student/delete-family-detail') ?>">
        <input type="hidden" name="delete_family_id" id="delete_family_id">
        <div class="modal-header border-0">
          <h5 class="modal-title">Delete Family Member</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <p class="mb-0">
            Are you sure you want to delete <strong id="delete_family_name_label">this family member</strong>?
          </p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Language Modal -->
<div class="modal fade" id="editLanguageModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="editLanguageForm" method="post" action="<?= base_url('/student/update-language') ?>">
        <input type="hidden" name="language_id" id="edit_language_id">

        <div class="modal-header border-0">
          <h5 class="modal-title">Edit Language</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label>Language</label>
            <?= (new \App\Libraries\GlobalData())->renderSelect('language_name', ['English', 'Hindi', 'Tamil', 'Telugu', 'Kannada'], '') ?>
          </div>

          <div class="col-md-6">
            <label>Proficiency</label>
            <?= (new \App\Libraries\GlobalData())->renderProficiencyLevelDropdown('proficiency', '') ?>
          </div>

          <div class="col-md-4 form-check">
            <input class="form-check-input" type="checkbox" name="can_read" id="edit_can_read" value="1">
            <label class="form-check-label" for="edit_can_read">Can Read</label>
          </div>

          <div class="col-md-4 form-check">
            <input class="form-check-input" type="checkbox" name="can_write" id="edit_can_write" value="1">
            <label class="form-check-label" for="edit_can_write">Can Write</label>
          </div>

          <div class="col-md-4 form-check">
            <input class="form-check-input" type="checkbox" name="can_speak" id="edit_can_speak" value="1">
            <label class="form-check-label" for="edit_can_speak">Can Speak</label>
          </div>
        </div>

        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Delete Language Modal -->
<div class="modal fade" id="deleteLanguageModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="deleteLanguageForm" method="post" action="<?= base_url('/student/delete-language-detail') ?>">
        <input type="hidden" name="delete_language_id" id="delete_language_id">
        <div class="modal-header border-0">
          <h5 class="modal-title">Delete Language</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <p class="mb-0">
            Are you sure you want to delete <strong id="delete_language_name_label">this language</strong>?
          </p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Project / Publication Modal -->
<div class="modal fade" id="editProjectPublicationModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="editProjectPublicationForm" method="post" action="<?= base_url('/student/update-project-publication') ?>">
        <input type="hidden" name="id" id="project_id">

        <div class="modal-header">
          <h5 class="modal-title" id="editProjectModalTitle">Edit Project / Publication</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="project_title" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Type</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="publishing_type" value="Project" id="type_project" required>
              <label class="form-check-label" for="type_project">Project</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="publishing_type" value="Publication" id="type_publication" required>
              <label class="form-check-label" for="type_publication">Publication</label>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Publisher</label>
            <input type="text" class="form-control" name="publisher" id="project_publisher">
          </div>

          <div class="mb-3">
            <label class="form-label">Completion Date</label>
            <input type="date" class="form-control" name="completion_date" id="project_date">
          </div>

          <div class="mb-3">
            <label class="form-label">Authors / Co-Authors</label>
            <textarea class="form-control" name="authors" id="project_authors"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Publication / Project URL</label>
            <input type="url" class="form-control" name="publication_url" id="project_url">
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" id="project_description"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Delete Project/Publication Modal -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="deleteProjectForm" method="post" action="<?= base_url('/student/delete-project') ?>">
        <input type="hidden" name="delete_project_id" id="delete_project_id">
        <div class="modal-header border-0">
          <h5 class="modal-title">Delete Project / Publication</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <p class="mb-0">
            Are you sure you want to delete <strong id="delete_project_title_label">this entry</strong>?
          </p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Placement Offer Modal -->
<div class="modal fade" id="editPlacementModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="editPlacementForm" method="post" action="<?= base_url('/student/update-placement-offer') ?>">
        <input type="hidden" name="offer_id" id="edit_offer_id">

        <div class="modal-header border-0">
          <h5 class="modal-title">Edit Placement Offer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label>Company Name</label>
            <input type="text" name="company_name" id="edit_company_name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Job Title</label>
            <input type="text" name="job_title" id="edit_job_title" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Offered Salary (LPA)</label>
            <input type="number" name="offered_salary" id="edit_offered_salary" step="0.01" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Offer Status</label>
            <?= (new \App\Libraries\GlobalData())->renderOfferStatusDropdown('offer_status', old('offer_status')) ?>
          </div>
          <div class="col-md-6">
            <label class="form-label">Application Status</label>
            <?= (new \App\Libraries\GlobalData())->renderApplicationStatusDropdown('status', old('status')) ?>
          </div>
        </div>

        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Delete Placement Offer Modal -->
<div class="modal fade" id="deletePlacementModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <form id="deletePlacementForm" method="post" action="<?= base_url('/student/delete-placement-offer') ?>">
        <input type="hidden" name="delete_placement_id" id="delete_placement_id">
        <div class="modal-header border-0">
          <h5 class="modal-title">Delete Placement Offer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <p class="mb-0">
            Are you sure you want to delete the offer from 
            <strong id="delete_placement_company_label">this company</strong>?
          </p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
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
      const listGroup = document.querySelector("#skills .d-flex.flex-wrap.gap-2");
      if (listGroup) {
        const newItem = document.createElement("div");
        newItem.className = "badge rounded-pill bg-light text-dark border d-flex align-items-center";
          newItem.style.fontSize = "14px";
          newItem.style.padding = "10px 14px";
          newItem.innerHTML = `
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

        newItem.style.background = "#f9f9f9";
        newItem.innerHTML = `
          <span class="text-dark">${skillName}</span>
          <button 
              type="button"
              class="btn btn-sm btn-link text-dark ms-2 p-0 deleteSkillBtn"
              data-id="TEMP"
              data-skill="${skillName}"
              data-bs-toggle="modal"
              data-bs-target="#deleteSkillModal"
              style="line-height: 1; text-decoration: none;">
              &times;
            </button>
            `;
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

          const skillItem = document.querySelector(`.deleteSkillBtn[data-id="${skillId}"]`)?.closest('.badge');
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
    const container = document.getElementById("semesterInputs");
    const addBtn = document.getElementById("addSemesterBtn");

    addBtn.addEventListener("click", function () {
        const count = container.querySelectorAll(".semester-group").length + 1;

        const div = document.createElement("div");
        div.className = "d-flex align-items-center mb-2 semester-group";

        div.innerHTML = `
            <input type="text" name="semesters[]" class="form-control me-2" placeholder="Semester ${count} SGPA/CGPA">
            <button type="button" class="btn btn-danger btn-sm remove-semester">X</button>
        `;

        container.appendChild(div);
    });

    container.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-semester")) {
            e.target.closest(".semester-group").remove();
        }
    });
});
</script>


<script>
  function openFamilyModal() {
    document.getElementById("familyDetailsForm").reset();
    document.getElementById("family_id").value = "";
    document.getElementById("familyModalTitle").textContent = "Add Family Detail";
  }

  function editFamily(data) {
    const modal = new bootstrap.Modal(document.getElementById('editFamilyModal'));
    document.getElementById("familyModalTitle").textContent = "Edit Family Detail";

    document.getElementById("family_id").value = data.id;
    document.getElementById("family_name").value = data.name;
    document.getElementById("family_occupation").value = data.occupation;
    document.getElementById("family_contact").value = data.contact;
    document.getElementById("family_mobile").value = data.mobile;
    document.getElementById("family_email").value = data.email;
    document.getElementById("family_salary").value = data.salary;

    // Set dropdown
    document.querySelector("#familyDetailsForm select[name='relation']").value = data.relation;

    modal.show();
  }

</script>

<script>
  function confirmDeleteFamily(id, name) {
    document.getElementById('delete_family_id').value = id;
    document.getElementById('delete_family_name_label').textContent = name;
    const modal = new bootstrap.Modal(document.getElementById('deleteFamilyModal'));
    modal.show();
  }
</script>

<script>
  function editLanguage(data) {
    const modal = new bootstrap.Modal(document.getElementById('editLanguageModal'));
    document.getElementById("languageModalTitle").textContent = "Edit Language Detail";

    document.getElementById("language_id").value = data.id;

    // Set dropdowns
    document.querySelector("#languageForm select[name='language_name']").value = data.language_name;
    document.querySelector("#languageForm select[name='proficiency']").value = data.proficiency;

    // Set checkboxes
    document.getElementById("can_read").checked = data.can_read == 1;
    document.getElementById("can_write").checked = data.can_write == 1;
    document.getElementById("can_speak").checked = data.can_speak == 1;

    modal.show();
 }

</script>

<script>
  function editLanguage(data) {
    const modal = new bootstrap.Modal(document.getElementById('editLanguageModal'));

    document.getElementById('edit_language_id').value = data.id;
    document.querySelector("#editLanguageForm select[name='language_name']").value = data.language_name;
    document.querySelector("#editLanguageForm select[name='proficiency']").value = data.proficiency;

    document.getElementById('edit_can_read').checked = data.can_read == 1;
    document.getElementById('edit_can_write').checked = data.can_write == 1;
    document.getElementById('edit_can_speak').checked = data.can_speak == 1;

    modal.show();
  }
</script>

 
<script>
  function confirmDeleteLanguage(id, name) {
    document.getElementById('delete_language_id').value = id;
    document.getElementById('delete_language_name_label').textContent = name;
    const modal = new bootstrap.Modal(document.getElementById('deleteLanguageModal'));
    modal.show();
  }
</script>

<script>
  function editProjectPublication(data) {
    const modal = new bootstrap.Modal(document.getElementById('editProjectPublicationModal'));
    document.getElementById("editProjectModalTitle").textContent = "Edit Project / Publication";

    document.getElementById("project_id").value = data.id;
    document.getElementById("project_title").value = data.title;
    document.getElementById("project_publisher").value = data.publisher;
    document.getElementById("project_date").value = data.completion_date;
    document.getElementById("project_authors").value = data.authors;
    document.getElementById("project_url").value = data.publication_url;
    document.getElementById("project_description").value = data.description;

    // Set radio buttons
    if (data.publishing_type === "Project") {
      document.getElementById("type_project").checked = true;
    } else if (data.publishing_type === "Publication") {
      document.getElementById("type_publication").checked = true;
    }

    modal.show();
  }
</script>


<script>
  function confirmDeleteProjectPublication(id, title) {
    document.getElementById('delete_project_id').value = id;
    document.getElementById('delete_project_title_label').textContent = title;
    const modal = new bootstrap.Modal(document.getElementById('deleteProjectModal'));
    modal.show();
  }
</script>

<script>
  function editPlacementOffer(data) {
    const modal = new bootstrap.Modal(document.getElementById('editPlacementModal'));

    document.getElementById("edit_offer_id").value = data.id;
    document.getElementById("edit_company_name").value = data.company_name;
    document.getElementById("edit_job_title").value = data.job_title;
    document.getElementById("edit_offered_salary").value = data.offered_salary;

    // Set dropdowns manually
    document.querySelector("#editPlacementForm select[name='status']").value = data.status;
    document.querySelector("#editPlacementForm select[name='offer_status']").value = data.offer_status;
    
    modal.show();
  }
</script>


<script>
  function confirmDeletePlacementOffer(id, companyName) {
    document.getElementById('delete_placement_id').value = id;
    document.getElementById('delete_placement_company_label').textContent = companyName;
    const modal = new bootstrap.Modal(document.getElementById('deletePlacementModal'));
    modal.show();
  }
</script>

<script>
  function editExperience(data) {
    const modal = new bootstrap.Modal(document.getElementById('editExperienceDetailsModal'));
    document.getElementById("editExperienceModalTitle").textContent = "Edit Experience";

    document.getElementById("experience_id").value = data.id;
    document.getElementById("experience_title").value = data.title;
    document.getElementById("employment_type").value = data.employment_type;
    document.getElementById("experience_organization").value = data.organization;
    document.getElementById("experience_joining_date").value = (data.joining_date && data.joining_date !== '0000-00-00') ? data.joining_date : '';
    document.getElementById("experience_end_date").value = (data.end_date && data.end_date !== '0000-00-00') ? data.end_date : '';
    document.getElementById("location_type").value = data.location_type;
    document.getElementById("experience_location").value = data.location;
    document.getElementById("experience_remarks").value = data.remarks;
    document.getElementById("experience_is_current").checked = data.is_current == 1;

    modal.show();
  }
</script>


<script>
  function confirmDeleteExperience(id, title) {
    document.getElementById('delete_experience_id').value = id;
    document.getElementById('delete_experience_title_label').textContent = title;
    const modal = new bootstrap.Modal(document.getElementById('deleteExperienceModal'));
    modal.show();
  }
</script>

<script>
  function editEducation(data) {
  const modal = new bootstrap.Modal(document.getElementById('editEducationDetailsModal'));
  document.getElementById("editEducationModalTitle").textContent = "Edit Education";

  document.getElementById("education_id").value = data.id;
  document.querySelector('[name="qualification_type"]').value = data.qualification_type;
  document.getElementById("education_institution_name").value = data.institution_name;
  document.getElementById("education_board_university").value = data.board_university;
  document.getElementById("education_course_specialization").value = data.course_specialization;
  document.querySelector('[name="course_type"]').value = data.course_type;
  document.getElementById("education_year_of_passing").value = data.year_of_passing;
  document.getElementById("education_grade_percentage").value = data.grade_percentage;
  document.querySelector('[name="result_status"]').value = data.result_status;

  modal.show();
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const viewLinks = document.querySelectorAll('[data-doc-url]');
  const viewer = document.getElementById('documentViewer');
  const modalTitle = document.getElementById('viewDocumentModalLabel');

  viewLinks.forEach(link => {
    link.addEventListener('click', function () {
      const docUrl = this.getAttribute('data-doc-url');
      const docName = this.getAttribute('data-doc-name');
      viewer.src = docUrl;
      modalTitle.textContent = 'View Document - ' + docName;
    });
  });

  // Clear iframe and title when modal is closed
  document.getElementById('viewDocumentModal').addEventListener('hidden.bs.modal', function () {
    viewer.src = '';
    modalTitle.textContent = 'View Document';
  });
});
</script>

<script>
  function confirmDeleteEducation(id, qualification) {
    document.getElementById('delete_education_id').value = id;
    document.getElementById('delete_education_title_label').textContent = qualification;
    const modal = new bootstrap.Modal(document.getElementById('deleteEducationModal'));
    modal.show();
  }
</script>

<script>
  function editCertification(data) {
    const modal = new bootstrap.Modal(document.getElementById('editCertificationModal'));
    document.getElementById("editCertificationModalTitle").textContent = "Edit Certification";

    document.getElementById("certification_id").value = data.id;
    document.getElementById("certification_name").value = data.certificate_name;
    document.getElementById("certification_organization").value = data.issuing_organization;
    document.getElementById("certification_issue_date").value = data.issue_date;
    document.getElementById("certification_expiry_date").value = data.expiry_date;
    document.getElementById("certification_reg_no").value = data.reg_no;
    document.getElementById("certification_url").value = data.url;

    modal.show();
  }
</script>

<script>
  function confirmDeleteCertification(id, title) {
    document.getElementById('delete_certification_id').value = id;
    document.getElementById('delete_certification_title_label').textContent = title;
    const modal = new bootstrap.Modal(document.getElementById('deleteCertificationModal'));
    modal.show();
  }
</script>

<!-- Bootstrap JS -->
<!-- Make sure this is included at the bottom of your page (before </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>