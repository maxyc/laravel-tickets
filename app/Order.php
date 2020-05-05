<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Order
 *
 * @property int $id
 * @property string $title
 * @property string $note
 * @property string|null $file
 * @property string $status
 * @property int $is_read
 * @property int $has_answer
 * @property int $owner_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereFile($value)
 * @method static Builder|Order whereHasAnswer($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereIsRead($value)
 * @method static Builder|Order whereNote($value)
 * @method static Builder|Order whereOwnerId($value)
 * @method static Builder|Order whereStatus($value)
 * @method static Builder|Order whereTitle($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_CLOSED = 'close';

    public const PERMISSION_LIST = 'order list';
    public const PERMISSION_VIEW = 'order view';
    public const PERMISSION_VIEW_ANY = 'order view any';
    public const PERMISSION_CREATE = 'order create';
    public const PERMISSION_UPDATE = 'order update';
    public const PERMISSION_UPDATE_ANY = 'order update any';
    public const PERMISSION_DELETE = 'order delete';
    public const PERMISSION_DELETE_ANY = 'order delete any';

    protected $fillable = [
        'title',
        'note',
        'file',
        'status',
        'is_read',
        'has_answer',
        'owner_id',
    ];

    public static function getAvailableStatuses(): array
    {
        return [
            static::STATUS_NEW,
            static::STATUS_APPROVED,
            static::STATUS_CLOSED
        ];
    }

    public function getCountMessagesAttribute(): int
    {
        return $this->messages()->count();
    }

    public function messages()
    {
        return $this->hasMany(OrderMessage::class)->orderBy('created_at', 'desc');
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function isNew()
    {
        return $this->status === static::STATUS_NEW;
    }

    public function isApproved()
    {
        return $this->status === static::STATUS_APPROVED;
    }

    public function isClosed()
    {
        return $this->status === static::STATUS_CLOSED;
    }
}
