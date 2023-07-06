<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\GroupModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use Myth\Auth\Password;
use ReflectionException;

class Users extends BaseController
{
    protected UserModel $userModel;
    protected GroupModel $groupModel;
    protected $config;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
        $this->config = config('Auth');
    }

    public function index(): string
    {
        $data = [
            'title' => 'User Management',
            'users' => $this->userModel->findAll(),
            'groups' => $this->groupModel->findAll(),
        ];
        foreach ($data['users'] as &$user) {
            $user->groups = $this->groupModel->getGroupsForUser($user->id);
        }
        return view('users/index', $data);
    }

    public function store(){
        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required',
            'pass_confirm' => 'required|matches[password]',
        ];

        if(!$this->validate($rules)){
            return $this->response->setJSON([
               'status' => 'error',
               'message' => "Gagal, silahkan periksa lagi",
               'errors' => $this->validator->getErrors()
            ]);
        }

        $allowedPostFields = array_merge(['password'], $this->config->validFields);
        $user = new User($this->request->getVar($allowedPostFields));
        $user->activate();

        if (!$this->userModel->withGroup($this->request->getVar('user_role'))->protect(false)->save($user)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => "Gagal, silahkan periksa lagi",
                'errors' => $this->userModel->errors()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => "Berhasil",
            'data' => $this->response->getJSON()
        ]);
    }

    public function destroy(): ResponseInterface
    {
        $id = $this->request->getVar('id');
        if(!$this->userModel->delete($id)){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus data'
            ]);
        }
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Berhasil menghapus data'
        ]);
    }

    /**
     * @throws ReflectionException
     */
    public function activate(): ResponseInterface
    {
        $id = $this->request->getVar('id');
        $active = $this->request->getVar('active');
        $this->userModel->update($id, ['active' => $active]);
        $status = ($active == '1') ? 'mengaktifkan' : 'menonaktifkan';
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Berhasil ' . $status . ' user',
        ]);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail User',
            'user' => $this->userModel->find($id),
            'groups' => $this->groupModel->findAll(),
        ];

        $data['user']->groups = $this->groupModel->getGroupsForUser($data['user']->id);
//        dd($data['user']->groups);
        return view('users/view', $data);
    }

    //update role
    public function updateRole($id)
    {
        $user = $this->userModel->find($id);
        $this->groupModel->removeUserFromAllGroups($id);
        $this->groupModel->addUserToGroup($id, $this->request->getVar('role'));
        session()->setFlashdata('message', 'User role has been changed');
        return redirect()->back();
    }

    //update email
    public function updateEmail($id)
    {
        $user = $this->userModel->find($id);
        $this->userModel->update($id, ['email' => $this->request->getVar('email')]);
        session()->setFlashdata('message', 'User email has been changed');
        return redirect()->back();
    }

    public function updatePassword($id)
    {
        $rules = [
            'new_password' => 'required|strong_password',
            'confirm_password' => 'required|matches[new_password]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'password_hash' => Password::hash($this->request->getVar('new_password')),
            'reset_hash' => null,
            'reset_at' => null,
            'reset_expires' => null,
        ];
        $this->userModel->update($id, $data);

        session()->setFlashdata('message', 'Password telah direset.');
        return redirect()->back();
    }

}
