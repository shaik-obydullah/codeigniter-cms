<?php

namespace App\Controllers\Admin;

class Categories extends BaseController
{
    public function index()
    {
        $categories = model('CategoryModel')->orderBy('name', 'ASC')->findAll();

        return $this->adminView('categories', [
            'pageTitle'  => 'Categories',
            'categories' => $categories,
        ]);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[2]',
            'slug' => 'required|is_unique[categories.slug]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = $this->request->getPost('name');
        $slug = $this->request->getPost('slug') ?: url_title($name, '-', true);

        model('CategoryModel')->insert([
            'name'        => $name,
            'slug'        => $slug,
            'description' => $this->request->getPost('description'),
            'icon'        => $this->request->getPost('icon'),
        ]);

        $this->activityModel->log(
            auth()->id(),
            'category.created',
            'Created category ' . $this->request->getPost('name'),
            'categories',
            model('CategoryModel')->getInsertID()
        );

        return redirect()->to('/admin/categories')->with('message', 'Category created successfully.');
    }

    public function update(int $id)
    {
        $category = model('CategoryModel')->find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        $rules = [
            'name' => 'required|min_length[2]',
            'slug' => "required|is_unique[categories.slug,id,{$id}]",
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = $this->request->getPost('name');
        $slug = $this->request->getPost('slug') ?: url_title($name, '-', true);

        model('CategoryModel')->update($id, [
            'name'        => $name,
            'slug'        => $slug,
            'description' => $this->request->getPost('description'),
            'icon'        => $this->request->getPost('icon'),
        ]);

        $this->activityModel->log(
            auth()->id(),
            'category.updated',
            'Updated category ' . $category->name,
            'categories',
            $id
        );

        return redirect()->to('/admin/categories')->with('message', 'Category updated successfully.');
    }

    public function delete(int $id)
    {
        $category = model('CategoryModel')->find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        model('CategoryModel')->delete($id);

        $this->activityModel->log(
            auth()->id(),
            'category.deleted',
            'Deleted category ' . $category->name,
            'categories',
            $id
        );

        return redirect()->to('/admin/categories')->with('message', 'Category deleted successfully.');
    }
}
