<?php

namespace NutriScore\Validators;


final class FileValidator extends AbstractValidator {
    private int $MAX_ALLOWED_FILE_SIZE;
    private array $ALLOWED_FILE_TYPES = ['image/jpeg', 'image/png'];

    public function __construct() {
        parent::__construct();

        $this->MAX_ALLOWED_FILE_SIZE = (int) str_replace('M', '000000', ini_get('upload_max_filesize'));
    }

    public function validate(mixed $data): void {
        parent::validate($data);

        $this->validateNotEmpty();
        $this->validateFileTypeAllowed();
        $this->validateFileSize();
    }

    protected function setFieldRules(): void {
        $this->addFieldRules(
            new ValidationRule('text', $this->data['text'], ['required', 'minLength' => 4, 'maxLength' => 100])
        );
    }

    private function validateNotEmpty(): void {
        if (empty($this->data) || $this->data['error'] === 4 || !$this->data['size'] > 0) {
            $this->validationObject->addError('root', _('You need to choose a file to upload'));
        }
    }

    private function validateFileTypeAllowed(): void {
        if (!in_array($this->data['type'], $this->ALLOWED_FILE_TYPES)) {
            $this->validationObject->addError('root', 'Please upload a file with valid file type');
        }
    }

    private function validateFileSize(): void {
        if ($this->data['size'] > $this->MAX_ALLOWED_FILE_SIZE) {
            $this->validationObject->addError('root', 'The size of the uploaded file is too big');
        }
    }
}