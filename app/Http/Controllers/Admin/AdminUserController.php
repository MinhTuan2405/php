<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
// added
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AdminUserController extends Controller {
    public function index(Request $request)
    {
        $users = User::query()
            ->orderByRaw("CASE WHEN role = 'Admin' THEN 0 ELSE 1 END") // Admin first
            ->orderBy('id', 'asc') // then by id (change to 'asc' if needed)
            ->get();

        $selectedUser = null;

        if ($request->filled('user_id')) {
            $selectedUser = $users->firstWhere('id', (int)$request->user_id);
        } else {
            $selectedUser = $users->first();
        }

        return view('admin.users.index', compact('users', 'selectedUser'));
    }

    public function edit(User $user) {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'is_admin' => 'nullable|boolean',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            DB::beginTransaction();

            $user->name = $data['name'];
            $user->role = !empty($data['is_admin']) && $data['is_admin'] ? 'Admin' : 'User';

            $passwordChanged = false;
            if ($request->filled('password')) {
                $user->password = Hash::make($data['password']);
                $user->remember_token = Str::random(60);
                event(new PasswordReset($user));
                $passwordChanged = true;
            }

            $user->save();
            DB::commit();

            return redirect()
                ->route('admin.users.edit', $user)
                ->with('success', $passwordChanged
                    ? 'Cập nhật người dùng & mật khẩu thành công.'
                    : 'Cập nhật người dùng thành công.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('User update failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['general' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }

    public function destroy(User $user) {
        if (auth()->id() === $user->id) {
            return back()->with('success','Cannot delete yourself.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','Deleted.');
    }

    public function exportCsv()
    {
        $users = User::all();
        $csvFileName = 'users_emails_' . date('Y-m-d') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($users) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Created At']); // Header Row

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id, 
                    $user->name, 
                    $user->email, 
                    $user->created_at
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
