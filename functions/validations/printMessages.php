<?php
function printMessages(array $errors, $key): void {
    $formFieldErrors = $errors[$key] ?? null;
    if (isset($formFieldErrors)) {
        echo '<ul class="text-sm font-medium text-error pl-2">';
        foreach ($formFieldErrors as $message) {
            echo "<li>$message</li>";
        }
        echo '</ul>';
    }
}