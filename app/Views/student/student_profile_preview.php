<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Profile - True Replica</title>
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
  </style>
</head>
<body>
<div class="container-custom">
  <!-- Top Full Width Profile Card -->
  <div class="profile-card">
    <div class="profile-info">
      <div class="profile-photo">
        <div class="progress-circle">5%</div>
      </div>
      <div class="details">
        <h5>Zainab Fathima BCA CC ✏️</h5>
        <small>Profile last updated - Yesterday</small>
        <p>📍 Add location</p>
        <p>🧑‍🎓 Fresher</p>
        <p>📅 Add availability to join</p>
      </div>
    </div>
    <div class="prompt-box">
      <ul class="ps-3">
        <li>📱 Verify mobile number <span class="text-success">+10%</span></li>
        <li>📍 Add preferred location <span class="text-success">+2%</span></li>
        <li>📄 Add resume <span class="text-success">+10%</span></li>
      </ul>
      <button class="btn">Add 14 missing details</button>
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
        <h5>Profile Summary <a href="#" data-bs-toggle="modal" data-bs-target="#profileSummaryModal">Add</a></h5>
        <p>Give recruiters a brief overview of your career goals, strengths, and profile interests.</p>
      </div>
      <div id="personal-info" class="section-card"><h5>Personal Information <a href="#">Add</a></h5></div>
      <div id="family-details" class="section-card">
        <h5>Family Details 
          <a href="#" data-bs-toggle="modal" data-bs-target="#familyDetailsModal">Add</a>
        </h5>
         <div id="familyDetailsList" class="mt-3"></div>
      </div>
      <div id="experience" class="section-card"><h5>Experience Details <a href="#">Add</a></h5></div>
      <div id="skills" class="section-card"><h5>Key Skills <a href="#">Add</a></h5></div>
      <div id="education" class="section-card"><h5>Education Details <a href="#">Add</a></h5></div>
      <div id="certifications" class="section-card"><h5>Licenses & Certifications <a href="#">Add</a></h5></div>
      <div id="projects" class="section-card"><h5>Projects & Publications <a href="#">Add</a></h5></div>
      <div id="languages" class="section-card"><h5>Languages <a href="#">Add</a></h5></div>
      <div id="academic-info" class="section-card"><h5>Current Academic Information <a href="#">Add</a></h5></div>
      <div id="preferences" class="section-card"><h5>Placement Preferences <a href="#">Add</a></h5></div>
      <div id="training" class="section-card"><h5>Placement Training <a href="#">Add</a></h5></div>
      <div id="offers" class="section-card"><h5>Placement Offers <a href="#">Add</a></h5></div>
      <div id="documents" class="section-card"><h5>Documents <a href="#">Upload</a></h5></div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="profileSummaryModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 16px;">
      <div class="modal-header border-0">
        <h5 class="modal-title">Profile Summary <span class="text-success">+8%</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Give recruiters a brief overview of your career goals, key achievements, and interests.</p>
        <textarea class="form-control" rows="6" maxlength="1000" placeholder="Type here..."></textarea>
        <div class="text-end small text-muted mt-1">1000 characters left</div>
      </div>
      <div class="modal-footer border-0">
        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary">Save</button>
      </div>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function addFamilyEntry() {
  const container = document.getElementById("familyInputs");
  const entry = container.querySelector(".family-entry").cloneNode(true);
  
  // Clear all input values in the new entry
  entry.querySelectorAll("input, select").forEach(el => el.value = "");
  container.appendChild(entry);
}

document.querySelector("#familyDetailsModal .btn.btn-primary").addEventListener("click", function () {
  const form = document.getElementById("familyForm");
  const entries = form.querySelectorAll(".family-entry");
  const output = document.getElementById("familyDetailsList");

  entries.forEach(entry => {
    const relation = entry.querySelector("select[name='relation[]']").value;
    const name = entry.querySelector("input[name='name[]']").value;
    const occupation = entry.querySelector("input[name='occupation[]']").value;
    const contact = entry.querySelector("input[name='contact[]']").value;
    const mobile = entry.querySelector("input[name='mobile[]']").value;
    const email = entry.querySelector("input[name='email[]']").value;
    const salary = entry.querySelector("input[name='salary[]']").value;

    // Only add if at least one field is filled
    if (relation || name || occupation || contact || mobile || email || salary) {
      const card = document.createElement("div");
      card.className = "p-3 mb-2 border rounded bg-light";

      card.innerHTML = `
        <strong>${relation || 'Relation'}:</strong> ${name || 'N/A'}<br>
        <small>Occupation: ${occupation || 'N/A'}, Contact: ${contact || 'N/A'}</small><br>
        <small>Mobile: ${mobile || 'N/A'}, Email: ${email || 'N/A'}</small><br>
        <small>Salary: ${salary || 'N/A'}</small>
      `;

      output.appendChild(card);
    }
  });

  // Clear form after save
  document.getElementById("familyInputs").innerHTML = document.querySelector(".family-entry").outerHTML;
  form.reset();

  // Close the modal
  const modal = bootstrap.Modal.getInstance(document.getElementById('familyDetailsModal'));
  modal.hide();
});
</script>
</body>
</html>
