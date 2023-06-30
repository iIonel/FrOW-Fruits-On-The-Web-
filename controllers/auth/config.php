<?php

$secretKey = bin2hex(random_bytes(32));
define('JWT_SECRET_KEY', $secretKey);
