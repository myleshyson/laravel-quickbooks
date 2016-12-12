<?php



return [
    'dsn' => env('DB_CONNECTION').'i://'.env('DB_USERNAME').':'.env('DB_PASSWORD').'@'.env('DB_HOST').'/'.env('DB_DATABASE'),
    'encryption_key' => env('APP_KEY'),
    'sandbox' => env('QBO_SANDBOX'),
    'token' => env('QB_TOKEN'),
    'oauth_consumer_key' => env('QB_OAUTH_CONSUMER_KEY'),
    'oauth_consumer_secret' => env('QB_OAUTH_CONSUMER_SECRET'),
    'quickbooks_oauth_url' => env('QB_OAUTH_URL'),
    'quickbooks_success_url' => env('QB_SUCCESS_URL'),
    'the_username' => env('QB_USERNAME'),
    'the_tenant' => env('QB_TENANT')

];
