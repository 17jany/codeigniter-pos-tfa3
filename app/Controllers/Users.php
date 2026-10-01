<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $data = [
            'title' => 'User Accounts',
            'users' => $userModel->findAll(),
        ];

        return view('templates/header', $data)
            . view('users/index', $data)
            . view('templates/footer');
    }

    public function new()
    {
        helper('form');

        $data = [
            'title' => 'New User',
        ];

        return view('templates/header', $data)
            . view('users/new', $data)
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        $rules = [
            'username' => [
                'rules'  => 'required|max_length[50]|is_unique[users.username]',
                'errors' => [
                    'required'   => 'Username is required.',
                    'max_length' => 'Username cannot exceed 50 characters.',
                    'is_unique'  => 'This username is already in use.',
                ],
            ],
            'full_name' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Full name is required.',
                    'max_length' => 'Full name cannot exceed 100 characters.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $userModel->insert([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/users')
            ->with('success', 'User added successfully.');
    }

    public function edit(int $id)
    {
        helper('form');

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound(
                'User account not found.'
            );
        }

        $data = [
            'title' => 'Edit User',
            'user'  => $user,
        ];

        return view('templates/header', $data)
            . view('users/edit', $data)
            . view('templates/footer');
    }

    public function update(int $id)
    {
        helper('form');

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound(
                'User account not found.'
            );
        }

        $rules = [
            'username' => [
                'rules' => 'required|max_length[50]'
                    . '|is_unique[users.username,id,' . $id . ']',
                'errors' => [
                    'required'   => 'Username is required.',
                    'max_length' => 'Username cannot exceed 50 characters.',
                    'is_unique'  => 'This username is already in use.',
                ],
            ],
            'full_name' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Full name is required.',
                    'max_length' => 'Full name cannot exceed 100 characters.',
                ],
            ],
        ];

        $avatar = $this->request->getFile('avatar');
        $hasNewAvatar = $avatar !== null
            && $avatar->getError() !== UPLOAD_ERR_NO_FILE;

        if ($hasNewAvatar) {
            $rules['avatar'] = [
                'rules' => 'uploaded[avatar]'
                    . '|max_size[avatar,2048]'
                    . '|is_image[avatar]'
                    . '|mime_in[avatar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Please select an avatar image.',
                    'max_size' => 'The avatar must not exceed 2 MB.',
                    'is_image' => 'The uploaded file must be a valid image.',
                    'mime_in'  => 'Only JPG and PNG images are allowed.',
                ],
            ];
        }
        

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $updatedData = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];

        if ($hasNewAvatar && $avatar->isValid()) {
            $uploadPath = FCPATH
                . 'uploads'
                . DIRECTORY_SEPARATOR
                . 'avatars';

            $newName = $avatar->getRandomName();
            $temporaryName = 'original_' . $newName;

            $avatar->move($uploadPath, $temporaryName);

            $temporaryPath = $uploadPath
                . DIRECTORY_SEPARATOR
                . $temporaryName;

            $preparedPath = $uploadPath
                . DIRECTORY_SEPARATOR
                . $newName;

            service('image')
                ->withFile($temporaryPath)
                ->fit(300, 300, 'center')
                ->save($preparedPath);

            if (is_file($temporaryPath)) {
                unlink($temporaryPath);
            }

            if (! empty($user['avatar'])) {
                $oldAvatarPath = $uploadPath
                    . DIRECTORY_SEPARATOR
                    . $user['avatar'];

                if (is_file($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }

            $updatedData['avatar'] = $newName;
        }

        $userModel->update($id, $updatedData);

        return redirect()->to('/users')
            ->with('success', 'User updated successfully.');
    }
}