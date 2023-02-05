<?php

namespace NutriScore\Validators;

class FileValidator extends FormValidator {
    private int $MAX_ALLOWED_FILE_SIZE;

    public function __construct(array $formInput) {
        parent::__construct($formInput);

        $this->MAX_ALLOWED_FILE_SIZE = (int) str_replace('M', '000000', ini_get('upload_max_filesize'));
    }

    public function validate(): void {
        parent::validate();

        $this->validateImageNotEmpty();
        $this->validateValidFileType();
        $this->validateFileSize();
    }

    private function validateImageNotEmpty(): void {
        if (empty($this->formInput) || $this->formInput['error'] === 4) {
            $this->errors['file'][] = 'You need to choose an image file';
        }
    }

    private function validateValidFileType(): void {
        if (isset($this->formInput['type']) && !str_contains($this->formInput['type'], 'image/')) {
            $this->errors['file'][] = 'Invalid file type';
        }
    }

    private function validateFileSize(): void {
        if ($this->formInput['size'] > $this->MAX_ALLOWED_FILE_SIZE) {
            $this->errors['file'][] = 'File size is too big';
        }
    }
}