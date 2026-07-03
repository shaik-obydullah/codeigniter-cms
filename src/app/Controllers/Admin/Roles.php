<?php

namespace App\Controllers\Admin;

use App\Models\ActivityModel;

class Roles extends BaseController
{
    public function index()
    {
        $groups     = setting('AuthGroups.groups');
        $permissions = setting('AuthGroups.permissions');
        $matrix     = setting('AuthGroups.matrix');

        $groupCounts = [];
        foreach (array_keys($groups) as $group) {
            $groupCounts[$group] = model('UserModel')
                ->select('id')
                ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                ->where('auth_groups_users.group', $group)
                ->countAllResults();
        }

        return $this->adminView('roles', [
            'pageTitle'   => 'Roles & Permissions',
            'groups'      => $groups,
            'permissions'  => $permissions,
            'matrix'      => $matrix,
            'groupCounts'  => $groupCounts,
        ]);
    }

    public function update()
    {
        $matrix = $this->request->getPost('matrix');

        if ($matrix === null) {
            return redirect()->back()->with('error', 'No data received.');
        }

        $configPath = APPPATH . 'Config/AuthGroups.php';

        $content = file_get_contents($configPath);
        $newMatrix = var_export($matrix, true);
        $content = preg_replace(
            "/'matrix'\s*=>\s*\[.*?\],/s",
            "'matrix' => {$newMatrix},",
            $content
        );
        file_put_contents($configPath, $content);

        $this->activityModel->log(
            auth()->id(),
            'roles.updated',
            'Updated role permissions matrix',
            'roles',
            null
        );

        return redirect()->to('/dashboard/roles')->with('message', 'Permissions updated successfully.');
    }
}
