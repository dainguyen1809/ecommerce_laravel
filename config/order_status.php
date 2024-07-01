<?php

return [
    'order_status_admin' => [
        'pending' => [
            'status' => 'Pending',
            'detail' => 'Your order is currently pending',
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Processed and ready to ship',
            'detail' => 'Your package has been processed and will be with our delivery partner soon',
        ],
        'dropped_off' => [
            'status' => 'Dropped Off',
            'detail' => 'The seller has dropped off your package',
        ],
        'shipped' => [
            'status' => 'Shipped',
            'detail' => 'Your package has arrived at our logistics facility',
        ],
        'out_for_delivery' => [
            'status' => 'Out For Delivery',
            'detail' => 'Our delivery partner will attempt to deliver your package',
        ],
        'delivered' => [
            'status' => 'Deliveried',
            'detail' => 'Deliveried',
        ],
        'cancel' => [
            'status' => 'Canceled',
            'detail' => 'Canceled',
        ],
    ],
    'order_status_vendor' => [
        'pending' => [
            'status' => 'Pending',
            'detail' => 'Your order is currently pending',
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Processed and ready to ship',
            'detail' => 'Your package has been processed and will be with our delivery partner soon',
        ],
    ],
];