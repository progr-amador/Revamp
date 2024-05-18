<?php

// Generate a CSRF token.

function generateCsrfToken(): string {
    
    return bin2hex(random_bytes(32));
}
