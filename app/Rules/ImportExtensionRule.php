<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

class ImportExtensionRule implements Rule
{
    private $filename;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
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

        $extension = strtolower(request()->file($this->filename)->getClientOriginalExtension());

        return in_array($extension, ['csv', 'json']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The import file must be a file of type: json, csv.';
    }
}
