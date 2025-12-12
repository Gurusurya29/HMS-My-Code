<?php

return [

    'receipt_type' => [
        ['id' => 1, 'subtype' => 'OP', 'maintype' => 'HMS'],
        ['id' => 2, 'subtype' => 'IP', 'maintype' => 'HMS'],
        ['id' => 3, 'subtype' => 'OT', 'maintype' => 'HMS'],
        ['id' => 4, 'subtype' => 'Pharmacy', 'maintype' => 'Pharmacy'],
        ['id' => 5, 'subtype' => 'Lab', 'maintype' => 'Investigation'],
        ['id' => 6, 'subtype' => 'Scan', 'maintype' => 'Investigation'],
        ['id' => 7, 'subtype' => 'X-ray', 'maintype' => 'Investigation'],
    ],

    'receipt_type_supplier' => [
        ['id' => 1, 'subtype' => 'HMS', 'maintype' => 'HMS'],
        ['id' => 4, 'subtype' => 'Pharmacy', 'maintype' => 'Pharmacy'],
        ['id' => 5, 'subtype' => 'Lab', 'maintype' => 'Investigation'],
        ['id' => 6, 'subtype' => 'Scan', 'maintype' => 'Investigation'],
        ['id' => 7, 'subtype' => 'X-ray', 'maintype' => 'Investigation'],
    ],

    // for Billdiscount
    'bill_type' => [
        ['id' => 1, 'subtype' => 'OP', 'maintype' => 'HMS'],
        ['id' => 2, 'subtype' => 'IP', 'maintype' => 'HMS'],
        ['id' => 3, 'subtype' => 'OT', 'maintype' => 'HMS'],
        ['id' => 4, 'subtype' => 'Pharmacy', 'maintype' => 'Pharmacy'],
        ['id' => 5, 'subtype' => 'Lab', 'maintype' => 'Investigation'],
        ['id' => 6, 'subtype' => 'Scan', 'maintype' => 'Investigation'],
        ['id' => 7, 'subtype' => 'X-ray', 'maintype' => 'Investigation'],
    ],

    'discount_type' => [
        1 => 'Bill Discount',
        2 => 'Bill Cancel',
    ],

    'asset_condition' => [
        1 => 'Working',
        2 => 'Not Used',
        3 => 'Broken',
        4 => 'Damaged',
        5 => 'Stolen',
        6 => 'Missing',
        7 => 'Need Replacement',
        8 => 'Sent for repair',
    ],

    'gender' => [
        1 => 'Male',
        2 => 'Female',
        3 => 'Other',
    ],
    'marital_status' => [
        1 => 'Married',
        2 => 'Un Married',
    ],
    'patient_visittype' => [
        1 => 'New',
        2 => 'Review',
        3 => 'Follow-up',
    ],
    'pain_scale' => [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 8,
        9 => 9,
        10 => 10,
    ],
    'blood_group' => [
        1 => 'O +',
        2 => 'O -',
        3 => 'A +',
        4 => 'A -',
        5 => 'B +',
        6 => 'B -',
        7 => 'AB +',
        8 => 'AB -',
    ],
    'visit_category' => [
        1 => 'OP',
        2 => 'IP',
        // 3 => 'Causality',
    ],
    'salutation' => [
        1 => 'Mr',
        2 => 'Ms',
        3 => 'Mrs',
        4 => 'Miss',
        5 => 'Master',
        6 => 'Baby',
        7 => 'Dr',
    ],
    'payment_type' => [
        1 => 'Bill Payment',
        2 => 'Advance',
    ],
    'modeofpayment' => [
        1 => 'Cash',
        2 => 'Card',
        3 => 'Online',
        4 => 'Cheque',
        5 => 'DD',
        6 => 'Others',
        7 => 'Gpay',
        8 => 'Paytm',
    ],

    'relationship' => [
        1 => 'Father',
        2 => 'Mother',
        3 => 'Son',
        4 => 'Daughter',
        5 => 'Brother',
        6 => 'Sister',
        7 => 'Spouse',
        8 => 'Guardian',
        9 => 'Grandfather',
        10 => 'Grandmother',
        11 => 'Uncle',
        12 => 'Aunty',
        13 => 'Friend',
        14 => 'Others',
    ],

    'doctor_type' => [
        0 => 'Other',
        1 => 'Permanent',
        2 => 'Consultant',
    ],

    'ward_category' => [
        1 => 'Ward',
        2 => 'OT',
        3 => 'Casuality',
    ],

    'approval_status' => [
        1 => 'Approved',
        2 => 'Rejected',
        3 => 'Pending',
        4 => 'In Progress',
    ],

    'payment_to' => [
        1 => 'Patient',
        2 => 'Employee',
        3 => 'Supplier',
        4 => 'Other',
    ],

    'payment_reason' => [
        1 => 'Advance',
        2 => 'Salary',
        3 => 'Refund',
        4 => 'Supplier Payment',
        5 => 'Commission',
        6 => 'Wages',
        7 => 'Conveyance',
        8 => 'Reimbursement',
        9 => 'Gift or Reward',
        10 => 'Bonus',
        11 => 'Consultant Charges',
        12 => 'Fee',
        13 => 'Others',
    ],

// investigation
    'labinvestigationtype' => [
        1 => 'Lab',
        2 => 'Scan',
        3 => 'X-Ray',
    ],

    'pharmacyrole' => [
        'user' => 'User',
        'admin' => 'Admin',
        'superadmin' => 'Super Admin',
    ],

    //  investigationrole,
    'investigationrole' => [
        'user' => 'user',
        'admin' => 'admin',
        'superadmin' => 'superadmin',
    ],
];
