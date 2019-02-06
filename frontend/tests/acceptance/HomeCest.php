<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    /*public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('My Application');

        $I->seeLink('About');
        $I->click('About');
        $I->wait(2); // wait for page to be opened

        $I->see('This is the About page.');
        $I->click('Contact');
        $I->wait(2); // wait for page to be opened
        $I->click('Login');
        $I->wait(2); // wait for page to be opened
    }
    */
    public function checkOneTaskComments(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('My Application');
        $I->seeLink('Tasks');
        $I->click(['link' => 'Tasks']);
        //$I->amOnPage(Url::toRoute('/site/index.php?r=task'));
        //$I->see('Tasks');
        $I->seeElement('.task-preview-link');
        $I->click(['class' => 'task-preview-link']);
        $I->seeElement('.task-edit');
        $I->seeElement('.task-history');
        $I->submitForm('#w2', array('TaskComments' => array(
            'content' => 'Приступить к выполнению',
        )));
    }

    public function checkOneTaskCreate(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('My Application');
        $I->seeLink('Tasks');
        $I->click(['link' => 'Tasks']);
        $I->seeLink('Create Tasks');
        $I->click(['link' => 'Create Tasks']);
        $I->seeElement('.tasks-create');
        $I->submitForm('#w0', array('Tasks' => array(
            'name' => 'Помой посуду',
            'date' => '2019-02-15',
            'description' => 'И про сковородку не забудь!',
            'responsible_id' => '1',
        )));
    }
}
