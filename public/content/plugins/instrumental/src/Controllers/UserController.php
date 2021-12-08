<?php

namespace Instrumental\Controllers;

//use OProfile\Models\DeveloperTechnologyModel;
//use OProfile\Models\ProjectDeveloperModel;
use WP_Query;

class UserController extends CoreController
{

    public function getProfile()
    {
        $query = new WP_Query([
            'author' => get_current_user_id(),
            'post_type' => 'profile-teacher'

        ]);

        $profile = $query->post;

        return $profile;
    }

    public function home()
    {
        $this->show('views/user-home.view');
        //$this->show('views/teacher-home.view');
    }

    /*

    public function instruments()
    {
        // récupération de l'utilisateur courant
        $currentUser = wp_get_current_user();
        $userId = $currentUser->ID;

        // nous devons récupérer toutes les lignes correspondant au niveau de maitrise de l'utilisateur courant
        $developerTechnologyModel = new DeveloperTechnologyModel();
        $technologiesLevels = $developerTechnologyModel->getByDeveloperId($userId);

        $this->show('views/user-skills.view', [
            'technologiesLevels' => $technologiesLevels
        ]);
    }


    public function confirmDeleteAccount()
    {

        // si l'utilisateur n'est pas connecté, nous affichons une page d'erreur avec l'entête http "forbidden"
        if(!$this->isConnected()) {


            header("EasterEgg: Hello wonderland");

            header("HTTP/1.1 403 Forbidden");
            // BONUS il es possible de faire http_response_code(403);
            $this->show('views/user-forbidden');
        }
        else {
            $this->show('views/user-confirm-delete-account.view');
        }
    }


    public function updateForm()
    {

        // si l'utilisateur n'est pas connecté, nous affichons une page d'erreur avec l'entête http "forbidden"
        if(!$this->isConnected()) {


            // BONUS E10 header il est possible de faire
            header("HTTP/1.1 403 Forbidden"); // équivalent à http_response_code(403);
            header("EasterEgg: Hello wonderland");


            $this->show('views/user-forbidden');
        }
        else {


            $profile = $this->getProfile();

            $this->show('views/user-update-form.view', [
                'profile' => $profile
            ]);
        }
    }

    public function updateSkills()
    {

        // Récupération des données envoyées depuis le formulaire de selectection des niveaux de maitrise des différentes technologies

        // TODO vérifier la validité des données envoyées dans $technologiesLevels
        $technologiesLevels = $_POST['technologiesLevels'];

        // récupération de l'utilisateur courant
        $currentUser = wp_get_current_user();
        $userId = $currentUser->ID;

        // nous devons supprimer toutes les lignes de la table developer_technology pour l'utilisateur courant
        $developerTechnologyModel = new DeveloperTechnologyModel();
        $developerTechnologyModel->deleteByDeveloperId($userId);

        // pour chaque technologies, association de la technologie à l'utilisateur

        foreach($technologiesLevels as $termId => $level) {
            $developerTechnologyModel->insert(
                $userId,
                $termId,
                $level
            );
        }

        // redirection vers la page de gestion des compétences
        global $router;
        $skillURL = $router->generate('user-skills');

        header('Location: ' . $skillURL);
    }

    public function participateToProject($projectId)
    {
        // TODO vérifier que l'utilisateur est connecté et qu'il a le rôle developer

        $model = new ProjectDeveloperModel();
        $user = wp_get_current_user();
        $userId = $user->ID;

        $model->insert(
            $projectId,
            $userId
        );

        $url = get_post_type_archive_link('project');
        header('Location: ' . $url);
    }

    public function leaveProject($projectId)
    {
        $model = new ProjectDeveloperModel();
        $user = wp_get_current_user();
        $userId = $user->ID;

        $model->delete($projectId, $userId);

        $url = get_post_type_archive_link('project');
        header('Location: ' . $url);
    }
    */
}
