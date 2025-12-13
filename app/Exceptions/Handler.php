
use Illuminate\Support\Facades\Log;

public function render($request, Throwable $e)
{
    Log::critical('ERROR APLIKASI', [
        'url' => $request->fullUrl(),
        'message' => $e->getMessage(),
    ]);

    return parent::render($request, $e);
}
