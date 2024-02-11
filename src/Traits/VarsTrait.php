<?php

namespace OsaEg\TapPayment\Traits;

trait VarsTrait
{
    protected $REQUIRED_CONFIG_VARS   = ['secret_api_Key' => true];
    protected $CONFIG_VARS            = ['secret_api_Key' => null];
    protected $CARD_VARS              = [
        'number'    => null,
        'exp_month' => null,
        'exp_year'  => null,
        'cvc'       => null,
        'name'      => null,
        'country'   => null,
        'line1'     => null,
        'city'      => null,
        'street'    => null,
        'avenue'    => null
    ];
    protected $REQUIRED_CUSTOMER_VARS = ['name'];
    protected $REQUIRED_CARD_VARS     = [
        'number'    => true,
        'exp_month' => true,
        'exp_year'  => true,
        'cvc'       => true
    ];
    protected $REQUIRED_CHARGE_VARS   = [
        'customer' => [
            'first_name'  => true,
            'middle_name' => false,
            'last_name'   => false,
            'email'       => false,
            'phone'       => [
                'country_code' => false,
                'number'       => false
            ]
        ],
        'address' => [
            'country' => false,
            'city'    => false,
            'line1'   => false,
            'ip'      => false
        ],
        'amount'               => true,
        'currency'             => true,
        'save_card'            => false,
        'threeDSecure'         => true,
        'description'          => true,
        'statement_descriptor' => false,
        'metadata'             => [
            'udf1' => false,
            'udf2' => false
        ],
        'reference' => [
            'transaction' => false,
            'order' => false
        ],
        'receipt' => [
            'email' => false,
            'sms' => false
        ],
        'merchant' => [
            'id' => false
        ],
        'source' => [
            'id' => false
        ],
        'post' => [
            'url' => true
        ],
        'redirect' => [
            'url' => true
        ]
    ];

    protected $CHARGE_VARS = [
        'customer' => [
            'first_name'  => null,
            'middle_name' => null,
            'last_name'   => null,
            'email'       => null,
            'phone'       => [
                'country_code' => null,
                'number'       => null
            ]
        ],
        'address' => [
            'country' => null,
            'city'    => null,
            'line1'   => null,
            'ip'      => null
        ],
        'amount'               => null,
        'currency'             => null,
        'save_card'            => 'false',
        'description'          => null,
        'threeDSecure'         => 'true',
        'statement_descriptor' => null,
        'metadata'             => [
            'udf1' => null,
            'udf2' => null
        ],
        'reference' => [
            'transaction' => null,
            'order' => null
        ],
        'receipt' => [
            'email' => 'true', 'sms' => 'true'
        ],
        'merchant' => [
            'id' => null
        ],
        'source' => [
            'id' => null
        ],
        'post' => [
            'url' => null
        ],
        'redirect' => [
            'url'
        ]
    ];

    protected $REFUND_VARS = [
        'charge_id' => null,
        'amount' => null,
        'currency' => null,
        'description' => null,
        'reason' => null,
        'reference' => [
            'merchant' => null
        ],
        'metadata' => [
            'udf1' => null,
            'udf2' => null,
        ],
        'post' => [
            'url' => null
        ]
    ];

    protected $REQUIRED_REFUND_VARS = [
        'charge_id' => true,
        'amount' => true,
        'currency' => true,
        'description' => false,
        'reason' => true,
        'reference' => [
            'merchant' => false
        ],
        'metadata' => [
            'udf1' => false,
            'udf2' => false,
        ],
        'post' => [
            'url' => true
        ]
    ];

    protected $CHARGES_FILTER = [
        'period' => [
            'date' => [
                'from' => 'null',
                'to' => 'null'
            ]
        ],
        'status' => 'null',
        'limit' => 24
    ];

    protected $REFUNDS_FILTER = [
        'period' => [
            'date' => [
                'from' => 'null',
                'to' => 'null'
            ]
        ],
        'limit' => 24
    ];

    protected $CHARGE_STATUS_LIST = [
        'INITIATED', 'ABANDONED', 'CANCELLED', 'FAILED', 'DECLINED', 'RESTRICTED', 'CAPTURED', 'VOID', 'TIMEDOUT', 'UNKNOWN'
    ];
}