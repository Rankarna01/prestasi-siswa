<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class NotifikasiController extends Controller
{
    public function index()
    {
        // Mengambil notifikasi user yang sedang login, urut dari yang terbaru
        $notifikasis = auth()->user()->notifications()->paginate(10);
        return view('admin.notifikasi.index', compact('notifikasis'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        
        // Jika notifikasi memiliki link (misal: link ke halaman edit data ditolak)
        if (isset($notification->data['url'])) {
            return redirect($notification->data['url']);
        }

        return back();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi telah ditandai dibaca.');
    }

    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();
        return back()->with('success', 'Notifikasi berhasil dihapus.');
    }
}
