<?php
declare(strict_types=1);

namespace App\Models;

use App\Services\ReferralPaymentService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kyslik\ColumnSortable\Sortable;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $payment_id
 * @property string $full_amount
 * @property string $amount
 * @property string $commission_amount
 * @property string $new_balance
 * @property string $old_balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCommissionAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFullAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereNewBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOldBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Payment|null $payment
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction sortable($defaultParameters = null)
 * @method static \Database\Factories\TransactionFactory factory(...$parameters)
 */
class Transaction extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'payment_id',
        'full_amount',
        'amount',
        'commission_amount',
        'new_balance',
        'old_balance',
    ];

    public $sortable = [
        'id',
        'created_at',
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->payment->user->balance = number_format((float)$model->new_balance, 8, '.', '');
            $model->payment->user->save();

            $referralPaymentService = app(ReferralPaymentService::class);

            $referralPaymentService->handle($model);
        });
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }
}
