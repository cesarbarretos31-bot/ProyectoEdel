<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use Config\Recaptcha;

class AuthController extends Controller
{
    public function registroForm()
    {
        return view('auth/registro'); // vista simple, captcha estará allí
    }

    public function registro()
    {
        helper(['form']);

        // Validación de reCAPTCHA
        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');

        $recaptchaConfig = new Recaptcha();
        $secret = $recaptchaConfig->secretKey;

        $verify = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptchaResponse}"
        );

        $captchaSuccess = json_decode($verify);

        if (!$captchaSuccess->success) {
            return redirect()->back()
                ->withInput()
                ->with('captcha_error', 'Captcha no válido');
        }

        // Reglas de validación del formulario
        $rules = [
            'nombre'           => 'required|min_length[3]',
            'correo'           => 'required|valid_email|is_unique[usuarios.correo]',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->validator);
        }

        $usuarioModel = new UsuarioModel();

        $usuarioModel->insert([
            'nombre'    => $this->request->getPost('nombre'),
            'correo'    => $this->request->getPost('correo'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'creado_en' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/registro')->with('success', 'Usuario registrado correctamente');
    }
}
