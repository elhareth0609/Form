<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\Permission;
use App\Models\Record;
use App\Models\Role;
use App\Models\Sim;
use App\Models\Station;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as LaravelFile;
use Yajra\DataTables\Facades\DataTables;

class DataTabelController extends Controller {

    public function users(Request $request) {
        $users = User::where('role_id',2)->get();
        if ($request->ajax()) {
            return DataTables::of($users)
            ->editColumn('id', function ($user) {
                return $user->id;
            })
            ->addColumn('name', function ($user) {
                return $user->fullname;
            })
            ->editColumn('email', function ($user) {
                return $user->email;
            })
            ->editColumn('phone', function ($user) {
                return $user->phone?? 'N/A';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($user) use ($request){
                // if ($request->has('trashed') && $request->trashed == 1) {
                //     return '
                //         <a href="javascript:void(0)" class="btn btn-icon btn-outline-warning" onclick="restoreUser(' . $user->id . ')"><i class="mdi mdi-backup-restore"></i></a>
                //         <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteUser(' . $user->id . ')"><i class="mdi mdi-delete-forever-outline"></i></a>
                //     ';
                // } else {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editUser(' . $user->id . ')"><i class="mdi mdi-pencil"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteUser(' . $user->id . ')"><i class="mdi mdi-trash-can"></i></a>
                    ';
                // }
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('content.dashboard.users.list');
    }

    public function records(Request $request) {
        $query = Record::query();

        // if ($request->has('type') && $request->type != 'all') {
        //     if ($request->type == 'active') {
        //         $query->where('status', 'active');
        //     } elseif ($request->type == 'inactive') {
        //         $query->where('status', 'inactive');
        //     }
        // }

        $records = $query->get();

        $ids = $records->pluck('id');
        if($request->ajax()) {
            return DataTables::of($records)
            ->editColumn('id', function ($record) {
                return (string) $record->id;
            })
            ->editColumn('user_id', function ($record) {
                return $record->user->full_name;
            })
            ->addColumn('full_name', function ($station) {
                return $station->full_name;
            })
            // ->editColumn('code', function ($station) {
            //     return $station->code;
            // })
            ->editColumn('status', function ($record) {
                if ($record->status == 'in progress') {
                    return '<span class="badge bg-secondary-subtle border border-secondary-subtle text-secondary-emphasis rounded-pill">'. __('Process') .'</span>';
                } else if ($record->status == 'accepted') {
                    return '<span class="badge bg-success-subtle border border-success-subtle text-success-emphasis rounded-pill">'. __('Accepted') .'</span>';
                } else if ($record->status == 'rejected') {
                    return '<span class="badge bg-danger-subtle border border-danger-subtle text-danger-emphasis rounded-pill">'. __('Rejected') .'</span>';
                } else {
                    return '<span class="badge bg-info-subtle border border-info-subtle text-info-emphasis rounded-pill">'. __('Unknown') .'</span>';
                }
            })
            // ->addColumn('sims', function ($station) {
            //     return $station->sims->count();
            // })
            ->editColumn('created_at', function ($record) {
                return $record->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($record) use ($request) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editRecord(' . $record->id . ')"><i class="mdi mdi-pencil"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteRecord(' . $record->id . ')"><i class="mdi mdi-trash-can"></i></a>
                    ';
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.records.list');
    }

    public function documents(Request $request) {
        $query = Document::query();

        if ($request->has('type') && $request->type != 'all') {
            if ($request->type == 'active') {
                $query->where('status', 'active');
            } elseif ($request->type == 'inactive') {
                $query->where('status', 'inactive');
            }
        }

        $documents = $query->get();

        $ids = $documents->pluck('id');
        if($request->ajax()) {
            return DataTables::of($documents)
            ->editColumn('id', function ($document) {
                return (string) $document->id;
            })
            ->editColumn('name', function ($document) {
                return $document->name;
            })
            ->editColumn('file', function ($document) { // link of file
                return '<a href="'. $document->documentUrl .'" class="text-primary" download><i class="mdi mdi-cloud-download-outline"></i></a>';
            })
            ->editColumn('status', function ($document) {
                if (Auth::user()->hasRole('admin')) {
                    if ($document->status == 'active') {
                        return '<span class="badge bg-success-subtle border border-success-subtle text-success-emphasis rounded-pill">'. __('Active') .'</span>';
                    } else {
                        return '<span class="badge bg-secondary-subtle border border-secondary-subtle text-secondary-emphasis rounded-pill">'. __('In Active') .'</span>';
                    }
                }
            })
            ->editColumn('created_at', function ($document) {
                return $document->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($document) use ($request) {
                if (Auth::user()->hasRole('admin')) {
                    return '
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editDocument(' . $document->id . ')"><i class="mdi mdi-pencil"></i></a>
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteDocument(' . $document->id . ')"><i class="mdi mdi-trash-can"></i></a>
                    ';
                }
            })
            ->rawColumns(['status','actions','file'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.documents.list');
    }

    public function transactions(Request $request) {
        $query = Transaction::query();

        if ($request->has('type') && $request->type != 'all') {
            if ($request->type == 'active') {
                $query->where('status', 'active');
            } elseif ($request->type == 'inactive') {
                $query->where('status', 'inactive');
            }
        }

        $transactions = $query->get();

        $ids = $transactions->pluck('id');
        if($request->ajax()) {
            return DataTables::of($transactions)
            ->editColumn('id', function ($transaction) {
                return (string) $transaction->id;
            })
            ->editColumn('user_id', function ($transaction) {
                return $transaction->user? $transaction->user->full_name : 'N/A';
            })
            ->editColumn('amount', function ($transaction) {
                return $transaction->amount;
            })
            ->editColumn('status', function ($transaction) {
                if ($transaction->status == 'active') {
                    return '<span class="badge bg-success-subtle border border-success-subtle text-success-emphasis rounded-pill">'. __('Active') .'</span>';
                } else {
                    return '<span class="badge bg-secondary-subtle border border-secondary-subtle text-secondary-emphasis rounded-pill">'. __('In Active') .'</span>';
                }
            })
            ->editColumn('created_at', function ($transaction) {
                return $transaction->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($transaction) use ($request) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editTransaction(' . $transaction->id . ')"><i class="mdi mdi-pencil"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteTransaction(' . $transaction->id . ')"><i class="mdi mdi-trash-can"></i></a>
                    ';
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.dashboard.transactions.list');
    }

    public function languages(Request $request) {
        $languages = [];
        foreach (config('language') as $locale => $language) {
            $languages[] = $locale;
        }

        if ($request->ajax()) {
            $words = [];

            foreach ($languages as $lang) {
                $jsonPath = resource_path("lang/{$lang}.json");

                if (LaravelFile::exists($jsonPath)) {
                    $translations = json_decode(LaravelFile::get($jsonPath), true);

                    foreach ($translations as $key => $translation) {
                        $words[$key][$lang] = $translation;
                    }
                }
            }

            $words = collect($words)->map(function ($translations, $word) use ($languages) {
                $row = ['word' => $word];
                foreach ($languages as $lang) {
                    $row[$lang] = $translations[$lang] ?? __('Not available');
                }
                return $row;
            });

            $id = 0;
            return DataTables::of($words)
            ->addColumn('id', function ($word) use (&$id) {
                return (string) ++$id;
            })
            ->addColumn('word', function ($word){
                return $word['word'];
            })
            ->addColumn('actions', function ($word) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editLanguage(\'' . addslashes($word['word']) . '\')"><i class="mdi mdi-pencil"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteLanguage(\'' . addslashes($word['word']) . '\')"><i class="mdi mdi-trash-can"></i></a>
                    ';
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('content.dashboard.languages.index')
            ->with('languages', $languages);
    }

    public function roles(Request $request) {
        $roles = Role::all();

        if ($request->ajax()) {
            return DataTables::of($roles)
            ->editColumn('id', function ($role) {
                return $role->id;
            })
            ->editColumn('name', function ($role) {
                return $role->name;
            })
            ->editColumn('guard_name', function ($role) {
                return $role->guard_name;
            })
            ->editColumn('created_at', function ($role) {
                return $role->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('actions', function ($role) {
                return '
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editRole(' . $role->id . ')"><i class="mdi mdi-pencil"></i></a>
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteRole(' . $role->id . ')"><i class="mdi mdi-trash-can"></i></a>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('content.dashboard.roles.index');
    }

    public function permissions(Request $request) {
        $permissions = Permission::all();

        if ($request->ajax()) {
            return DataTables::of($permissions)
            ->editColumn('id', function ($permission) {
                return $permission->id;
            })
            ->editColumn('name', function ($permission) {
                return $permission->name;
            })
            ->editColumn('guard_name', function ($permission) {
                return $permission->guard_name;
            })
            ->editColumn('created_at', function ($permission) {
                return $permission->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('actions', function ($permission) {
                return '
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editPermission(' . $permission->id . ')"><i class="mdi mdi-pencil"></i></a>
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deletePermission(' . $permission->id . ')"><i class="mdi mdi-trash-can"></i></a>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('content.dashboard.permissions.index');
    }

}
