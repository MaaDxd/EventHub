<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Muestra la página principal de ayuda
     */
    public function index()
    {
        return view('help.index');
    }

    /**
     * Muestra la guía para usuarios
     */
    public function userGuide()
    {
        return view('help.user-guide');
    }

    /**
     * Muestra la guía para creadores
     */
    public function creatorGuide()
    {
        return view('help.creator-guide');
    }

    /**
     * Muestra la guía para administradores
     */
    public function adminGuide()
    {
        return view('help.admin-guide');
    }

    /**
     * Muestra las preguntas frecuentes
     */
    public function faq()
    {
        return view('help.faq');
    }

    /**
     * Muestra información de contacto y soporte
     */
    public function contact()
    {
        return view('help.contact');
    }
} 