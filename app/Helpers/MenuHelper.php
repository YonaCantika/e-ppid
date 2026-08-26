<?php

namespace App\Helpers;

use App\Models\UserMenuPermission;
use Illuminate\Support\Facades\Cache;

class MenuHelper
{
    // ─── Definisi semua menu yang bisa dikontrol ───────────────────────────

    /**
     * Daftar menu yang dapat dikontrol untuk USER ADMIN.
     * Kunci: menu_key yang disimpan di DB.
     * Value: info tampilan.
     */
    public static function adminMenus(): array
    {
        return [
            'mytask' => [
                'label'         => 'My Task (Dashboard)',
                'icon'          => 'fas fa-chart-pie',
                'route_pattern' => 'admin',
                'url_path'      => '/admin',
            ],
            'permohonan' => [
                'label'         => 'Daftar Permohonan',
                'icon'          => 'fas fa-envelope-open-text',
                'route_pattern' => 'admin/view_permohonan',
                'url_path'      => '/admin/view_permohonan',
            ],
            'pemohon_list' => [
                'label'         => 'Daftar Pemohon',
                'icon'          => 'fas fa-users',
                'route_pattern' => 'admin/view_pemohon',
                'url_path'      => '/admin/view_pemohon',
            ],
        ];
    }

    /**
     * Daftar menu yang dapat dikontrol untuk USER PEMOHON.
     */
    public static function pemohonMenus(): array
    {
        return [
            'mytask_user' => [
                'label'         => 'My Task (Dashboard)',
                'icon'          => 'fas fa-tasks',
                'route_pattern' => 'user',
                'url_path'      => '/user',
            ],
            'permohonan_user' => [
                'label'         => 'Create Permohonan',
                'icon'          => 'fas fa-edit',
                'route_pattern' => 'user/view_permohonan',
                'url_path'      => '/user/view_permohonan',
            ],
        ];
    }

    // ─── Cek apakah menu DIBLOKIR ─────────────────────────────────────────

    /**
     * Cek apakah menu_key tertentu DIBLOKIR untuk user admin.
     * Return true  => diblokir (tidak boleh akses)
     * Return false => boleh akses (default)
     */
    public static function isAdminMenuBlocked(int $userId, string $menuKey): bool
    {
        return UserMenuPermission::where('user_id', $userId)
            ->where('user_type', 'admin')
            ->where('menu_key', $menuKey)
            ->exists();
    }

    /**
     * Cek apakah menu_key tertentu DIBLOKIR untuk user pemohon.
     */
    public static function isPemohonMenuBlocked(int $userId, string $menuKey): bool
    {
        return UserMenuPermission::where('user_id', $userId)
            ->where('user_type', 'pemohon')
            ->where('menu_key', $menuKey)
            ->exists();
    }

    /**
     * Ambil semua menu yang DIBLOKIR untuk user admin sebagai array of menu_key.
     */
    public static function getBlockedAdminMenus(int $userId): array
    {
        return UserMenuPermission::where('user_id', $userId)
            ->where('user_type', 'admin')
            ->pluck('menu_key')
            ->toArray();
    }

    /**
     * Ambil semua menu yang DIBLOKIR untuk pemohon sebagai array of menu_key.
     */
    public static function getBlockedPemohonMenus(int $userId): array
    {
        return UserMenuPermission::where('user_id', $userId)
            ->where('user_type', 'pemohon')
            ->pluck('menu_key')
            ->toArray();
    }

    // ─── Simpan / Update Permissions ──────────────────────────────────────

    /**
     * Simpan daftar menu yang DIBLOKIR untuk admin.
     * $blockedMenuKeys = array of menu_key yang ingin diblokir.
     * Menu yang tidak ada dalam array ini akan diizinkan (dibuka).
     */
    public static function saveAdminPermissions(int $userId, array $blockedMenuKeys): void
    {
        // Hapus semua setting lama untuk user ini
        UserMenuPermission::where('user_id', $userId)
            ->where('user_type', 'admin')
            ->delete();

        // Insert yang baru (yang diblokir)
        foreach ($blockedMenuKeys as $key) {
            if (array_key_exists($key, self::adminMenus())) {
                UserMenuPermission::create([
                    'user_id'   => $userId,
                    'user_type' => 'admin',
                    'menu_key'  => $key,
                ]);
            }
        }
    }

    /**
     * Simpan daftar menu yang DIBLOKIR untuk pemohon.
     */
    public static function savePemohonPermissions(int $userId, array $blockedMenuKeys): void
    {
        UserMenuPermission::where('user_id', $userId)
            ->where('user_type', 'pemohon')
            ->delete();

        foreach ($blockedMenuKeys as $key) {
            if (array_key_exists($key, self::pemohonMenus())) {
                UserMenuPermission::create([
                    'user_id'   => $userId,
                    'user_type' => 'pemohon',
                    'menu_key'  => $key,
                ]);
            }
        }
    }
}
