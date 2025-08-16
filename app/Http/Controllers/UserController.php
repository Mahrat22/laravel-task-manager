<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');   // search text
        $filter = $request->query('filter');   // under_15 | above_15 | all

        $q = User::query();

        if (!empty($search)) {
            $q->where('name', 'like', "%{$search}%");
        }

        if ($filter === 'under_15') {
            $q->where('age', '<', 15);
        } elseif ($filter === 'above_15') {
            $q->where('age', '>', 15);
        } // 'all' or null => no extra filter

        $users = $q->orderBy('name')->paginate(12)->withQueryString();

        return view('users', [
            'users'  => $users,
            'search' => $search,
            'filter' => $filter ?? 'all',
        ]);
    }
}
