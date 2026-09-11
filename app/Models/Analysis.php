<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    use HasFactory;

    protected $table = 'analyses';

    protected $fillable = [
        'incident_code',
        'video_name',
        'status',
        'accuracy',
        'location',
        'camera_id',
        'details',
    ];

    protected $casts = [
        'accuracy'   => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ============ Scope ============

    public function scopeShoplifting($query)
    {
        return $query->where('status', 'Shoplifting');
    }

    public function scopeNormal($query)
    {
        return $query->where('status', 'Normal');
    }

    public function scopeByCamera($query, $cameraId)
    {
        return $query->where('camera_id', $cameraId);
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', $location);
    }

    public function scopeHighAccuracy($query, $min = 80)
    {
        return $query->where('accuracy', '>=', $min);
    }

    // ============ Accessor ============

    public function getIsShopliftingAttribute(): bool
    {
        return strtolower($this->status) === 'shoplifting';
    }

    public function getAccuracyLabelAttribute(): string
    {
        if ($this->accuracy >= 90) return 'Sangat Akurat';
        if ($this->accuracy >= 75) return 'Akurat';
        if ($this->accuracy >= 50) return 'Cukup';
        return 'Rendah';
    }

    public function getStatusBadgeAttribute(): string
    {
        return $this->is_shoplifting
            ? '<span class="badge bg-danger">Shoplifting</span>'
            : '<span class="badge bg-success">Normal</span>';
    }
}