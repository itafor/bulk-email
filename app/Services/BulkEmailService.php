<?php

namespace App\Services;

use App\Jobs\SendBulkEmailJob;
use App\Models\BulkEmail;

class BulkEmailService
{

    public function sendBulkEmail($request)
    {
        $emails =  explode(',', $request->emails);
        $details = $this->saveEmail($request);

        if (isset($emails)) {
            foreach ($emails as $email) {
                dispatch(new SendBulkEmailJob($email, $details));
            }
        }
        return $details;
    }

    public function saveEmail($request)
    {
        $bemail = new BulkEmail();
        $bemail->subject = $request->subject;
        $bemail->body = $request->body;
        $bemail->photo_url = isset($request->image) ? $this->uploadFile($request->image) : null;
        $bemail->save();
        return $bemail;
    }


    /**
     * To handle file Uploads
     * @param mixed $file
     *
     * @return array
     */
    public function uploadFile($file)
    {
        if ($file->isValid()) {
            $image_name = $file->getClientOriginalName();
            $image_name_withoutextensions = pathinfo($image_name, PATHINFO_FILENAME);
            $name = str_replace(" ", "", $image_name_withoutextensions);
            $image_extension = $file->getClientOriginalExtension();
            $file_name_extension = $name . '_' . self::getUniqueNineDigits() . '.' . $image_extension;
            $path = $file->storeAs('public/uploads', trim($file_name_extension));
            $full_path = url('/') . '/' . $file->storeAs('storage/uploads', trim($file_name_extension));

            return $full_path;
        }
    }

    public static function getUniqueNineDigits()
    {
        $nineDigitRandomNumber = mt_rand(100000000, 999999999);
        return $nineDigitRandomNumber;
    }
}
