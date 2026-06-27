<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'subject',
        'email',
        'message',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'subject' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email',
        'message' => 'required'
    ];

    protected $validationMessages = [
        'subject' => [
            'required' => 'Subject is required.',
            'min_length' => 'Subject must be at least 3 characters.',
            'max_length' => 'Subject cannot exceed 100 characters.'
        ],
        'email' => [
            'required' => 'Email is required.',
            'valid_email' => 'Please enter a valid email address.'
        ],
        'message' => [
            'required' => 'Message is required.'
        ]
    ];
}
