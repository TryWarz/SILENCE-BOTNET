<?php

// App Settings
define('APP_DEBUG', false);

// API Settings
define('API_MAINTENANCE', false);
define('API_COOLDOWN_ENABLED', true);
define('API_COOLDOWN_TIME', 60); // Maximum allowed requests before cooldown
define('API_MAX_REQUESTS', 2); // Cooldown duration in seconds
define('API_MAX_SLOTS', 3);
define('API_TIMEOUT_AFTER', 3); // temps de réponse max pour une api avant de la skip

// App Settings
define('WEBHOOK_URL', "https://canary.discord.com/api/webhooks/1153040596953473024/RUu0pRQGMccvRLDI2_SE54bHh_ouBgjR6SncmYqNIae_rD_CSNKO0-OQE0FBA1aQ96O6");
define('WEBHOOK_ERROR', "https://canary.discord.com/api/webhooks/1154126888864862288/euW9nJWSptAVnRDP3t2uS4l0dy_KNVkvSaaTy8RKAROabkR61Fi6Td5Sq1sch41PIWZM");