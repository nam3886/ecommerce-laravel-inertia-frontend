<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class FileAdjustment implements Rule
{
    private $file;
    private $isMultiple;
    private $rules;
    private $message;

    /**
     * Create a new rule instance.
     *  @param mixed $file
     *  @param bool $isMultiple
     *  @param array $rules check for each file
     * @return void
     */
    public function __construct(mixed $file, bool $isMultiple, array|string $rules = [])
    {
        $this->file = $file;
        $this->isMultiple = $isMultiple;
        $this->rules = $rules;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->message = "The {$attribute} field is invalid type.";

        // is multiple
        if ($this->isMultiple) {
            // case 1: is files
            $newFiles = collect($value)->filter(fn ($file) => $file instanceof UploadedFile);

            if (!empty($this->rules)) {
                $rules = ["{$attribute}.*" => $this->rules];

                $input = [$attribute => $newFiles->all()];

                $validator = Validator::make($input, $rules);

                if ($validator->fails()) {
                    $this->message = $validator->getMessageBag()->first();

                    return false;
                }
            }
            // case 2: is not files
            $notFiles = collect($value)->filter(fn ($file) => !$file instanceof UploadedFile);

            $paths = collect($this->file)->pluck('path');
            // kiểm tra những cái không phải UploadedFile có path = path file DB?
            $isOld = $notFiles->every(function ($file) use ($paths) {
                return isset($file['path']) && in_array($file['path'], $paths->all());
            });

            return $isOld;
        }

        // is single
        // case 1: is file
        if ($value instanceof UploadedFile) {
            if (empty($this->rules)) {
                return true;
            } else {
                $rules = [$attribute => $this->rules];

                $input = [$attribute => $value];

                $validator = Validator::make($input, $rules);

                $this->message = $validator->getMessageBag()->first();

                $isNotFails = !$validator->fails();

                return $isNotFails;
            }
        }
        // case 2: is not file
        return collect($value)->get('path') === $this->file->path;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
