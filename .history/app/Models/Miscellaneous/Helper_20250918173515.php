<?php

namespace App\Models\Miscellaneous;

use App\Models\Admin\Settings\Tracking\Logininfo;
// use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class Helper extends Model
{
    public static function getNextSequenceId($digit, $name, $model)
    {
        $object = $model::withTrashed()
            ->orderBy('sequence_id', 'desc')
            ->first();

        $lastId = (!$object) ? 0 : $object->sequence_id;

        return array(
            'uniqid' => 'ENH-' . $name . '-' . sprintf('%0' . $digit . 'd', intval($lastId) + 1),
            'sequence_id' => $lastId + 1,
            'sys_id' => md5(uniqid(rand(), true)),
        );
    }

    public static function trackmessage($user, $functionable, $function, $sessionid, $type, $trackmsg)
    {
        $user->trackable()
            ->make([
                'name' => $user->name,
                'uniqid' => $user->uniqid,
                'function' => $function,
                'trackmsg' => $trackmsg,
                'sessionid' => $sessionid,
                'type' => $type,
            ])->functionable()
            ->associate($functionable)
            ->save();
    }

    public static function deviceInfo($user, $sessionid, $type)
    {
        $agent = new Agent();
        $user->logininfoable()
            ->save(new Logininfo([
                'device' => $agent->device(),
                'robot' => $agent->robot(),
                'browser' => $agent->browser(),
                'browser_v' => $agent->version($agent->browser()),
                'platform' => $agent->platform(),
                'platform_v' => $agent->version($agent->platform()),
                'languages' => json_encode($agent->languages()),
                'serverIp' => request()->ip(),
                'clientIp' => Helper::getIp(),
                'user_name' => $user->name,
                'user_uniqid' => $user->uniqid,
                'login_status' => true,
                'email' => $user->email,
                'sessionid' => $sessionid,
                'type' => $type,
            ]));
    }

    public static function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    public static function autogenerateid($digit, $prefix, $model)
    {
        if ($digit) {
            $uniqueId = Helper::getNextSequenceId($digit, $prefix, $model);
            $model->uuid = (string) Str::uuid();
            $model->sys_id = $uniqueId['sys_id'];
            $model->uniqid = $uniqueId['uniqid'];
            $model->sequence_id = $uniqueId['sequence_id'];
        }
    }

    public static function getPatientNextSequenceId($digit, $prefix, $uhid_prefix, $patientid_prefix, $model)
    {
        $object = $model::withTrashed()
            ->orderBy('sequence_id', 'desc')
            ->first();

        $lastId = (!$object) ? 0 : $object->sequence_id;

        return $insertDataTwo = array(
            'uniqid' => $prefix . '-' . sprintf('%0' . $digit . 'd', intval($lastId) + 1),
            'uhid' => 'ENH-' . $uhid_prefix . '-' . sprintf('%0' . $digit . 'd', intval($lastId) + 1),
            'patient_sys_id' => $patientid_prefix . '-' . sprintf('%0' . $digit . 'd', intval($lastId) + 1),
            'sequence_id' => $lastId + 1,
            'sys_id' => md5(uniqid(rand(), true)),
        );
    }

    public static function patientautogenerateid($digit, $prefix, $uhid_prefix, $patientid_prefix, $model)
    {
        if ($digit) {
            $model->uuid = (string) Str::uuid();
            $uniqueId = Helper::getPatientNextSequenceId($digit, $prefix, $uhid_prefix, $patientid_prefix, $model);
            $model->sys_id = $uniqueId['sys_id'];
            $model->uniqid = $uniqueId['uniqid'];
            $model->uhid = $uniqueId['uhid'];
            $model->patient_sys_id = $uniqueId['patient_sys_id'];
            $model->sequence_id = $uniqueId['sequence_id'];
        }
    }

    public static function getPatientVisitSequenceId($digit, $tokendigit, $name, $model)
    {
        $object = $model::withTrashed()
            ->orderBy('sequence_id', 'desc')
            ->first();

        $lastId = (!$object) ? 0 : $object->sequence_id;

        $objecttwo = $model::withTrashed()
            ->whereDate('created_at', Carbon::today())
            ->count();

        $lastIdtwo = (!$object) ? 0 : $objecttwo;

        return array(
            'uniqid' => 'ENH-' . $name . '-' . sprintf('%0' . $digit . 'd', intval($lastId) + 1),
            'sequence_id' => $lastId + 1,
            'sys_id' => md5(uniqid(rand(), true)),
            'token_id' => sprintf('%0' . $tokendigit . 'd', intval($lastIdtwo) + 1),
        );
    }

    public static function patientvisitautogenerateid($digit, $tokendigit, $name, $model)
    {
        if ($digit) {
            $model->uuid = (string) Str::uuid();
            $uniqueId = Helper::getPatientVisitSequenceId($digit, $tokendigit, $name, $model);
            $model->sys_id = $uniqueId['sys_id'];
            $model->uniqid = $uniqueId['uniqid'];
            $model->token_id = $uniqueId['token_id'];
            $model->sequence_id = $uniqueId['sequence_id'];
        }
    }

    public static function pharmacyautogenerateid($digit, $prefix, $model, $spl = false)
    {
        if ($digit) {
            $model->uuid = (string) Str::uuid();
            if ($spl) {
                $uniqueId = Helper::pharmsplgetNextSequenceId($digit, $prefix, $model);
            } else {
                $uniqueId = Helper::getNextSequenceId($digit, $prefix, $model);
            }
            $model->sys_id = $uniqueId['sys_id'];
            $model->uniqid = $uniqueId['uniqid'];
            $model->sequence_id = $uniqueId['sequence_id'];
        }
    }

    public static function pharmsplgetNextSequenceId($digit, $name, $model)
    {
        $object = $model::withTrashed()
            ->orderBy('sequence_id', 'desc')
            ->first();

        $lastId = (!$object) ? 0 : $object->sequence_id;

        return array(
            'uniqid' => 'ENH-' . $name . sprintf('%0' . $digit . 'd', intval($lastId) + 1),
            'sequence_id' => $lastId + 1,
            'sys_id' => md5(uniqid(rand(), true)),
        );
    }

    public static function laboratoryautogenerateid($digit, $prefix, $model)
    {
        if ($digit) {
            $model->uuid = (string) Str::uuid();
            $uniqueId = Helper::getNextSequenceId($digit, $prefix, $model);
            $model->sys_id = $uniqueId['sys_id'];
            $model->uniqid = $uniqueId['uniqid'];
            $model->sequence_id = $uniqueId['sequence_id'];
        }
    }

}
