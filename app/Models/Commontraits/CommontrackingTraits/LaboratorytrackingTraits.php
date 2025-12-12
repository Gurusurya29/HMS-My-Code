<?php

namespace App\Models\Commontraits\CommontrackingTraits;

use App\Models\Laboratory\Auth\Laboratory;
use App\Models\Laboratory\Laboratory\Labpatient;
use App\Models\Laboratory\Laboratory\Labpatientlist;
use App\Models\Laboratory\Scan\Scanpatient;
use App\Models\Laboratory\Scan\Scanpatientlist;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigationgroup\Labinvestigationgroup;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigation\Labinvestigation;
use App\Models\Laboratory\Settings\Laboratorymaster\Labreporttemplate\Labreporttemplate;
use App\Models\Laboratory\Settings\Laboratorymaster\Labtestmethod\Labtestmethod;
use App\Models\Laboratory\Settings\Laboratorymaster\Labunit\Labunit;
use App\Models\Laboratory\Xray\Xraypatient;
use App\Models\Laboratory\Xray\Xraypatientlist;

trait LaboratorytrackingTraits
{
    public function laboratorycreatable()
    {
        return $this->morphOne(Laboratory::class, 'creatable');
    }

    public function laboratoryupdatable()
    {
        return $this->morphMany(Laboratory::class, 'updatable');
    }

    //  Lab Report template
    public function labreporttemplatecreatable()
    {
        return $this->morphMany(Labreporttemplate::class, 'creatable');
    }

    public function labreporttemplateupdatable()
    {
        return $this->morphMany(Labreporttemplate::class, 'updatable');
    }

    //  Lab Category
    public function labinvestigationgroupcreatable()
    {
        return $this->morphMany(Labinvestigationgroup::class, 'creatable');
    }

    public function labinvestigationgroupupdatable()
    {
        return $this->morphMany(Labinvestigationgroup::class, 'updatable');
    }

    //  Lab Investigation
    public function labinvestigationcreatable()
    {
        return $this->morphMany(Labinvestigation::class, 'creatable');
    }

    public function labinvestigationupdatable()
    {
        return $this->morphMany(Labinvestigation::class, 'updatable');
    }

    //  Lab Unit
    public function labunitcreatable()
    {
        return $this->morphMany(Labunit::class, 'creatable');
    }

    public function labunitupdatable()
    {
        return $this->morphMany(Labunit::class, 'updatable');
    }

    // Lab Patient
    public function labpatientcreatable()
    {
        return $this->morphMany(Labpatient::class, 'creatable');
    }

    public function labpatientupdatable()
    {
        return $this->morphMany(Labpatient::class, 'updatable');
    }

    // Lab Patient List
    public function labpatientlistcreatable()
    {
        return $this->morphMany(Labpatientlist::class, 'creatable');
    }

    public function labpatientlistupdatable()
    {
        return $this->morphMany(Labpatientlist::class, 'updatable');
    }

    //  Scan Patient
    public function scanpatientcreatable()
    {
        return $this->morphMany(Scanpatient::class, 'creatable');
    }

    public function scanpatientupdatable()
    {
        return $this->morphMany(Scanpatient::class, 'updatable');
    }

    //  Scan Patient List
    public function scanpatientlistcreatable()
    {
        return $this->morphMany(Scanpatientlist::class, 'creatable');
    }

    public function scanpatientlistupdatable()
    {
        return $this->morphMany(Scanpatientlist::class, 'updatable');
    }

    // Xray Patient
    public function xraypatientcreatable()
    {
        return $this->morphMany(Xraypatient::class, 'creatable');
    }

    public function xraypatientupdatable()
    {
        return $this->morphMany(Xraypatient::class, 'updatable');
    }

    // Xray Patient List
    public function xraypatientlistcreatable()
    {
        return $this->morphMany(Xraypatientlist::class, 'creatable');
    }

    public function xraypatientlistupdatable()
    {
        return $this->morphMany(Xraypatientlist::class, 'updatable');
    }

    // Lab Test Method
    public function labtestmethodcreatable()
    {
        return $this->morphMany(Labtestmethod::class, 'creatable');
    }

    public function labtestmethodupdatable()
    {
        return $this->morphMany(Labtestmethod::class, 'updatable');
    }

}
