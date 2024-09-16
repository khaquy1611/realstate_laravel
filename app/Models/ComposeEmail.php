<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComposeEmail extends Model
{
    use HasFactory;
    protected $table = 'compose_email';

    static public function getRecord() {
        $resultQuery = self::select('compose_email.*')
                    ->orderBy('id', 'desc');
        $resultQuery = $resultQuery->paginate(2);
        return $resultQuery;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}