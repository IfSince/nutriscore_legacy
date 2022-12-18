<?php

function getPostParam(string $param): mixed {
    return $_POST[$param] ?? null;
}
