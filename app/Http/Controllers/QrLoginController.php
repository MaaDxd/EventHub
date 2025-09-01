<?php
// app/Http/Controllers/ProfileController.php (o donde tengas el método show)

namespace App\Http\Controllers;

use App\Models\QrLoginToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QrLoginController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        
        // Generar QR para login (opcional, solo si se solicita)
        $qrCode = null;
        $token = null;
        
        if ($request->has('generate_qr') || $request->get('show_qr')) {
            // Generar token único
            $token = Str::random(32);
            
            // Crear registro en base de datos
            QrLoginToken::create([
                'token' => $token,
                'user_id' => $user->id, // Asociar con el usuario actual
                'is_used' => false,
                'expires_at' => Carbon::now()->addMinutes(5)
            ]);

            // Generar URL de verificación
            $verifyUrl = route('qr.verify', ['token' => $token]);
            Log::info('URL de verificación generada: ' . $verifyUrl);

            // Generar código QR
            $qrCode = QrCode::size(300)
                ->format('svg')
                ->backgroundColor(255, 255, 255)
                ->color(0, 0, 0)
                ->margin(1)
                ->errorCorrection('H')
                ->generate($verifyUrl);
            Log::info('URL para verificación QR: ' . $verifyUrl);
            Log::info('QR generado correctamente: ' . $qrCode);

            // Verificar que el QR se generó correctamente
            if (empty($qrCode)) {
                Log::error('Error al generar el código QR');
            } else {
                Log::info('QR generado correctamente: ' . substr($qrCode, 0, 100) . '...');
            }
        }

        // Asegurarse de que las variables se pasen correctamente a la vista
        Log::info('Pasando a la vista - Token: ' . ($token ?? 'null') . ', QR Code: ' . (isset($qrCode) ? 'generado' : 'null'));
        return view('profile.show', [
            'user' => $user,
            'qrCode' => $qrCode,
            'token' => $token
        ]);
    }
    
    // Mantener los métodos de QR aquí también
    public function verifyQr($token)
    {
        $qrToken = QrLoginToken::where('token', $token)->first();

        if (!$qrToken || !$qrToken->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'Token inválido o expirado'
            ], 400);
        }

        // Automatically authenticate the user associated with the token
        $user = $qrToken->user;
        if ($user) {
            // Mark token as used
            $qrToken->update(['is_used' => true]);

            // Log in the user
            Auth::login($user);

            // Redirect to welcome page
            return redirect()->route('welcome')->with('success', '¡Inicio de sesión exitoso mediante código QR!');
        }

        return response()->json([
            'success' => false,
            'message' => 'Usuario no encontrado'
        ], 400);
    }


}