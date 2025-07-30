<?= $this->extend('student/layout/default') ?>
<?= $this->section('content') ?>

<style>
    .number-badge {
        background: none;
        color: #000;
        font-weight: 500;
        font-size: 15px;
        padding: 0;
        width: 20px;
        display: inline-block;
        text-align: center;
    }

    .company-name {
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 4px;
        color: #333;
    }

    .job-detail {
        font-size: 13px;
        color: #555;
        margin-bottom: 2px;
    }

    .mt-custom {
        margin-top: 40px;
    }
</style>

<div class="container-fluid mt-custom">
    <div class="row">
        <!-- Left Side: Current Openings -->
        <div class="col-lg-6">
            <div class="widget-holder widget-full-height widget-flex">
                <div class="widget-bg">
                    <div class="widget-heading">
                        <h5 class="widget-title">Current Openings</h5>
                    </div>
                    <div class="widget-body">
                        <div class="widget-todo">
                            <?php $count = 1; foreach ($jobOpenings as $job): ?>
                                <div class="single media mb-3">
                                    <div class="align-self-start mr-3">
                                        <span class="number-badge"><?= $count++ ?>.</span>
                                    </div>
                                    <div class="media-body">
                                        <div class="company-name"><?= esc($job['company_name']) ?></div>
                                        <div class="job-detail"><strong>Job Profile:</strong> <?= esc($job['job_profile']) ?></div>
                                        <div class="job-detail">
                                            <strong>Vacancies:</strong> <?= esc($job['vacancies']) ?> &nbsp;&nbsp;
                                            <strong>CTC:</strong> <?= esc($job['ctc_package']) ?> &nbsp;&nbsp;
                                            <strong>Location:</strong> <?= esc($job['job_location']) ?>
                                        </div>

                                        <div class="job-detail"><strong>Eligibility:</strong> <?= esc($job['eligibility_criteria']) ?></div>
                                    </div>
                                    <div class="align-self-center ml-3">
                                        <form method="post" action="<?= site_url('student/apply') ?>">
                                            <input type="hidden" name="job_id" value="<?= esc($job['requirement_id']) ?>">
                                            <button type="submit" class="btn btn-sm px-3 btn-rounded btn-success text-uppercase fw-600 fs-11">Apply</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Applications -->
        <div class="col-lg-6">
            <div class="widget-holder widget-full-height widget-flex">
                <div class="widget-bg">
                    <div class="widget-heading">
                        <h5 class="widget-title">My Applications</h5>
                    </div>
                    <div class="widget-body">
                        <div class="widget-todo">
                            <?php if (!empty($appliedJobs)): ?>
                                <?php $aCount = 1; foreach ($appliedJobs as $applied): ?>
                                    <div class="single media mb-3">
                                        <div class="align-self-start mr-3">
                                            <span class="number-badge"><?= $aCount++ ?>.</span>
                                        </div>
                                        <div class="media-body">
                                            <div class="company-name"><?= esc($applied['company_name']) ?></div>
                                            <div class="job-detail"><strong>Job Profile:</strong> <?= esc($applied['job_profile']) ?></div>
                                            <div class="job-detail"><strong>Location:</strong> <?= esc($applied['job_location']) ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">You haven't applied to any jobs yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
