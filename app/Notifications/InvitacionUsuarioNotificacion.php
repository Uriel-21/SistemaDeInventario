<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitacionUsuarioNotificacion extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $urlActivacion)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Bienvenido a Guantes Mena Tapia - Activa tu cuenta')
            ->greeting('Hola, ' . $notifiable->name)
            ->line('Un administrador ha dado de alta tu cuenta en el sistema.')
            ->line('Haz clic en el botón de abajo para crear tu contraseña y poder iniciar sesión:')
            ->action('Configurar mi contraseña', $this->urlActivacion)
            ->line('Por seguridad, este enlace tiene una vigencia de 24 horas.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
