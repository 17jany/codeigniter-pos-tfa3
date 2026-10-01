<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();

        $data = [
            'title'     => 'Customer Accounts',
            'customers' => $customerModel->findAll(),
        ];

        return view('templates/header', $data)
            . view('customers/index', $data)
            . view('templates/footer');
    }

    public function new()
    {
        helper('form');

        $data = [
            'title' => 'New Customer',
        ];

        return view('templates/header', $data)
            . view('customers/new', $data)
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        $rules = $this->customerValidationRules();

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $customerModel = new CustomerModel();

        $customerModel->insert([
            'full_name'  => $this->request->getPost('full_name'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/customers')
            ->with('success', 'Customer added successfully.');
    }

    public function edit(int $id)
    {
        helper('form');

        $customerModel = new CustomerModel();
        $customer = $customerModel->find($id);

        if ($customer === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Customer record not found.'
            );
        }

        $data = [
            'title'    => 'Edit Customer',
            'customer' => $customer,
        ];

        return view('templates/header', $data)
            . view('customers/edit', $data)
            . view('templates/footer');
    }

    public function update(int $id)
    {
        helper('form');

        $customerModel = new CustomerModel();
        $customer = $customerModel->find($id);

        if ($customer === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Customer record not found.'
            );
        }

        $rules = $this->customerValidationRules();

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $customerModel->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ]);

        return redirect()->to('/customers')
            ->with('success', 'Customer updated successfully.');
    }

    private function customerValidationRules(): array
    {
        return [
            'full_name' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Full name is required.',
                    'max_length' => 'Full name cannot exceed 100 characters.',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required'    => 'Email address is required.',
                    'valid_email' => 'Please enter a valid email address.',
                    'max_length'  => 'Email address cannot exceed 100 characters.',
                ],
            ],
            'phone' => [
                'rules' => 'permit_empty|max_length[20]',
            ],
        ];
    }
}