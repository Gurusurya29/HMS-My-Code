<?php

namespace App\Models\Miscellaneous;

use App\Models\Miscellaneous\Financialhelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Financialhelper extends Model
{
    public static function getNextSequenceId($digit, $name, $model)
    {
        $year = Carbon::now()->format('y');
        $object = $model::withTrashed()
            ->orderBy('created_at', 'desc')
            ->first();

        $now = Carbon::now();

        $lastId = (!$object) ? 0 : $object->sequence_id;

        $year = ($now->month < 4) ? $year - 1 : $year;
        $finacialyearobject = $model::withTrashed()
            ->whereBetween('created_at', [date(($year) . '-04-01'), date(($year + 1) . '-03-31')])->first();
        $lastId = (!$finacialyearobject) ? 0 : $lastId;

        return array(
            'uniqid' => $name . sprintf('%0' . $digit . 'd', intval($lastId) + 1) . '/' . $year . '-' . $year + 1,
            'sequence_id' => $lastId + 1,
            'sys_id' => md5(uniqid(rand(), true)),
        );
    }

    public static function hmsautogenerateid($digit, $prefix, $model)
    {
        if ($digit) {
            $model->uuid = (string) Str::uuid();
            $uniqueId = Financialhelper::getNextSequenceId($digit, $prefix, $model);
            $model->sys_id = $uniqueId['sys_id'];
            $model->uniqid = $uniqueId['uniqid'];
            $model->sequence_id = $uniqueId['sequence_id'];
        }
    }

    public static function pharmacyautogenerateid($digit, $prefix, $model)
    {
        if ($digit) {
            $model->uuid = (string) Str::uuid();
            $uniqueId = Financialhelper::getNextSequenceId($digit, $prefix, $model);
            $model->sys_id = $uniqueId['sys_id'];
            $model->uniqid = $uniqueId['uniqid'];
            $model->sequence_id = $uniqueId['sequence_id'];
        }
    }

    public static function investigationautogenerateid($digit, $prefix, $model)
    {
        if ($digit) {
            $model->uuid = (string) Str::uuid();
            $uniqueId = Financialhelper::getNextSequenceId($digit, $prefix, $model);
            $model->sys_id = $uniqueId['sys_id'];
            $model->uniqid = $uniqueId['uniqid'];
            $model->sequence_id = $uniqueId['sequence_id'];
        }
    }
}
