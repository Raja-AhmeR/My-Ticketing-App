<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

function getAllPermissions() {
    $roleArray = Auth::user()->role->first();
    // dd($roleArray);
    // dd($roleArray->permissions->pluck('name')->toArray());
    return $roleArray->permissions->pluck('name','name')->toArray();

    // dd($fetchRole);
    // dd(Arr::($fetchRole, 'admin.new-agent'));
}

function getRoleChecked ($role) {

    return $role->permissions->pluck('id','id')->toArray();

}
