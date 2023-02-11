<?php

namespace NutriScore\Enums;

enum MessageType: string {
    case ERROR = 'error';
    case WARNING = 'warning';
    case HINT = 'hint';
    case SUCCESS = 'success';
}
