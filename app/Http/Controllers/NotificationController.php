<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Menandai satu notifikasi spesifik sebagai 'sudah dibaca' berdasarkan ID notifikasi.
     *
     * @param string $id ID dari DatabaseNotification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRead($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (! $user) {
            return back();
        }

        $notification = $user->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        return back();
    }

    /**
     * Menandai semua notifikasi milik user yang sedang login sebagai 'sudah dibaca'.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAllAsRead()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (! $user) {
            return back();
        }

        $user->unreadNotifications->markAsRead();
        return back();
    }
}
