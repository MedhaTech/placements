<?php

namespace App\Libraries;

use PhpParser\Node\Stmt\Global_;

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

    // ✅ Reusable Yes/No Dropdown
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
}
