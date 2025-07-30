@extends('layouts.app')

@section('content')
<style>
    .contact-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
        color: white;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        padding: 0;
    }
    .contact-section {
        padding: 100px 0 60px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .contact-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 60% 40%, rgba(255,255,255,0.10) 0%, rgba(50, 0, 78, 0.25) 60%, rgba(26, 0, 70, 0.7) 100%);
        z-index: 1;
    }
    .contact-section > .container {
        position: relative;
        z-index: 2;
    }
    .contact-section h1 {
        font-size: 3.2rem;
        font-weight: 900;
        background: linear-gradient(90deg, #fff 30%, #FFD600 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: 0 6px 24px rgba(26,0,70,0.18);
        margin-bottom: 1.5rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }
    .contact-section p {
        font-size: 1.25rem;
        margin-bottom: 40px;
        color: rgba(255, 255, 255, 0.95);
        text-shadow: 0 2px 12px rgba(50,0,78,0.13);
    }
    .contact-info-box {
        max-width: 520px;
        margin: 0 auto;
        background: rgba(255,255,255,0.13);
        border-radius: 2rem;
        box-shadow: 0 12px 40px 0 rgba(26,0,70,0.22);
        padding: 3rem 2.2rem 2.2rem 2.2rem;
        backdrop-filter: blur(12px);
        border: 2px solid rgba(255,255,255,0.18);
        color: #fff;
        font-size: 1.13rem;
        transition: box-shadow 0.3s;
        position: relative;
        overflow: hidden;
    }
    .contact-info-box::after {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 120px;
        height: 120px;
        background: radial-gradient(circle, #FFD60033 0%, transparent 80%);
        z-index: 0;
    }
    .contact-info-box h2 {
        font-size: 2.1rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        color: #fff;
        letter-spacing: 1.2px;
        text-shadow: 0 2px 12px rgba(26,0,70,0.13);
        position: relative;
        z-index: 1;
    }
    .contact-info-box ul {
        list-style: none;
        padding: 0;
        margin: 0;
        position: relative;
        z-index: 1;
    }
    .contact-info-box li {
        margin-bottom: 1.3rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        font-size: 1.13rem;
        background: rgba(255,255,255,0.07);
        border-radius: 1rem;
        padding: 0.85rem 1.1rem;
        box-shadow: 0 2px 8px rgba(50,0,78,0.07);
        transition: background 0.2s;
    }
    .contact-info-box li:hover {
        background: rgba(255,255,255,0.18);
    }
    .contact-info-box i {
        font-size: 1.5rem;
        color: #FFD600;
        filter: drop-shadow(0 2px 6px #FFD60055);
    }
    .contact-info-box a {
        color: #fff;
        text-decoration: underline;
        transition: color 0.2s;
        word-break: break-all;
    }
    .contact-info-box a:hover {
        color: #FFD600;
    }
</style>
<div class="contact-bg">
    <div class="contact-section">
        <div class="container">
            <h1>Contacto</h1>
            <p>¿Tienes dudas, sugerencias o quieres colaborar? ¡Contáctanos a través de los siguientes medios!</p>
            <div class="contact-info-box">
                <h2>Información de contacto</h2>
                <ul>
                    <li><i class="bi bi-envelope-fill"></i> Email: <a href="mailto:eventhub@soporte.com">eventhub@soporte.com</a></li>
                    <li><i class="bi bi-telephone-fill"></i> Teléfono: <a href="tel:+34123456789">+34 123 456 789</a></li>
                    <li><i class="bi bi-geo-alt-fill"></i> Dirección: Calle Ficticia 123, Ciudad, País</li>
                    <li><i class="bi bi-instagram"></i> Instagram: <a href="https://instagram.com/eventhub" target="_blank">@eventhub</a></li>
                    <li><i class="bi bi-facebook"></i> Facebook: <a href="https://facebook.com/eventhub" target="_blank">/eventhub</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
