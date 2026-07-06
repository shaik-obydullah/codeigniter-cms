<?php

namespace App\Controllers\Admin;

class Skills extends BaseController
{
    public function index()
    {
        $skills = model('SkillModel')->orderBy('serial', 'ASC')->orderBy('name', 'ASC')->findAll();

        return $this->adminView('skills', [
            'pageTitle' => 'Skills',
            'skills'    => $skills,
        ]);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[2]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        model('SkillModel')->insert([
            'name'        => $this->request->getPost('name'),
            'icon'        => $this->request->getPost('icon'),
            'description' => $this->request->getPost('description'),
            'serial'      => $this->request->getPost('serial') ?? 0,
        ]);

        return redirect()->to('/dashboard/skills')->with('message', 'Skill created successfully.');
    }

    public function update(int $id)
    {
        $skill = model('SkillModel')->find($id);

        if (!$skill) {
            return redirect()->back()->with('error', 'Skill not found.');
        }

        $rules = [
            'name' => 'required|min_length[2]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        model('SkillModel')->update($id, [
            'name'        => $this->request->getPost('name'),
            'icon'        => $this->request->getPost('icon'),
            'description' => $this->request->getPost('description'),
            'serial'      => $this->request->getPost('serial') ?? 0,
        ]);

        return redirect()->to('/dashboard/skills')->with('message', 'Skill updated successfully.');
    }

    public function delete(int $id)
    {
        $skill = model('SkillModel')->find($id);

        if (!$skill) {
            return redirect()->back()->with('error', 'Skill not found.');
        }

        model('SkillModel')->delete($id);

        return redirect()->to('/dashboard/skills')->with('message', 'Skill deleted successfully.');
    }
}
