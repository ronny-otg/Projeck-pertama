<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Memberitahu model ini untuk menggunakan tabel 'transaksis'.
     */
    protected $table = 'transaksis';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id', 'amount', 'type', 'category', 'transaction_date', 'description',
    ];
}
