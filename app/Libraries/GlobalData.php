<?php

namespace App\Libraries;

class GlobalData
{
    public function getRelationTypes()
    {
        return ['Father', 'Mother', 'Guardian', 'Brother', 'Sister'];
    }

    public function getEmploymentTypes()
    {
        return ['Full-time', 'Part-time', 'Self-Employed', 'Freelance', 'Internship', 'Trainee'];
    }

    public function getLocationTypes()
    {
        return ['On-site', 'Hybrid', 'Remote'];
    }

    public function getCourseTypes()
    {
        return ['Full Time', 'Part Time', 'Correspondence', 'Distance Learning'];
    }

    public function getResultStatuses()
    {
        return ['Passed', 'Pursuing', 'Waiting for Results'];
    }

    public function getQualificationTypes()
    {
        return ['X / SSC', 'XII / PUC', 'Diploma', 'Graduation', 'Post Graduation', 'Ph.D'];
    }

    public function getProficiencyLevels()
    {
        return ['Beginner', 'Proficient', 'Expert'];
    }

    public function getPursuingDegrees()
    {
        return ['UG', 'PG', 'Ph.D.'];
    }

    public function getEntryTypes()
    {
        return ['Regular', 'Lateral'];
    }

    public function getAdmissionModes()
    {
        return ['Through Management', 'Through Entrance', 'Others'];
    }

    public function getYesNoOptions()
    {
        return ['Yes', 'No'];
    }

    public function getSpecificChoices()
    {
        return [
            'Yes' => [
                'Software/IT Job',
                'Core domain job',
                'Sales/Marketing/Business Development'
            ],
            'No' => [
                'Higher Studies',
                'Govt. Jobs',
                'Business'
            ]
        ];
    }

    public function getApplicationStatuses()
    {
        return ['Eligible', 'Applied', 'In Process', 'Selected', 'Rejected', 'Waiting for Results'];
    }

    public function getOfferStatuses()
    {
        return ['Accepted', 'Rejected', 'On Hold'];
    }


    public function getDocumentTypes()
     {
         return [
            'Photo',
            'PAN Card',
            'Aadhar Card',
            'College ID Card',
            'Resume',
            'Passport',
            'X Certificate',
            'XII Certificate',
            'UG Certificate',
            'PG Certificate',
            'Diploma Certificate',
            'Internship Certificate',
            'Experience Certificate',
            'Skill Certificate',
            'Offer Letter'
        ];
    }


    // ✅ Below are reusable dropdown generators

    public function renderSelect($name, $options, $selected = null, $class = 'form-select')
{
    $html = "<select name='$name' class='$class'>\n";
    $html .= "<option value=''>Select</option>\n"; // 🔥 Added this line
    foreach ($options as $opt) {
        $isSelected = $selected === $opt ? 'selected' : '';
        $html .= "<option value='" . esc($opt) . "' $isSelected>" . esc($opt) . "</option>\n";
    }
    $html .= "</select>";
    return $html;
}


    // Individual renderers
    public function renderRelationTypeDropdown($name = 'relation', $selected = null)
    {
        return $this->renderSelect($name, $this->getRelationTypes(), $selected);
    }

    public function renderEmploymentTypeDropdown($name = 'employment_type', $selected = null)
    {
        return $this->renderSelect($name, $this->getEmploymentTypes(), $selected);
    }

    public function renderLocationTypeDropdown($name = 'location', $selected = null)
    {
        return $this->renderSelect($name, $this->getLocationTypes(), $selected);
    }

    public function renderCourseTypeDropdown($name = 'course_type', $selected = null)
    {
        return $this->renderSelect($name, $this->getCourseTypes(), $selected);
    }

    public function renderResultStatusDropdown($name = 'result_status', $selected = null)
    {
        return $this->renderSelect($name, $this->getResultStatuses(), $selected);
    }

    public function renderQualificationTypeDropdown($name = 'qualification', $selected = null)
    {
        return $this->renderSelect($name, $this->getQualificationTypes(), $selected);
    }

    public function renderProficiencyLevelDropdown($name = 'proficiency', $selected = null)
    {
        return $this->renderSelect($name, $this->getProficiencyLevels(), $selected);
    }

    public function renderPursuingDegreeDropdown($name = 'pursuing_degree', $selected = null)
    {
        return $this->renderSelect($name, $this->getPursuingDegrees(), $selected);
    }

    public function renderEntryTypeDropdown($name = 'entry_type', $selected = null)
    {
        return $this->renderSelect($name, $this->getEntryTypes(), $selected);
    }

    public function renderAdmissionModeDropdown($name = 'admission_mode', $selected = null)
    {
        return $this->renderSelect($name, $this->getAdmissionModes(), $selected);
    }

    public function renderYesNoDropdown($name = 'yes_no', $selected = null)
    {
        return $this->renderSelect($name, $this->getYesNoOptions(), $selected);
    }

    public function renderApplicationStatusDropdown($name = 'application_status', $selected = null)
    {
        return $this->renderSelect($name, $this->getApplicationStatuses(), $selected);
    }

    public function renderOfferStatusDropdown($name = 'offer_status', $selected = null)
    {
        return $this->renderSelect($name, $this->getOfferStatuses(), $selected);
    }

    public function renderDocumentTypeDropdown($name = 'document_type', $selected = null)
    {
        return $this->renderSelect($name, $this->getDocumentTypes(), $selected);
    }

}
