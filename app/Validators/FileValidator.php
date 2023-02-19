<?php

namespace NutriScore\Validators;


class FileValidator extends AbstractValidator {
    private int $MAX_ALLOWED_FILE_SIZE;
    private array $ALLOWED_FILE_TYPES;

    public function __construct(mixed $data, array $allowedTypes = ['image/jpeg', 'image/png']) {
        parent::__construct($data);

        $this->MAX_ALLOWED_FILE_SIZE = (int) str_replace('M', '000000', ini_get('upload_max_filesize'));
        $this->ALLOWED_FILE_TYPES = $allowedTypes;
    }

    public function validate(): void {
        parent::validate();

        $this->validateNotEmpty();
        $this->validateFileTypeAllowed();
        $this->validateFileSize();

        $this->addFieldRules(
            new ValidationRule('text', $this->data['text'], ['required', 'minLength' => 4, 'maxLength' => 100])
        );
    }

    private function validateNotEmpty(): void {
        if (empty($this->data) || $this->data['error'] === 4 || !$this->data['size'] > 0) {
            $this->validationObject->addError('file', _('You need to choose a file to upload'));
        }
    }

    private function validateFileTypeAllowed(): void {
        if (!in_array($this->data['type'], $this->ALLOWED_FILE_TYPES)) {
            $this->validationObject->addError('file', 'Please upload a file with valid file type');
        }
    }

    private function validateFileSize(): void {
        if ($this->data['size'] > $this->MAX_ALLOWED_FILE_SIZE) {
            $this->validationObject->addError('file', 'The size of the uploaded file is too big');
        }
    }
}