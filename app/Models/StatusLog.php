namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusLog extends Model
{
    protected $fillable = ['pedido_id', 'status', 'changed_at'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
