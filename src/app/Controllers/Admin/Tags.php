<?php

namespace App\Controllers\Admin;

class Tags extends BaseController
{
    public function index()
    {
        $tags = model('TagModel')->orderBy('name', 'ASC')->findAll();

        return $this->adminView('tags', [
            'pageTitle' => 'Tags',
            'tags'      => $tags,
        ]);
    }

    public function store()
    {
        $name = $this->request->getPost('name');

        $rules = [
            'name' => 'required|min_length[2]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $slug = $this->request->getPost('slug') ?: url_title($name, '-', true);

        model('TagModel')->insert([
            'name'  => $name,
            'slug'  => $slug,
            'color' => $this->request->getPost('color'),
        ]);

        return redirect()->to('/admin/tags')->with('message', 'Tag created successfully.');
    }

    public function update(int $id)
    {
        $tag = model('TagModel')->find($id);

        if (!$tag) {
            return redirect()->back()->with('error', 'Tag not found.');
        }

        $rules = [
            'name' => 'required|min_length[2]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = $this->request->getPost('name');
        $slug = $this->request->getPost('slug') ?: url_title($name, '-', true);

        model('TagModel')->update($id, [
            'name'  => $name,
            'slug'  => $slug,
            'color' => $this->request->getPost('color'),
        ]);

        return redirect()->to('/admin/tags')->with('message', 'Tag updated successfully.');
    }

    public function delete(int $id)
    {
        $tag = model('TagModel')->find($id);

        if (!$tag) {
            return redirect()->back()->with('error', 'Tag not found.');
        }

        model('TagModel')->delete($id);

        return redirect()->to('/admin/tags')->with('message', 'Tag deleted successfully.');
    }
}
